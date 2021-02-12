<?php 

    function uploadPhoto( $file ){
        $original_name = $file;
        $tmp_name = $_FILES[$file]['tmp_name'][$key];
        // originalna ekstenzija
        $temp_arr = explode(".", $original_name );
        $ext = $temp_arr[ count($temp_arr)-1 ];
        
        $new_file_name = "./img/".uniqid().".".$ext;
        copy($tmp_name, $new_file_name);

        return $new_file_name;
    }

?>