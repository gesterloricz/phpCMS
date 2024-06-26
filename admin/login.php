<?php
session_start();
include_once '../connect.php';

if (isset($_POST['login'])) {
    $adminUser = $_POST['username'];
    $adminPassword = $_POST['password'];

    if (empty($adminUser) || empty($adminPassword)) {
        $_SESSION['error'] = "Username or password cannot be blank.";
        header("Location: login.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM super_user WHERE adminUser = ?");
    $stmt->bind_param("s", $adminUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $psswrd = $user['adminPassword'];

        if ($psswrd !== $adminPassword) {
            $_SESSION['error'] = "Incorrect password.";
            header("Location: login.php");
            exit();
        }

        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Username not found.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="stylee.css">
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
                        <form action="login.php" method="post">
                            <div class="text-center my-4">
                                <h1 class="fw-bold mx-3 mb-0">Admin Login</h1>
                            </div>
                            <?php
                            if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_SESSION['error']; ?>
                                </div>
                            <?php
                                unset($_SESSION['error']);
                            }
                            ?>
                            <div class="form-group">
                                <input type="text" placeholder="Username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Login" name="login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
