<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TienKieumobile</title>
    <style>
        #thongtinkhach {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#thongtinkhach p {
    font-size: 26px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

#thongtinkhach table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size:17px;
}

#thongtinkhach table, #thongtinkhach th, #thongtinkhach td {
    border: 1px solid #ddd;
}

#thongtinkhach th, #thongtinkhach td {
    padding: 10px;
    text-align: left;
}

#thongtinkhach input {
    width: calc(100% - 20px);
    padding: 8px;
    box-sizing: border-box;
    margin-top: 5px;
    font-size:15px;
}

#thongtinkhach input[type="text"] {
    border: 1px solid #ccc;
    border-radius: 4px;
}
#cacphuongthucthanhtoan {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding-left:70px;
    padding-right:70px;
}

#phuongthucthanhtoan {
    border: 2px solid #3498db;
    border-radius: 8px;
    margin: 10px;
    padding: 10px; /* Giảm kích thước khoảng trắng bên trong */
    width: 180px; /* Giảm kích thước chiều rộng */
    transition: transform 0.3s ease;
}

#phuongthucthanhtoan:hover {
    transform: scale(1.05);
}

#phuongthucthanhtoan input {
    margin-right: 5px;
}

#phuongthucthanhtoan p {
    margin: 8px 0; /* Giảm khoảng cách giữa văn bản và biểu tượng radio */
}

#phuongthucthanhtoan:hover {
    background-color: #ecf0f1;
}
    </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/giohang.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        
        <?php include 'header.php'; ?>
    <br>
    <br>

    <script>

       
        function Tangsoluong(a,b) {
            var tongtien = document.getElementById("tongtien");
            var Soluong = document.getElementById(a);
            var Tonggiasp = document.getElementById(b);
            Soluong.value++;

            var giacong = parseInt(Tonggiasp.value)/ (parseInt(Soluong.value)-1);
            
            Tonggiasp.value = parseInt(Tonggiasp.value) +  parseInt(giacong);
            tongtien.value = parseInt(tongtien.value) + parseInt(giacong);


        // Lưu giá trị vào Local Storage
            //localStorage.setItem(a, Soluong.value);
            //localStorage.setItem(b, Tonggiasp.value);
        }

    // Function to decrement quantity and update local storage
    function Giamsoluong(a,b) {
        var tongtien = document.getElementById("tongtien");
        var Soluong = document.getElementById(a);
        var Tonggiasp = document.getElementById(b);
        if (Soluong.value > 1) {
            var giatru = parseInt(Tonggiasp.value)/ (parseInt(Soluong.value));
            Tonggiasp.value = parseInt(Tonggiasp.value) -  parseInt(giatru);
            tongtien.value =  parseInt(tongtien.value) - parseInt(giatru);

            Soluong.value--;
            // Lưu giá trị vào Local Storage
            //localStorage.setItem(a, Soluong.value);
            //localStorage.setItem(b, Tonggiasp.value);

           
        }
    }


    // Hàm để khôi phục giá trị từ Local Storage khi trang được tải lại
    //function Khoiphucgiatri() {
        // Lặp qua tất cả các ô text và cập nhật giá trị từ Local Storage
     //   var inputs = document.querySelectorAll('input[type="text"]');
       // inputs.forEach(function(input) {
         //   var id = input.id;
           // var storedValue = localStorage.getItem(id);
            //if (storedValue !== null) {
              //  input.value = storedValue;
            //}
        //});
    //}
    //window.onload = Khoiphucgiatri;
    </script>

<main>
    <br>
    <br>

    <div>
        
             
            <div style="text-align:center;">
                <h2>Giỏ hàng của bạn</h2>

    
            </div>
    <form method="POST" action="thanhtoan_success.php">

        <?php
            require_once("connect.php");
            if (!empty($_GET["action"])){
                switch($_GET["action"]){
                    case "remove":
                        if (!empty($_SESSION["cart_item"])){
                            foreach($_SESSION["cart_item"] as $k=>$v){
                                if ($_GET["masp"]==$k)
                                {
                                    unset($_SESSION["cart_item"][$k]);
                                }
                                if (empty($_SESSION["cart_item"]))
                                {
                                    unset($_SESSION["cart_item"]);
                                }
                               
                            }
                
                        }
                        break;

                    case "payment":
                        if ($_SESSION["login"]==true){
                            
                        } 
                        else{
                            echo "<script>
                            Swal.fire({
                                title: 'Vui lòng đăng nhập để thanh toán',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = 'login.php';
                                }
                            });
                            </script>
                            ";
                        }
                        break;

                    
                }
            }

            if (!empty($_SESSION["cart_item"])){
                $i=0;
                $tongtien=0;
                foreach($_SESSION["cart_item"] as $item){
                    $i++;
                    $Soluong = "Soluong".$i;
                    $Soluong2 = "Soluong2".$i;

                    echo "<div style='display:flex; border:1px solid #DCDCDC'>
                            <div style='width:15%;  text-align:center; padding-top:17px;'>
                            <img src='images/sanpham/".$item["Anh"]."' width=85px alt=''> 
                            <br>
                            <a href='?action=remove&masp=a".$item["Masp"]."'>
                            <img src='images/Xoa.jpg' width=20px alt=''> 
                            </a>  
                            </div>
                            <div  style='width:70%; '>
                            <h3>".$item["Tensp"]."</h3>
                            <div>Màu:".$item["Mau"]."</div>
                            <div>".$item["Phienban"]."</div>            
                            </div>
                            <div style='width:15%; '>
                            <br>
                            <input type=text style='color:red;  font-weight: bold; border:none; font-size:20px; width:88px;' name=".$Soluong2." id=\"".$Soluong2."\" value=".$item["Gia"].">đ
                            
                                <div style='display:flex; margin-top:5px;'>
                                <input type=button style='width:27px;height:39px;' value='-' onclick='Giamsoluong(\"".$Soluong."\",\"".$Soluong2."\")'>
                                <input type=text style='width:20px; text-align:center;' value='1' name=".$Soluong." id=\"".$Soluong."\">
                                <input type=button value='+' onclick='Tangsoluong(\"".$Soluong."\",\"".$Soluong2."\")'>
                                </div>
                            </div>
                        </div> ";
                    $tongtien+=$item["Gia"];
                }

                echo "<br> <div style='float:right; font-size:19px;color:blue;'>Tổng tiền thanh toán: <input style='font-size:16px; font-weight:bold; width:75px; border:none;' type=text value='$tongtien' name=tongtien  id=tongtien>đ </div> <br> <br>";
            }
        ?>

        <?php 
			if(!empty($_GET["action"])){
				if ($_GET["action"]=="payment" && $_SESSION["login"]==true){
                    $uid=intval($_SESSION["uid"]);
                    $userinfo = $conn->query("select * from user where Mauser=$uid") or die($conn->error);
					$ruser = $userinfo->fetch_assoc();	
        ?>

        
        <div id="thongtinkhach">
            <p style="font-size:20px;">Thông tin khách hàng</p>
            <table>
                <tr>
                    <td>Họ tên người nhận:</td>
                    <td><input type="text" name='Tennguoinhan' value='<?php echo $ruser["Tenuser"] ?>'></td>
                </tr>
                <tr>
                    <td>Địa chỉ người nhận:</td>
                    <td><input type="text" name='Diachinguoinhan' value='<?php echo $ruser["Diachi"] ?>'></td>
                </tr>
                <tr>
                    <td>Số điện thoại người nhận:</td>
                    <td><input type="text" name='Sodtnguoinhan' value='<?php echo $ruser["Sodienthoai"] ?>'></td>
                </tr>
                <tr>
                    <td>Email người nhận:</td>
                    <td><input type="text" name='Emailnguoinhan' value='<?php echo $ruser["Email"] ?>'></td>
                </tr>
            </table>
        </div>

        <div id="cacphuongthucthanhtoan">
            <div style="width:150px;">
            <h2>Phương thức 
            thanh toán:</h2>
            </div>
            <?php

                $payment = $conn->query("select * from payment where paystatus=1") or die($conn->error);
                while($pay = $payment->fetch_assoc())
                {
            ?>   

            <div id="phuongthucthanhtoan">
                <input type="radio" name="Payid" value=<?php echo $pay["payid"] ?>> <?php echo $pay["payname"] ?>
                <p><?php echo $pay["paydesc"]; ?></p>
            </div>
            <?php
                }
            ?>
        </div>

        </br>
        <div style="text-align:center;">
            
            <input type="submit" style="width:500px; height:50px; font-weight: bold; border:none; font-size:20px; color: white; background-color:#FFD700; border-radius:5px;" value="Đặt hàng">
            
        </div>
        </form>

        <?php
                }
            }
        ?>


        <br>

        <?php
            if(empty($_GET["action"]) && !empty($_SESSION["cart_item"])){
        ?>
        <div style="text-align:center;">
            <a href="?action=payment">
                <input type="button" style="width:500px; height:50px; font-weight: bold; border:none; font-size:20px; color: white; background-color:#FFD700; border-radius:5px;" value="Đặt hàng">
            </a>
        </div>

        <?php
            }

            if(empty($_SESSION["cart_item"]))
            {
        ?>
        <div style="text-align:center;">
            <p style="font-weight: bold; border:none; font-size:25px;"> Giỏ hàng của bạn đang trống! </p>
        </div>
        <?php
            }
        ?>
        <br>
        
    </div>

</main>
<?php include 'footer.php'; ?>