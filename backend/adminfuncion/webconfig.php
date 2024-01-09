<?php include_once("../../config/connect.php");
$title = $_POST["webtitle"];
$icon = $_POST["webicon"];
$brand = $_POST["webbrand"];

mysqli_query($conn,"UPDATE webconfig SET title = '$title' , icon = '$icon' , brand = '$brand'");
?>
<script>
    history.back();
</script>