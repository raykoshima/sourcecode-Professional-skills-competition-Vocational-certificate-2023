<?php include_once("header.php");
if(isset($_POST["username"])){
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $compass = $_POST["comfirmPassword"];
    $firstname = $_POST["first_name"];
    $lastname = $_POST["last_name"];
    if($pass != $compass){
        echo"<script>alert('กรุณาใส่รหัสผ่านให้ตรงกัน'); history.back(); </script>";
    }else{
        $checkuser = $dbcon->prepare("SELECT * FROM user WHERE username = '$user'");
        $checkuser->execute();
        $row = $checkuser->fetch(PDO::FETCH_ASSOC);
        if(empty($row)){
            mysqli_query($conn,"INSERT INTO user(username,password,role,first_name,last_name,avatar)
            VALUE ('$user','$pass','1','$firstname','$lastname','avatar.png')");
            echo"<script>alert('สมัครสมาชิกแล้ว กรุณา login'); location.href=('login.php');</script>";
        }else{
            echo"<script>alert('ชื่อผู้ใช้นี้ถูกใช้งานไปแล้ว'); history.back(); </script>";
        }
    }

}else{
?>
<center><h1>Register</h1>
<table><form method="post">
    <td colspan="2">
    <fieldset>
        <legend><label for="username">Username</label></legend>
        <input type="text" name="username" id="username" style="width:100%; border:white;" required>
    </fieldset>
    </td><tr>
    <td>
    <fieldset>
        <legend><label for="password">Password</label></legend>
        <input type="password" name="password" id="password" style="width:100%; border:white;" required>
    </fieldset>
    </td>
    <td>
    <fieldset>
        <legend><label for="comfirmPassword">ยืนยันรหัสผ่าน</label></legend>
        <input type="password" name="comfirmPassword" id="comfirmPassword" style="width:100%; border:white;" required>
    </fieldset>
    </td><tr>
    <td colspan="2">
    <fieldset>
        <legend><label for="firstname">ชื่อจริง</label></legend>
        <input type="text" name="first_name" id="firstname" style="width:100%; border:white;" required>
    </fieldset>
    </td><tr>
    <td colspan="2">
    <fieldset>
        <legend><label for="lastname">นามสกุล</label></legend>
        <input type="text" name="last_name" id="lastname" style="width:100%; border:white;" required>
    </fieldset>
    </td><tr>
    <td colspan="2">
        <button style="width:100%;">สมัครสมาชิก</button>
    </td>
</form></table>
<?php } ?>