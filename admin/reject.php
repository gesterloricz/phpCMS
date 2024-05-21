<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reject'])) {
    include("../connect.php");
    $postID = $_POST['postID'];
    $deletePost = "DELETE FROM posts WHERE postID = $postID";
    if (mysqli_query($conn, $deletePost)) {
        echo "Post rejected and deleted successfully!";
        // Redirect to a page or display a success message
    } else {
        echo "Error deleting post: " . mysqli_error($conn);
    }
}
?>