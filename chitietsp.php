
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TienKieumobile</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    

    <link rel="stylesheet" href="css/chitietpr.css">
    <link rel="stylesheet" href="css/header.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    


    
    <style>

.strikethrough {
  text-decoration: line-through;
  color: black; /* Màu chữ của giá gạch giá có thể thay đổi tùy ý */
  border:none;
  font-size:18px;
  padding:4px;
  width:105px;
}

        .Thongsokythuat {
    margin: 20px; /* Khoảng cách giữa đối tượng và các phần khác trên trang */
}

/* Phần tiêu đề */
.Thongsokythuat h2 {
    text-align: center;
    color: #333; /* Màu chữ */
    margin-bottom: 10px; /* Khoảng cách giữa tiêu đề và các dòng dưới đó */
}

/* Bảng thông số kỹ thuật */
.Thongsokythuat table {
    width: 390px;
    border: 1px solid #ddd; /* Màu đường viền */
    border-collapse: collapse;
    margin-top: 10px; /* Khoảng cách giữa tiêu đề và bảng */
}

/* Dòng trong bảng */
.Thongsokythuat tr {
    border: 1px solid #ddd; /* Màu đường viền */
}

/* Ô trong bảng */
.Thongsokythuat td {
    padding: 8px; /* Khoảng cách giữa nội dung và mép của ô */
    border: 1px solid #ddd; /* Màu đường viền */
}

/* Điều chỉnh màu nền cho các dòng chẵn */
.Thongsokythuat tr:nth-child(even) {
    background-color: #f2f2f2;
}

.swal2-confirm, .swal2-cancel {
        width: 150px !important;
        height: 35px !important;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    /* Thiết lập màu nền và chữ cho nút "Xem giỏ hàng" */
    .swal2-confirm {
        background-color: #4CAF50;
        color: #fff;
        margin-right: 10px; /* Khoảng cách giữa các nút */
    }

    /* Thiết lập màu nền và chữ cho nút "Trang chủ" */
    .swal2-cancel {
        background-color: #808080;
        color: #fff;
    }

    /* Hiệu ứng hover cho cả hai nút */
    .swal2-confirm:hover, .swal2-cancel:hover {
        filter: brightness(90%); /* Giảm độ sáng khi di chuột qua */
    }




    </style>

    <script>
        
        function sendDataToServer() {
            // Lấy giá trị từ input
            var valueFromUser = document.getElementById('inputValue').value;

            // Tạo đối tượng XMLHttpRequest
            var xhr = new XMLHttpRequest();
            
            // Thiết lập sự kiện khi trạng thái thay đổi
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Xử lý kết quả từ server nếu cần
                    console.log(xhr.responseText);
                }
            };

            // Mở kết nối và gửi dữ liệu lên server (sử dụng phương thức GET)
            xhr.open("GET", "process.php?a=" + valueFromUser, true);
            xhr.send();
        }
    </script>

<?php include 'header.php'; ?>

<br>
<br>


<?php
    //unset($_SESSION["cart_item"]);
    require_once("connect.php");


    if(!isset($_POST["sel"]))
    {
        $tongramrom="";
    }
    else{
        $tongramrom=intval($_POST["sel"]);
    }

    if(!isset($_REQUEST["Masp"]))
    {
        $Masp="";
    }
    else{
        $Masp = $_REQUEST["Masp"];
    }

    $sql1 = "select * from sanpham a, thongsosanpham b where a.Mathongso=b.Mathongso and Masp=$Masp";
	$result = $conn->query($sql1) or die($conn->error);
    $rows=$result->fetch_assoc();
    $sql = "select * from sanpham_mausac a, mausac b where a.Mamau=b.Mamau and Masp = $Masp";
    $mota = $rows["Mota"];
    $tensp = $rows["Tensp"];


    //Xử lý thêm vào giỏ hàng
    if (!empty($_GET["action"])){
		switch($_GET["action"]){
			case "add":
				$gia = $_POST["txtGiasp"];
                $mau = $_POST["selm"];
                $sp = ($conn->query("select * from sanpham where Masp=$Masp"))->fetch_assoc();
                $tensp = $sp["Tensp"];

                $sp = $conn->query("select * from sanpham a,sanpham_mausac b,mausac c where a.Masp=b.Masp and b.Mamau = c.Mamau and a.Tensp like '$tensp' and a.Gia=$gia and c.Tenmau like '$mau'");
                $r[] = $sp->fetch_assoc();
				
				$itemArray = array("a".$r[0]["Masp"]=>array("Masp"=>$r[0]["Masp"],"Mamau"=>$r[0]["Mamau"],"Gia"=>$r[0]["Gia"],"Soluong"=>"1","Anh"=>$r[0]["imagesp_mau"], "Tensp"=>$r[0]["Tensp"],"Mau"=>$r[0]["Tenmau"],"Phienban"=>"".$r[0]["Ram"]."-".$r[0]["Rom"]."GB"));
				//echo "<br> <br> <br>";
                //var_dump($itemArray);
				//$_SESSION["cart_item"]
				/*
						4=>("name"=>"SS","pid"=>4,"price"=>10,"pquantity"=>1,"pimage"=>"ss.jpg"),
						10=>("name"=>"SS11","pid"=>10,"price"=>7,"pquantity"=>1,"pimage"=>"ss.jpg"),
						5=>("name"=>"SS4","pid"=>5,"price"=>1,"pquantity"=>1,"pimage"=>"ss.jpg")
						
					*/
				if (!empty($_SESSION["cart_item"])){
					if (in_array("a".$r[0]["Masp"], array_keys($_SESSION["cart_item"]))){
						foreach($_SESSION["cart_item"] as $k=>$v){
							if ("a".$r[0]["Masp"]==$k){
					    		echo "<script> Swal.fire('Sản phẩm đã có trong giỏ!'); </script>";
                            
							}		
						}
							
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                            echo "<script>
                            Swal.fire({
                                title: 'Thêm sản phẩm vào giỏ hàng thành công',
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'Xem giỏ hàng',
                                cancelButtonText: 'Trang chủ'
                            }).then((result) => {
                                if (result.value) {
                                   
                                    window.location.href = 'giohang.php';
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    
                                    window.location.href = 'index.php';
                                }
                            });
                        </script>";
						}
						
					} else {
						$_SESSION["cart_item"] = $itemArray;
                        echo "<script>
                        Swal.fire({
                            title: 'Thêm sản phẩm vào giỏ hàng thành công',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Xem giỏ hàng',
                            cancelButtonText: 'Trang chủ'
                        }).then((result) => {
                            if (result.value) {
                                
                                window.location.href = 'giohang.php';
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                
                                window.location.href = 'index.php';
                            }
                        });
                    </script>";
					}

					
                    //echo "<br> <br> <br>";
				//var_dump($_SESSION["cart_item"]);
				//echo "<br>";
				//var_dump($itemArray);
				

			    break;
        }
    }
        
?>



<main>
    <br>

    <?php
        echo "<h3 style='font-size:25px;'>&nbsp &nbsp &nbsp &nbsp Điện thoại ".$rows["Tensp"]."</h3>";
    ?>


<div class=product>
    <div class="anhmota">
        <div class="productimages">

            <?php
                echo "<img src='images/sanpham/".$rows['imagesp']."' id='image0' alt=''>";
                $result1 = $conn->query($sql) or die($conn->error);
                $i=0;
                while($rows=$result1->fetch_assoc()){
                    $i++;
                    $img= 'image'.$i;
                
                    echo "<img src='images/sanpham/".$rows["imagesp_mau"]."' id='$img' style='display:none;' class='image' alt=''>";
                }
            ?>
        </div>



        <br>
        <br>

        <div class="mota">
            <button><strong>Mô tả sản phẩm</strong></button>

            <?php
                echo"<p>".$mota."</p>";
            ?>

        </div>
    </div>



<div class=Chonphienban>
        <?php
            
                $sql4 = "select Tensp, imagesp,min(Gia) as Gia,min(Ram) as Ram, min(Rom) as Rom, min(Giagoc) as Giagoc ,Masp from Sanpham where Masp=$Masp GROUP BY Tensp,imagesp order by Gia asc";
            
            $result3 = $conn->query($sql4);
            $rows3 = $result3->fetch_assoc();
            $Gia = $rows3["Gia"];
            $Giagoc = $rows3["Giagoc"];

        
        ?>
<form method="POST" action="?Masp=<?php echo $Masp; ?>&action=add">
    <div style="display:flex;">
        <div><input type="text" style="padding-left:5px;border:none; color:red; font-size:25px;font-weight: bold; width:145px;" value=<?php echo number_format($Gia, 0, ',', '.')."đ" ?> id="displayPrice"> </div>
        <div> <input type="text" class="strikethrough" value=<?php echo number_format($Giagoc, 0, ',', '.')."đ"?> id="displayPrice3"> </div>

        <div style="margin-top:4px;height:20px;display:flex;"> 
         &nbsp  Tình trạng:
                <input type="text" style="font-size:14px; width:70px; padding:0px;margin:0px;border:none;" value="" id = "displaytinhtrang"> 
                <img style="" src="" alt="" width=18 id="imageLink">
            
        </div>
    </div>
    <input type="text" style="display:none;" value=<?php echo $Gia ?> name="txtGiasp" id="displayPrice2">
        <p style="font-weight: bold; padding-left:5px;">Chọn phiên bản để xem giá và tình trạng hàng.</p>
        <div class="chonramrom1">
            <div style="padding-left:5px; padding-top:8px; font-size:18px;font-weight: bold;">
                Phiên bản:
            </div>
            <?php
               $sql1 = "SELECT * FROM sanpham WHERE Tensp IN (SELECT Tensp FROM sanpham WHERE Masp = $Masp)";
               $sql2 = "SELECT Sum(Soluongcon) as slcon from sanpham_mausac a, sanpham b where a.Masp = b.Masp and Tensp in (SELECT Tensp FROM sanpham WHERE Masp = $Masp) group by Ram,Rom";
               $result3 = $conn->query($sql2) or die($conn->error);

               $i=1;
               while($row = $result3->fetch_assoc())
               {
                $sl[$i] = $row['slcon'];
                $i++;
               }

                $result1 = $conn->query($sql1) or die($conn->error);
                $i=1;
                while ($rows = $result1->fetch_assoc()){
                    $ram = $rows['Ram'];
                    $rom = $rows['Rom'];
                    $gia = $rows['Gia'];
                    $giagoc=$rows['Giagoc'];
                    // Sử dụng giá trị unique để tạo giá trị cho radio button và label
                    $value = $ram+$rom;
                    echo "<div class='chonramrom'>
                    <input type='radio' name='sel' value='$gia-$giagoc-$ram-$rom-$sl[$i]' id='bonho'>
                    <label for='radio-$value'>$ram-$rom GB</label>
                  </div>";
                  $i++;
                }
                
            ?>
        </div>
    <br>

  

       

        <div style="display:flex;">

        <div style="padding-left:5px; padding-top:3px;font-size:18px;font-weight: bold;">
                Màu sắc: &nbsp &nbsp
            </div>
        <div class=chonmau2>
            <?php
                $result1 = $conn->query($sql) or die($conn->error);
                $a=0;
                while($rows=$result1->fetch_assoc())
                {
                    $a++;
                    $img= 'image'.$a;
                    echo "<label class='chonmau' style='background-color:".$rows['Tenmau']."'> <input type=radio style='display: none;' id='mau' name=selm value=".$rows['Tenmau']." onclick=hienthianh('$img')> </label> &nbsp";
                }
            ?>
        </div>
        </div>


        <div class="frame_dt promotion">
            <label style="background-color:red; font-size:17px; padding:12px; border-radius:5px;font-weight: bold; color:white;" >Khuyến mãi</label>
				
            <p><strong>Tặng <span>Combo DCL+&nbsp;t.nghe AKG Type-C&nbsp;trị giá 300k</span> khi mua bhv</strong></p>

            <p><strong>Cài ROM quốc tế miễn phí trọn đời</strong></p>

            <p><a bis_size="{" x=""><span><strong>Trả góp nhanh, trả&nbsp;góp lãi suất 0% từ xa/ Online cực dễ&nbsp;(*)</strong></span></a></p>

            <p><strong>Mua Online: Giao hàng tận nhà- Nhận hàng thanh toán</strong></p>
			
			
		</div>

        <div>
            <button style="width:250px;height:55px;font-weight: bold; color:black;padding: 12px 0px;background: #5d83db; border:0.1px solid black; border-radius:8px">
            <i class="material-icons">shopping_cart</i>
            <input style="font-weight: bold; font-size:17px; color:white; background: #5d83db;border:none;" type="submit" value='THÊM VÀO GIỎ HÀNG' >
            </button>
        </div>
        </form>
</div>



<div class="Thongsokythuat">
    <table border=1 width=390>
    <?php
    $sql = "select * from sanpham a,thongsosanpham b where a.Mathongso=b.Mathongso and a.Masp=$Masp";
    $result1 = $conn->query($sql) or die($conn->error);
    $rows=$result1->fetch_assoc()
    ?>
        <tr>
            <h2>Thông số kỹ thuật</h2>
        </tr>
        <tr>
            <td>Màn hình</td>
            <td> <?php echo $rows["Manhinh"] ?> </td>
        </tr>
        <tr>
            <td>Hệ điều hành</td>
            <td> <?php echo $rows["Hedieuhanh"] ?> </td>
        </tr>
        <tr>
            <td>Camera sau</td>
            <td> <?php echo $rows["Camerasau"] ?> </td>
        </tr>
        <tr>
            <td>Camera trước </td>
            <td> <?php echo $rows["Cameratruoc"] ?> </td>
        </tr>
        <tr>
            <td>CPU</td>
            <td> <?php echo $rows["CPU"] ?> </td>
        </tr>
        <tr>
            <td>Ram</td>
            <td> <?php echo $rows["Ram"] ?> </td>
        </tr>
        <tr>
            <td>Rom</td>
            <td> <?php echo $rows["Rom"] ?> </td>
        </tr>
        <tr>
            <td>Dung lượng pin sạc</td>
            <td> <?php echo $rows["Dungluongpinsac"] ?> </td>
        </tr>
        <tr>
            <td>Thiết kế</td>
            <td> <?php echo $rows["Thietke"] ?> </td>
        </tr>
        <tr>
            <td>Công nghệ bảo mật</td>
            <td> <?php echo $rows["Congnghebaomat"] ?> </td>
        </tr>
    </table>
</div>

    <script src="js/chitietsp.js"></script>
</div>


   


</main>




<?php include 'footer.php'; ?>