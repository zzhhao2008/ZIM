<?php
session_start();
include "../user/functionset.php";
inituser();
if (login_check()) {
} else {
    header("location:/");
    exit;
};
if(empty($_POST['n'])){
    echo "<script>alert('密码不能为空');history.go(-1)</script>";
    exit;
}
if(md5($_POST['y'])===$user['password']){
    $user['password']=md5($_POST["n"]);
    save_user();
    header("location:/");
}else{
    echo "<script>alert('原密码错误！');history.go(-1)</script>";
}