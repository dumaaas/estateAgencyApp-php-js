<?php
    include "db.php";

    if(isset($_POST['grad_id']) && $_POST['grad_id'] != "") {
        $id = $_POST['grad_id'];
    }

    if(isset($_POST['grad_ime']) && $_POST['grad_ime'] != "") {
        $grad = $_POST['grad_ime'];
    }

    $sql_insert = "UPDATE sifarnik_gradova SET ime_grada = '$grad' WHERE id = $id";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: gradovi.php?".$sql_insert);
    } else {
        exit("<pre>".$sql_insert."</pre>");
    }
?>