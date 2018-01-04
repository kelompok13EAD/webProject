<?php
if(isset($_POST['change'])){
	$oldP = $_POST['oldPass'];
	$newP = $_POST['newPass'];
	$cnewP = $_POST['confNewPass'];

	
	$db = mysqli_connect('localhost','root','', 'projectead');

	$token = strval($_COOKIE['CID']);
	$read = mysqli_query($db, "SELECT uid FROM token WHERE token = '$token'");
	
	if($row = mysqli_fetch_array($read)){
		$uid = $row['uid'];
		$read2 = mysqli_query($db,"SELECT password FROM usermc WHERE id = '$uid'");
		if($row1 = mysqli_fetch_array($read2)){
			$oldpw = $row1['password'];
			if($oldpw == $oldP){
				if($newP == $cnewP){
					mysqli_query($db, "UPDATE usermc SET password = '$newP' WHERE id = $uid");
					echo "<script type='text/javascript'>alert('password changed');</script>";
					header('refresh:0.1;url=profileForm.php');
				}else{
					echo "<script type='text/javascript'>alert('confirm your new password');</script>";
				}
			}else{
				echo "<script type='text/javascript'>alert('Password Incorrect');</script>";
			}
		}

	}else{
		echo "<script type='text/javascript'>alert('Changing Password Failed');</script>";
		header('refresh:0.1;url=changePassword.php');
	}	
}

?>

<h1>Change Password</h1>
<form method="post" action="changePassword.php">
	<input type="text" name="oldPass" placeholder="your old password"></p>
	<input type="password" name="newPass" placeholder="your new password"></p>
	<input type="password" name="confNewPass" placeholder="confirm your new password"></p>
	<button type="submit" name="change">Change</button>

</form>