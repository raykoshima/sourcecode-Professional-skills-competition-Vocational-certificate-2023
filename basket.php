<?php include_once("header.php");
if(isset($_POST["amount"])){ // ถ้ามี request ให้ทำอันนี้ 
$amount = $_POST["amount"];
$fl_id = $_POST["id"];
mysqli_query($conn,"INSERT INTO user_order(order_fl_id,order_amout,order_ispaid,order_owner_u_id)
VALUE('$fl_id','$amount','0','$user_id')");
header("location:/");
}else{ // ถ้าไม่มี request
$selectfood = $dbcon->prepare("SELECT * FROM foodlist WHERE fl_id = '".$_GET["add"]."'");
$selectfood->execute();
$row = $selectfood->fetch();
?><form method="post">
<center><h1>กรุณาใส่จำนวนของ<?php echo $row["fl_name"];?>ที่ต้องการ</h1>
<img src="upload/food/<?php echo $row["fl_image"];?>" style="max-width:150px;"><br>
<input type="number" min="1" value="1" name="amount">
<input type="hidden" name="id" value="<?php echo $_GET["add"];?>">
<button>เพิ่ม</button>
</form>
<?php } ?>