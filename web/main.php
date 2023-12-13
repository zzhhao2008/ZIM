<?php
session_start();
include "./user/functionset.php";
if (login_check()) {
} else {
    header("location:/user");
    exit;
};
if ($user['welcome'] != 1) {
    header("location:./user/welcome.php");
    exit;
}
$userdata = $user;
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/bootstrap-3.4.1-dist/css/bootstrap.css" th:href="@{/lib/semantic/dist/semantic.min.css}">
    <link rel="stylesheet" href="/static/css/main.css">
    <title>ZSV ChatBox-主页</title>

</head>
<script>
    var uid = "<?php echo $_SESSION['id'] ?>";
</script>

<body>
    <?php include './static/models/main/toolbar.php' ?>
    <?php include './static/models/main/groupmain.php' ?>
    <div class='page'>
        <div class='pages' id='page1'>
            <?php include './static/models/main/page1.php' ?>
        </div>
        <div class='pages' id='page2'>
            <?php include './static/models/main/page2.php' ?>
        </div>
    </div>
    <?php include './static/models/main/navbar.php' ?>
</body>

<script src="/static/js/o.js"></script>
<script src="/static/js/windowctrol.js"></script>
<script src="/static/js/tool.js"></script>
<script src="/static/js/group.js"></script>

<iframe name="tempifa" id="tempifa" style="display: none;"></iframe>
<?php include "./static/models/main/websocketmain.php" ?>
<!--
    关于回调函数：
    opentool("工具名") - 打开工具
    closetool() -- 关闭
    lookwhoi("id") -- 查看用户
    group("群id") -- 进入群
    closegroup() -- 关闭群
    wuser() -- 获取用户名
-->