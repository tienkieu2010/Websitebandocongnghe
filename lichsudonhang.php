<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>TienKieumobile</title>

    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--<link href="css/style.css" rel="stylesheet" type="text/css">-->
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/lichsudonhang.css">
		<style>
			#shopping-cart {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

main{
	min-height:400px;
}
.txt-heading {
    font-size: 30px;
	text-align:center;
    font-weight: bold;
    margin-bottom: 10px;
}

#btn {
    text-decoration: none;
    padding: 8px 12px;
    border: 1px solid #3498db;
    border-radius: 4px;
    color: #3498db;
    background-color: #fff;
    transition: background-color 0.3s, color 0.3s;
}

#btn:hover {
    background-color: #3498db;
    color: #fff;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #3498db;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e0e0e0;
}
		</style>
		<?php include 'header.php'; ?>

<?php 
	//unset($_SESSION["cart_item"]);
	require_once("connect.php");
	if (!isset($_GET["Trangthaidonhang"])){
		$ostatus = 0;
	}
	else {
	$ostatus = $_GET["Trangthaidonhang"];
	}
	//var_dump($ostatus);
	$sql = "select a.*,b.payname from donhang a,payment b where a.payid=b.payid and Mauser=".$_SESSION["uid"]." and Trangthaidon=".$ostatus."";
	$result = $conn->query($sql);
	//var_dump($result);
	
?>

<br>
<br>

	<main>
		<br>
		<br>
			<div id="shopping-cart">
			
			<div class="txt-heading">Lịch sử đơn hàng</div>
			<br>
			<a id="btn" href=?Trangthaidonhang=0>Đang chờ xác nhận</a>
			&nbsp;&nbsp;
			<a id="btn" href=?Trangthaidonhang=1>Đã xác nhận</a>
			&nbsp;&nbsp;
			<a id="btn" href=?Trangthaidonhang=2>Đang giao hàng</a>
			&nbsp;&nbsp;
			<a id="btn" href=?Trangthaidonhang=3>Đã hoàn thành</a>
			
            &nbsp;&nbsp;
			<a id="btn" href=?Trangthaidonhang=4>Đã hủy</a>

				<table>
					<tr>
						<th>Mã đơn hàng</th>
						<th>Hình thức thanh toán</th>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Email</th>
						<th>Số điện thoại</th>
                        <th>Thời gian đặt</th>
						<th>Trạng thái đơn</th>
						<th>Xem chi tiết</th>
						
					</tr>
					<?php 
						if ($result->num_rows>0){
							while ($r=$result->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $r["Madonhang"];?></td>
								<td><?php echo $r["payname"];?></td>
								<td><?php echo $r["Tennguoinhan"];?></td>
								<td><?php echo $r["Diachinhan"];?></td>
								<td><?php echo $r["Emailnguoinhan"];?></td>
								<td><?php echo $r["Sodtnguoinhan"];?></td>
                                <td><?php echo $r["Thoigiandat"];?></td>
								<td><?php 
								switch(intval($r["Trangthaidon"])){
									case 0:
										echo "Đang chờ xác nhận";
										break;
									case 1:
										echo "Đã xác nhận, chuẩn bị giao";
										break;
									case 2:
										echo "Đang giao hàng";
										break;
									case 3:
										echo "Đã giao hàng";
										break;
                                    case 4:
										echo "Đã hủy";
										break;
									default:
										echo "Trạng thái không xác định";
										break;
								}
								?></td>
								<td><a href="chitietdonhang.php?Madonhang=<?php echo $r["Madonhang"];?>">Order Detail</a></td>
							</tr>
							
						<?php 	
							}
						} else {
							echo "<tr><td colspan=8>No order</td></tr>";
						}
					?>
				</table>
			</div>
			
			
	</main>


	<?php include 'footer.php'; ?>