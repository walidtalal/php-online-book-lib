<?php

//function is_empty($var, $text, $location, $ms, $data)
//{
//    if($var) {
//        $em = "The".$text.'is required';
//        header('Location: $location?$ms=$em&$data');
//        exit();
//    }
//    return 0;
//}


function is_empty($var, $text, $location, $ms, $data)
{
    if (empty($var)) {
        $em = "The " . $text . " is required";
        header("Location: $location?$ms=$em&$data");
        exit();
    }
    return 0;
}
