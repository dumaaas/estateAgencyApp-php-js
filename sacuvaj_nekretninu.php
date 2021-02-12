<?php

    include 'db.php';
    include 'functions.php';

    if(isset($_POST['gradovi'])) {
        $grad = $_POST['gradovi'];
    }
    if(isset($_POST['tipovi'])) {
        $tip = $_POST['tipovi'];
    }
    if(isset($_POST['oglasi'])) {
        $oglas = $_POST['oglasi'];
    }
    if(isset($_POST['adresa'])) {
        $adresa = $_POST['adresa'];
    }
    if(isset($_POST['godina'])) {
        $godina = $_POST['godina'];
    }
    if(isset($_POST['povrsina'])) {
        $povrsina = $_POST['povrsina'];
    }
    if(isset($_POST['cijena'])) {
        $cijena = $_POST['cijena'];
    }
    if(isset($_POST['opis'])) {
        $opis = $_POST['opis'];

    }
    if(isset($_FILES['slike'])) {
        $slike = "";
        $targetDir = "./img/";
        foreach($_FILES['slike']['tmp_name'] as $key => $value) {
            
            $slike = ($slike == '' ? '' : $slike . ',').$_FILES['slike']['name'][$key];

            $fileName = basename($_FILES['slike']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            
            move_uploaded_file($_FILES["slike"]["tmp_name"][$key], $targetFilePath);
        }
    }
    $sql_insert = "INSERT INTO nekretnina (povrsina,cijena,godina_izgradnje,opis,grad_id,tip_id,oglas_id,adresa,slika) VALUES ($povrsina, $cijena, $godina, '$opis', $grad, $tip, $oglas, '$adresa', '$slike')";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: index.php?".$slike);
    } else {
        exit("<pre>".$sql_insert."</pre>");
    }
?>