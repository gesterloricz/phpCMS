<?php


if (!isset($_SESSION['userDetails'])) {
    $_SESSION['userDetails'] = array(
        'user_id' => 0,
        'username' => 'guest',
        'name' => 'Guest User',
    );
}

if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to a page after logout
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src ="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="sidebar.css">

</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <h2>Beku</h2>
        <ul>
            <li><a href="./index.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="create.php"><i class="fas fa-pen-to-square"></i>Draft</a></li>
            <li><a href="../index.php"><i class="fas fa-blog"></i>Blogs</a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i>Profile</a></li>
        </ul> 
    </div>
    <div class="main_content">
        <div class="header">Welcome <?= $_SESSION['userDetails']['name'] ?>!</div>  
        <div class="info">