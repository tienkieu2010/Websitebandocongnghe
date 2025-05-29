<?php 
	require_once("connect.php");
	$textsearch = $_POST["search-box"];

    $sql="select Tensp, imagesp,min(Gia) as Gia,min(Ram) as Ram, min(Rom) as Rom, Masp from Sanpham where Tensp like N'%$textsearch%' GROUP BY Tensp,imagesp order by Gia asc";
	$result = $conn->query($sql) or die($conn->error);
?>


    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/reset.css">

    <br>
    <br>
    <br>

    <main>
        <br>
        <div>
            <p style="text-decoration:none; font-weight:bold;"> &nbsp &nbsp
                <a style="text-decoration: none;color:black;" href="index.php">
                    Trang chủ > 
                </a>
                <a style="text-decoration: none;color:black;" href="">
                    Tìm kiếm
                </a>
            </p>
        </div>
        <div class="headct">
            <div class="name-product-category">
                <h3 style="font-size: 25px;">Kết quả tìm kiếm: &nbsp &nbsp &nbsp</h3>
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
						
						echo "<a style='text-decoration: none; font-size:20px; color: black;' href='chitietsp.php?Masp=".$rows["Masp"]."'><h1 style='font-size:20px;'>".$rows["Tensp"]."</h1></a>";
						echo "<h3 style='font-size:18px; color: red;'> ".number_format($rows["Gia"],0,'.','.')."đ</h3></p>";
                        echo "<button style='width: 200px; background-color: #FFFF00; font-size: 17px;border-radius: 10px;'>Mua ngay</button> <br> <br> </div>";
						
					}
					$conn->close();
					
				?>
			</div>
        </div>
    </main>

    <?php include 'footer.php'; ?>