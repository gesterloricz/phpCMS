<?php 
 $_SESSION['userDetails'] = array(
    'user_id' => 0,
    'username' => 'guest',
    'name' => 'Guest User',
);

?>
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
        .article-card {
        border-radius: 10px; 
        overflow: hidden;
        min-height: 330px;
    }
         .article-content {
             padding:15px;
             display: flex;
             flex-direction: column;
             justify-content: space-between;
             height: 100%;
         }
         .btn-primary {
        align-self: flex-end;
    }
    </style>
</head>
<body>
<div class="admin-panel" onclick="goToAdminPanel()">
        Admin Panel
    </div>
    <header class="p-4 text-center" style="background-color: #1E2134;">
        <h1><a href="index.php" class="text-light text-decoration-none">Blogs</a></h1>
    </header>
    <div class="container mt-5">
        <h3>Latest Articles</h3>
        <div class="row">
            <?php
                include("connect.php");
                $sqlSelect = "SELECT * FROM posts";
                $result = mysqli_query($conn,$sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card article-card">
                            <div class="card-body article-content">
                                <h5><?php echo $data["title"]; ?></h5>
                                <p><?php echo $data["content"]; ?></p>
                                <a href="view.php?id=<?php echo $data['postID']; ?>" class="btn btn-primary" style="background-color: rgb(0,112,66); border-color: rgb(0,112,66); color: white;">READ MORE</a>
                            </div>
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