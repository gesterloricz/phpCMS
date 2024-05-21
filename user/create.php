<?php
session_start();

if ($_SESSION['userDetails']['username'] === "guest") {
    header("Location: login.php");
}

include("templates/header.php");
?>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
</head>
<body>
<div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
    <form action="process.php" method="post" id="reg_form">
        <div class="form-field mb-4">
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title:">
        </div>
        <div class="form-field mb-4">
            <textarea name="summary" class="form-control" id="summary" cols="30" rows="10" placeholder="Enter Summary:"></textarea>
        </div>
        <div class="form-field mb-4">
            <textarea name="content" class="form-control" id="content" cols="30" rows="10" placeholder="Enter Post:"></textarea>
        </div>
        <div class="form-field mb-4">
            <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter Tags:">
            <div id="tagContainer"></div>
        </div>
        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

        <div class="form-fielsd">
            <input type="submit" class="btn btn-primary" value="Submit" name="create" id="submit">
        </div>
    </form>
</div>
<?php
 include('../connect.php');
$result = $conn->query("SELECT * FROM tags");
$tags = $result->fetch_all(MYSQLI_ASSOC);
?>
<script>
    $(document).ready(function(){
      $('#tags').tokenfield({
        autocomplete:{
        source: [<?php foreach($tags as $tag) { ?>
            "<?php echo $tag['tagName']; ?>", 
            <?php } ?>],
        delay:100
        },
        showAutocompleteOnFocus: true
      });
      
      
});
</script>     
</body>
</html>
<?php
include("templates/footer.php");
?>