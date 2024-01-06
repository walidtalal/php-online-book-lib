<?php


//function get_all_authors($conn)
//{
//    $sql = 'SELECT * FROM authors';
//    $stmt = $conn->prepare($sql);
//
//    $stmt->execute(['$id']);
//
//    if ($stmt->rowCount() > 0) {
//        $author = $stmt->fetch();
//    } else {
//        $author = array();
//    }
//    return $author;
//}

function get_all_authors($conn)
{
    $sql = 'SELECT * FROM authors';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $authors;
}


function get_author($conn, $id)
{
    $sql = 'SELECT * FROM authors where id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    $author = $stmt->fetch(PDO::FETCH_ASSOC);

    return $author;
}