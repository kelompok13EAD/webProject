<?php 
if(isset($_POST['yes'])){
	if(isset($_COOKIE['CID'])){
		//connect Database
		$db = mysqli_connect('localhost','root','', 'projectead');
		$token = strval($_COOKIE['CID']);
		$read = mysqli_query($db, "SELECT uid FROM token WHERE token = '$token'");
		if ($row1 = mysqli_fetch_array($read)){
			$uid = strval($row1['uid']);
			mysqli_query($db, "DELETE FROM token WHERE uid = '$uid'");
			if(isset($_COOKIE['CID'])){
				unset($_COOKIE['CID']);
				setcookie('CID', '', time()-3600, '/');
				echo "<script type='text/javascript'>alert('LOGGED OUT');</script>";
				header('refresh:0.1;url=index.php');
			}
		}


		
	}
}

?>
