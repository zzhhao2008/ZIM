<?php
session_start();
if($_SESSION['userid']){
    include "user/functionset.php";
    header("location:./main.php");
}else{
    header("location:./user");
}
?>
