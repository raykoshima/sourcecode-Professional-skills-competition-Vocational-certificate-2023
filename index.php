<?php include_once("header.php");
if(isset($_GET["cate"])){
    $foodlist_sql = "SELECT * FROM foodlist WHERE fl_category = '".$_GET["id"]."' AND fl_soldout = '0'";
}else{ // ถ้ามีคำค้นหาให้ใช้ sql query ตัวนี้
    if(isset($_GET["seachfoodlist"])){
    $seachword = "%".$_GET["seachfoodlist"]."%";
    $foodlist_sql = "SELECT * FROM foodlist WHERE fl_name LIKE '$seachword' AND fl_soldout = '0'";
    }else{
    $foodlist_sql = "SELECT * FROM foodlist WHERE fl_soldout = '0'";
    }
}
?>
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
        cursor: default;
    }
    .foodlist img{
        border-radius:20px;
    }
    .catelist{
        width:64px; height:64px; background-color:black; color:white; text-align: center;
    }
</style>
<center><h1>รายการอาหาร</h1>
<h2>ประเภทอาหาร</h2>
<table>
    <?php
    $select_cate = $dbcon->prepare("SELECT * FROM food_category");
    $select_cate ->execute();
    $catelist = 0;
    while($cate = $select_cate->fetch(PDO::FETCH_ASSOC)){
    if($catelist >= 8){ // 8 ประเภทปัดลง
        echo"<tr>";
        $catelist = 1;
    }else{
        $catelist++;
    }
    ?>
    <td><a href="index.php?cate&id=<?php echo $cate["fc_id"];?>"><div class="catelist"><p style="margin-top:10px;"><br><?php echo $cate["fc_name"]; ?></p></div></a></td>
<?php }?>
</table>
<div id="foodlist"><h3>รายการอาหาร</h3></div>
<form method="get"><input type="text" placeholder="ค้นหาชื่ออาหาร" name="seachfoodlist" value="<?php if(isset($_GET["seachfoodlist"])){echo $_GET["seachfoodlist"];} ?>">&nbsp;<button>ค้นหา</button></form>
<table>
    <?php
        $select_foodlist = $dbcon->prepare($foodlist_sql);
        $select_foodlist ->execute();
        $foodlist = 0;
        while($foodl = $select_foodlist->fetch(PDO::FETCH_ASSOC)){
        if($foodlist >= 6){ // 6 รายการปัดลง
            echo"<tr>";
            $foodlist = 1;
        }else{
            $foodlist++;
        }
        ?>
        <td><center><div class="foodlist"><div><img src="upload/food/<?php echo $foodl["fl_image"];?>" style="max-width:150px;"><br><?php echo $foodl["fl_name"]."<br>ราคา ".$foodl["fl_price"]." บาท"; ?></div></div><br><a href="basket.php?add=<?php echo $foodl["fl_id"];?>"><button>เพิ่ม</button></a></center></td>
    <?php }?>