<?php include_once("header.php");
if(isset($_POST["foodname"])){
    $foodname = $_POST["foodname"];
    $foodprice = $_POST["foodprice"];
    $soldout = $_POST["soldout"];
    $food_id = $_POST["food_id"];
    if(empty($_FILES["file"]["name"])){
        $sql = "UPDATE foodlist SET	fl_name = '$foodname' , fl_price = '$foodprice' , fl_soldout = '$soldout' WHERE fl_id = '$food_id'";
    }else{
        $oldimage = $_POST["image"];
        $file_name = $_FILES["file"]["name"];
        $tmp_name = $_FILES["file"]["tmp_name"];
        $type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
        $newname = uniqid('',true).".".$type;
        $location = "../upload/food/".$newname;
        if(move_uploaded_file($tmp_name,$location)){
            if(unlink("../upload/food/$oldimage")){
                $sql = "UPDATE foodlist SET	fl_name = '$foodname' , fl_price = '$foodprice' , fl_soldout = '$soldout' , fl_image = '$newname' WHERE fl_id = '$food_id'";
            }else{
                echo"error delete image";
            }
        }else{
            echo("dsad");
        }
    }
    mysqli_query($conn,$sql);
    if($soldout == '1'){
        mysqli_query($conn,"DELETE FROM user_order WHERE order_fl_id = '$food_id' AND order_ispaid = '0'");
    }
    header("location:edit.php#foodlist");
}
if(isset($_POST["catename"])){
    $catename = $_POST["catename"];
    $cateid = $_POST["cateid"];
    mysqli_query($conn,"UPDATE food_category SET fc_name = '$catename' WHERE fc_id = '$cateid'");
    header("location:edit.php");
}



if(isset($_GET["foodlist"])){
$selectfood = $dbcon->prepare("SELECT * FROM foodlist WHERE fl_id = '".$_GET["id"]."'");
$selectfood->execute();
$row = $selectfood->fetch();
?>
<center><h1><?php echo $row["fl_name"];?></h1>
<img src="../upload/food/<?php echo $row["fl_image"];?>" style="max-width:150px;"><br><br>
<form method="post" enctype="multipart/form-data">
    <table style="width:20%;">
        <td>
        <fieldset>
            <legend><label for="foodname">ชื่ออาหาร</label></legend>
            <input type="text" name="foodname" value="<?php echo $row["fl_name"];?>" id="foodname" style="width:100%; border:white;" required>
        </fieldset>
        </td>
        <td style="width:40%;">
        <fieldset>
            <legend><label for="foodprice">ราคา</label></legend>
            <input type="number" min="1" name="foodprice" value="<?php echo $row["fl_price"];?>" id="foodprice" style="width:40%; border:white;" required>บาท
        </fieldset>
        </td><tr>
        <td colspan="2">
        <fieldset>
            <legend><label for="foodprice">สถานะของการขาย</label></legend>
            <select name="soldout" style="width:100%; border:white;">
            <?php if($row["fl_soldout"] == 1){?>
                <option value="1" selected>ของหมด</option>
                <option value="0">มีของอยู่</option>
            <?php }else{?>
                <option value="1">ของหมด</option>
                <option value="0" selected>มีของอยู่</option>
            <?php }?>
            </select>
        </fieldset>
        </td><tr>
        <td colspan="2">
        <fieldset>
            <legend><label for="image">รูปอาหารใหม่ (กรณีแก้)</label></legend>
            <input type="file" name="file" accept="image/*" id="image" style="width:100%; border:white;">
        </fieldset>
        </td><tr>
        <td colspan="2">
            <button style="width:100%;">บันทึกข้อมูล</button>
            <input type="hidden" name="food_id" value="<?php echo $row["fl_id"];?>">
            <input type="hidden" name="image" value="<?php echo $row["fl_image"];?>">
        </td></form>
    </table><br><a href="delete.php?foodlist&id=<?php echo $row["fl_id"];?>">ลบรายการนี้</a>
<?php }elseif(isset($_GET["cate"])){
$selectcate = $dbcon->prepare("SELECT * FROM food_category WHERE fc_id = '".$_GET["id"]."'");
$selectcate->execute();
$row = $selectcate->fetch();
?>
<form method="post">
    <center><h3>เปลี่ยนชื่อหมวดหมู่อาหาร</h3>
    <table>
        <td>
        <fieldset>
            <legend><label for="catename">ชื่อหมวดหมู่</label></legend>
            <input type="text" name="catename" value="<?php echo $row["fc_name"];?>" id="catename" style="width:100%; border:white;" required>
        </fieldset>
        </td><tr>
        <td>
        <button style="width:100%;">เปลี่ยนชื่อ</button>
        </td>
        <input type="hidden" name="cateid" value="<?php echo $_GET["id"];?>">
</form></table><br><a href="delete.php?cate&id=<?php echo $row["fc_id"];?>">ลบหมวดหมู่นี้และอาหารภายในทั้งหมด</a>
<?php }else{
    echo"<script>
            history.back();
        </script>";
}
?>