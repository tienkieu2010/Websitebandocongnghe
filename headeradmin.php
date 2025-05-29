

<style type="text/css">
    .frmSearch{}
		#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
		#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
		#country-list li:hover{background:#ece3d2;cursor: pointer;}
		#search-box{padding: 2px;border: #a8d4b1 1px solid;border-radius:4px;}
		</style>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="js/header.js"></script>

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

               
                <input style="border-radius: 5px;width:200px; height:30px; font-size: 15px;"
                    type="text" placeholder="Tìm kiếm sản phẩm..." name=search-box id="search-box">
                    <button type=submit name=cmd>
                        <img src="images/icon_search.jpg" width=17 alt="">
                    </button>
			    <div id="suggesstion-box"></div>
		        </div>

            
            </form>

            <ul id="main-menu">
                <li><a href="Quanlydienthoai.php">
                        <button class="icon-button">
                            <i class="material-icons">smartphone</i>&nbsp Điện thoại
                        </button>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="Quanlymausac.php">Quản lý màu sắc</a></li>
                        <li><a href="Quanlythongso.php">Quản lý thông số</a></li>
                        <li><a href="Quanlyhang.php">Quản lý hãng</a></li>
                        
                    </ul>
                </li>
        

                <li><a href="contact.html">
                        <button class="icon-button">
                            <i class="material-icons">power</i> Phụ kiện
                        </button>
                    </a></li>
              
                <li><a href="Quanlytintuc.php">
                        <button class="icon-button">
                            <i class="material-icons">business</i>&nbsp Tin tức
                        </button>
                </a></li>

                <li><a href="Quanlydonhang.php">
                        <button class="icon-button">
                            <i class="material-icons">build_circle</i>&nbsp Đơn hàng
                        </button>
                    </a></li>
                

                <li>
                    <a href="logout_action.php">
                        <button class="icon-button">
                            <i class=" material-icons">account_circle</i>&nbsp Đăng xuất
                        </button>
                    </a>
                </li>

            

            </ul>
        </nav>
    </header>