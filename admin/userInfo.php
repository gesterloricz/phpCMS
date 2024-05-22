<?php
require("partials/headerAdmin.php");

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the user ID from the URL
    $userID = $_GET['id'];

    // Fetch user data from the database
    include("../connect.php");
    $stmt = $conn->prepare("SELECT * FROM user WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    $passwordConfirmation = $_POST['passwordConfirmation'];

    // Check if password and confirmation match
    if ($password !== $passwordConfirmation) {
        echo "Passwords do not match!";
    } else {
        // Update user data in the database
        $stmt = $conn->prepare("UPDATE user SET fullName = ?, username = ?, email = ?, password = ?, status = ? WHERE userID = ?");
        $stmt->bind_param("sssssi", $fullName, $username, $email, $password, $status, $userID);

        if ($stmt->execute()) {
            echo "User information updated successfully.";
        } else {
            echo "Error updating user information: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>


<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-semibold">User Information</h3>

        <div class="mt-8">
            <div class="mt-4">
                <div class="p-6 bg-gray-100 rounded-md shadow-md">
                    <h2 class="text-lg text-gray-700 font-semibold capitalize">Account settings</h2>
                    <form action="userInfo.php?id=<?php echo $userID; ?>" method="post">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label class="text-gray-700" for="fullName">Full Name</label>
                                <input name="fullName" id="fullName" class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="text" value="<?php echo $user['fullName']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="username">Username</label>
                                <input name="username" id="username" class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="text" value="<?php echo $user['username']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="emailAddress">Email Address</label>
                                <input name="email" id="email" class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="email" value="<?php echo $user['email']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="password">Password</label>
                                <input name="password" id="password" class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="password" value="<?php echo $user['password']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="status">Status</label>
                                <select name="status" id="status" class="form-select w-full mt-2 p-2 rounded-md focus:border-indigo-600">
                                    <option value="Active" <?php echo ($user['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($user['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                    <option value="Suspended" <?php echo ($user['status'] == 'Suspended') ? 'selected' : ''; ?>>Suspended</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-gray-700" for="passwordConfirmation">Password Confirmation</label>
                                <input name="passwordConfirmation" id="passwordConfirmation" class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="password">
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require("partials/footerAdmin.php") ?>
