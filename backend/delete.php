<?php include_once("header.php");
if(isset($_GET["foodlist"])){
$deletefood = $dbcon->prepare("SELECT * FROM foodlist WHERE fl_id = '".$_GET["id"]."'");
$deletefood->execute();
$row = $deletefood->fetch();
$image = $row["fl_image"];
$food_id = $row["fl_id"];
if(unlink("../upload/food/$image")){
    $sql = "DELETE FROM foodlist WHERE fl_id = '$food_id'";
    mysqli_query($conn,$sql);
    header("location:edit.php");
}else{
    echo"error delete image";
}
}elseif(isset($_GET["cate"])){
    $cateid = $_GET["id"];
    $sql = "DELETE FROM food_category WHERE fc_id = '$cateid'";
    mysqli_query($conn,$sql);
    mysqli_query($conn,"DELETE FROM foodlist WHERE fl_category = '$cateid'");
    header("location:edit.php");
}
?>