<?php 
date_default_timezone_set("Asia/Jakarta");
if(isset($_COOKIE['CID'])){
	$token = strval($_COOKIE['CID']);
		//connect Database
	$db = mysqli_connect('localhost','root','', 'projectead');

	$read = mysqli_query($db, "SELECT uid FROM token WHERE token = '$token'");
	if ($row1 = mysqli_fetch_array($read)){
		$uid = strval($row1['uid']);
		$read2 = mysqli_query($db, "SELECT * FROM laporsit WHERE uid = '$uid' ORDER BY id DESC");
		
		$read3 = mysqli_query($db, "SELECT id FROM laporsit WHERE uid = '$uid' ORDER BY id DESC");
		if(mysqli_num_rows($read2) != 0){
			while ($row2 = mysqli_fetch_array($read2) AND $row3 = mysqli_fetch_array($read3)){
				$id = $row3['id'];
				echo "Laporan Tanggal dan Jam : ".$row2['uptime']."</br/>";	
				echo ""."</br/>";
				echo '<img src="viewImage.php?id='.$id.'" width="150" height="100">'."</br/>";
				echo "Isi Laporan : ".$row2['lapor']."</br/>";
				echo "Lokasi : ".$row2['loc']."</br/>";
				$stts = strval($row2['status']);
				if($stts == NULL){
					$s = "Not Approved Yet"; 
				}elseif($stts == "1"){
					$s = "Approved";
				}else{
					$s = "Not Approved";
				}
				echo "Status : ".$s;

				echo ""."<hr /></br/>";


			}
		}else{
			echo "<script type='text/javascript'>alert('NO POST YET');</script>";
			header('refresh:0;url=profileForm.php');
		}
	}
}
?>
<a href="profileForm.php"><input type="submit" name="back" value="<-back"></a>
