<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cuahangdt";
    $conn = new mysqli($servername,$username,$password, $database);
    $conn1 = new mysqli($servername,$username,$password, $database);
    $conn2 = new mysqli($servername,$username,$password, $database);
    $conn3 = new mysqli($servername,$username,$password, $database);
    $conn4 = new mysqli($servername,$username,$password, $database);
    $conn5 = new mysqli($servername,$username,$password, $database);
    mysqli_set_charset($conn, "utf8");
    mysqli_set_charset($conn2, "utf8");
    mysqli_set_charset($conn3, "utf8");
    mysqli_set_charset($conn4, "utf8");
    if($conn->connect_error)
        die("lỗi kết nối với CSDL");
    
      
    /*
      &sql = "insert into Categories(cname, cdesc, cimage, corder, cstatus)
      values('Samsung','Hãng đt HQ','samsung.jpg',1,1)";
&sql1 = "insert into Categories(cname, cdesc, cimage, corder, cstatus)
      values('Apple','Hãng đt n tiếng t cầu','apple.jpg',2,1)";
$conn->query($sql) or die($conn->error);
$conn->query($sql1) or die($conn->error);
$conn->close();

    */
    
?>