<?php
function get_all_books($conn)
{
    $sql = 'SELECT * FROM books ORDER BY id DESC';
    $stmt = $conn->prepare($sql);

    $stmt->execute(); // Corrected typo here

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = array(); // Set an empty array when there are no results
    }
    return $books;
}


function search_books($con, $key){
    # creating simple search algorithm :)
    $key = "%{$key}%";

    $sql  = "SELECT * FROM books 
            WHERE title LIKE ?
            OR description LIKE ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$key, $key]);

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    }else {
        $books = 0;
    }

    return $books;
}

function get_books_by_category($conn, $id)
{
    $sql = 'SELECT * FROM books where category_id = ?';
    $stmt = $conn->prepare($sql);

    $stmt->execute([$id]); // Corrected typo here

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = array(); // Set an empty array when there are no results
    }
    return $books;
}

function get_books_by_author($conn, $id)
{
    $sql = 'SELECT * FROM books where author_id = ?';
    $stmt = $conn->prepare($sql);

    $stmt->execute([$id]); // Corrected typo here

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = array(); // Set an empty array when there are no results
    }
    return $books;
}