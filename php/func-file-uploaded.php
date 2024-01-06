<?php

// In func-file-uplaoded.php
function upload_file($file, $allowed_exs, $path)
{
    $file_name = $file['name'];
    $temp_name = $file['tmp_name']; // Corrected variable name
    $error = $file['error'];

    if ($error == 0) {
        $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_ex_lc = strtolower($file_ex);

        if (in_array($file_ex_lc, $allowed_exs)) { // Checking against lowercase extension
            $new_file_name = uniqid("", true) . '.' . $file_ex_lc;
            $file_upload_path = '../uploads/' . $path . "/" . $new_file_name;

            move_uploaded_file($temp_name, $file_upload_path);

            $sm['status'] = 'success';
            $sm['data'] = $new_file_name;

            return $sm;
        } else {
            $em['status'] = 'error';
            $em['data'] = 'you cannot upload this file';
            return $em;
        }
    } else {
        $em['status'] = 'error';
        $em['data'] = 'error occurred on uploading';
        return $em;
    }
}
