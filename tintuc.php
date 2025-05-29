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

    <script>
    function openPopup(url) {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}



    window.addEventListener('message', function(event) {
        // Kiểm tra xem thông điệp có phải là yêu cầu đóng popup và load lại trang chính hay không
        if (event.data === 'closePopupAndRedirect') {
            // Đóng popup
            closePopup();
            // Load lại trang chính
            
        }
        // Kiểm tra xem thông điệp có phải là yêu cầu hiển thị thông báo đăng bài viết thành công hay không
        if (event.data === 'successMessage') {
            // Hiển thị thông báo đăng bài viết thành công
            Swal.fire({
                title: 'Đăng bài viết thành công!',
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                // Sau khi người dùng nhấn OK, load lại trang
                if (result.value) {
                    location.reload();
                }
            });
        }
    });
    </script>

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

.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: none;
}

.popup-content {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    width: 1000px; /* Đặt chiều rộng của popup */
    height: 700px; /* Đặt chiều cao của popup */
    max-width: 90%; /* Đặt chiều rộng tối đa */
    max-height: 90%; /* Đặt chiều cao tối đa */
    overflow: auto;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}

#popupIframe {
    width: 100%; /* Đặt chiều rộng của iframe bằng với chiều rộng của popup */
    height: 95%; /* Đặt chiều cao của iframe bằng với chiều cao của popup */
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
             if(isset($_SESSION["quyen"]))
             {
             if($_SESSION["quyen"]==2)
             {
        ?>

         <li>
         <a href="#" onclick="openPopup('Dangtin.php')">
            <?php echo 'Đăng tin mới!' ?>
        </a>
        </li>

        <div class="popup-overlay" id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <!-- Nội dung của popup -->
        <iframe src="Dangtin.php" frameborder="0" id="popupIframe"></iframe>
    </div>
</div>
        <?php
            }
        }
        ?>

    </ul>
    </div>
<div style="display:flex;">
    <div class="Tintucmoi">

        <?php
            require_once("connect.php");
            $sql = "select * from tintuc order by Thoigiandang desc limit 0,3";
	        $result = $conn->query($sql) or die($conn->error);
            $tindau = $result->fetch_assoc();
        ?>

        <div class="Tindau">
            <div class="Anhtin">
                <a href="chitiettintuc.php?Matintuc=<?php echo $tindau["Matintuc"] ?>">
                    <img src='images/tintuc/<?php echo $tindau["Anhtintuc"]?>' alt="">
                </a>
            </div>

            <div class="Noidung">
                <a href='chitiettintuc.php?Matintuc=<?php echo $tindau["Matintuc"] ?>' style="text-decoration: none; color:black;"> <h2> <?php echo $tindau["Tentintuc"] ?> </h2> </a>
                <p><?php echo substr($tindau["Noidung"], 0, 200) . '...'; ?></p>
                <i><?php echo date("H:i d/m/Y", strtotime($tindau["Thoigiandang"])); ?></i>
            </div>
        </div>

        <div class="batintiep">
            <?php
                $sql = "select * from tintuc order by Thoigiandang desc limit 1,3";
                $result = $conn->query($sql) or die($conn->error);
                while($row=$result->fetch_assoc())
                {
            ?>
            <div class="Tinhaibabon">
            <a href="chitiettintuc.php?Matintuc=<?php echo $row["Matintuc"] ?>"> <img src='images/tintuc/<?php echo $row["Anhtintuc"] ?>' width=200 alt=""> </a>
             <a href="chitiettintuc.php?Matintuc=<?php echo $row["Matintuc"] ?>"  style="text-decoration: none; color:black;">   <p > <?php echo $row['Tentintuc'] ?> </p> </a>
                <i> <?php echo date("H:i d/m/Y", strtotime($row["Thoigiandang"])); ?> </i>
            </div>

            <?php
                }
            ?>
        </div>
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
                <a href="chitiettintuc.php?Matintuc=<?php echo $row2["Matintuc"] ?>"> <img src="images/tintuc/<?php echo $row2["Anhtintuc"] ?>" width=140 alt=""> </a>
                <br> 
            </div>
            <div>
               <a href="chitiettintuc.php?Matintuc=<?php echo $row2["Matintuc"] ?>"  style="text-decoration: none; color:black;">  <p style="padding:0px 13px; font-weight:bold;margin-top: 0;text-align:justify;"> <?php echo $row2["Tentintuc"] ?> </p> </a>
            </div>
        </div>

        <?php
                 }
        ?>
        
    </div>
</div>

    



<div class="Tincongnghe">

        <div>
            <p style="margin-bottom:15px; margin-left:0px ;border-bottom:1px solid black;font-weight:bold; font-size:20px;width:892px;">Tin công nghệ</p>
        </div>

    <?php
        $sql = "select * from tintuc,loaitintuc where tintuc.Maloaitin = loaitintuc.Maloaitin and Tenloaitin like N'Tin công nghệ' order by Thoigiandang desc limit 0,2";
        $result = $conn->query($sql) or die($conn->error);
        while($row3 = $result->fetch_assoc())
        {
    ?>

        <div style="display:flex;">
            <div>
                <a href="chitiettintuc.php?Matintuc=<?php echo $row3["Matintuc"] ?>"> <img src="images/tintuc/<?php echo $row3["Anhtintuc"] ?>" width=270 alt=""> </a>
            </div>

            <div style="width:600px; margin-left:23px;text-align: justify;">
                <a href="chitiettintuc.php?Matintuc=<?php echo $row3["Matintuc"] ?>"  style="text-decoration: none; color:black;"> <h3 style="margin:0px; padding:0px;"> <?php echo $row3["Tentintuc"] ?> </h3> </a>
                <p style="margin:0px;"> <?php echo substr($row3["Noidung"], 0, 350) . '..' ?> </p>
                <i> <?php echo date("H:i d/m/Y", strtotime($row3["Thoigiandang"])); ?> </i>
            </div>
        </div>
    <?php
        }
    ?>
    
</div>


<div class="Mohopvadanhgia">

        <div>
            <p style="margin-bottom:15px; margin-left:0px ;border-bottom:1px solid black;font-weight:bold; font-size:20px;width:892px;">Mở hộp & Đánh giá</p>
        </div>

    <?php
        $sql = "select * from tintuc,loaitintuc where tintuc.Maloaitin = loaitintuc.Maloaitin and Tenloaitin like N'Mở hộp & Đánh giá' order by Thoigiandang desc limit 0,2";
        $result = $conn->query($sql) or die($conn->error);
        while($row3 = $result->fetch_assoc())
        {
    ?>

        <div style="display:flex;">
            <div>
                <a href="chitiettintuc.php?Matintuc=<?php echo $row3["Matintuc"] ?>"> <img src="images/tintuc/<?php echo $row3["Anhtintuc"] ?>" width=270 alt=""> </a>
            </div>

            <div style="width:600px; margin-left:23px;text-align: justify;">
                <a href="chitiettintuc.php?Matintuc=<?php echo $row3["Matintuc"] ?>"  style="text-decoration: none; color:black;"> <h3 style="margin:0px; padding:0px;"> <?php echo $row3["Tentintuc"] ?> </h3> </a>
                <p style="margin:0px;"> <?php echo substr($row3["Noidung"], 0, 350) . '..' ?> </p>
                <i> <?php echo date("H:i d/m/Y", strtotime($row3["Thoigiandang"])); ?> </i>
            </div>
        </div>
    <?php
        }
    ?>
    
</div>


<div class="Tuyendung">

        <div>
            <p style="margin-bottom:15px; margin-left:0px ;border-bottom:1px solid black;font-weight:bold; font-size:20px;width:892px;">Tin tuyển dụng</p>
        </div>

    <?php
        $sql = "select * from tintuc,loaitintuc where tintuc.Maloaitin = loaitintuc.Maloaitin and Tenloaitin like N'Tuyển dụng' order by Thoigiandang desc limit 0,2";
        $result = $conn->query($sql) or die($conn->error);
        while($row3 = $result->fetch_assoc())
        {
    ?>

        <div style="display:flex;">
            <div>
                <a href="chitiettintuc.php?Matintuc=<?php echo $row3["Matintuc"] ?>"> <img src="images/tintuc/<?php echo $row3["Anhtintuc"] ?>" width=270 alt=""> </a>
            </div>

            <div style="width:600px; margin-left:23px;text-align: justify;">
                <a href="chitiettintuc.php?Matintuc=<?php echo $row3["Matintuc"] ?>"  style="text-decoration: none; color:black;"> <h3 style="margin:0px; padding:0px;"> <?php echo $row3["Tentintuc"] ?> </h3> </a>
                <p style="margin:0px;"> <?php echo substr($row3["Noidung"], 0, 350) . '..' ?> </p>
                <i> <?php echo date("H:i d/m/Y", strtotime($row3["Thoigiandang"])); ?> </i>
            </div>
        </div>
    <?php
        }
    ?>
    
</div>

</main>

<?php include 'footer.php'; ?>