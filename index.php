<?php 
include("login.php");

if(!login::isLoggedin()){
	header('location: menu.html');
}else{
	header('location: afterlogin.html');
}

?>