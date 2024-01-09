<?php include_once("header.php");
?>
<center><h1>ประวัติการซื้อ <?php echo $_SESSION["fullname"];?></h1>
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
$mycart = $dbcon->prepare("SELECT * FROM user_order as uo JOIN food_category as fc JOIN foodlist as fl ON uo.order_fl_id = fl.fl_id AND fl.fl_category = fc.fc_id WHERE order_owner_u_id = '$user_id' AND order_ispaid = '1'");
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
    
    
    <tr>
<?php $sumprice = $sumprice + $sumone; }?>
</table>