	<!DOCTYPE html>
	<html>
	<head>
		<title>Sign In Form</title>
		<link rel="stylesheet" type="text/css" href="style - Signin.css">
		<h1>Sign In</h1>
	</head>
	<body bgcolor="#009688">
	<?php 

	//connect Database
	$db = mysqli_connect('localhost','root','', 'projectEAD');

	if(isset ($_POST['login-acc'])){
			$user = $_POST['username'];
			$pass = $_POST['password'];
		//Read
		$queryR = mysqli_query($db, "SELECT username FROM usercba WHERE username = '$user'");
		if ($row = mysqli_fetch_array($queryR)){
			$queryR1 = mysqli_query($db, "SELECT password FROM usercba WHERE password = '$pass'");
				if ($row = mysqli_fetch_array($queryR1)){
						
						$userid = mysqli_query($db, "SELECT id FROM usercba WHERE username = '$user'");
						if ($row1 = mysqli_fetch_array($userid)){
							$uid = $row1['id'];
							$status = True;
							$token = bin2hex(openssl_random_pseudo_bytes(64, $status));
							$tokenSc = sha1($token);
							$queryC = "INSERT INTO token (token,uid) VALUES('$tokenSc','$uid')";
							mysqli_query($db, $queryC);

							setcookie("SNID", $tokenSc, time() + 60 * 60 * 24 * 7,'/', NULL, NULL, TRUE);
						}
				
						//header('location: laporField.php'); //redirected to page after inserting
						
						
					}else{
						echo "<script type='text/javascript'>alert('Username or Password incorrect !');</script>";
					}
		}else{
			echo "<script type='text/javascript'>alert('Username Unregistered !');</script>";
	}
}
?>
	 
<form method="post" action="signin.php">
		<div class="user">
			<input type="text" name="username" value = "" placeholder="Username here..."> </p>
			<input type="password" name="password" value = "" placeholder="Password here..."></p>			
			<div class = "submit">
				<button type="submit" name="login-acc" class="signup">Sign In</button>
			</div>
			
		 		
	</div>	 		
</form>
			<div class = "pindah">
				<a href="index.php">Don't Have an Account? Sign Up here.</a>
			</div>

	</body>
	</html>
	
