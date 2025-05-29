
<?php
 
    session_start();
    if(!isset($_SESSION["uid"]))
    {
        $_SESSION["uid"]="";
    }
    if(!isset($_SESSION["login"]))
    {
        $_SESSION["login"]=false;
    }
    if(!isset($_SESSION["fullname"]))
    {
        $_SESSION["fullname"]="";
    }
?>
    <style type="text/css">
    .frmSearch{}
		#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
		#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
		#country-list li:hover{background:#ece3d2;cursor: pointer;}
		#search-box{padding: 2px;border: #a8d4b1 1px solid;border-radius:4px;}
		</style>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="js/header.js"></script>

    <style>
.frmSearch {
    position: relative;
    display: inline-block;
    margin-top:20px;
}

#search-box {
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 200px;
    height: 35px;
    font-size: 15px;
    padding: 5px;
    box-sizing: border-box;
}

button {
    border: none;
    background-color: transparent;
    color: black;
    border-radius: 5px;
    height: 30px;
    cursor: pointer;
}

#suggesstion-box {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1;
    width: 200px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none;
    display: none;
}

#suggesstion-box a {
    padding: 10px;
    display: block;
    text-decoration: none;
    color: #333;
    transition: background-color 0.3s;
}

#suggesstion-box a:hover {
    background-color: #f1f1f1;
}



    </style>

    <script>
        
    </script>

</head>

<body>
    <header>
        
        <nav class="container">
            <a href="" id="logo">
                <img src="images/logo.png" width="140px;" alt="">
            </a>

            <form method="POST" action="search.php">
                &nbsp;
                <div class="frmSearch">

               
                <input type="text" placeholder="Tìm kiếm sản phẩm..." name=search-box id="search-box">
                    <button type=submit name=cmd>
                    <i class="fa fa-search"></i>
                    </button>
			    <div id="suggesstion-box"></div>
		        </div>

            
            </form>

            <ul id="main-menu">
                <li><a href="index.php">
                        <button class="icon-button">
                            <i class="material-icons">smartphone</i>&nbsp Điện thoại
                        </button>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="">Xiaomi</a></li>
                        <li><a href="">Realme</a></li>
                        <li><a href="">Oneplus</a></li>
                        <li><a href="">Iphone</a></li>
                        <li><a href="">Tecno</a></li>
                        <li><a href="">Samsung</a></li>
                        <li><a href="">Red Magic</a></li>

                    </ul>
                </li>

                <li><a href="tintuc.php">
                        <button class="icon-button">
                            <i class="material-icons">business</i>&nbsp Tin tức
                        </button>
                </a></li>

                

                <li><a href="giohang.php">
                        <button class="icon-button">
                            <i class="material-icons">shopping_cart</i>&nbsp Giỏ hàng
                        </button>
                    </a>
                    
                </li>

            <?php
                if($_SESSION["login"]==false)
                {
                echo "<li>
                    <a href='login.php'>
                        <button class='icon-button'>
                            <i class='material-icons'>account_circle</i>&nbsp Đăng nhập
                        </button>
                    </a>
                </li>";
            
                }
                else{
                echo "<li>
                    <a href=''>
                        <button class='icon-button'>
                            <i class='material-icons'>account_circle</i>".$_SESSION["fullname"]."
                        </button>
                    </a>

                    <ul class='sub-menu'>
                        <li><a href=''>Thông tin cá nhân</a></li>
                        <li><a href='lichsudonhang.php'>Lịch sử đơn hàng</a></li>
                        <li><a href=''>Đổi mật khẩu</a></li>
                        <li><a href='logout_action.php'>Đăng xuất</a></li>
                    </ul>
                </li>";
                }

               

            ?>
            </ul>
        </nav>
    </header>