<?php include_once("header.php");
if(isset($_GET["id"])){
    if($_GET["role"] == 54){
        $newrole = 1;
    }else{
        $newrole = 54;
    }
    mysqli_query($conn,"UPDATE user SET role = '$newrole' WHERE u_id = '".$_GET["id"]."'");
    header("location:userlist.php");
}else{
?>
<center><h1>รายชื่อ user ทั้งหมด</h1>
<table>
    <th></th>
    <th>username</th>
    <th>Fullname</th>
    <th>ตำแหน่ง</th>
    
<?php $userlist = $dbcon->prepare("SELECT * FROM user WHERE u_id NOT LIKE '$user_id'");
      $userlist->execute();
while($row = $userlist->fetch(PDO::FETCH_ASSOC)){?>
    <tr>
        <td><img src="../upload/user/<?php echo $row["avatar"];?>" style="max-width:80px;"></td>
        <td><?php echo $row["username"];?></td>
        <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
        <td><center><?php if($row["role"] == "54"){
        echo"แอดมิน";
    }else{
        echo"ลูกค้า";
    }?></center></td><td><a href="userlist.php?id=<?php echo $row["u_id"];?>&role=<?php echo $row["role"];?>">ปรับตำแหน่ง</a></td>
<?php } ?>
<?php } ?>