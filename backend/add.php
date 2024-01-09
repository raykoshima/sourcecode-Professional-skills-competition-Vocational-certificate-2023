<?php include_once("header.php");
if(isset($_POST["cate"])){
    $cate = $_POST["cate"];
    mysqli_query($conn,"INSERT INTO food_category(fc_name) VALUE ('$cate')");
    header("location:edit.php");
}elseif(isset($_POST["foodname"])){
$foodname = $_POST["foodname"];
$price = $_POST["price"];
$cated = $_POST["cated"];

$file_name = $_FILES["file"]["name"];
$tmp_name = $_FILES["file"]["tmp_name"];
$type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
$newname = uniqid('',true).".".$type;
$location = "../upload/food/".$newname;
if(move_uploaded_file($tmp_name,$location)){
    mysqli_query($conn,"INSERT INTO foodlist(fl_name,fl_price,fl_image,fl_soldout,fl_category)
    VALUE ('$foodname','$price','$newname','0','$cated')");
    header("location:edit.php");
}else{
    echo("dsad");
}
}



if(isset($_GET["category"])){?>
<center><h1>เพิ่มหมวดหมู่อาหาร</h1>
<form method="post">
<fieldset style="width:30%;">
        <legend><label for="cate">ชื่อหมวดหมู่อาหาร</label></legend>
        <input type="text" name="cate" id="cate" style="width:100%; border:white;" required>
</fieldset><br><br>
<button style="width:5%;">บันทึก</button></form>&nbsp;<a href="edit.php"><button style="width:5%;">กลับ</button></a>

<?php }elseif(isset($_GET["foodlist"])){?>
<center><h1>เพิ่มรายการอาหาร</h1>
<form method="post" enctype="multipart/form-data">
<table>
    <td>
    <fieldset>
        <legend><label for="foodname">ชื่ออาหาร</label></legend>
        <input type="text" name="foodname" id="foodname" style="width:100%; border:white;" required>
    </fieldset>
    </td><tr>
    <td>
    <fieldset>
        <legend><label for="price">ราคา</label></legend>
        <input type="number" min="1" name="price" id="price" style="width:100%; border:white;" required>
    </fieldset>
    </td><tr>
    <td>
    <fieldset>
        <legend><label for="cated">หมวดหมู่</label></legend>
        <select name="cated" id="cated" style="width:100%; border:white;">
<?php $ceteselect = $dbcon->prepare("SELECT * FROM food_category");
      $ceteselect->execute();
while($ceterow = $ceteselect->fetch(PDO::FETCH_ASSOC)){?>
    <option value="<?php echo $ceterow["fc_id"];?>"><?php echo $ceterow["fc_name"];?></option>
<?php } ?>
            
        </select>
    </fieldset>
    </td><tr>
    <td>
    <fieldset>
        <legend><label for="image">รูปภาพ</label></legend>
        <input type="file" name="file" id="image" style="width:100%; border:white;" accept="image/*" required>
    </fieldset>
    </td><tr>
    <td>
        <button style="width:100%;">เพิ่มรายการ</button>
    </td>
</form></table>
<?php }else{
    echo"<script>
            history.back();
        </script>";
}
?>