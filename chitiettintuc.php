<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TienKieumobile</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/header.css">
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        
        
        <?php include 'header.php'; ?>
    <br>
    <br>


    <style>
        body{
          
        }

        main{
            max-width: 1500px;
    min-height: 600px;
    margin-left: 140px;
    margin-right: 135px;
    margin-top: 30px;
    height: auto;
    background-color: rgb(254, 254, 251);
    padding:20px;
    
}



.Tindau {
  width: 800px;
  display: flex;
  justify-content:center;
  padding:15px;
}

.Anhtin img {
  width: 350px;
  max-width: 1200px; /* Giảm kích thước ảnh nếu nó lớn hơn 400px */
  padding-top:22px;
}

.Noidung {
  width: 450px;
  padding-left:15px;
}

.batintiep {
    padding:15px;
  display: flex;
  width:800px;
}

.Tinhaibabon {
  width: calc(33.333% - 0px); /* 10px là khoảng cách giữa các tin */
  display: flex;
  flex-direction: column;
}

.Tinhaibabon img {
  width: 100%;
  max-width: 240px; /* Giảm kích thước ảnh nếu nó lớn hơn 200px */
  
}

.Tinhaibabon p{
    width:100%;
    max-width:240px;
    font-weight:bold;
    text-align: justify;
}



.Noidung p{
    width:418px;
    text-align: justify;
}
.Noidung h2{
    width:418px;
    text-align: justify;
}

.Tincongnghe{
    margin:20px;
}

.Mohopvadanhgia{
    margin:20px;
}

.Tuyendung{
    margin:20px;
}


ul.menutintuc {
    list-style-type: none;
    width:590px;
    margin: 0;
    padding: 0;
    display: flex; /* Chuyển sang hiển thị theo chiều ngang */
    background-color: transparent; /* Màu nền của menu */
}

/* Thiết lập giao diện cho mỗi mục menu */
ul.menutintuc li {
    padding: 10px 20px; /* Kích thước của mỗi mục menu */
    border-radius: 5px;
    color: #74D6D6;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

ul.menutintuc li a{
    color: #C9B124;
    font-weight:bold;
    text-decoration: none;
}

/* Hiệu ứng khi di chuột vào mục menu */
ul.menutintuc li:hover {
    background-color: #555; /* Màu nền khi di chuột vào mục menu */
}

</style>
    
    <?php
    require_once("connect.php");

    
    

?>

<main class="centered">

    <div style="display:flex; justify-content:center;">
    <ul class="menutintuc">
        <?php
             $sql = "select * from loaitintuc";
             $result = $conn->query($sql) or die($conn->error);
             while($row = $result->fetch_assoc())
             {
        ?>
        <li> <a href="alltintucbyloai.php?Maloaitin=<?php echo $row["Maloaitin"] ?>"> 
                <?php echo $row["Tenloaitin"] ?>
            </a>
        </li>
        <?php
             }
        ?>
    </ul>
    </div>
<div style="display:flex;">
    <div style="text-align:justify; width:750px; padding:20px;">

        <?php
            require_once("connect.php");
            if(!isset($_GET["Matintuc"]))
            {
                header("Location:tintuc.php");
            }
            $Matintuc = $_GET["Matintuc"];
            $sql = "select * from tintuc,user where tintuc.Mauser = user.Mauser and Matintuc = $Matintuc";
	        $result = $conn->query($sql) or die($conn->error);
            $tin = $result->fetch_assoc();
        ?>

        <div style="width: 750px;">
            <h2 style="margin-bottom:15px;"> <?php echo $tin["Tentintuc"] ?> </h2>
            <div style="display:flex;">
            <div>
                <i class='material-icons'>account_circle</i>
            </div>
            <div> 
                <p style="margin:4px;"> <?php echo $tin["Tenuser"] ?>-<?php echo date("H:i d/m/Y", strtotime($tin["Thoigiandang"])); ?> </p>
            </div>
        </div>
    </div>

        <p style=""> <?php echo $tin["Noidung"] ?> </p>

      
</div>


    <div>
        
        <p style="font-weight:bold;font-size:22px;padding-top:10px;margin-left:15px;border-bottom:1px solid black;">Tin khuyến mãi</p>
    

       
            
        <?php
                 $sql = "select * from tintuc,loaitintuc where tintuc.Maloaitin = loaitintuc.Maloaitin and Tenloaitin like N'Tin khuyễn mãi' order by Thoigiandang desc limit 0,4";
                 $result = $conn->query($sql) or die($conn->error);
                 while($row2 = $result->fetch_assoc())
                 {
        ?>
         <div style='width:370px ;display:flex; margin-left:16px; margin-top:0px; padding:0px;'>
            <div style=' text-align:center; padding-top:0px;'>
                <a href=""> <img src="images/tintuc/<?php echo $row2["Anhtintuc"] ?>" width=140 alt=""> </a>
                <br> 
            </div>
            <div>
               <a href=""  style="text-decoration: none; color:black;">  <p style="padding:0px 13px; font-weight:bold;margin-top: 0;text-align:justify;"> <?php echo $row2["Tentintuc"] ?> </p> </a>
            </div>
        </div>

        <?php
                 }
        ?>
        
    </div>
</div>

    

</main>

<?php include 'footer.php'; ?>