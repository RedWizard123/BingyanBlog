<?php
include("../php/MySQL.config.php");
include("../php/Function.php");
if(checkCookie()){
    header("location:admin.php");
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
        window.onload=index_onload;
    </script>
    <title>
        Faraway的个人博客
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
<div class="login-box">
    <form action="../../Blog/php/Data.php?req=login" method="post">
        <h1>Login</h1>
        <input type="text" placeholder="用户名" name="name" id="in1"/>
        <input type="password" placeholder="密码" name="password" id="in2"/>
        <input type="button" title="登录" placeholder="登录" value="登录" id="in3"/>
    </form>
</div>
</body>
</html>