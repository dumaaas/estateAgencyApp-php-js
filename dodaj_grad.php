<?php
    include "db.php";

    $sql_insert = "INSERT INTO sifarnik_gradova";
    if(isset($_POST['grad']) && $_POST['grad'] != "") {
        $grad = $_POST['grad'];
        $sql_insert = "INSERT INTO sifarnik_gradova (ime_grada) VALUES ('$grad')";
    }
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: gradovi.php");
    } else {
        header("location: gradovi.php?greska=Molim Vas popunite sva polja!");

    }
?>