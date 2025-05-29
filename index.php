<?php 


	require_once("connect.php");
    if (!isset($_REQUEST["cmd"])){
		$cmd = "";
	} else {
		$cmd = $_REQUEST["cmd"];
	}

    if (!isset($_REQUEST["search"])){
		$search = "";
	} else {
		$search = $_REQUEST["search"];
	}


    $sql="select Tensp, imagesp,min(Gia) as Gia,min(Ram) as Ram, min(Rom) as Rom, Masp from Sanpham GROUP BY Tensp,imagesp order by Gia asc";
	$result = $conn->query($sql) or die($conn->error);
?>

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
    <link rel="stylesheet" href="css/reset.css">


    <?php include 'header.php'; ?>


    <br>
    <br>
    

    <div style="display:flex;justify-content:center;">
    <div class="sale">
        <div class="slider">
            <div class="list">
                <div class="item">
                    <img src="images/sukien/sale1.jpg"  alt="">
                </div>
                <div class="item">
                    <img src="images/sukien/sale2.jpg"  alt="">
                </div>
                <div class="item">
                    <img src="images/sukien/sale3.jpg"  alt="">
                </div>
                <div class="item">
                    <img src="images/sukien/sale4.jpg"  alt="">
                </div>
            </div>
            <div class="buttons">
                <button id="prev">?</button>
                <button id="next">></button>
            </div>
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

        <div class="khuyenmaicodinh">
            <ul class="tintuc">
                <li>
                    <h2>Tin tức công nghệ mới nhất</h2>
                </li>

                <?php
                    $sql = "select * from tintuc order by Thoigiandang desc limit 0,4";
                    $result = $conn->query($sql) or die($conn->error);
                    while($tin= $result->fetch_assoc()){

                
                ?>
                <li>
                    <a href="">
                        <img src="images/tintuc/<?php echo $tin["Anhtintuc"] ?>" width=100 height=65 alt="">
                        <p style="padding:0px 10px;font-weight:bold;text-align:justify;margin-top:6px;"> <?php echo $tin["Tentintuc"] ?> </p>
                    </a>
                </li>
                
                <?php
                }

                $sql="select Tensp, imagesp,min(Gia) as Gia,min(Ram) as Ram, min(Rom) as Rom, Masp from Sanpham GROUP BY Tensp,imagesp order by Gia asc";
	            $result = $conn->query($sql) or die($conn->error);
                ?>


            </ul>
            
        </div>
    </div>
    </div>

    <script src="js/trangchu.js"></script>

    <br>

    <div style="text-align:center;">
            <img src="images/salengang.jpg" style="width: 1200px ; border-radius:10px;" alt="">
        </div>

    <div style="display:flex; justify-content:center;">
    <main>
        <div class="headct">
            <div class="name-product-category">
                <h3 style="font-size: 25px;">Điện thoại nổi bật: &nbsp &nbsp &nbsp</h3>
            </div>
            <div class="product-category-child">
                <a href="">
                    <p> Realme &nbsp|&nbsp &nbsp</p>
                </a>
                <a href="">
                    <p>Xiaomi &nbsp|&nbsp &nbsp</p>
                </a>
                <a href="">
                    <p>One plus  &nbsp|&nbsp &nbsp</p>
                </a>

                <a href="">
                    <p>Red magic &nbsp|&nbsp &nbsp</p>
                </a>

                <a href="">
                    <p>Iphone &nbsp|&nbsp &nbsp</p>
                </a>

                <a href="">
                    <p>Sony</p>
                </a>


            </div>

            <div style="padding-top:25px;">
            <select style="width: 200px; height: 35px; font-size: 15px; border-radius: 3px; float: right;" name="">
                id="">
                <option value="0">---Sắp xếp theo giá---</option>
                <option value="1">Giá từ thấp đến cao</option>
                <option value="2">Giá từ cao xuống thấp</option>
            </select>
            </div>
        </div>

       


        


        <div>
            <br>
            <div style="width=1370px;align=center;border:0;">
				<?php 
					$i=0;
					while ($rows=$result->fetch_assoc()){
						echo "<div class=product-list>";
						echo "<img src='images/sanpham/".$rows["imagesp"]."' width=200>";
						//echo "<br>";
						
						echo "<a style='text-decoration: none; text-align:left;font-size:20px; color: black;' href='chitietsp.php?Masp=".$rows["Masp"]."'><h1 style='font-size:18.5px; padding:0px;height:55px;'>".$rows["Tensp"]."</h1></a>";
						echo "<p style='font-size:17.5px; color: red;font-weight:bold; padding:0px; margin:0px;text-align:left;'> ".number_format($rows["Gia"],0,'.','.')."đ</p></p>";
                        echo "<button style='width:100%; background-color: #FF6347; font-size: 17px;border-radius: 5px;'>Mua ngay</button> <br> <br> </div>";
						
					}
					$conn->close();
					
				?>
			</div>
        </div>
    </main>
                </div>
            

    
    <?php include 'footer.php'; ?>