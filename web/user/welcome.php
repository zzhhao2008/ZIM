<!DOCTYPE html>
<html>


<head>
    <link rel="shortcut icon" href="/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://61.183.42.64:45337/static/bootstrap-3.4.1-dist/css/bootstrap.css" th:href="@{/lib/semantic/dist/semantic.min.css}">
    <title>ZSV ChatBox-初始化账号</title>
</head>

<body>
    <form method="post" action="../apiports/saveabout.php">
        <div class="container windowbox">
            <div class="window window1" id="window1">
                <h1>欢迎来到ZSV-Z聊</h1>
                你的账号ID是：<h3 style="display: inline;"><?php print_r($_SESSION['id']) ?></h3><br>
                这是你在Z聊世界畅行的重要凭证,请牢记<br>
                <h4>在开始之前，请先设置一个名字吧！</h4>
                <input type="text" name="name" value="<?php print_r($_SESSION['id']) ?>"><br>
                <span class="btn btn-info" onclick="nextwindow(1)">下一步</span>
            </div>
            <div class="window windowb" id="window2">
                <h1>介绍一下你自己</h1>
                <h3>性别</h3>
                <input type="radio" name="about[sex]" value="男">男
                <input type="radio" name="about[sex]" value="女">女<br>
                <input type="text" name="about[sex]" placeholder="其他">
                <h3>年龄</h3>
                <input type="number" name="about[age]">
                <h3>位置</h3>
                <input type="text" name="about[address]">
                <h3>个性签名</h3>
                <input type="text" name="about[axqm]">
                <br>
                <input type="submit" class="btn btn-danger" value="提交">
            </div>
        </div>
    </form>
</body>

<style>
    .windowbox {
        text-align: center;
    }

    .window {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }

    .btn {
        margin: 25px;
    }

    .windowb {
        left: 100%
    }
    input[type="text"]{
        width: 50%;
        max-width: 350px;
    }
</style>
<script>
    var i = 0
    var shell
    var windows = [];
    for (i = 1; i <= 2; i++) {
        windows[i] = document.getElementById("window" + i);
    }

    function nextwindow(now) {
        next = now + 1
        if (windows[next]) {
            shell = setInterval(function() {
                windows[now].style.left = (i * -1) + "%";
                windows[next].style.left = (100 - i) + "%";
                i++
                if (i > 100) clearInterval(shell)
            }, 1)
        }
    }
</script>