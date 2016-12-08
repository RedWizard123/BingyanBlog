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
            <a class="left-a current">博主信息</a>
            <a class="left-a">用户管理</a>
            <a class="left-a">博文管理</a>
            <a class="left-a">新建博文</a>
        </div>
    </div>
    <div class="admin-main-box">
        <div class="tab-1">




        </div>
        <div class="tab-1"></div>
        <div class="tab-1"></div>
        <div class="tab-1"></div>

    </div>




</div>
</body>
</html>


