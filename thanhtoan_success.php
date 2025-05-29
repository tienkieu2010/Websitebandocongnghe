<?php
    session_start();
    require_once("connect.php");
    if ($_SESSION["login"]==false){
        echo "<script>
        alert('Vui lòng đăng nhập để thanh toán!');
        setTimeout(function() {
            window.location.replace('login.php');
        }, 2000);
        </script>";
    } 

    else{
        $tongtien =$_POST["tongtien"];
        $Mauser = $_SESSION["uid"];
        $Payid = $_POST["Payid"];
        $Tennguoinhan = $_POST["Tennguoinhan"];
        $Diachinhan = $_POST["Diachinguoinhan"];
        $Sodtnguoinhan = $_POST["Sodtnguoinhan"];
        $Emailnguoinhan = $_POST["Emailnguoinhan"];
        $Thoigiandat = date("Y-m-d H:i:s");

        $sql = "insert into donhang(Mauser,Payid,Tennguoinhan,Diachinhan,Sodtnguoinhan,Emailnguoinhan,Thoigiandat,Tongtienthanhtoan,Trangthaidon) values ($Mauser,$Payid,'$Tennguoinhan','$Diachinhan','$Sodtnguoinhan','$Emailnguoinhan','$Thoigiandat',$tongtien,0)";
	    $conn->query($sql) or die($conn->error);
	    $sql1 = "select Madonhang from donhang where Mauser=$Mauser order by Madonhang desc limit 0,1";

        $result = $conn->query($sql1) or die($conn->error);
	    $r = $result->fetch_assoc();
	    if (!empty($_SESSION["cart_item"])){
            $i=0;
		    foreach($_SESSION["cart_item"] as $item){
                $i++;
                $Soluong = "Soluong".$i;
                $Soluong2 = "Soluong2".$i;
                $soluongspi = $_POST["$Soluong"];
                $gia = $_POST["$Soluong2"];

			    $conn->query("insert into chitietdonhang(Madonhang,Masp,Mamau,Soluong,Giaspindon) values (".$r["Madonhang"].",".$item["Masp"].",".$item["Mamau"].",$soluongspi,$gia)") or die($conn->error);
		    }
		
	    }
	    unset($_SESSION["cart_item"]);
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h3 align=center>Đặt hàng thành công! Cảm ơn quý khách đã sử dụng dịch vụ!</h3>
		<script>
			setTimeout("window.location='index.php';",3000);
		</script>
	</body>
</html>

<?php
	}
?>