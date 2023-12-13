<audio src="/tcm.mp3" id="tcm"></audio>
<script>
    tcm = document.getElementById("tcm");//获取提示音控件
    socket = new WebSocket("ws://116.62.220.226:5536/");//创建websocket连接
    var initData = {
        "id": "<?php echo $_SESSION['id'] ?>",
        "pass": "<?php echo $_SESSION['loginpas'] ?>"
    };//初始化用户信息
    socket.onopen = function() {//连接成功回调函数
        socket.send(JSON.stringify(initData));//发送初始化信息
    }
    socket.onmessage = function(e) {//收到消息
        console.log(e)
        recvdata = JSON.parse(e.data);//解析JSON
        tcm.play()//播放提示音
        switch (recvdata.order) { //根据指令执行操作
            case "onmes":
                document.getElementById("etof" + recvdata.group).innerHTML = timestampToTime(recvdata.mes.time); 
                document.getElementById("previewof" + recvdata.group).innerHTML = wuser(recvdata.mes.user) + ":" + recvdata.mes.msg; 
                f = false
                if (nowgroup == recvdata.group) { 
                    f = true
                    if (mesbox.scrollTop <= mesbox.scrollHeight - 900) f = false 
                    drawmes(recvdata.mes) //绘制消息
                    if (f) mesbox.scrollTo(0, mesbox.scrollHeight); 
                } else {
                    document.getElementById("alaof" + recvdata.group).style.display = 'inline'; 
                }
                break;
            case "error":
                window.location = "/erclose.php?code=" + recvdata.code;
                break;
        }
    }
    socket.onclose = function() {//连接断开
        alert("与服务器的连接意外断开！");
        location.href = "/erclose.php?code=Unexpect Disconnect";
        console.error("Socket Disc:UD")
        //location.reload()
    }

    function send(str) {//发送函数
        if (nowgroup && socket.readyState === 1 && document.getElementById("mess").value != "") {//状态正常且消息不为空
            var data = {
                "userinfo": initData,
                "group": nowgroup,
                "msg": document.getElementById("mess").value
            }
            socket.send(JSON.stringify(data));//发送JSON
            document.getElementById("mess").value = ""//清空输入框
        }
        else if(str){
            socket.send(str)
        }
    }
</script>