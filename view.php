<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .admin-panel {
            position: absolute;
            top: 13px; 
            left: 0;
            padding: 30px;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="admin-panel" onclick="goToAdminPanel()">
        Back
    </div>
    <header class="p-4 bg-dark text-center">
        <h1><a href="index.php" class="text-light text-decoration-none">Blogs</a></h1>
    </header>
    <div class="post-list mt-5">
        <div class="container">
            <?php
                $id = $_GET['id'];
                if ($id) {
                    include("connect.php");
                    $sqlSelect = "SELECT * FROM posts WHERE postID = $id";
                    $result = mysqli_query($conn,$sqlSelect);
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                       <div class="post bg-light p-4 mt-5">
                        <h1><?php echo $data['title']; ?></h1>
                        <p><?php echo $data['date']; ?> </p>
                        <p><?php echo $data['content']; ?> </p>
                       </div>
                    <?php
                    }
                }else{
                    echo "No post found";
                }
            ?>
         </div>
    </div>
    <script>
        function goToAdminPanel() {
            window.location.href = "./index.php";
        }
    </script>
</body>
</html>