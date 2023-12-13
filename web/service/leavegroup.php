<?php
session_start();
include "../user/functionset.php";
inituser();
if (login_check()) {
} else {
    header("location:/");
    exit;
};
include "../apiports/commontext.php";
if(!$_GET['gid']){
    echo "<script>alert('请检查空项！')</script>";
    exit;
}
$groupid=autotext($_GET['gid']);
$gcpath="../database/chat/grconfig/$groupid.php";
if(!file_exists($gcpath)){
    echo "<script>alert('群不存在！！')</script>";
    exit;
}
$gc=require($gcpath);
foreach($gc['users'] as $k=>$v){
    if($v===$_SESSION['id']){
        unset($gc['users'][$k]);
        break;
    }
}

save_user();
file_put_contents($gcpath,"<?php return ".var_export($gc,1)."; ?>");
echo "<script>;top.send('reloadusers');top.location.reload();</script>";
?>
