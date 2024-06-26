<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="bekube.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="container">
                        <?php
                        if (isset($_POST["submit"])) {
                            $fullName = $_POST["fullname"];
                            $username = $_POST["username"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $passwordRepeat = $_POST["repeat_password"];

                            $errors = array();

                            if (empty($fullName) || empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
                                array_push($errors, "All fields are required");
                            }
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                array_push($errors, "Email is not valid");
                            }
                            if (strlen($password) < 8) {
                                array_push($errors, "Password must be at least 8 characters long");
                            }
                            if ($password !== $passwordRepeat) {
                                array_push($errors, "Passwords do not match");
                            }

                            require_once "../connect.php";

                            $sql = "SELECT * FROM user WHERE email = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowCount = $result->num_rows;

                            if ($rowCount > 0) {
                                array_push($errors, "Email already exists!");
                            }

                            if (count($errors) > 0) {
                                foreach ($errors as $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            } else {
                                $sql = "INSERT INTO user (fullName, username, email, password) VALUES (?, ?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                if ($stmt) {
                                    $stmt->bind_param("ssss", $fullName, $username, $email, $password);
                                    $stmt->execute();
                                    header("Location: login.php");
                                    exit();
                                } else {
                                    die("Something went wrong");
                                }
                            }
                        }
                        ?>


                        <form action="register.php" method="post">
                            <div class="text-center my-4">
                                <h1 class="fw-bold mx-3 mb-0">Register</h1>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="username" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
                                <?php if (!empty($repeatPasswordError)) : ?>
                                    <small class="text-danger"><?php echo $repeatPasswordError; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Register" name="submit">
                            </div>
                            <div>
                                <p><a href="login.php">Go back.</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>