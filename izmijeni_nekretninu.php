<?php
    include 'db.php';
    include 'functions.php';
    $nekretine = [];
    $where_arr = [];
    if( isset($_POST['nekretnina_id']) && $_POST['nekretnina_id'] != "" ){
        $id = strtolower($_POST['nekretnina_id']);
        $where_arr[] = " id = $id ";
    }
    if( isset($_POST['gradovi']) && $_POST['gradovi'] != "" ){
        $grad = strtolower($_POST['gradovi']);
        $where_arr[] = " grad_id = $grad ";
    }
    if( isset($_POST['tipovi']) && $_POST['tipovi'] != "" ){
        $tip = strtolower($_POST['tipovi']);
        $where_arr[] = " tip_id = $tip ";
    }
    if( isset($_POST['oglasi']) && $_POST['oglasi'] != "" ){
        $oglas = strtolower($_POST['oglasi']);
        $where_arr[] = " oglas_id = $oglas ";
    }
    if( isset($_POST['adresa']) && $_POST['adresa'] != "" ){
        $adresa = strtolower($_POST['adresa']);
        $where_arr[] = " adresa = '$adresa' ";
    }
    if( isset($_POST['godina']) && $_POST['godina'] != "" ){
        $godina = strtolower($_POST['godina']);
        $where_arr[] = " godina_izgradnje = '$godina' ";
    }
    if( isset($_POST['povrsina']) && $_POST['povrsina'] != "" ){
        $povrsina = strtolower($_POST['povrsina']);
        $where_arr[] = " povrsina = '$povrsina' ";
    }
    if( isset($_POST['cijena']) && $_POST['cijena'] != "" ){
        $cijena = strtolower($_POST['cijena']);
        $where_arr[] = " cijena = '$cijena' ";
    }
    if( isset($_POST['slike_izmjena']) && $_POST['slike_izmjena'] != "" ){
        $slike = strtolower($_POST['slike_izmjena']);
    }

    if(isset($_FILES['slike']) && !empty($_FILES['slike']['tmp_name'])) {
        $targetDir = "./img/";
        foreach($_FILES['slike']['tmp_name'] as $key => $value) {
            
            $slike = ($slike == '' ? '' : $slike . ',').$_FILES['slike']['name'][$key];
            $where_arr[] = " slika = '$slike' ";

            $fileName = basename($_FILES['slike']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            
            move_uploaded_file($_FILES["slike"]["tmp_name"][$key], $targetFilePath);
        }
    }

    $where_str = implode(",", $where_arr );
    $sqlNekretnine = "UPDATE nekretnina SET $where_str WHERE id = $id";
    $resNekretnine = mysqli_query($dbconn, $sqlNekretnine);

    if($resNekretnine) {
        header("location: nekretnina.php?id=".$id);
    } else {
        exit("<pre>".$sqlNekretnine."</pre>");
    }
?>