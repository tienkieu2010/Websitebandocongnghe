<meta charset="utf-8">
<html lang="vi">
<head>

    <title>TienKieuMobile</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<style>
		.Bangsanpham {
    width: 100%;
    border-collapse: collapse;
}

.Bangsanpham th,
.Bangsanpham td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.Bangsanpham th {
    background-color: #f2f2f2;
    text-align: left;
}

.Bangsanpham tr:hover {
    background-color: #f5f5f5;
}

/* CSS cho biểu mẫu chỉnh sửa sản phẩm */
.Bangsanpham form {
    width: 60%;
    margin: 0 auto;
}

.Bangsanpham input[type="text"],
.Bangsanpham select,
.Bangsanpham textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.Bangsanpham input[type="submit"],
.Bangsanpham input[type="reset"],
.Bangsanpham input[type="button"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
}

.Bangsanpham input[type="submit"]:hover,
.Bangsanpham input[type="reset"]:hover,
.Bangsanpham input[type="button"]:hover {
    background-color: #45a049;
}
	</style>
	<script>
		function openPopup(url) {
    		window.open(url, 'popupWindow', 'width=1000,height=500');
		}

		function linkclick(){
			var fileInput = document.getElementById("clickanh");
  			var textInput = document.getElementById("textanh");


  // Kiểm tra xem người dùng đã chọn tệp tin chưa
  			fileInput.addEventListener('change', function() {
  			if (fileInput.files.length > 0) {
    				var selectedFile = fileInput.files[0];
    				textInput.value = selectedFile.name;
  				} else {
    			textInput.value = "Không có tệp tin được chọn";
  				}
			});
		}

		function linkclick2(){
			var fileInput = document.getElementById("clickanh2");
  			var textInput = document.getElementById("textanh2");


  // Kiểm tra xem người dùng đã chọn tệp tin chưa
  			fileInput.addEventListener('change', function() {
  			if (fileInput.files.length > 0) {
    				var selectedFile = fileInput.files[0];
    				textInput.value = selectedFile.name;
  				} else {
    			textInput.value = "Không có tệp tin được chọn";
  				}
			});
		}

    </script>
    <?php include 'headeradmin.php'; ?>
<?php
    session_start();
	//unset($_SESSION["cart_item"]);
    require_once 'connect.php';
    if(!isset($_SESSION["product_error"]))
    {
        $_SESSION["product_error"]="";
    }

    if(!isset($_SESSION["product_add_error"]))
    {
       $_SESSION["product_add_error"]="";
    }


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

    if (isset($_GET['action'])) {
        $p=$_GET["action"];

    switch($p)
    {
        case "save_add":
            $tensp=$_POST["txttensp"];
	        $gia=$_POST["txtgia"];
			$giagoc = $_POST["txtgiagoc"];
	        $anh = $_POST["txtanh"];
            $ram = $_POST["slram"];
			$rom = $_POST["slrom"];
            $hang = $_POST["slhang"];
			$spapdung = $_POST["txttensp"];

			
            $type = substr($_FILES["uploaded"]["type"],0,5);
	        $target ="images/sanpham/".strconvert($_FILES["uploaded"]["name"]);


	        if (move_uploaded_file($_FILES["uploaded"]["tmp_name"],$target)){

	        $sql="select * from Sanpham where Tensp like '$tensp' and Ram=$ram and Rom=$rom";
            $result = $conn->query($sql);
	        if ($result->num_rows>0){
		        $_SESSION["product_error"]="Sản phẩm $tensp bản $ram/$rom GB đã có trong hệ thống rồi";
                header("Location:Quanlydienthoai.php?action=add");
            }
            else {

				$sql2 = "select * from thongsosanpham where Sanphamapdung like N'$spapdung'";
				$result = $conn2->query($sql2);
				$rows = $result->fetch_assoc();
				$mathongso = intval($rows["Mathongso"]);

		        $sql = "insert into Sanpham(Tensp,Gia,Giagoc,imagesp,Ram,Rom,Mahang,Mathongso) values ('$tensp',$gia,$giagoc,'$anh',$ram,$rom,$hang,$mathongso)";
                $conn->query($sql) or die($conn->error);


				$sql = "select * from sanpham where (Tensp like N'$tensp' and Ram=$ram and Rom=$rom)";
				$result = $conn->query($sql);
				$rows1 = $result->fetch_assoc();
				$masp = intval($rows1["Masp"]);
              
				if (!empty($_SESSION["cart_item"])){
						foreach($_SESSION["cart_item"] as $item){
							
							$mamauht = intval($item['slmau1']);
							$anh = $item['anh1'];
							$soluong = intval($item['soluong1']);

							$sql3 = "insert into sanpham_mausac(Masp,Mamau,imagesp_mau,Soluongcon) values($masp,$mamauht,'$anh',$soluong)";
							$conn->query($sql3) or die($conn->error);
			
						}
				}

				header("Location:Quanlydienthoai.php");
			}    
		}

        
            break;
        

		case "save_edit":
			$pid = $_POST["pid"];
			$pname=$_POST["txtpname"];
			$pdesc=$_POST["tapdesc"];
			$pimage = $_POST["txtpimage"];
			$pprice = $_POST["txtpprice"];
   			$pquantity = $_POST["txtpquantity"];
    		$cid = $_POST["slcid"];
    		$pinsertdate = $_POST["txtpinsertdate"];
    		$pupdatedate = $_POST["txtpupdatedate"];
    		$pishot = $_POST["rdpishot"];
			$pstatus=$_POST["rdpstatus"];

			$sql = "select * from product where pname like '$pname' and pid<>$pid";
			$result = $conn->query($sql);
			if ($result->num_rows>0){
			$_SESSION["product_edit_error"]="$pname adready exist!";
			header("Location:product_edit.php");
			} else {
				$sql ="update product set
					pname='$pname',
				 	pdesc='$pdesc',
				 	pimage='$pimage',
				 	pquantity = $pquantity,
				 	pprice = $pprice,
				 	cid = $cid,
				 	pinsertdate = '$pinsertdate',
				 	pupdatedate = '$pupdatedate',
				 	pishot = $pishot,
				 	pstatus = $pstatus
				where pid=$pid";
			
			$conn->query($sql) or die($conn->error);
			if ($conn->error == ""){
				$_SESSION["product_error"] = "Update Successful!";
				header("Location:product_view2.php");
			} else {
				$_SESSION["product_error"]="Error update data!";
				header("Location:product_view2.php");
			}
			}
			break;

		case "delete":
			$Masp = $_GET["Masp"];
			$sql = "update sanpham set Trangthaisp=1 where Masp = $Masp";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				echo "<script>
				Swal.fire({
					title: 'Xóa sản phẩm thành công!',
					icon: 'success',
					showCancelButton: false,
					confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location.href = 'Quanlydienthoai.php?action=add';
					}
					else{
						window.location.href = 'Quanlydienthoai.php?action=add';
					}
				});
			 </script>";
			} else {
				echo "<script>
				Swal.fire({
					title: 'Xóa sản phẩm không thành công!',
					icon: 'error',
					showCancelButton: false,
					confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location.href = 'Quanlydienthoai.php?action=add';
					}
					else{
						window.location.href = 'Quanlydienthoai.php?action=add';
					}
				});
			 </script>";
			}
			
		}
	}

	if (!empty($_GET["action2"])){
		switch($_GET["action2"]){
			case "add":
				$slmau = $_POST["slmau"];
				$anh = $_POST["txtanhcomau"];
				$soluong = $_POST["txtsoluong"];


	        	$target2 ="images/sanpham/".strconvert($_FILES["uploaded2"]["name"]);

	        	if(move_uploaded_file($_FILES["uploaded2"]["tmp_name"],$target2))
				{
					$_SESSION["product_error"]="Thêm ảnh lên sever thành công";
				}


				$itemArray = array($slmau=>array("slmau1"=>$slmau,"anh1"=>$anh,"soluong1"=>$soluong));
					//var_dump($itemArray);
					//$_SESSION["cart_item"]
					/*
						4=>("name"=>"SS","pid"=>4,"price"=>10,"pquantity"=>1,"pimage"=>"ss.jpg"),
						10=>("name"=>"SS11","pid"=>10,"price"=>7,"pquantity"=>1,"pimage"=>"ss.jpg"),
						5=>("name"=>"SS4","pid"=>5,"price"=>1,"pquantity"=>1,"pimage"=>"ss.jpg")
						
					*/
					if (!empty($_SESSION["cart_item"])){
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
						
					 else {
						$_SESSION["cart_item"] = $itemArray;
					}
					

				/*var_dump($_SESSION["cart_item"]);
				echo "<br>";
				var_dump($itemArray);
				*/
				break;
			case "remove":
				if (!empty($_SESSION["cart_item"])){
					foreach($_SESSION["cart_item"] as $k=>$v){
						if ($_GET["slmau1"]==$v["slmau1"])
							unset($_SESSION["cart_item"][$k]);
						if (empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);
					}
				}
				break;
			case "empty":
				unset($_SESSION["cart_item"]);
				break;
			}
		}
	
		
		 
    
?>


	
        <link rel="stylesheet" href="css/header.css">

    
<main style="margin-left:85px; margin-right:85px">
    <br>
    <br>
    <br>
	<br>
    <h1 align=center> Danh sách các sản phẩm trong hệ thống </h1>

    <center><font color=red><?php echo $_SESSION["product_error"];?></center>

    <br>
    <center><a href="Quanlydienthoai.php?action=add">Thêm mới một nhóm sản phẩm </a></center>
    <?php
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action=="add") {
    ?>
	<div>
        <h1 align=center>Thêm mới một sản phẩm</h1>
		<center><font color=red><?php echo $_SESSION["product_add_error"];?></font></center>
		<form method=POST enctype="multipart/form-data" action="Quanlydienthoai.php?action=save_add">
			<table border=0 align=left width=400 style="margin-left:170px;">
				<tr>
					<td>Tên sản phẩm:</td>
					<td><input style="width:180px" type=text name=txttensp></td>
				</tr>
                <tr>
					<td>Giá:</td>
					<td><input type=text  style="width:180px" name=txtgia></td>
				</tr>

				<tr>
					<td>Giá gốc:</td>
					<td><input type=text  style="width:180px" name=txtgiagoc></td>
				</tr>

				<tr>
					<td>Ảnh:</td>
					<td><input type=file name=uploaded id ="clickanh" onclick="linkclick()">
					</td>
					<td>
					
					<td><input type="text" name=txtanh id=textanh value="" style="display:none;"></td>
				</tr>
                
                <tr>
					<td>Ram:</td>
					<td><select name="slram" style="width:100px;" id="">
						<option value="3">3GB</option>
						<option value="4">4GB</option>
						<option value="6">6GB</option>
						<option value="8">8GB</option>
						<option value="12">12GB</option>
						<option value="16">16GB</option>
					</select></td>
				</tr>

				<tr><td>
					Rom:
				</td>
				<td><select name="slrom" style="width:100px;" id="">
					<option value="32">32GB</option>
					<option value="64">64GB</option>
					<option value="128">128GB</option>
					<option value="256">256GB</option>
					<option value="512">512GB</option>
					<option value="1024">1TB</option>
					
					
				</select></td>
				</tr>

				<tr>
					<td>Hãng</td>
					<td>
						<select name="slhang" style="width:100px;" id="">
							<?php
								$sql3 = "select * from hang";
								$result3 = $conn->query($sql3);
								while($rows3 = $result3->fetch_assoc())
								{
							?>
							<option value=" <?php echo $rows3["Mahang"]; ?> "> <?php echo $rows3["Tenhang"]; ?>  </option>
							<?php
								}
							?>
						</select>
					</td>
				</tr>

				
			</tr>
				<td>   
				    <input style="width:150px; font-size:16px; height:30px; border-radius:10px; color:white; background-color: #808080; border:none;" type=reset value="Làm lại"> 
					</td>
					<td><input style="width:230px; font-size:16px; height:30px; border-radius:10px; color:white; background-color: #808080; border:none;" type=submit value="Thêm mới"></td>
				</tr>
			<!--<input type=hidden name=action value="save_add">-->
			</table>
		</form>

		<form method=POST enctype="multipart/form-data" action='?action=add&action2=add'>
            <table border=1 width=400 align=right  style="margin-right:150px;">

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
					<input type=file name="uploaded2" id=clickanh2 onclick="linkclick2()">
					
					<input type="text" name=txtanhcomau id=textanh2 value="" style="display:none;">
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

		<table border=1 width=526 align=right  style="margin-right:150px;">
				<tr>
					<th>Màu</th>
					<th>Ảnh</th>
					<th>Số lượng</th>
					<th>Xóa</th>
				</tr>
				
				<?php 
						if (!empty($_SESSION["cart_item"])){
						foreach($_SESSION["cart_item"] as $item){
							?>
							<tr valign=middle style="text-align:center;">

								<td><?php
									$mamauht = intval($item['slmau1']);
									$sql3 = "select * from Mausac where Mamau = $mamauht";
									$result = $conn->query($sql3);
								    $rows = $result->fetch_assoc();
									echo $rows["Tenmau"];
								?></td>
								<td><img width=50px src='images/sanpham/<?php echo $item["anh1"];?>' ></td>
								
								<td><?php echo $item["soluong1"];?></td>
								
								<td><a href='?action=add&action2=remove&slmau1=<?php echo $item["slmau1"];?>'>Remove</a></td>
							</tr>
							<?php 
						}
						}
					?>
			

			</table>
    
    <?php
            }
        }
        else{
            echo "";
        }
        
        $sql1 = "select * from sanpham where Trangthaisp=0 order by Masp desc";
        $result1 = $conn1->query($sql1) or die($conn1->error);
    ?>
	</div>


    <table class="Bangsanpham">
        <tr>
            <th> Mã sản phẩm </th>
            <th> Tên sản phẩm </th>
			<th> Ram</th>
			<th> Rom</th>
            <th> Giá </th>
            <th> Ảnh sản phẩm </th>
			
            <th> Xem chi tiết màu sản phẩm </th>
            <th> Xóa </th>

        </tr>


        <?php
            if($result1->num_rows>0)
            {
                while($row = $result1->fetch_assoc())
                {
                    if(isset($_GET["action"]) and $_GET["action"]=="edit" and isset($_GET['pid']) and intval($_GET['pid']) == $row["pid"])
                    {
                    
        ?>
                            <form method=POST action="product_view2.php?action=save_edit">
                            <tr valign=top>
                                <td><input style="width:180px" type=text value="<?php echo $row["pid"] ?>"></td>
					            <td><input style="width:180px" type=text value="<?php echo $row["pname"];?>" name=txtpname></td>
					            <td><textarea cols=20 style="width:180px" rows=6 name=tapdesc value= ><?php echo $row["pdesc"];?></textarea></td>
					            <td><input type=text value="<?php echo $row["pimage"];?>"  style="width:180px" name=txtpimage></td>
					            <td><input type=text value="<?php echo $row["pprice"];?>"  style="width:180px" name=txtpprice></td>
					            <td><input type=text  style="width:180px" value="<?php echo $row["pquantity"];?>" name=txtpquantity></td>
                                <td>
						        <select name=slcid>
							    <?php
                                    $sql1 = "select * from categories";
                                    $result1 = $conn->query($sql1);
								    while($row1 = $result1->fetch_assoc())
								    {
							    ?>
								    <option value=<?php echo $row1["cid"];?>
								    <?php
									    if($row1["cid"]==$row["cid"])
									    {
										    echo " selected ";
									    }
								    ?>
								    > <?php echo $row1["cname"]; ?> </option>
							        <?php
								    }
							        ?>
						        </select>
					            </td>
					            <td><input type=date  style="width:180px" value="<?php echo $row["pinsertdate"];?>" name=txtpinsertdate></td>
				            
					            <td><input type=date  style="width:180px" value="<?php echo $row["pupdatedate"];?>" name=txtpupdatedate></td>
				          
					            <td><input type=radio
						        <?php
							        if($row["pishot"]==1)
							        {
								        echo " checked ";
							        }
						        ?>
							    name=rdpishot value=1>Bán chạy
						        <input type=radio
						        <?php
							        if($row["pishot"]==0)
							        {
								        echo " checked ";
							        }
						        ?> 
							    name=rdpishot value=0>Không bán chạy
					            </td>
				            
				


				            
					            <td><input type=radio 
						        <?php
							    if($row["pstatus"]==1)
							    {
								    echo " checked ";
							    }
						        ?>
						        name=rdpstatus value=1>Hoạt động
						        <input type=radio 
						        <?php
							    if($row["pstatus"]==0)
							    {
								    echo " checked ";
							    }
						        ?>
							    name=rdpstatus value=0>Ngừng Hoạt động
					            </td>
				        	
					            <td align=right><input type=submit value="Update"></td>
					            <td><input type=button value="Cancel" onclick = "window.location='product_view2.php'">
								<input type=hidden name=pid value="<?php echo $row["pid"];?>">
								</td>
                            </tr>
                            </from>
				           
                    <?php
                    
                    }
                    else {
                    ?>
                        <tr>
                            <td><?php echo $row["Masp"]?></td>
                            <td><?php echo $row['Tensp']?></td>
							<td><?php echo "".$row["Ram"]."GB"?></td>
							<td><?php echo "".$row["Rom"]."GB"?></td>
                            <td><?php echo $row["Gia"]?></td>

                            <td><img src="images/sanpham/<?php echo $row["imagesp"]?>" width=150></td>
							
                    
                            <td><a href="Capnhatsoluong.php?Masp=<?php echo $row["Masp"];?>">Xem chi tiết</a></td>
				            <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" href="Quanlydienthoai.php?action=delete&Masp=<?php echo $row["Masp"];?>">
								<img src="images/x.jpg" width=50 alt="">
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

<?php include 'footer.php'; ?>

<?php
    unset($_SESSION["product_error"]);
?>