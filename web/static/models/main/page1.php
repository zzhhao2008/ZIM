<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="headbars">
    消息列表
    <div class="dropdown" style="float: right;">
        <button type="button" class="btn dropdown-toggle glyphicon glyphicon-plus" id="dropdownMenu1" data-toggle="dropdown" style="background: none;"></button>
        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation">
                <a role="menuitem" tabindex="-1" href="javascript:opentool('cg')">创建群聊</a>
            </li>
            <li role="presentation">
                <a role="menuitem" tabindex="-1" href="javascript:opentool('jg')">加入群聊</a>
            </li>
            <li role="presentation">
                <a role="menuitem" tabindex="-1" href="javascript:location.reload()">重置</a>
            </li>
        </ul>
    </div>
</div>
<ul id="msglist">
    为节省性能，仅加载50条消息，更多消息请查看群详情
    <hr>
</ul>