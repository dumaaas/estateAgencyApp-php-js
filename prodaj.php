<?php
    include "db.php";

    if(isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    }

    $sql_insert = "UPDATE nekretnina SET datum_prodaje = NOW(), status = 'Nedostupno'  WHERE id = $id";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: nekretnina.php?id=".$id);
    } else {
        exit("<pre>".$sql_insert."</pre>");
    }
?>