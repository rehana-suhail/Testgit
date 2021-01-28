function $(x){
	return document.getElementById(x);
}
function toggleElement(x){
	var x= $(x);
	if(x.style.display=='block'){
		x.style.display='none';
	}else{
	x.style.display='block';
	}
}