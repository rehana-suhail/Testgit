<?php  
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
/*  
1: "die()" will exit the script and show an error statement if something goes wrong with the "connect" or "select" functions. 
2: A "mysql_connect()" error usually means your username/password are wrong  
3: A "mysql_select_db()" error usually means the database does not exist. 
*/ 
// Place db host name. Sometimes "localhost" but  
// sometimes looks like this: >>      ???mysql??.someserver.net 
$db_host = "localhost"; 
// Place the username for the MySQL database here 
$db_username = "root";  
// Place the password for the MySQL database here 
$db_pass = "";  
// Place the name for the MySQL database here 
$db_name = "myonlinestore"; 

// Run the actual connection here  
$con = mysqli_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql") ;
// or die ("could not connect to mysql");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()) or die ("no database");
}
else
{
mysqli_select_db($con,"$db_name") ;
//or die ("no database");
}             
?>