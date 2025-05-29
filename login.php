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
        <link rel="stylesheet" href="css/login.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
        <?php include 'header.php'; ?>
    <br>
    <br>

    <?php
    require_once("connect.php");
    if(!isset($_SESSION["login_error"]))
    {
        $_SESSION["login_error"]="";
    }

    if(!isset($_POST["txtTenDangNhap"]))
    {
        $taikhoan="";
    }
    else{
        $taikhoan=$_POST["txtTenDangNhap"];
    }

    if(!isset($_POST["txtMatKhau"]))
    {
        $matkhau="";
    }
    else{
        $matkhau=$_POST["txtMatKhau"];
    }

    if(!isset($_POST["cmdlogin"]))
    {
        $cmd="";
    }
    else{
        $cmd=$_POST["cmdlogin"];
    }
    

    if($cmd!="")
    {
    if($taikhoan!="" && $matkhau!="")
    {
        $sql = "select * from user where Tendangnhap like'$taikhoan' and Matkhau like'$matkhau'";
        $result = $conn->query($sql) or die($conn->error);
        if($result->num_rows>0)
        {
            $rows = $result->fetch_assoc();
            if($rows["Quyen"]==1)
            {
                $_SESSION["login"]="true";
                $_SESSION["uid"] = $rows["Mauser"];
                $_SESSION["fullname"] = $rows["Tenuser"];
                $_SESSION["quyen"] = 1;
                echo "<script>
				alert('Đăng nhập thành công!');
				setTimeout(function() {
					window.location.replace('Admin.php');
				}, 2000);
			 </script>";
            }
            if($rows["Quyen"]==0)
            {
                $_SESSION["login"]="true";
                $_SESSION["uid"] = $rows["Mauser"];
                $_SESSION["fullname"] = $rows["Tenuser"];
                $_SESSION["quyen"] = 0;
                echo "<script>
                Swal.fire({
                    title: 'Đăng nhập thành công',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'index.php';
                    }
                });
			 </script>";
            }
            if($rows["Quyen"]==2)
            {
                $_SESSION["login"]="true";
                $_SESSION["uid"] = $rows["Mauser"];
                $_SESSION["fullname"] = $rows["Tenuser"];
                $_SESSION["quyen"] = 2;
                echo "<script>
                Swal.fire({
                    title: 'Đăng nhập thành công',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'index.php';
                    }
                });
			 </script>";
            }

        } 
        else{
            $_SESSION["login"]="false";
            echo '<script>alert("Sai tài khoản hoặc mật khẩu");</script>';
        }
    }
    else{
        echo '<script>alert("Vui lòng điền đầy đủ thông tin");</script>';
    }
    }

?>

<main>
    <br>
    <br>
		<p style="text-align:center; font-size:30px;color: #DC143C"><strong>Đăng nhập hệ thống</strong></p>
		<form name=f method=POST action="login.php">
		<table cellspacing=10 cellpadding=3 align=center>			
				<tr>
					<td><input type=text class="textbox"  placeholder="Tên đăng nhập/Email/Số điện thoại" name=txtTenDangNhap></td>
				</tr>
				<tr>
					<td>
						<input type=password class="textbox"  placeholder="Mật khẩu" id=pass name=txtMatKhau>
					</td>
                </tr>

                <tr>

                <td> <input type=checkbox id=check> Hiển thị mật khẩu </td>

<script>
    const pwd = document.getElementById("pass");
    const chck=document.getElementById("check");
    chck.onchange = function(e){
        pwd.type=chck.checked ? "text" : "password";
    };
</script>
                </tr>
				<tr>
					<td class="but"><input type=submit name=cmdlogin value="Đăng nhập">
                    &nbsp &nbsp &nbsp
					<input type=reset value="Làm mới"></td>
				</tr>
		</table>
		
		</form>
        <a href="dangki.php">Đăng kí</a>
        <br>
        <a href="quenmatkhau.php">Quên mật khẩu</a>
</main>
<?php include 'footer.php'; ?>