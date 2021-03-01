<?php
    include "db.php";

    if(isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    }

    $sql_insert = "DELETE FROM sifarnik_tipova WHERE id = $id";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: tipovi_nekretnina.php?".$sql_insert);
    } else {
        exit("<pre>".$sql_insert."</pre>");
    }
?>