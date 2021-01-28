<?php


//if user is already logged in, header that
if(isset($_SESSION["username"])){
	echo $_SESSION["username"];
	header("location:user.php?u=".$_SESSION["username"]);
	//exit();
}
?><?php
//ajax calls this login code to execute
if(isset($_POST["e"])){
	//connect to the database
	include_once "../storescripts/connect_to_mysql.php"; 
	//gather the posted data into local variables and sanitize
	$e=mysqli_real_escape_string($con,$_POST['e']);
	$p=md5($_POST['p']);
	//get user ip address
	$ip=preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	//form data error handling
	if($e=="" || $p==""){
		echo "login_failed";
		exit();
	} else{
		//end form data handling
		$sql="SELECT id, username, password FROM users WHERE email='$e' LIMIT 1";
		$query=mysqli_query($con,$sql);
		$row=mysqli_fetch_row($query);
		$db_id=$row[0];
		$db_username=$row[1];
		$db_pass_str=$row[2];
		if($p !=$db_pass_str){
			echo "login_failed";
			exit();
		}else {
			//create their sessions and cookies
			$_SESSION['userid']=$db_id;
			$_SESSION['username']=$db_username;
			$_SESSION['password']=$db_pass_str;
			setcookie("id",$db_id,strtotime('+30 days'),"/","","",TRUE);
			setcookie("user",$db_username,strtotime('+30 days'),"/","","",TRUE);
			setcookie("pass",$db_pass_str,strtotime('+30 days'),"/","","",TRUE);
			//update their ip and lastlogin fields
			$sql="UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			echo $db_username;
			exit();
		}
	}
	exit();
}
			
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../style/style.css">
<style type="text/css">
#loginform{
	margin-top:24px;
	margin-left: 12px;
}
#loginform > div{
	margin-top: 12px;
	
}
#loginform > input{
	width: 200px;
	padding: 3px;
	background: #F3F9DD;
}
#loginbtn{
	font-size: 15px;
	padding: 10px;
}
h3{
	margin: 0px;
	margin-left: 12px;
	}
</style>
<script src="../js/main.js"></script>
<script src="../js/ajax.js"></script>
<script>
function emptyElement(x){
	$(x).innerHTML="";
}
function login(){
	var e=$("email").value;
	var p=$("password").value;
	if(e=="" || p==""){
		$("status").innerHTML="Fill out all of the form data";
	} else{
		$("loginbtn").style.display="none";
		$("status").innerHTML='Please wait...';
		var ajax=ajaxObj("POST","../storeuser/login.php");
		ajax.onreadystatechange=function(){
			if(ajaxReturn(ajax)== true){
				if(ajax.responseText== "login_failed"){
					$("status").innerHTML="Login unsuccessful, Please try again.";
					$("loginbtn").style.display= "block";
				}else{
					window.location="user.php?u="+ajax.responseText;
				}
			}
		}
		ajax.send("e="+e+"&p="+p);
	}
}
		

</script>
</head>
<body>
<?php include_once("template_pageTop.php");?>
<div id="pageMiddle">
	<h3>Log In Here</h3>
	<form id="loginform" onsubmit="return false;">
		<div>Email Address:</div>
		<input type="text" id="email" onfocus="emptyElement('status')" maxlength="88">
		<div>Password:</div>
		<input type="password" id="password" onfocus="emptyElement('status')" maxlength="100">
		<br /><br />
		<button id="loginbtn" onclick="login()">Log In</button>
		<p id="status"></p>
		<a href="#">Forgot Your Password?</a>
	</form>
 
</div>
<?php include_once("template_pageBottom.php");?>
</body>
</html>