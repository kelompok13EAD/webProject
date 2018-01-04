<?php 
date_default_timezone_set("Asia/Jakarta");
if(isset($_POST["submit1"])){
    $dataTime = date("Y-m-d H:i:s");
    $time = strval($dataTime);
    $jmlh = intval($_POST["jml"]);
    $loc1 = $_POST["loc1"];
    $hp = $_POST["hp"];
    if(isset($_POST["organik"])){
        $jns = "Organik";
    }
    if(isset($_POST["anorganik"])){
        $jns = "Anorganik";
    }
    if(isset($_POST["organik"]) AND isset($_POST["anorganik"])){
        $jns = "Organik dan Anorganik";
    }
    if(isset($_COOKIE['CID'])){
        $db = mysqli_connect('localhost','root','', 'projectead');
        $token = strval($_COOKIE['CID']);
        $read = mysqli_query($db, "SELECT uid FROM token WHERE token = '$token'");
        if ($row1 = mysqli_fetch_array($read)){
            $uid = strval($row1['uid']);
            $create = "INSERT INTO clean (kilo,loc,hp,jenis,waktu,uid) VALUES ('$jmlh','$loc1','$hp','$jns','$time','$uid')";
            mysqli_query($db, $create);
            if($create){
                echo "<script type='text/javascript'>alert('Terimakasih, permintaan akan segera di proses');</script>";
                header('refresh:0.1;url=afterlogin.html');
            }else{
                echo "<script type='text/javascript'>alert('Terjadi kesalahan dalam sistem, coba lagi');</script>";
                header('refresh:0.1;url=afterlogin.html');
            } 
            
        }            

    }
}
?>