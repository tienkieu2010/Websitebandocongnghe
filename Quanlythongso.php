
<meta charset="UTF-8">
<?php
    session_start();
    require_once 'connect.php';
    if(!isset($_SESSION["thongso_error"]))
    {
        $_SESSION["thongso_error"]="";
    }

    if(!isset($_SESSION["thongso_add_error"]))
    {
       $_SESSION["thongso_add_error"]="";
    }

    if (isset($_GET['action'])) {
        $p=$_GET["action"];

    switch($p)
    {
        case "save_add":
            $sanphamapdung=$_POST["tasanphamapdung"];

            $manhinh = $_POST["tamanhinh"];
            $hedieuhanh = $_POST["txthedieuhanh"];
            $camerasau = $_POST["tacamerasau"];
            $cameratruoc = $_POST["tacameratruoc"];
            $cpu = $_POST["tacpu"];
            $ram = $_POST["taram"];
            $rom = $_POST["tarom"];
            $dungluongpinsac = $_POST["tadungluongpinsac"];
            $thietke = $_POST["tathietke"];
            $congnghebaomat = $_POST["tacongnghebaomat"];
            $mota = $_POST["tamota"];

	        $sql="select * from thongsosanpham where sanphamapdung like N'$sanphamapdung'";
            $result = $conn->query($sql);
	        if ($result->num_rows>0){
		        $_SESSION["thongso_add_error"]="Thông số áp dụng cho sản phẩm $sanphamapdung đã có rồi";
                header("Location:Quanlythongso.php?action=add");
            }
            else {
		        $sql = "insert into thongsosanpham(Manhinh,Hedieuhanh,Camerasau,Cameratruoc,CPU,Ram,Rom,Dungluongpinsac,Thietke,Congnghebaomat,Mota,Sanphamapdung) values ('$manhinh','$hedieuhanh','$camerasau','$cameratruoc','$cpu','$ram','$rom','$dungluongpinsac','$thietke','$congnghebaomat','$mota','$sanphamapdung')";
                $conn->query($sql) or die($conn->error);
                if($conn->connect_error=="")
                {
                    $_SESSION["thongso_error"] = "Thêm thông số thành công";
                    header("Location:Quanlythongso.php");
                }

                else{
		            $_SESSION["thongso_add_error"] = "Thêm thông số không thành công";
		            header("Location:Quanlythongso.php?action=add");
                }
                //$conn->close();

            }
            break;
        

		
	    case "delete":
			$mamau = $_GET["Mamau"];
			$sql = "delete from thongso where Mamau = $mamau";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				$_SESSION["thongso_error"]="Delete successful!";
			} else {
				$_SESSION["thongso_error"]="Delete fail!";
			}
			header("Location:Quanlythongso.php");
		}
	}



    
?>


<html lang="vi">
<head>
    <title>TienKieuMobile</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/header.css">

    <script>
    </script>
    <?php include 'headeradmin.php'; ?>
<main>
    <br>
    <br>
    <br>
    <br>

    <h1 align=center> Danh sách các màu có trong hệ thống </h1>
    <center><font thongso=red><?php echo $_SESSION["thongso_error"];?></center>
    <center><a href="Quanlythongso.php?action=add"> <h3>Thêm mới một thông số</h3> </a></center>
    <?php
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action=="add") {
    ?>
        <h1 align=center>Thêm mới một thông số</h1>
		<center><font thongso=red><?php echo $_SESSION["thongso_add_error"];?></font></center>
		<form method=POST enctype="multipart/form-data" action="Quanlythongso.php?action=save_add">
			<table border=0 align=center width=400>
				<tr>
					<td>Màn hình:</td>
					<td><textarea style="width:250px;" rows=2 name=tamanhinh></textarea></td>
				</tr>
                <tr>
					<td>Hệ điều hành:</td>
					<td><input type=text  style="width:250px;" name=txthedieuhanh></td>
				</tr>
                <tr>
					<td>Camera sau:</td>
					<td><textarea style="width:250px" rows=3 name=tacamerasau></textarea></td>
				</tr>
                <tr>
					<td>Camera trước:</td>
					<td><textarea cols=20 style="width:250px" rows=3 name=tacameratruoc></textarea></td>
				</tr>
                <tr>
					<td>CPU:</td>
					<td><textarea cols=20 style="width:250px" rows=3 name=tacpu></textarea></td>
				</tr>
                <tr>
					<td>Ram:</td>
					<td><textarea cols=20 style="width:250px" rows=2 name=taram></textarea></td>
				</tr>
                <tr>
					<td>Rom:</td>
					<td><textarea cols=20 style="width:250px" rows=1 name=tarom></textarea></td>
				</tr>
                <tr>
					<td>Dung lượng pin sạc:</td>
					<td><textarea cols=20 style="width:250px" rows=1 name=tadungluongpinsac></textarea></td>
				</tr>
                <tr>
					<td>Thiết kế:</td>
					<td><textarea cols=20 style="width:250px" rows=2 name=tathietke></textarea></td>
				</tr>
                <tr>
					<td>Công nghệ bảo mật:</td>
					<td><textarea cols=20 style="width:250px" rows=2 name=tacongnghebaomat></textarea></td>
				</tr>
                <tr>
					<td>Mô tả:</td>
					<td><textarea cols=20 style="width:250px" rows=2 name=tamota></textarea></td>
				</tr>

                <tr>
					<td>Sản phẩm áp dụng:</td>
					<td><textarea cols=20 style="width:250px" rows=2 name=tasanphamapdung></textarea></td>
				</tr>
				
				<tr>
					<td align=right><input type=submit value="Thêm mới"></td>
					<td><input type=reset value="Làm lại">
						<!--<input type=hidden name=action value="save_add">-->
				</tr>
			</table>
		</form>
    
    <?php
            }
        }
        else{
            echo "";
        }
        
        $sql = "select * from thongsosanpham";
        $result = $conn->query($sql) or die($conn->error);
    ?>
    <br>

    <table border=1 width=100% align=center>
        <tr>
            <th>Mã thông số</th>
            <th>Màn hình</th>
            <th>Hệ điều hành</th>
            <th>Cammera sau</th>
            <th>Cammera trước</th>
            <th>CPU</th>
            <th>Ram</th>
            <th>Rom</th>
            <th>Dung lượng pin sạc</th>
            <th>Thiết kế</th>
            <th>Công nghệ bảo mật</th>
            <th>Mô tả</th>
            <th>Sản phẩm áp dụng</th>
            <th>Cập nhật</th>
            <th>Xóa</th>
        </tr>


        <?php
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    
        ?>
                        <tr style="text-align:center">
                            <td><?php echo $row["Mathongso"]?></td>
                            <td><?php echo $row["Manhinh"]?></td>
                            <td><?php echo $row["Hedieuhanh"]?></td>
                            <td><?php echo $row["Camerasau"]?></td>
                            <td><?php echo $row["Cameratruoc"]?></td>
                            <td><?php echo $row["CPU"]?></td>
                            <td><?php echo $row["Ram"]?></td>
                            <td><?php echo $row["Rom"]?></td>
                            <td><?php echo $row["Dungluongpinsac"]?></td>
                            <td><?php echo $row["Thietke"]?></td>
                            <td><?php echo $row["Congnghebaomat"]?></td>
                            <td><?php echo $row["Mota"]?></td>
                            <td><?php echo $row["Sanphamapdung"]?></td>
                            <td><a href="Quanlythongsophp?action=edit&Mathongso=<?php echo $row["Mathongso"];?>">Sửa</a></td>
				            <td><a onclick="return confirm('Are you sure to delete?')" href="Quanlythongso.php?action=delete&Mathongso=<?php echo $row["Mathongso"];?>">
                                <img src="images/Xoa.jpg" width=30 alt="">
                            </a></td>
                        </tr>
                    <?php
                    }
                }
            

            else{
                echo "Tập dữ liệu rỗng!";
            }

        ?>
    </table>

</main>

<br>
<br>
<br>
<?php include 'footer.php'; ?>

<?php
    
?>