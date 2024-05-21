<?php
session_start();

if (isset($_POST["create"])) {
    include("../connect.php");
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $date = $_POST["date"];
    $userID = $_SESSION['userDetails']['user_id'];
    $tags = explode(',', $_POST['tags']); // Assuming tags are comma-separated

    // Define the status
    $status = "Pending";

    // Inserting post with status "Pending"
    $stmt = $conn->prepare("INSERT INTO posts(date, title, summary, content, userID, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $date, $title, $summary, $content, $userID, $status);

    if ($stmt->execute()) {
        // Get the last inserted post ID
        $postId = $conn->insert_id;

        // Use an array to keep track of inserted tag IDs to prevent duplicates
        $insertedTagIds = [];

        // Insert each tag and link it to the post
        foreach ($tags as $tag) {
            // Trim whitespace from tag name
            $tag = trim($tag);

            // Check if the tag already exists
            $stmt = $conn->prepare("SELECT tagID FROM tags WHERE tagName = ?");
            $stmt->bind_param("s", $tag);
            $stmt->execute();
            $stmt->bind_result($tagId);
            $stmt->fetch();
            $stmt->close();

            // If the tag does not exist, insert it
            if (!$tagId) {
                $stmt = $conn->prepare("INSERT INTO tags (tagName) VALUES (?)");
                $stmt->bind_param("s", $tag);
                $stmt->execute();
                $tagId = $conn->insert_id;
                $stmt->close();
            }

            // Check if the tag has already been linked to this post
            if (!in_array($tagId, $insertedTagIds)) {
                // Link the tag to the post
                $stmt = $conn->prepare("INSERT INTO post_tags (postID, tagID) VALUES (?, ?)");
                $stmt->bind_param("ii", $postId, $tagId);
                if (!$stmt->execute()) {
                    die('Error inserting tag: ' . $stmt->error);
                }
                $stmt->close();

                // Add the tag ID to the array of inserted tags for this post
                $insertedTagIds[] = $tagId;
            }
        }

        $_SESSION["create"] = "Post and tags added successfully";
        header("Location: index.php");
        exit();
    } else {
        die("Data is not inserted: " . $stmt->error);
    }
}

if (isset($_POST["update"])) {
    include("../connect.php");
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $date = $_POST["date"];
    $id = $_POST["id"];

    // Use a prepared statement to update the post
    $stmt = $conn->prepare("UPDATE posts SET title = ?, summary = ?, content = ?, date = ? WHERE postID = ?");
    $stmt->bind_param("ssssi", $title, $summary, $content, $date, $id);

    if ($stmt->execute()) {
        $_SESSION["update"] = "Post updated successfully";
        header("Location: index.php");
    } else {
        die("Data is not updated: " . $stmt->error);
    }
}
?>
