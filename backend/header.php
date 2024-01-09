<link rel="stylesheet" href="style.css">
<?php include_once("../config/connect.php");
if(isset($_SESSION["role"])){
    $user_id = $_SESSION["u_id"];
    if($_SESSION["role"] == "54"){ // admin ?>
    <div class="header"><a href="/backend/"><?php echo $title2["brand"];?></a>
        <div class="header-right">
            <a href="userlist.php">ตั้งค่าผู้ใช้</a>
            <a>Welcome back Admin <a href="../userinfo.php"><?php echo $_SESSION["fullname"];?></a></a>
            <a><img src="../upload/user/<?php echo $_SESSION["avatar"];?>" style="max-width:80px;"></a>
            <!-- <a href="edit.php">การแก้ไข</a> -->
            <a href="/">[ sell page ]</a>
            <a href="logout.php">[ LOGOUT ]</a> 
            </div>
    </div><br><br><br><br>
<?php }else{ // user ?>
    <script>
        history.back();
    </script>
<?php }}else{?>
    <script>
        history.back();
    </script>
<?php } ?>