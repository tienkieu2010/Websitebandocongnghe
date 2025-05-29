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
        

        $sql = "update donhang set Trangthaidon=Trangthaidon+1 where Madonhang=$Madonhang";
	    $conn->query($sql) or die($conn->error);

        $sql = "select * from donhang where Madonhang=$Madonhang";
	    $result=$conn->query($sql);
        $don = $result->fetch_assoc();

?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
        <?php
            if($don["Trangthaidon"]==1)
            {
                echo "<h3 align=center>Xác nhận đơn hàng thành công!</h3>";
            }
            if($don["Trangthaidon"]==2)
            {
                echo "<h3 align=center>Xác nhận đơn hàng đang giao thành công!</h3>";
            }
            if($don["Trangthaidon"]==3)
            {
                echo "<h3 align=center>Xác nhận đơn hàng hoàn thành thành công!</h3>";
            }
        ?>

		<script>
			setTimeout("window.location='Qlydonhang.php';",3000);
		</script>
	</body>
</html>

<?php
	}
?>