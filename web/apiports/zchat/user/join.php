<?php
$uinfo=json_decode($_GET['json'],1);
include ("./functionset.php");
echo login_check()?"OK":"NO";