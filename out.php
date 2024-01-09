<?php include_once("header.php"); // checkout page
$sql = "UPDATE user_order SET order_ispaid = '1' WHERE order_owner_u_id = '$user_id'";
mysqli_query($conn,$sql);
?>
<script>
    alert('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
    location.href=('cart.php');
</script>