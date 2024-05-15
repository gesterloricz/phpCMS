<?php
session_start();

if ($_SESSION['userDetails']['username'] === "guest") {
    header("Location: login.php");
}

include("templates/header.php");
?>
<a href="<?= $_SERVER['HTTP_REFERER'] ?>">
    <h3>Return </h3>
</a>
<div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
    <form action="process.php" method="post">
        <div class="form-field mb-4">
            <input type="text" class="form-control" name="title" id="" placeholder="Enter Title:">
        </div>
        <div class="form-field mb-4">
            <textarea name="summary" class="form-control" id="" cols="30" rows="10" placeholder="Enter Summary:"></textarea>
        </div>
        <div class="form-field mb-4">
            <textarea name="content" class="form-control" id="" cols="30" rows="10" placeholder="Enter Post:"></textarea>
        </div>
        <div class="form-field mb-4">
            <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter Tags:">
            <div id="tagContainer"></div>
        </div>
        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

        <div class="form-fielsd">
            <input type="submit" class="btn btn-primary" value="Submit" name="create">
        </div>
    </form>
</div>
<?php
include("templates/footer.php");
?>