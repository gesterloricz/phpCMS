<?php
require("partials/headerAdmin.php");

// Assuming you have a valid session with user ID stored
$userID = $_SESSION['userDetails']['user_id'];

?>


<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-semibold">User Information</h3>

        <div class="mt-8">
            <div class="mt-4">
                <div class="p-6 bg-gray-100 rounded-md shadow-md">
                    <h2 class="text-lg text-gray-700 font-semibold capitalize">Account settings</h2>

                    <?php
                    // Assuming you have a valid session with user ID stored
                    $userID = $_SESSION['userDetails']['user_id'];

                    // Fetch user data from the database
                    include("../connect.php");
                    $stmt = $conn->prepare("SELECT * FROM user WHERE userID = ?");
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    ?>

                    <form>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label class="text-gray-700" for="username">Full Name</label>
                                <input class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="text" value="<?php echo $user['fullName']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="username">Username</label>
                                <input class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="text" value="<?php echo $user['username']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="emailAddress">Email Address</label>
                                <input class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="email" value="<?php echo $user['email']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="password">Password</label>
                                <input class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="password" value="<?php echo $user['password']; ?>">
                            </div>

                            <div>
                                <label class="text-gray-700" for="status">Status</label>
                                <select class="form-select w-full mt-2 p-2 rounded-md focus:border-indigo-600">
                                    <option value="Active" <?php echo ($user['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($user['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                    <option value="Suspended" <?php echo ($user['status'] == 'Suspended') ? 'selected' : ''; ?>>Suspended</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-gray-700" for="passwordConfirmation">Password Confirmation</label>
                                <input class="form-input w-full mt-2 p-2 rounded-md focus:border-indigo-600" type="password">
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button href="userInfo.php" class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require("partials/footerAdmin.php") ?>