<?php 
	require("connect.php");
	$keyword = $_REQUEST["keyword"];

	$sql="select Tensp, imagesp,min(Gia) as Gia,min(Ram) as Ram, min(Rom) as Rom, Masp from Sanpham  where Tensp like N'%".$keyword."%' GROUP BY Tensp,imagesp order by Gia asc";
	$result = $conn->query($sql) or die($conn->error);
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
			<ul id="country-list">
				<?php while ($row=$result->fetch_assoc()){
				?>
				<li onClick="selectCountry('<?php echo $row["Tensp"];?>');">
					<?php echo $row["Tensp"];?>
				</li>
				<?php } 
				$conn->close();
				?>
			</ul>
	</body>
</html>