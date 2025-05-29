
<html lang="vi">
<head>
    <title>TienKieuMobile</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/header.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   

    <script>
    </script>

    <style>
        #imagePreview {
            width: 200px;
            height: 300px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #aaa;
            margin-top: 10px;
        }

        #imagePreview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <?php include 'headeradmin.php'; ?>


<?php
    session_start();
    require_once 'connect.php';
  
    if(isset($_GET['Masp']))
    {
        $Masp = $_GET["Masp"];
    }
    if (isset($_GET['action'])) {
        $p=$_GET["action"];

    switch($p)
    {
        case "save_edit":
            $Masp = $_GET["Masp"];
            $Masp_mausac = $_GET["Masp_mausac"];
            $nbslcon = $_POST["nbslcon"];
		        $sql = "update sanpham_mausac set Soluongcon=$nbslcon where Masp_mausac=$Masp_mausac";
                $conn->query($sql) or die($conn->error);
                if($conn->connect_error=="")
                {
                    echo "<script>
                    Swal.fire({
                        title: 'Cập nhật số lượng của sản phẩm thành công!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                        }
                        else{
                            window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                        }
                    });
                 </script>";
                }

                else{
		            echo "<script>
            Swal.fire({
                title: 'Cập nhật số lượng không thành công!',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                }
                else{
                    window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                }
            });
         </script>";
                }

                break;
                //$conn->close();

        case "addnew":
            $Masp = $_GET["Masp"];
            $mamauht = $_POST["slmau"];
            $soluong = $_POST["txtsoluong"];
            

            if (isset($_FILES['uploadanh'])) {
                $file_name = $_FILES['uploadanh']['name'];
                $file_tmp = $_FILES['uploadanh']['tmp_name'];
            
                // Kiểm tra loại file
                $file_type = exif_imagetype($file_tmp);
                if ($file_type !== false) {
                    // Các loại file ảnh được hỗ trợ
                    $allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
                    if (in_array($file_type, $allowed_types)) {
                        // Đưa file vào thư mục lưu trữ
                        $target_dir = "images/sanpham/";
                        $target_file = $target_dir . basename($file_name);
                        move_uploaded_file($file_tmp, $target_file);
            
                       
    
                        $sql = "insert into sanpham_mausac(Masp,Mamau,imagesp_mau,Soluongcon) values ('$Masp','$mamauht','$file_name','$soluong')";
                        $conn->query($sql) or die($conn->error);
                        if($conn->connect_error=="")
                        {
                            echo "<script>
                    Swal.fire({
                        title: 'Thêm biến thể của sản phẩm thành công!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                        }
                        else{
                            window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                        }
                    });
                 </script>";
                            
                        } else {
                            echo "<script>
                            Swal.fire({
                                title: 'Thêm biến thể sp không thành công!',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                                }
                                else{
                                    window.location.href = 'Capnhatsoluong.php?Masp=$Masp';
                                }
                            });
                         </script>";
                        }
                        
                    } else {
                        echo "<script> alert('Chỉ chấp nhận các loại file ảnh JPEG, PNG, GIF!') </script>";
                    
                    }
                } else {
                    echo "Tệp không phải là ảnh.";
                }
            } else {
                echo "Vui lòng chọn một tệp để tải lên.";
            }

            break;

            

    }
        
        
}



    
?>



<main>
    <br>
    <br>
    <br>
    <br>

    <?php
        $sql = "select * from sanpham where Masp=$Masp";
        $result = $conn->query($sql) or die($conn->error);
        $sp = $result->fetch_assoc();
        $Tensp = $sp["Tensp"]."(".$sp["Ram"]."-".$sp["Rom"]."GB)";
    ?>

    <h1 align=center> Danh sách các màu của: <?php echo $Tensp ?></h1>

    

    <center><a href="Capnhatsoluong.php?action=add&Masp=<?php echo $Masp ?>">Thêm màu sản phẩm</a></center>

    <?php
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action=="add") {
    ?>
	


    <form method=POST enctype="multipart/form-data" action='?Masp=<?php echo $Masp ?>&action=addnew'>
            <table border=1 width=400 align=center>

				<tr>
                	<td>Chọn màu:
                	<select name="slmau" style="width:100px;">
				<?php
					$sql1 = "select * from Mausac";
					$result1 = $conn->query($sql1);
					while($rows1 = $result1->fetch_assoc())
					{
				?>
						<option value="<?php echo $rows1["Mamau"]; ?>"> <?php echo $rows1["Tenmau"]; ?> </option>";
				<?php
					}
				?>

				</select> </td>


				<td>Ảnh:

                    <input type="file" id="imageInput" name=uploadanh accept="image/*">
                    <div id="imagePreview">Preview Image Here</div>


				</td>

				<td>Số lượng:
					<input type="text" name="txtsoluong" style="width:100px;">
				</td>

				<td>
					<input type="submit" name=action2 value="Thêm">
				</td>

				</tr>
			</table>
		</form>

		
        <script>
            document.getElementById('imageInput').addEventListener('change', function(event) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview">';
        };

        reader.readAsDataURL(input.files[0]);
    }
});
        </script>

    <?php
            }
        }
    ?>
    
   
    <?php
        
        $sql = "select * from sanpham_mausac a, sanpham b, mausac c where a.Masp = b.Masp and c.Mamau = a.Mamau and a.Masp=$Masp";
        $result = $conn->query($sql) or die($conn->error);
    ?>
    <br>

    <table border=1 width=60% align=center style="font-size:18px;">
        <tr>
            <th> Màu</th>
            <th> Ảnh sp</th>
            <th> Số lượng còn lại</th>
            <th> Cập nhật số lượng</th>

        </tr>
        


        <?php
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    if(isset($_GET["action"]) and $_GET["action"]=="edit" and isset($_GET['Masp_mausac']) and intval($_GET['Masp_mausac']) == $row["Masp_mausac"])
                    {
                    
        ?>
                            <form method=POST action="Capnhatsoluong.php?action=save_edit&Masp_mausac=<?php echo $row["Masp_mausac"] ?>&Masp=<?php echo $row["Masp"] ?>">
                                <tr style="text-align:center; font-size:18px;">
                                    <td> <?php echo $row["Tenmau"]?> : <div style="background-color:<?php echo $row["Tenmau"]?>;width:30px; height:30px; margin: 0 auto;"> </div> </td>
                                    <td> <img src='images/sanpham/<?php echo $row["imagesp_mau"]?>' width=100></td>
                                    <td> <input type="number" name='nbslcon' style="width:100px;" value='<?php echo $row["Soluongcon"] ?>'>  </td>
                                    <td> <input type="submit" value="Cập nhật">
                                        <a href="Capnhatsoluong.php?Masp=<?php echo $Masp ?>">
                                            <input type="button" value='Cancel'>
                                        </a> 
                                </td>
                                </tr>
                            </form>
                    <?php
                    }
                    else{
                    
        ?>
                         
                        <tr style="text-align:center">
                            <td><?php echo $row["Tenmau"]?> : <div style="background-color:<?php echo $row["Tenmau"]?>;width:30px; height:30px; margin: 0 auto;"> </div></td>
                            <td> <img src='images/sanpham/<?php echo $row["imagesp_mau"]?>' width=100></td>
                            <td> <?php echo $row["Soluongcon"] ?>  </td>
				            <td><a href="Capnhatsoluong.php?action=edit&Masp=<?php echo $Masp ?>&Masp_mausac=<?php echo $row["Masp_mausac"];?>">
                                <img src="images/Sua.jpg" width=30 alt="">
                            </a></td>
                        </tr>
                    <?php
                    }
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