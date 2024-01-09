<?php include_once("header.php");
if(isset($_POST["amount"])){ // บันทึกข้อมูลของ request edit
    $order_id = $_POST["order_id"];
    $amount = $_POST["amount"];
    if($amount == 0){
        mysqli_query($conn,"DELETE FROM user_order WHERE order_id = '$order_id'");
        header("location:cart.php");
    }else{
        mysqli_query($conn,"UPDATE user_order SET order_amout = '$amount' WHERE order_id = '$order_id'");
        header("location:cart.php");
    }
}
if(isset($_GET["edit"])){ // ถ้า request edit มา
    $selectfood = $dbcon->prepare("SELECT * FROM foodlist WHERE fl_id = '".$_GET["fid"]."'");
    $selectfood->execute();
    $rowa = $selectfood->fetch();
?>
<center><h1>แก้ไขจำนวน</h1>
<form method="post">
<img src="upload/food/<?php echo $rowa["fl_image"];?>" style="max-width:150px;"><br><br>
<?php echo $rowa["fl_name"];?><br>
จำนวน <input name="amount" type="number" min="0" value="<?php echo $_GET["amout"];?>">
<input type="hidden" name="order_id" value="<?php echo $_GET["edit"];?>">
<br><br><button>บันทึก</button>
</form>

<?php }else{ // หน้าหลักแบบไม่มี request
?>
<center><h1>รายการสินค้าในตระกร้าของ <?php echo $_SESSION["fullname"];?></h1>
<?php 
?>
<table border="1">
    <th>รูปภาพ</th>
    <th>ชื่ออาหาร</th>
    <th>ประเภทอาหาร</th>
    <th>ราคา</th>
    <th>จำนวน</th>
    <th>ราคารวม</th>
    <tr>
<?php 
$mycart = $dbcon->prepare("SELECT * FROM user_order as uo JOIN food_category as fc JOIN foodlist as fl ON uo.order_fl_id = fl.fl_id AND fl.fl_category = fc.fc_id WHERE order_owner_u_id = '$user_id' AND order_ispaid = '0'");
$mycart->execute();
$sumprice = 0;
while($row = $mycart->fetch(PDO::FETCH_ASSOC)){
    $sumone = $row["fl_price"] * $row["order_amout"]?>
    <td><img src="upload/food/<?php echo $row["fl_image"];?>" style="max-width:150px;"></td>
    <td><?php echo $row["fl_name"];?></td>
    <td><center><?php echo $row["fc_name"];?></center></td>
    <td><?php echo $row["fl_price"];?></td>
    <td><?php echo $row["order_amout"];?> บาท</td>
    <td><?php echo $sumone;?> บาท</td>
    <td><a href="cart.php?edit=<?php echo $row["order_id"];?>&amout=<?php echo $row["order_amout"];?>&fid=<?php echo $row["fl_id"];?>">แก้ไข</a></td>
    
    <tr>
<?php $sumprice = $sumprice + $sumone; }?>
    <tr>
    <td><td><td><td><td><td><?php echo $sumprice;?> บาท<td colspan="2"><center><a href="checkout.php">สั่งซื้อ</a></center></td>
</table>
<?php } ?>