<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
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
        Admin Panel
    </div>
    <header class="p-4 bg-dark text-center">
        <h1><a href="index.php" class="text-light text-decoration-none">Blogs</a></h1>
    </header>
    <div class="post-list mt-5">
        <div class="container">
            <?php
                include("connect.php");
                $sqlSelect = "SELECT * FROM posts";
                $result = mysqli_query($conn,$sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="row mb-4 p-5 bg-light">
                        <div class="col-sm-2">
                            <?php echo $data["date"]; ?>
                        </div>
                        <div class="col-sm-3">
                           <h2> <?php echo $data["title"]; ?></h2>
                        </div>
                        <div class="col-sm-5">
                            <?php echo $data["content"]; ?>
                        </div>
                        <div class="col-sm-2">
                            <a href="view.php?id=<?php echo $data['postID']; ?>" class="btn btn-primary" style="background-color: rgb(0,112,66); border-color: rgb(0,112,66); color: white;">READ MORE</a>
                        </div>
                    </div>
                <?php
                }
            ?>
         </div>
    </div>
    <script>
        function goToAdminPanel() {
            window.location.href = "admin/index.php";
        }
    </script>
</body>
</html>
