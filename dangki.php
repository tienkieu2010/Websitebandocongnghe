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
        background-color: white;
      }

    .input-container {
      position: relative;
      width: 600px;
      height:67px;
    }

    input {
      width: 100%;
      padding: 10px;
      font-size: 16px;

      border:none;
      border-bottom:1px solid #ccc;
    }
    input:focus {
      border-bottom: 1px solid red; /* Thay thế #ccc bằng màu sắc mong muốn */
    outline: none;
    }
    

    label {
      position: absolute;
      top: 3px;
      left: 10px;
      padding: 5px 5px;
      font-size: 17px;
      color: #666;
      background-color: #fff;
      transition: 0.3s;
      pointer-events: none;
      
    }

  

    input:focus + label, input:not(:placeholder-shown) + label {
      top: -22px;
      font-size: 16px;
      color: red;
      background-color: #fff;

    }
    
    input:not(:focus) + label {
      color: #666; /* Thay thế black bằng màu bạn muốn khi không focus */
    }
    </style>

<script>
$(document).ready(function() {
    // Bắt sự kiện khi nút submit được click
    $('form').submit(function(event) {
        // Lấy giá trị của hai trường mật khẩu
        var matkhau = $('#matkhau').val();
        var nhaplaimk = $('#nhaplaimk').val();

        // Kiểm tra xem mật khẩu nhập lại có trùng khớp không
        if (matkhau !== nhaplaimk) {
            // Nếu không trùng khớp, ngăn chặn sự kiện submit và hiển thị thông báo
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mật khẩu nhập lại không khớp!',
            });
            event.preventDefault(); // Ngăn chặn sự kiện submit
        }
        // Ngược lại, cho phép submit
    });
});
</script>

    
    <?php
    require_once("connect.php");

    if(isset($_GET["action"]) && $_GET["action"]="save-add")
    {
      $name = $_POST["txtname"];
      $sodt = $_POST["txtsodt"];
      $email = $_POST["txtemail"];
      $diachi = $_POST["txtdiachi"];
      $matkhau = $_POST["txtmatkhau"];
      $tendangnhap = $_POST["txttendangnhap"];
      
      $sql="select * from user where sodt = $sodt";
      $result = $conn->query($sql);
	    if ($result->num_rows>0){
        echo "<script>
        Swal.fire({
            title: 'Số điện thoại này đã đăng kí tài khoản trong hệ thống!',
            icon: 'error',
            showCancelButton: false,
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location.href = 'dangki.php';
            }
        });
</script>";
      }
      else {
		        $sql = "insert into user(Tendangnhap,Matkhau,Tenuser,Diachi,Email,Sodienthoai,Quyen,Trangthai) values ('$tendangnhap','$matkhau','$name','$diachi','$email',$sodt,0,1)";
            $conn->query($sql) or die($conn->error);
            if($conn->connect_error=="")
            {
              echo "<script>
        Swal.fire({
            title: 'Đăng kí thành công!',
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location.href = 'login.php';
            }
        });
</script>";
            }

            
        }
    }

?>

<main>
    <br>
    <br>
		<p style="text-align:center; font-size:30px;color: #DC143C"><strong>Đăng ký tài khoản</strong></p>
		<form name=f method=POST action="?action=save-add">
        <div style="display: grid;place-items: center;">
                  
                    <div class="input-container">
                      <input type="text" name=txtname placeholder=" ">
                      <label for="fullName">Nhập họ tên</label>
                    </div>

                    <div class="input-container">
                      <input type="text" name=txtsodt placeholder=" ">
                      <label for="fullName">Nhập số điện thoại</label>
                    </div>

                    <div class="input-container">
                      <input type="text" name=txtemail placeholder=" ">
                      <label for="fullName">Nhập email</label>
                    </div>

                    <div class="input-container">
                      <input type="text" name=txtdiachi placeholder=" ">
                      <label for="fullName">Nhập địa chỉ</label>
                    </div>

                    <div class="input-container">
                      <input type="text" name=txttendangnhap placeholder=" ">
                      <label for="fullName">Nhập tên đăng nhập</label>
                    </div>

                    <div class="input-container">
                      <input type="text" name=txtmatkhau id="matkhau" placeholder=" ">
                      <label for="fullName">Nhập mật khẩu</label>
                    </div>

                    <div class="input-container">
                      <input type="text" name=txtnhaplaimk id="nhaplaimk" placeholder=" ">
                      <label for="fullName">Nhập lại mật khẩu</label>
                    </div>

                    <div class="input-container">
                      <input type="submit" name=btndki style="background-color:red; font-weight:bold; color:white;" value="Đăng ký">
                    </div>
        </div>           
  
                  
		</form>
       
</main>
<?php include 'footer.php'; ?>