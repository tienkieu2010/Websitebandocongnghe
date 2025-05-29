
<meta charset="UTF-8">
<?php
    session_start();
    require_once 'connect.php';
    if(!isset($_SESSION["color_error"]))
    {
        $_SESSION["color_error"]="";
    }

    if(!isset($_SESSION["color_add_error"]))
    {
       $_SESSION["color_add_error"]="";
    }

    if (isset($_GET['action'])) {
        $p=$_GET["action"];

    switch($p)
    {
        case "save_add":
            $name=$_POST["txtpname"];
	        $sql="select * from Mausac where Tenmau like N'$name'";
            $result = $conn->query($sql);
	        if ($result->num_rows>0){
		        $_SESSION["color_add_error"]="Màu $name đã có rồi";
                header("Location:Quanlymausac.php?action=add");
            }
            else {
		        $sql = "insert into Mausac(Tenmau) values ('$name')";
                $conn->query($sql) or die($conn->error);
                if($conn->connect_error=="")
                {
                    $_SESSION["color_error"] = "Thêm màu thành công";
                    header("Location:Quanlymausac.php");
                }

                else{
		            $_SESSION["color_add_error"] = "Thêm màu không thành công";
		            header("Location:Quanlymausac.php?action=add");
                }
                //$conn->close();

            }
            break;
        

		
	    case "delete":
			$mamau = $_GET["Mamau"];
			$sql = "delete from Mausac where Mamau = $mamau";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				$_SESSION["color_error"]="Delete successful!";
			} else {
				$_SESSION["color_error"]="Delete fail!";
			}
			header("Location:Quanlymausac.php");
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
    <center><font color=red><?php echo $_SESSION["color_error"];?></center>
    <center><a href="Quanlymausac.php?action=add"> <h3>Thêm mới một màu</h3> </a></center>
    <?php
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action=="add") {
    ?>
        <h1 align=center>Thêm mới một sản phẩm</h1>
		<center><font color=red><?php echo $_SESSION["color_add_error"];?></font></center>
		<form method=POST enctype="multipart/form-data" action="Quanlymausac.php?action=save_add">
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
        
        $sql = "select * from Mausac";
        $result = $conn->query($sql) or die($conn->error);
    ?>
    <br>

    <table border=1 width=60% align=center>
        <tr>
            <th> Mã màu </th>
            <th> Tên màu</th>
     
            <th>Xóa</th>

        </tr>


        <?php
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    
        ?>
                         
				      
                 
                        <tr style="text-align:center">
                            <td><?php echo $row["Mamau"]?></td>
                            <td><?php echo $row["Tenmau"]?></td>
				            <td><a onclick="return confirm('Are you sure to delete?')" href="Quanlymausac.php?action=delete&Mamau=<?php echo $row["Mamau"];?>">
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