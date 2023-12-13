<?php
$dirpath="../../../database/chat/grconfig/";
$dir=scandir($dirpath);
$ndl=array(".","..");
$list=array();
foreach ($dir as $v){
    if(in_array($v,$ndl)) continue;
    $ng=require($dirpath.$v);
    $nu=array();
    foreach($ng['users'] as $vv){
        $nu[]=$vv;
    }
    $list[str_replace(".php","",$v)]=$nu;
}
echo json_encode($list);