<?php include_once("header.php");
if(isset($_POST["username"])){
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $checkuser = $dbcon->prepare("SELECT * FROM user WHERE username='$user' AND password = '$pass'");
    $checkuser->execute();
    $row = $checkuser->fetch(PDO::FETCH_ASSOC);
    if(empty($row)){
        echo"<script>alert('ไม่พบบัญชีนี้'); history.back(); </script>";
    }else{
        $_SESSION["u_id"] = $row["u_id"];
        $_SESSION["fullname"] = $row["first_name"]." ".$row["last_name"];
        $_SESSION["firstname"] = $row["first_name"];
        $_SESSION["lastname"] = $row["last_name"];
        $_SESSION["role"] = $row["role"];
        $_SESSION["avatar"] = $row["avatar"];
        $_SESSION["username"] = $row["username"];
        header("location:/");
    }
}else{
?>
<center><h1>Login</h1>
<table><form method="post">
    <td>
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
    </td><tr>
    <td>
        <button style="width:100%;">เข้าสู่ระบบ</button>
    </td>
</form></table>
<?php } ?>