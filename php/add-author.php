<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    include "../db-conn.php";
    if(isset($_POST['author_name'])) {

        $name= $_POST['author_name'];

        if(empty($name)) {
            $em = 'The author name is required';
            header("location: ../add-author.php?error=$em");
            exit();

        } else {
            $sql = "insert into authors (name) values (?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name]);

            if($res) {
                $sm = 'Successfully added';
                header("location: ../add-author.php?success=$sm");
                exit();
            } else {
                $em = 'unknown error occured';
                header("location: ../add-author.php?error=$em");
                exit();
            }
        }

    } else {
        header("location: ../admin.php");
        exit();
    }

} else {
    header("location: ..login/admin.php");
    exit();
}