<?php
class login{
	public static function isLoggedin(){
		$db = mysqli_connect('localhost','root','', 'projectead');
		if(isset($_COOKIE['CID'])){
			
			$uid = strval($_COOKIE['CID']);
			
			$readUID = mysqli_query($db, "SELECT uid FROM token WHERE token = '$uid'");
			if ($readUID){
				
				return true;
			}
		}
		return false;
	}
}

?>