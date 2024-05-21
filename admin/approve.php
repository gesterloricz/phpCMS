<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve'])) {
    include("../connect.php");
    $postID = $_POST['postID'];
    $updateStatus = "UPDATE posts SET status = 'Approved' WHERE postID = $postID";
    if (mysqli_query($conn, $updateStatus)) {
        echo "Post approved successfully!";
        // Redirect to a page or display a success message
    } else {
        echo "Error updating post status: " . mysqli_error($conn);
    }
}
?>