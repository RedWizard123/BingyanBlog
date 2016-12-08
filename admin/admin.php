<?php
include("../php/MySQL.config.php");
include("../php/Function.php");
if(!checkCookie()){
    header("location:admin/");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/main.css" rel="stylesheet" type="text/css"/>
    <link href="../css/admin.css" rel="stylesheet" type="text/css"/>
    <link href="../css/clearfix.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../JavaScript/main.js"></script>
    <script type="text/javascript" src="../JavaScript/request.js"></script>
    <script type="text/javascript" src="../JavaScript/sha1.js"></script>
    <script type="text/javascript" src="../JavaScript/admin.js"></script>
    <script>
        window.onload=admin_onload;
    </script>
    <title>
        Faraway的个人博客-管理员界面
    </title>
</head>
<body>
<header class="normal">
    <div class="search-box">
        <form>
            <label for="search-for"></label>
            <input id="search-for" type="text"/><button><span class="icon-font"></span></button>
        </form>
    </div>
</header>
<div class="admin-main">
    <div class="admin-left">
        <div>
            <a onclick="slide_to(1);" id="tab-a-1" class="left-a ">博主信息</a>
            <a onclick="slide_to(2);" id="tab-a-2" class="left-a">用户管理</a>
            <a onclick="slide_to(3);" id="tab-a-3" class="left-a current">博文管理</a>
            <a onclick="window.location='../Editor.php';" class="left-a">新建博文</a>
        </div>
    </div>
    <div class="admin-main-box">
        <div id="tab-1">
            <h1>博主信息</h1>
            <div>
                <form name="uploadForm" class="uploadForm" action="admin.php?opt=file" method= "post" enctype ="multipart/form-data">
                    <!--<label>博主姓名<input class="writer" type="text" name="writer"></label>
                    <label>博主签名<input class="motto" type="text" name="motto"></label>
                    <label>主页 ID<input class="mean_id" type="text" name="mean_id"></label>-->
                    <img class="avatar" src="../upload/avatar"/>
                    <label>博主头像<input class="avatar" type="file" name="avatar"></label>
                    <input type="button" onclick="upload_avatar();" value="提交"/>
                </form>
            </div>
        </div>
        <div id="tab-2">
            <h1>用户管理</h1>
        </div>
        <div id="tab-3" class="current">
            <h1>博文管理</h1>
            <div>
                <ul class="articles-ul">
                    <li class="articles-list header">
                        <span class="articles-list-n">编号</span>
                        <span class="articles-list-id">id</span>
                        <span class="articles-list-title">标题</span>
                        <span class="articles-list-desp">描述</span>
                        <span>删除</span>
                        <span>编辑</span>
                    </li>

                    <li class="articles-list hidden">
                        <span class="articles-list-n">{{n}}</span>
                        <span class="articles-list-id">{{id}}</span>
                        <span class="articles-list-title">{{title}}</span>
                        <span class="articles-list-desp">{{desp}}</span>
                        <span><a href="javascript:delete_article({{id}});">删除博文</a></span>
                        <span><a href="../Editor.php?id={{id}}">编辑博文</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>




</div>
</body>
</html>


