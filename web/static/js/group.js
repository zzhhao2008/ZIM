function group(groupid) {
    document.getElementById("grdiv").style.display = "block";
    fetch("/apiports/groupconfig.php?groupid=" + groupid)
        .then(response => response.json())
        .then(data => groupmain(data, groupid))

}
function closegroup() {
    nowgroup=''
    document.getElementById("grdiv").style.display = "none";
    document.getElementById("grname").innerHTML = "";
    mesbox.innerHTML="";
    document.getElementById("aboutg").innerHTML = "";
}

function drawmes(data) {
    mes = "msg"; user = "user";
    time=data.time;
    if (data[user] == uid) {
        data[user]='';
        mesbox.innerHTML += "<div class='minediv'>" + data[user] + (time == 0 ? "" : "" + timestampToTime(time)) + "<br><p class='mine'>" + data[mes] + "</p><br></div>"
    } else {
        
        mesbox.innerHTML += `<a href="javascript:lookwhoi(`+data[user]+`)">`+wuser(data[user])+"</a>" + (time == 0 ? "" : " - " + timestampToTime(time)) + "<p>" + data[mes] + "</p>"
    }
}

msglist = document.getElementById("msglist");

function showmsgs(data) {
    for (i = 0; i <= data.length; i++) {
        ti=i
        //console.log(data[ti])
        if (data[ti].error) continue;
        if(i==0){
            users=data[0];
            continue;
        }
        msglist.innerHTML += `<a href="javascript:group(` + data[ti].id + `)" class="group-link">
        <img src="/icon.png" class="group-icon">
        <span class='et' id='etof`+data[ti].id+`'>`+ timestampToTime(data[ti].t) + `</span>
        <div class="group-details">
            <span class="ua">` + data[ti].name + `<b style="color:red;display:none" class="glyphicon glyphicon-bell" id="alaof`+data[ti].id+`"></b></span>
            <span class="message-preview" id="previewof`+data[ti].id+`">` + data[ti].msgnewest + `</span>
        </div>
        
    </a><hr>`;
    }
};

function getmsglist() {
    fetch("/apiports/gag.php")
        .then(response => response.json())
        .then(data => showmsgs(data))
}
getmsglist()