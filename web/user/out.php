<?php
session_start();
foreach($_SESSION as $k=>$v){
    unset ($_SESSION[$k]);
}
setcookie("PHPSESSID","",time()-3600,"/");
header("location:/");