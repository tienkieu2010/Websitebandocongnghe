<?php

    session_start();
    $_SESSION["fullname"]="";
    $_SESSION["uid"]="";
    $_SESSION["login"]=false;
    header("Location:login.php");
?>
