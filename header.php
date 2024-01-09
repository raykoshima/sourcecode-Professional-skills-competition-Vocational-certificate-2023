<link rel="stylesheet" href="style.css">
<?php include_once("config/connect.php");
if(isset($_SESSION["role"])){
    $user_id = $_SESSION["u_id"];
    $cartlist = mysqli_query($conn,"SELECT * FROM user_order WHERE order_owner_u_id = '$user_id' AND order_ispaid = '0'");
    $cart = mysqli_num_rows($cartlist);
    if($_SESSION["role"] == "54"){ // admin ?>
    <div class="header"><a href="/"><?php echo $title2["brand"];?></a>
        <div class="header-right">
            <a href="cart.php">ตระกร้า (<?php echo $cart?>)</a>
            <a href="history.php">ประวัติการซื้อ</a>
            <a>Welcome back Admin <a href="userinfo.php"><?php echo $_SESSION["fullname"];?></a></a>
            <a href="userinfo.php"><img src="upload/user/<?php echo $_SESSION["avatar"];?>" style="max-width:80px;"></a>
            <a href="backend/">[ dashboard ]</a>
            <a href="logout.php">[ LOGOUT ]</a>
            </div>
            
    </div><br><br><br><br>
<?php }else{ // user ?>
    <div class="header"><a href="/"><?php echo $title2["brand"];?></a>
        <div class="header-right">
            <a href="cart.php">ตระกร้า (<?php echo $cart?>)</a>
            <a href="history.php">ประวัติการซื้อ</a>
            <a>Welcome back คุณลูกค้า <a href="userinfo.php"><?php echo $_SESSION["fullname"];?></a></a>
            <a href="userinfo.php"><img src="upload/user/<?php echo $_SESSION["avatar"];?>" style="max-width:80px;"></a>
            <a href="logout.php">[ LOGOUT ]</a>
            </div>
    </div><br><br><br><br>
<?php }}else{?>
    <div class="header"><a href="/"><?php echo $title2["brand"];?></a>
        <div class="header-right">
            <a href="login.php">[ LOGIN ]</a>
            <a href="register.php">[ REGISTER ]</a>
    </div><br><br><br><br>
<?php } ?>