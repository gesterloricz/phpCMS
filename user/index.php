<?php
session_start();

if ($_SESSION['userDetails']['username'] === "guest" || $_SESSION['userDetails']['username'] === null) {
    header("Location: login.php");
}

include("templates/header.php");
?>
<div class="posts-list p-5">
    <?php
    if (isset($_SESSION["create"])) {
    ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION["create"];
            ?>
        </div>
    <?php
        unset($_SESSION["create"]);
    }
    ?>
    <?php
    if (isset($_SESSION["update"])) {
    ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION["update"];
            ?>
        </div>
    <?php
        unset($_SESSION["update"]);
    }
    ?>
    <?php
    if (isset($_SESSION["delete"])) {
    ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION["delete"];
            ?>
        </div>
    <?php
        unset($_SESSION["delete"]);
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="width:15%;">Publication Date</th>
                <th scope="col" style="width:20%;">Title</th>
                <th scope="col" style="width:40%;">Article</th>
                <th scope="col" style="width:10%;">Status</th>
                <th scope="col" style="width:20%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../connect.php');
            // Select both Pending and Approved posts for the logged-in user
            $selectPost = "SELECT * FROM posts WHERE userID = " . $_SESSION['userDetails']['user_id'] . " ORDER BY date DESC";
            $result = mysqli_query($conn, $selectPost);
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo date("F d, Y", strtotime($data["date"])) ?></td>
                    <td><?php echo $data["title"] ?></td>
                    <td><?php echo $data["summary"] ?></td>
                    <td><?php echo $data["status"] ?></td>
                    <td>
                        <a class="btn btn-info" href="view.php?id=<?php echo $data["postID"] ?>" style="background-color: rgb(0,112,66); border-color: rgb(0,112,66); color: white;">View</a>
                        <?php
                        if ($data["status"] === "Approved") {
                        ?>
                            <a class="btn btn-warning" href="edit.php?id=<?php echo $data["postID"] ?>" style="background-color: rgb(7, 61, 106); border-color: rgb(7, 61, 106); color: white;">Edit</a>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-warning" disabled style="background-color: rgb(7, 61, 106); border-color: rgb(7, 61, 106); color: white;">Edit</button>
                        <?php
                        }
                        ?>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $data["postID"] ?>" style="background-color: rgb(209, 26, 42); border-color: rgb(209, 26, 42); color: white;">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<?php
include("templates/footer.php");
?>