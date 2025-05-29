<?php

    session_start();
    require_once("connect.php");
    if ($_SESSION["login"]==false){
        echo "<script>
        alert('Vui lòng đăng nhập!');
        setTimeout(function() {
            window.location.replace('login.php');
        }, 2000);
        </script>";
    } 

    else{
        $Madonhang = $_GET["Madonhang"];
        $Trangthaidon = $_GET["Trangthaidon"];
        

        $sql = "update donhang set Trangthaidon=$Trangthaidon where Madonhang=$Madonhang";
	    $conn->query($sql) or die($conn->error);
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h3 align=center>Hủy đơn hàng thành công! Cảm ơn quý khách đã sử dụng dịch vụ!</h3>
		<script>
			setTimeout("window.location='index.php';",3000);
		</script>
	</body>
</html>

<?php
	}
?>