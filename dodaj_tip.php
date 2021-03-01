<?php
    include "db.php";

    $sql_insert = "INSERT INTO sifarnik_tipova";

    if(isset($_POST['tip']) && $_POST['tip'] != "") {
        $tip = $_POST['tip'];
        $sql_insert = "INSERT INTO sifarnik_tipova (tip) VALUES ('$tip')";

    }


    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: tipovi_nekretnina.php");
    } else {
        header("location: tipovi_nekretnina.php?greska=Molimo Vas popunite sva polja!");
    }
?>