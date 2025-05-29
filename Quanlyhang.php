
<meta charset="UTF-8">
<?php
    session_start();
    require_once 'connect.php';
    if(!isset($_SESSION["hang_error"]))
    {
        $_SESSION["hang_error"]="";
    }

    if(!isset($_SESSION["hang_add_error"]))
    {
       $_SESSION["hang_add_error"]="";
    }

    if (isset($_GET['action'])) {
        $p=$_GET["action"];

    switch($p)
    {
        case "save_add":
            $name=$_POST["txtpname"];
	        $sql="select * from hang where Tenhang like N'$name'";
            $result = $conn->query($sql);
	        if ($result->num_rows>0){
		        $_SESSION["hang_add_error"]="Màu $name đã có rồi";
                header("Location:Quanlyhang.php?action=add");
            }
            else {
		        $sql = "insert into hang(Tenmau) values ('$name')";
                $conn->query($sql) or die($conn->error);
                if($conn->connect_error=="")
                {
                    $_SESSION["hang_error"] = "Thêm màu thành công";
                    header("Location:Quanlyhang.php");
                }

                else{
		            $_SESSION["hang_add_error"] = "Thêm màu không thành công";
		            header("Location:Quanlyhang.php?action=add");
                }
                //$conn->close();

            }
            break;
        

		
	    case "delete":
			$mamau = $_GET["Mamau"];
			$sql = "delete from hang where Mamau = $mamau";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				$_SESSION["hang_error"]="Delete successful!";
			} else {
				$_SESSION["hang_error"]="Delete fail!";
			}
			header("Location:Quanlyhang.php");
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

    <h1 align=center> Danh sách các hãng có trong hệ thống </h1>
    <center><font hang=red><?php echo $_SESSION["hang_error"];?></center>
    <center><a href="Quanlyhang.php?action=add"> <h3>Thêm mới một màu</h3> </a></center>
    <?php
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action=="add") {
    ?>
        <h1 align=center>Thêm mới một hãng</h1>
		<center><font hang=red><?php echo $_SESSION["hang_add_error"];?></font></center>
		<form method=POST enctype="multipart/form-data" action="Quanlyhang.php?action=save_add">
			<table border=0 align=center width=400>
				<tr>
					<td>Tên màu:</td>
					<td><input style="width:180px" type=text name=txtpname></td>
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
        
        $sql = "select * from hang";
        $result = $conn->query($sql) or die($conn->error);
    ?>
    <br>

    <table border=1 width=60% align=center>
        <tr>
            <th> Mã hãng </th>
            <th> Tên hãng</th>
            <th> Ảnh hãng</th>
            <th>Xóa</th>

        </tr>


        <?php
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    
        ?>
                         
                        <tr style="text-align:center">
                            <td><?php echo $row["Mahang"]?></td>
                            <td><?php echo $row["Tenhang"]?></td>
                            <td> <img src="<?php echo $row["Anhhang"]?>" width=100></td>
				            <td><a onclick="return confirm('Are you sure to delete?')" href="Quanlyhang.php?action=delete&Mahang=<?php echo $row["Mahang"];?>">
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