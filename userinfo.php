<?php include_once("header.php");
if(isset($_SESSION["u_id"])){
    if(isset($_POST["first_name"])){
        $firstname = $_POST["first_name"];
        $lastname = $_POST["last_name"];
        $oldpass = $_POST["oldpass"];
        $newpass = $_POST["newpass"];
        $newpasscom = $_POST["newpasscomfirm"];
        $avatar = $_SESSION["avatar"];
        if(empty($_FILES["file"]["name"])){
            $sql = "UPDATE user SET first_name = '$firstname' , last_name = '$lastname' WHERE u_id='$user_id'";
        }else{
            $file_name = $_FILES["file"]["name"];
            $tmp_name = $_FILES["file"]["tmp_name"];
            $type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
            $newname = uniqid('',true).".".$type;
            $location = "upload/user/".$newname;
            if(move_uploaded_file($tmp_name,$location)){
                if($avatar != "avatar.png"){
                    unlink("upload/user/$avatar");
                }
                $_SESSION["avatar"] = $newname;
                $sql = "UPDATE user SET first_name = '$firstname' , last_name = '$lastname' , avatar = '$newname' WHERE u_id = '$user_id'";
            }
        }
        if(empty($oldpass)){
            mysqli_query($conn,$sql);
            $_SESSION["fullname"] = $firstname." ".$lastname;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            echo"<script>alert('บันทึกข้อมูลแล้ว'); location.href=('userinfo.php'); </script>";
        }else{
            $checkoldpass = $dbcon->prepare("SELECT * FROM user WHERE u_id = '$user_id'");
            $checkoldpass->execute();
            $row = $checkoldpass->fetch();
            if(empty($newpass)){
                echo"<script>alert('กรุณาใส่รหัสใหม่ด้วย'); history.back(); </script>";
            }else{
                if($newpass != $newpasscom){
                    echo"<script>alert('รหัสผ่านใหม่ไม่ตรงกัน'); history.back(); </script>";
                }else{
                    if($oldpass == $row["password"]){
                        mysqli_query($conn,$sql);
                        mysqli_query($conn,"UPDATE user SET password = '$newpass' WHERE u_id = '$user_id'");
                        echo"<script>alert('บันทึกข้อมูลแล้ว กรุณาเข้าสู่ระบบใหม่อีกครั้ง'); location.href=('logout.php'); </script>";
                    }else{
                        echo"<script>alert('รหัสผ่านเก่าไม่ถูกต้อง'); history.back(); </script>";
                    }
                }
            }
        }

    }else{
?>
<center><h1>ข้อมูลส่วนตัว</h1>
<img src="upload/user/<?php echo $_SESSION["avatar"];?>" style="max-width:512px; border-radius:50%;">
<br><br><br>
<table><form method="post" enctype="multipart/form-data">
<?php if(isset($_GET["edit"])){?>
    <td colspan="2">
    <fieldset>
        <legend><label for="username">ชื่อบัญชี</label></legend>
        <input type="text" value="<?php echo $_SESSION["username"];?>" style="width:100%; border:white;" disabled>
    </fieldset>
    </td><tr>
    <td>
    <fieldset>
        <legend><label for="firstname">ชื่อจริง</label></legend>
        <input type="text" name="first_name" id="firstname" value="<?php echo $_SESSION["firstname"]; ?>" style="width:100%; border:white;" required>
    </fieldset>
    </td>
    <td>
    <fieldset>
        <legend><label for="lastname">นามสกุล</label></legend>
        <input type="text" name="last_name" id="lastname" value="<?php echo $_SESSION["lastname"]; ?>" style="width:100%; border:white;" required>
    </fieldset>
    </td><tr>
    <td colspan="2">
    <fieldset>
        <legend><label for="oldpass">รหัสผ่านเก่า</label></legend>
        <input type="password" name="oldpass" id="oldpass" style="width:100%; border:white;" placeholder="ใส่เฉพาะตอนจะเปลี่ยนรหัสเท่านั้น">
    </fieldset>
    </td></tr>
    <td>
    <fieldset>
        <legend><label for="newpass">รหัสผ่านใหม่</label></legend>
        <input type="password" name="newpass" id="newpass"  style="width:100%; border:white;">
    </fieldset>
    </td><td>
    <fieldset>
        <legend><label for="newpasscomfirm">ยืนยันรหัสผ่านใหม่</label></legend>
        <input type="password" name="newpasscomfirm" id="newpasscomfirm" style="width:100%; border:white;">
    </fieldset>
    </td><tr>
    <td colspan="2">
    <fieldset>
        <legend><label for="image">รูปประจำตัว</label></legend>
        <input type="file" name="file" accept="image/*" id="image" style="width:100%; border:white;">
    </fieldset>
    </td><tr><tr>
    <td colspan="2">
        <button style="width:100%;">บันทึกข้อมูล</button>
    </td></form>
<?php }else{ ?>
    <td><h3>ชื่อบัญชี <?php echo $_SESSION["username"];?></h3></td><tr>
    <td><h3>ชื่อจริง <?php echo $_SESSION["fullname"];?></h3></td><tr>
    <td><h3>ตำแหน่ง <?php if($_SESSION["role"] == "54"){
        echo"แอดมิน";
    }else{
        echo"ลูกค้า";
    }?></h3></td></tr>
    <td><center><a href="userinfo.php?edit">แก้ไขข้อมูล</a>
<?php }}}else{
    header("location:login.php");
}