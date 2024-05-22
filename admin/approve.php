<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve'])) {
    include("../connect.php");
    $postID = $_POST['postID'];
    $updateStatus = "UPDATE posts SET status = 'Approved' WHERE postID = $postID";
    if (mysqli_query($conn, $updateStatus)) {
        header("Location: pendingBlogs.php");
    } else {
        echo "Error updating post status: " . mysqli_error($conn);
    }
}
?>