<?php 
if(isset ($_POST['sbm'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	$db = mysqli_connect('localhost','root','', 'projectead');
	//Read
	$queryR = mysqli_query($db, "SELECT username FROM usermc WHERE username = '$user'");
	if ($row = mysqli_fetch_array($queryR)){
		$queryR1 = mysqli_query($db, "SELECT password FROM usermc WHERE password = '$pass'");
		if ($row1 = mysqli_fetch_array($queryR1)){
			echo "<script type='text/javascript'>alert('LOGGED IN');</script>";
			$userid = mysqli_query($db, "SELECT id FROM usermc WHERE username = '$user'");
					if ($row2 = mysqli_fetch_array($userid)){
						$uid = $row2['id'];
						$status = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $status));
						$tokenSc = sha1($token);
						$queryC = "INSERT INTO token (token,uid) VALUES('$tokenSc','$uid')";
						mysqli_query($db, $queryC);
						setcookie("CID", $tokenSc, time() + 60 * 60 * 24 * 1,'/', NULL, NULL, TRUE);
			header('refresh:0.1;url=afterlogin.html');
		}
		}else{
			echo "<script type='text/javascript'>alert('Username or Password incorrect !');</script>";
			header('refresh:0.1;url=signin.html');
		}
	}else{
		echo "<script type='text/javascript'>alert('Username Unregistered !');</script>";
		header('refresh:0.1;url=signin.html');
		
	}
	
}
?>