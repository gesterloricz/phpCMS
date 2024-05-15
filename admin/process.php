<?php
session_start();

if (isset($_POST["create"])) {
    include("../connect.php");
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $date = $_POST["date"];
    $userID = $_SESSION['userDetails']['user_id']; 

    $stmt = $conn->prepare("INSERT INTO posts(date, title, summary, content, userID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $date, $title, $summary, $content, $userID);

    if ($stmt->execute()) {
        $_SESSION["create"] = "Post added successfully";
        header("Location:index.php");
    } else {
        die("Data is not inserted!");
    }
}

if (isset($_POST["update"])) {
    include("../connect.php");
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $date = $_POST["date"];
    $id = $_POST["id"];
    $updateData = "UPDATE posts SET title = '$title', summary = '$summary', content = '$content', date = '$date' WHERE postID = $id";
    if (mysqli_query($conn, $updateData)) {
        session_start();
        $_SESSION["update"] = "Post updated successfully";
        header("Location:index.php");
    } else {
        die("Data is not updated!");
    }
}
?>