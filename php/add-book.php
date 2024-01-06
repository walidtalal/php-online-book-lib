<?php

session_start();
include '../db-conn.php';
include './fun-author.php';
include './fun-category.php';
include './fun-validation.php';
include './func-file-uploaded.php';

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    if(isset($_POST['book_title']) &&
        isset($_POST['book_description']) &&
        isset($_POST['book_author']) &&
        isset($_POST['book_category']) &&
        isset($_FILES['book_cover']) &&
        isset($_FILES['book_file']))
    {


        $bookTitle = $_POST['book_title'];
        $bookDescription = $_POST['book_description'];
        $bookAuthor = $_POST['book_author'];
        $bookCategory = $_POST['book_category'];

        $user_input = 'title='.$bookTitle.'&category='.$bookCategory.'&desc='.$bookDescription.'&author_id='.$bookAuthor;

        $text = "Book Title";
        $location = '../add-book.php';
        $ms= 'Error';
        is_empty($bookTitle, $text, $location, $ms, $user_input);

        $text = "Book Description";
        $location = '../add-book.php';
        $ms= 'Error';
        is_empty($bookDescription, $text, $location, $ms, $user_input);

        $text = "Book Author";
        $location = '../add-book.php';
        $ms= 'Error';
        is_empty($bookAuthor, $text, $location, $ms, $user_input);

        $text = "Book Category";
        $location = '../add-book.php';
        $ms= 'Error';
        is_empty($bookCategory, $text, $location, $ms, $user_input);

        $allowed_images_exs = array('jpg', 'jpeg', 'png');
        $path = 'cover';
        $book_cover = upload_file($_FILES['book_cover'], $allowed_images_exs, $path);

        if ($book_cover['status'] === 'error') {
            $em = $book_cover['data'];
            header("location: ../add-book.php?error=$em&$user_input");
            exit();
        } else {
            $allowed_file_exs = array('pdf', 'docx','txt', 'pptx');
            $path = 'files';
            $file = upload_file($_FILES['book_file'], $allowed_file_exs, $path); // Corrected variable name

            if ($file['status'] === 'error') {
                $em = $file['data'];
                header("location: ../add-book.php?error=$em&$user_input");
                exit();
            } else {
                $file_URL = $file['data'];
                $book_cover_URL = $book_cover['data'];

                $sql = 'INSERT INTO books (title, description, category_id, author_id, cover, file) VALUES (:title, :description, :category, :author, :cover, :file)';
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':title', $bookTitle);
                $stmt->bindParam(':description', $bookDescription);
                $stmt->bindParam(':category', $bookCategory);
                $stmt->bindParam(':author', $bookAuthor);
                $stmt->bindParam(':cover', $book_cover_URL);
                $stmt->bindParam(':file', $file_URL);

                $res = $stmt->execute();

                if($res) {
                    $sm = 'Successfully added';
                    header("location: ../add-book.php?success=$sm");
                    exit();
                } else {
                    $em = 'unknown error occured';
                    header("location: ../add-book.php?error=$em");
                    exit();
                }
            }
        }

    } else {
        header("location: ../admin.php");
        exit();
    }
}