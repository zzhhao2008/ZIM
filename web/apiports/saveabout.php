<?
session_start();
include "../user/functionset.php";
inituser();
if (login_check()) {
} else {
    header("location:/");
    exit;
};
include "./commontext.php";
foreach($_POST['about'] as $k=>$v){
    $user["about"][$k]=autotext($v);
}
$user['name']=autotext($_POST['name']);
$user['welcome']=1;
save_user();
if( $_POST['reload']==="1"){
    echo "<script>top.loadaboutme()</script>";
}else{
header("location:/main.php");
}