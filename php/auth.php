<?php
session_start();
require_once '../db-conn.php';
require_once 'fun-validation.php';

// Set PDO to throw exceptions on error
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple form validation
    $text = 'Email';
    $location = '../login.php';
    $ms = 'error';
    is_empty($email, $text, $location, $ms, '');

    $text = 'Password';
    is_empty($password, $text, $location, $ms, '');

    $sql = "SELECT id, email, password FROM admin WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    try {
        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: ../admin.php");
            exit();
        } else {
            // Incorrect email or password
            $em = "Incorrect email or password";
        }
    } catch (PDOException $e) {
        // Handle PDO exception (e.g., database error)
        $em = "Database error: " . $e->getMessage();
    }

    // Redirect with error message
    header("Location: ./login.php?error=$em");
    exit();
} else {
    // Redirect if email and password are not set
    header("Location: ./login.php");
    exit();
}
?>
