

<?php
    session_start();
    if($_SESSION["login"]=true && $_SESSION["quyen"]=1)
    {

    }

    else{
        echo "<script>
				alert('Vui lòng đăng nhập!');
				setTimeout(function() {
					window.location.replace('login.php');
				}, 1000);
			 </script>";
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TienKieumobile</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/admin.css">
        <?php include 'headeradmin.php'; ?>
    <br>
    <br>


<main>


</main>


<?php include 'footer.php'; ?>