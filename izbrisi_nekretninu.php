<?php
    include "db.php";

    if(isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    }

    $sql_insert = "DELETE FROM nekretnina WHERE id = $id";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: index.php");
    } else {
        exit("<pre>".$sql_insert."</pre>");
    }
?>