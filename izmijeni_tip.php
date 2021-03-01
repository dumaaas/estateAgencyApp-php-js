<?php
    include "db.php";

    if(isset($_POST['tip_id']) && $_POST['tip_id'] != "") {
        $id = $_POST['tip_id'];
    }

    if(isset($_POST['tip']) && $_POST['tip'] != "") {
        $tip = $_POST['tip'];
    }

    var_dump($id);

    $sql_insert = "UPDATE sifarnik_tipova SET tip = '$tip' WHERE id = $id";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert) {
        header("location: tipovi_nekretnina.php?".$sql_insert);
    } else {
        exit("<pre>".$sql_insert."</pre>");
    }
?>