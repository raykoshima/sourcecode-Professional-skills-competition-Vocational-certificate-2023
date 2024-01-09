<?php include_once("header.php");
if(isset($_GET["seachfoodlist"])){
$seachword = "%".$_GET["seachfoodlist"]."%";
$foodlist_sql = "SELECT * FROM foodlist WHERE fl_name LIKE '$seachword'";
}else{
$foodlist_sql = "SELECT * FROM foodlist";
}
?><br><br><br><br>
<center><h1>เลือกประเภทการแก้ไข</h1>
<style>
    .foodlist a{
    text-decoration: none;
    color:white;
    text-align: center;
}
    .foodlist{
        background-color:black;
        border-radius:20px;
        color:white;
        padding-bottom:10px;
    }
    .foodlist img{
        border-radius:20px;
    }
</style>
<h3>ข้อมูลเว็ปไซต์</h3>
<form method="post" action="adminfuncion/webconfig.php">
    <table>
        <th>title</th>
        <th>icon url</th>
        <th>ชื่อร้าน</th>
        <tr>
        <td><input type="text" value="<?php echo $title2["title"]; ?>" name="webtitle"></td>
        <td><input type="text" value="<?php echo $title2["icon"]; ?>" name="webicon"></td>
        <td><input type="text" value="<?php echo $title2["brand"]; ?>" name="webbrand"></td>
        <tr>
            <td>
            <td><button style="width:100%;">บันทึก</button>
    </table>
</form>
<h3>ประเภทชื่ออาหาร</h3>
<table>
    <?php
    $select_cate = $dbcon->prepare("SELECT * FROM food_category");
    $select_cate ->execute();
    $catelist = 0;
    while($cate = $select_cate->fetch(PDO::FETCH_ASSOC)){
    if($catelist >= 4){
        echo"<tr>";
        $catelist = 1;
    }else{
        $catelist++;
    }
    ?>
    <td><a href="view.php?cate&id=<?php echo $cate["fc_id"];?>"><div style="width:64px; height:64px; background-color:black; color:white; text-align: center;"><p style="margin-top:10px;"><br><?php echo $cate["fc_name"]; ?></p></div></a></td>

<?php }?>
    <tr><td><a href="add.php?category"><div style="width:64px; height:64px; background-color:black; color:white; text-align: center;"><p style="margin-top:10px;"><br>+</p></div></a></td>
</table>
<div id="foodlist"><h3>รายการอาหาร</h3></div>
<form method="get"><input type="text" placeholder="ค้นหาชื่ออาหาร" name="seachfoodlist" value="<?php if(isset($_GET["seachfoodlist"])){echo $_GET["seachfoodlist"];} ?>">&nbsp;<button>ค้นหา</button></form>
<table>
    <?php
        $select_foodlist = $dbcon->prepare($foodlist_sql);
        $select_foodlist ->execute();
        $foodlist = 0;
        while($foodl = $select_foodlist->fetch(PDO::FETCH_ASSOC)){
        if($foodlist >= 4){
            echo"<tr>";
            $foodlist = 1;
        }else{
            $foodlist++;
        }
        ?>
        <td class="foodlist"><a href="view.php?foodlist&id=<?php echo $foodl["fl_id"];?>"><div ><img src="../upload/food/<?php echo $foodl["fl_image"];?>" style="max-width:150px;"><br><?php echo $foodl["fl_name"]."<br>ราคา ".$foodl["fl_price"]." บาท"; ?></div></a></td>
    <?php }?>
    <tr><td><td style=""><a href="add.php?foodlist"><div style="width:64px; height:64px; border-radius:20px; background-color:white; color:white; text-align: center;"><p style="margin-top:10px;"><br><img src="../upload/web/addFood.png" width="64px"></p></div></a></td>