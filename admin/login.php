<?php
session_start();
include_once '../connect.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username or password cannot be blank.";
        header("Location: login.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE username =?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['userID'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found.";
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
                      <form action="login.php" method="post">
                        <div class="text-center my-4">
                            <h1 class="fw-bold mx-3 mb-0">Login</h1>
                        </div>
                        <?php 
                        if(isset($_SESSION['error'])) { ?>
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
                        <div><p>Not registered yet? <a href="register.php">Register Here.</a></p></div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
