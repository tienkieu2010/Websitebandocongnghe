<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
    function closePopupAndRedirect() {
            // Gửi thông điệp tới cửa sổ mẹ để yêu cầu đóng popup và hiển thị trang chính
            window.parent.postMessage('closePopupAndRedirect', '*');
        }
    </script>


    <style>
        form {
    width: 100%;
}

/* CSS for text input */
input[type="text"],
select,
textarea {
    width: 100%;
    padding: 5px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    transition: 0.3s;
    font-size:17px;
}

/* CSS for file input */
input[type="file"] {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    transition: 0.3s;
}

/* CSS for preview image */
#image-preview {
    max-width: 60%;
    height: auto;
    margin-top: 10px;
    display: block;
}

/* CSS for editor */
#editor {
    width: 100%;
    height: 500px;
    padding: 12px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    transition: 0.3s;
}

/* CSS for submit button */
input[type="submit"] {
    width: 100%;
    height: 50px;
    background-color: #4CAF50;
    color: white;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Optional: Add hover effect on submit button */
input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
    <script>

    </script>
</head>
<body>

<?php
    session_start();
    require_once 'connect.php'; 

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
                         window.parent.postMessage('successMessage', '*');
                         window.parent.closePopup();
                        </script>";
                }
    
                else{
                    echo "<script>
                Swal.fire({
                    title: 'Đăng tin tức mới không thành công!',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'Dangtin.php';
                    }
                    else{
                        window.location.href = 'Dangtin.php';
                    }
                });
             </script>";
            
    
             
                }
                //$conn->close();
    
                
    
            }
        }
        
        break;
    }
}
?>

<script>
  CKEDITOR.replace('editor', {
    height: 660, // Chiều cao của trình soạn thảo
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


<form method=POST enctype="multipart/form-data" action="Dangtin.php?action=save_add">
			<table border=0 align=center>
				<tr>
				<center>	Tên tin tức (Tiêu đề):<input style="width:300px" type=text name=txttentintuc> &nbsp &nbsp
            

                <?php
                    $sql1 = "select * from loaitintuc";
                    $result = $conn->query($sql1);
                
                ?>
                </tr>

                <tr>

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
                    <td></td>

                    <td>
                    <center id="chonanhtintuc">
                    <label for="file">Chọn ảnh tin tức</label>
                    

                    <input style="width:300px" type=file name=fileanh id="file" onchange="previewImage(this)"> <br>
                        <img id="image-preview" >
                    </center>
                    <td>
                </tr>
                
                <tr>
					<td><h2>Nội dung:</h2></td>
					<td><textarea id="editor" name="txtnoidung"></textarea></td>
				</tr>
               

				
				<tr>
                    <td></td>
					<td align=center><input type=submit style="width:300px; height:35px; background-color:aqua; border:none; font-size:18px;" value="Đăng tin">
						<!--<input type=hidden name=action value="save_add">-->
                    </td>
				</tr>
			</table>
		</form>

        <script>
  CKEDITOR.replace('editor', {
    height: 370, // Chiều cao của trình soạn thảo
    toolbar: [
        { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
        { name: 'styles', items: [ 'Styles', 'Format' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
        { name: 'links', items: [ 'Link', 'Unlink' ] },
        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
        { name: 'tools', items: [ 'Maximize' ] },
        { name: 'document', items: [ 'Source' ] }
    ],
    // Các tùy chọn khác...
});
</script>
                    </body>

                    </html>