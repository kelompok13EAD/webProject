<?php 
if(isset ($_POST['sbm'])){
	$namad = $_POST['namaD'];
	$namab = $_POST['namaB'];
	$ktp = $_POST['ktp'];
	$tempatL = $_POST['tempatLahir'];
	$tanggalL = $_POST['tanggalLahir'];
	$user = $_POST['uname'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];
	$db = mysqli_connect('localhost','root','', 'projectead');

	if(empty($namad) || empty($namab) || empty($ktp) || empty($tempatL) || empty($tanggalL) || empty($user) || empty($pass) || empty($email)){
		echo "<script type='text/javascript'>alert('Please Fill all the Data');</script>";
		header('refresh:0.1;url=signup.html');
	}else{
		if(strlen($user) < 6 || strlen($user) > 10 && strlen($pass) < 6 || strlen($pass) > 10){	
			echo "<script type='text/javascript'>alert('Username and Password not Valid');</script>";
			header('refresh:0.1;url=signup.html');
		}else{
			$queryR = mysqli_query($db, "SELECT username FROM usermc WHERE username = '$user'");
			if(mysqli_fetch_array($queryR)){
				echo "<script type='text/javascript'>alert('Username Already Taken');</script>";
				header('refresh:0.1;url=signup.html');
			}else{
				$queryR1 = mysqli_query($db, "SELECT email FROM usermc WHERE email = '$email'");
				if(mysqli_fetch_array($queryR1)){
					echo "<script type='text/javascript'>alert('Email Already Used');</script>";
					header('refresh:0.1;url=signup.html');
				}else{
					$queryR1 = mysqli_query($db, "SELECT ktp FROM usermc WHERE ktp = '$ktp'");
					if(mysqli_fetch_array($queryR1)){
						echo "<script type='text/javascript'>alert('your ID number already used');</script>";
						header('refresh:0.1;url=signup.html');
					}else{
						$qC = "INSERT INTO usermc (username,password,email,firstname,lastname,tempatlahir,tanggallahir,ktp) VALUES('$user','$pass','$email','$namad','$namab','$tempatL','$tanggalL','$ktp')";
						mysqli_query($db, $qC);	
						echo "<script type='text/javascript'>alert('REGISTER SUCCESS');</script>";
						header('refresh:0.1;url=signin.html');	
					}




				}
			}
		}
	}

}
?>		
