<?php 
	if(isset($_COOKIE['CID'])){
		$token = strval($_COOKIE['CID']);
		//connect Database
		$db = mysqli_connect('localhost','root','', 'projectead');

		$read = mysqli_query($db, "SELECT uid FROM token WHERE token = '$token'");
		if ($row1 = mysqli_fetch_array($read)){
			$uid = strval($row1['uid']);
			$read2 = mysqli_query($db, "SELECT * FROM usermc WHERE id = '$uid'");			
			if ($row2 = mysqli_fetch_array($read2)){
				echo "Username : ".$row2['username']."<hr /></br/>";
				echo "Password : ".$row2['password']."<hr /></br/>";
				echo "email : ".$row2['email']."<hr /></br/>";
				echo "Firstname : ".$row2['firstname']."<hr /></br/>";
				echo "Lastname : ".$row2['lastname']."<hr /></br/>";		
				echo "no. KTP : ".$row2['ktp']."<hr /></br/>";
				echo "Tempat & tanggal lahir : ".$row2['tempatlahir'].", ".$row2['tanggallahir']."<hr /></br/>";

			}
		}


		
	}


?>
<a href="afterlogin.html"><input type="submit" name="back" value="<-back"></a>
<a href="changePassword.php"><input type="submit" name="edit" value="edit profile->"></a></p>
<a href="post.php"><input type="submit" name="edit" value="see all your posts !"></a>