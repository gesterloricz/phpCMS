<?php
// Fetch user data from the database
include("../connect.php");
$stmt = $conn->prepare("SELECT * FROM user WHERE userID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Update user data (you'll need to implement this part)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'];
    $passwordConfirmation = $_POST['passwordConfirmation'];

    // Validate email address
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address');
    }

    // Check if email already exists
    $existingEmailQuery = $conn->prepare("SELECT 1 FROM user WHERE email = ?");
    $existingEmailQuery->bind_param("s", $newEmail);
    $existingEmailQuery->execute();
    $existingEmailResult = $existingEmailQuery->get_result();
    if ($existingEmailResult->num_rows > 0) {
        die('Email already exists');
    }

    // Check password match
    if ($newPassword !== $passwordConfirmation) {
        die('Password confirmation does not match');
    }
}
?>
