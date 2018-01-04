<?php
date_default_timezone_set("Asia/Jakarta");
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $lp = $_POST['lapor'];
        $locc = $_POST['loc'];
        $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */
        
        //DB details
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'projectead';
        
        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
        // Check connection
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }
        
        $dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        if(isset($_COOKIE['CID'])){
        //connect Database
            $db = mysqli_connect('localhost','root','', 'projectead');
            $token = strval($_COOKIE['CID']);
            $read = mysqli_query($db, "SELECT uid FROM token WHERE token = '$token'");
            if ($row1 = mysqli_fetch_array($read)){
                $uid = strval($row1['uid']);
                $insert = $db->query("INSERT into laporsit (lapor,loc,image, uptime,uid) VALUES ('$lp','$locc','$imgContent', '$dataTime','$uid')");
                if($insert){
                    echo "<script type='text/javascript'>alert('Terimakasih Telah Melapor !');</script>";
                    header('refresh:0.1;url=afterlogin.html');
                }else{
                    echo "<script type='text/javascript'>alert('Gagal Melapor, coba lagi');</script>";
                    header('refresh:0.1;url=afterlogin.html');
                } 
            }else{
                echo "<script type='text/javascript'>alert('Tolong sertakan foto juga.');</script>";
                header('refresh:0.1;url=afterlogin.html');
            }
        }
    }
}

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
            $insert = "INSERT INTO clean (kilo,loc,hp,jenis,waktu,uid) VALUES ('$jmlh','$loc1','$jns','$dataTime','$uid')";
            mysqli_query($db, $insert);
            if($insert){
                echo "berhasil";
            }else{
                echo "tidak berhasil";
            }
        }            

    }
}
?>