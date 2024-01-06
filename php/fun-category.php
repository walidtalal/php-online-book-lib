<?php
function get_all_categories($conn)
{
    $sql = 'SELECT * FROM categories';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}

function get_category($conn, $id)
{
    $sql = 'SELECT * FROM categories where id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    return $category;
}