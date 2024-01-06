<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    include 'db-conn.php';

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Ad dAuthor</title>
    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-book.php">Add book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-category.php">Add category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="add-author.php">Ad Author</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Add Author-->
        <form action="php/add-author.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem ">
            <h1 class="text-center pb-5 display-4 fs-3">
                Add New Author
            </h1>

            <?php if (isset($_GET['error'])) {?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error'])?>
                </div>
            <?php }?>

            <?php if (isset($_GET['success'])) {?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_GET['success'])?>
                </div>
            <?php }?>

            <div class="mb-3">
                <label for="author_name" class="form-label">Author name</label>
                <input type="text" name="author_name" class="form-control" id="author_name" aria-describedby="emailHelp">
            </div>

            <button type="submit" name="" class="btn btn-primary">Add author</button>
            <a href="index.php">Store</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>

    <?php
} else {
    header('Location: login.php');
    exit(); // Ensure that script execution stops after redirection
}
?>
