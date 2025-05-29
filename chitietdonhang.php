

<!DOCTYPE html>
<ht lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--<link href="css/style.css" rel="stylesheet" type="text/css">-->
		<link rel="stylesheet" href="css/header.css">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    main {
        width: 80%;
        margin: 20px auto;
    }

    h2 {
        text-align: center;
    }

    .table1, .table2 {
        margin-top: 20px;
        margin-bottom: 20px;
        width: 80%;
        margin: 0 auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    .buttonxnh {
        margin-top: 20px;
        text-align: center;
    }

    input[type="button"] {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="button"]:hover {
        background-color: #45a049;
    }

</style>

<?php include 'header.php'; ?>

<br>
<br>
<?php
   
	//unset($_SESSION["cart_item"]);
	require_once("connect.php");
    $Madonhang = $_GET["Madonhang"];
?>
<main>

    <br> <br> <br>
    <center><h2>Thông tin chi tiết đơn hàng</h2></center>

    <?php
        $detail = $conn->query("select * from payment a,user b,donhang c where c.Mauser = b.Mauser and c.payid=a.payid and Madonhang=$Madonhang");
        $detailtt = $detail->fetch_assoc();	
        $payment = $conn->query("select * from payment");
    
    ?>
            <div class="table1">
                <table>
					<tr>
						<td valign=top width=150 style="font-weight:bold">Payment by: </td>
						<td>
							<?php while ($rpay = $payment->fetch_assoc()){
								?>
								<input type=radio name=rdPayment 
                                <?php
                                    if($rpay["payid"]==$detailtt["payid"])
                                    {
                                        echo "checked";
                                    }
                                ?>
                                > <?php echo $rpay["payname"];?><br>
							<?php 
							}
							?>
						</td>
					</tr>
					<tr>
						<td valign=top  style="font-weight:bold">
							Receiver Name:
						</td>
						<td>
							<?php echo $detailtt["Tennguoinhan"];?>
						</td>
					</tr>
					<tr>
						<td valign=top  style="font-weight:bold">
							Address:
						</td>
						<td>
							<?php echo $detailtt["Diachinhan"];?>
						</td>
					</tr>
					<tr>
						<td valign=top  style="font-weight:bold">
							Email:
						</td>
						<td>
							<?php echo $detailtt["Emailnguoinhan"];?>
						</td>
					</tr>
					<tr>
						<td valign=top  style="font-weight:bold">
							Phone:
						</td>
						<td>
							<?php echo $detailtt["Sodtnguoinhan"];?>
						</td>
					</tr>

                    <tr>
                        <td valign=top  style="font-weight:bold">
                            Trạng thái:
                        </td>
                        <td>
                        <?php 
								switch(intval($detailtt["Trangthaidon"])){
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
									default:
										echo "Trạng thái không xác định";
										break;
								}
								?>
                        </td>
                    </tr>
				
				</table>
            </div>

            <div class="table2">
            <table>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Phiên bản</th>
                    <th>Màu</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
        
                </tr>    
            <?php
                $detailsp = $conn->query("select * from chitietdonhang a, sanpham b,mausac c,sanpham_mausac d where d.Masp = a.Masp and d.Mamau = a.Mamau and a.Masp = b.Masp and c.Mamau = a.Mamau and Madonhang = $Madonhang") or die($conn->error);
                while ($detailspct = $detailsp->fetch_assoc()){
            ?>
                <tr>
                    <td> <?php echo $detailspct["Tensp"] ?> </td>
                    <td> <?php echo $detailspct["Tenmau"] ?> </td>
                    <td> <?php echo "".$detailspct["Ram"]."-".$detailspct["Rom"]."GB" ?> </td>
                    <td> <img src='images/sanpham/<?php echo $detailspct["imagesp_mau"] ?>' width=200px> </td>
                    <td> <?php echo $detailspct["Soluong"] ?> </td>
                    <td> <?php echo $detailspct["Giaspindon"] ?> </td>
                </tr>
            <?php 
            }
            ?>
            </table>
            </div>

            <?php
                if($detailtt["Trangthaidon"]+1<=3)
                {
            ?>

            <div class="buttonxnh">
                <?php
                    if($detailtt["Trangthaidon"]==0)
                    {
                ?>
                <a href="changestatus.php?Madonhang=<?php echo $detailtt["Madonhang"] ?>&Trangthaidon=4" onclick="return confirm('Bạn có chắc chắn muốn xác nhận hủy không?');">
                    <input type="button" value="Xác nhận hủy">
                </a>

                <?php
                    }
                ?>
                 
            </div>
            <?php
                }
            ?>
            
            </main>

<?php include 'footer.php'; ?>
