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
        
        
    ?>
	</div>