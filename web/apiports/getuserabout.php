<?php
session_start();
include "../user/functionset.php";
inituser();
if (empty($_GET['id'])) $ge = $user;
else {
    $gup = "../database/chat/user/" . $_GET['id'] . ".php";
    if (!file_exists($gup)) $ge=array("name"=>"?","about"=>array("sex"=>"?","age"=>"?","axqm"=>"?","address"=>"?"));
    //else if ($_GET['id']==='100013') $ge=array("name"=>"zzh的孙子LYZ","about"=>array("sex"=>"？","age"=>"-114514","axqm"=>"zzh的孙子","address"=>"zzh的孙子"));
    else $ge = require($gup);
}
$nout = array("about", "name");
foreach ($nout as $v) {
    $out[$v] = $ge[$v];
}
echo json_encode($out, 1);
