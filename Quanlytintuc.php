

<html lang="vi">
<head>
    <title>TienKieuMobile</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/header.css">
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <?php include 'headeradmin.php'; ?>
       

<?php
require_once 'connect.php';
session_start();
if(!isset($_SESSION["color_error"]))
{
    $_SESSION["color_error"]="";
}

if(!isset($_SESSION["color_add_error"]))
{
   $_SESSION["color_add_error"]="";
}

if (isset($_GET["action"])) {
    $p=$_GET["action"];


    function strconvert($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        return $str;
    }


switch($p)
{
    case "save_add":

        $type = substr($_FILES["fileanh"]["type"],0,5);
        $target ="images/tintuc/".strconvert($_FILES["fileanh"]["name"]);
        if ($type!="image"){
            echo "<script>
            Swal.fire({
                title: 'Sai kiểu, vui lòng upload Ảnh!',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'Quanlytintuc.php?action=add';
                }
                else{
                    window.location.href = 'Quanlytintuc.php?action=add';
                }
            });
         </script>";
        } else if (move_uploaded_file($_FILES["fileanh"]["tmp_name"],$target)){

            $fileName = $_FILES["fileanh"]["name"];
            

        $tentintuc=$_POST["txttentintuc"];
        $noidung = $_POST["txtnoidung"];
        $loaitin = $_POST["slloaitin"];
        $mauser = $_SESSION['uid'];
        $thoigiandang = date("Y-m-d H:i:s");



        $sql = "select * from tintuc where Tentintuc like N'$tentintuc'";
        $result = $conn->query($sql);
        if ($result->num_rows>0){
            echo "<script>
            Swal.fire({
                title: 'Tin tức có tiêu đề này đã tồn tại!',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'Quanlytintuc.php?action=add';
                }
                else{
                    window.location.href = 'Quanlytintuc.php?action=add';
                }
            });
         </script>";
        }
        else {
            
            $sql = "insert into tintuc(Tentintuc,Noidung,Anhtintuc,Thoigiandang,Mauser,Maloaitin) values ('$tentintuc','$noidung','$fileName','$thoigiandang',$mauser,$loaitin)";
            $conn->query($sql) or die($conn->error);
            
            if($conn->connect_error=="")
            {
                echo "<script>
            Swal.fire({
                title: 'Thêm tin tức mới thành công!',
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'Quanlytintuc.php';
                }
                else{
                    window.location.href = 'Quanlytintuc.php';
                }
            });
         </script>";
            }

            else{
                echo "<script>
            Swal.fire({
                title: 'Thêm tin tức mới không thành công!',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'Quanlytintuc.php?action=add';
                }
                else{
                    window.location.href = 'Quanlytintuc.php?action=add';
                }
            });
         </script>";
        

         
            }
            //$conn->close();

            

        }
    }
    
    break;
    

    
    case "delete":
        $matintuc = $_GET["Matintuc"];
        $sql = "delete from tintuc where Matintuc= $matintuc";
        $conn->query($sql) or die($conn->error);
        if ($conn->error==""){
            echo "<script>
            Swal.fire({
                title: 'Xóa tin thành công!',
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'Quanlytintuc.php';
                }
                else{
                    window.location.href = 'Quanlytintuc.php';
                }
            });
         </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Xóa tin không thành công!',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'Quanlytintuc.php';
                }
                else{
                    window.location.href = 'Quanlytintuc.php';
                }
            });
         </script>";
        }


    }
}




?>




        <script>
  CKEDITOR.replace('editor', {
    height: 700, // Chiều cao của trình soạn thảo
    toolbar: 'full', // Thanhd công cụ, có thể là 'basic', 'full', hoặc bạn có thể tùy chỉnh
    // Các tùy chọn khác...
  });


  function previewImage(input) {
            var preview = document.getElementById('image-preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
</script>

<style>
  .tablett {
    width: 90%;
    margin: 0 auto; /* Để căn giữa bảng */
    border-collapse: collapse;
  }

  .tablett tr {
    border-bottom: 1px solid #ddd; /* Đường viền dưới cho từng hàng */
    align:center;
    
  }

  .tablett td {
    padding: 10px;
    text-align: left;
    
  }

  .tablett input {
    width: 100%; /* Độ rộng 100% của input trong cột */
    padding: 8px;
    box-sizing: border-box; /* Đảm bảo rằng padding và border không làm tăng kích thước của ô input */
  }

  .tablett input[type="submit"],
  .tablett input[type="reset"] {
    width: auto; /* Độ rộng tự động để nút chỉ chiếm không gian cần thiết */
    padding: 8px 12px; /* Điều chỉnh padding cho nút */
  }

  .tablett td:last-child {
    text-align: center; /* Căn phải cho cột cuối cùng */
  }

   .tablett th:nth-child(1), td:nth-child(1) {
      width: 10%; /* Ví dụ: Đặt kích thước cho cột đầu tiên là 20% */
    }

    .tablett th:nth-child(2), td:nth-child(2) {
      width: 90%; /* Ví dụ: Đặt kích thước cho cột thứ hai là 40% */
    }



    #chonanhtintuc {
    text-align: center;
    margin-top: 20px;
}

label {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

input[type="file"] {
    display: none;
}

#image-preview {
    max-width: 100%;
    max-height: 200px;
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.Bangtintuc {
    width: 100%;
    border-collapse: collapse;
}

.Bangtintuc th,
.Bangtintuc td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.Bangtintuc th {
    background-color: #f2f2f2;
    text-align: left;
}

.Bangtintuc tr:hover {
    background-color: #f5f5f5;
}


/* CSS cho nút chỉnh sửa và xóa */
.Bangtintuc a {
    display: inline-block;
    padding: 5px 10px; /* Điều chỉnh padding tùy ý */
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
}

.Bangtintuc a:hover {
    background-color: #0056b3;
}
</style>

 



<main>
    <br>
    <br>
    <br>
    <br>

    <h1 align=center> Danh sách tin tức có trong hệ thống </h1>
    <center><font color=red><?php echo $_SESSION["color_error"];?></center>
    
        <button style="background-color:aqua; border:none; border-radius:10px;height:50px;"> 
            <a style="text-decoration:none;" href="Quanlytintuc.php?action=add"> <h3>Thêm mới một tin tức</h3> </a>
        </button>
    
    <?php
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action=="add") {
    ?>
        <h1 align=center>Thêm mới một tin tức</h1>
		<center><font color=red><?php echo $_SESSION["color_add_error"];?></font></center>
		<form method=POST enctype="multipart/form-data" action="Quanlytintuc.php?action=save_add">
			<table border=0 align=center width=90% class="tablett">
				<tr>
				<center>	Tên tin tức (Tiêu đề):<input style="width:300px" type=text name=txttentintuc> &nbsp &nbsp
            

                <?php
                    $sql1 = "select * from loaitintuc";
                    $result = $conn->query($sql1);
                
                ?>

                Loại tin tức: <select name="slloaitin" id="">
                    <?php
                        while($row = $result->fetch_assoc())
                        {
                    ?>
                        <option value='<?php echo $row["Maloaitin"] ?>'> <?php echo $row["Tenloaitin"] ?> </option>
                    <?php
                        }
                    ?>
                </select>

                </center> 
				</tr>
                
                <tr>
                    <center id="chonanhtintuc">
                    <label for="file">Chọn ảnh tin tức</label>
                    <input style="width:300px" type=file name=fileanh id="file" onchange="previewImage(this)"> <br>
                        <img id="image-preview" >
                    </center>
                </tr>
                
                <tr>
					<td><h2>Nội dung:</h2></td>
					<td><textarea id="editor" name="txtnoidung"></textarea></td>
				</tr>
               

				
				<tr>
					<td align=right><input type=submit value="Thêm mới"></td>
					<td><input type=reset value="Làm lại">
						<!--<input type=hidden name=action value="save_add">-->
				</tr>
			</table>
		</form>
        <script>
  CKEDITOR.replace('editor', {
    height: 300, // Chiều cao của trình soạn thảo
    toolbar: 'basic', // Thanhd công cụ, có thể là 'basic', 'full', hoặc bạn có thể tùy chỉnh
    // Các tùy chọn khác...
  });
</script>
    
    <?php
            }
            
        }
        else{
            echo "";
        }
        
        $sql = "select * from tintuc";
        $result = $conn->query($sql) or die($conn->error);
    ?>
    <br>

    <table class="Bangtintuc">
        <tr>
            <th> Mã tin tức </th>
            <th> Tên tin tức</th>
            <th> Ảnh tin tức</th>
            
            <th> Người đăng</th>
            <th> Cập nhật</th>
            <th>Xóa</th>

        </tr>


        <?php
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    
        ?>
                         
				      
                 
                        <tr style="text-align:center">
                            <td><?php echo $row["Matintuc"]?></td>
                            <td><?php echo $row["Tentintuc"]?></td>
                            <td> <img src='images/tintuc/<?php echo $row["Anhtintuc"]?>' width=200></td>
                            
                            <td><?php echo $row["Mauser"]?></td>
                            <td><a href="Capnhattintuc.php?Matintuc=<?php echo $row["Matintuc"];?>">
                                <img src="images/Sua.jpg" width=30 alt="">
                            </a></td>

				            <td><a onclick="return confirm('Are you sure to delete?')" href="Quanlytintuc.php?action=delete&Matintuc=<?php echo $row["Matintuc"];?>">
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