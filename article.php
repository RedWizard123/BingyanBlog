<?php
include("php/MySQL.config.php");
include("php/Function.php");
$SQL="SELECT * FROM `blog_user`";
$r=$mysql->query($SQL);
$row=$r->fetch_object();

?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <link href="css/clearfix.css" rel="stylesheet" type="text/css"/>
    <script src="JavaScript/main.js"></script>
    <script src="JavaScript/request.js"></script>
    <script src="JavaScript/articles.js"></script>
    <title>
        <?php echo($row->name);?>的个人博客
    </title>
</head>
<body>
<header class="normal">
    <div class="search-box">
        <form>
            <label for="search-for"></label>
            <input id="search-for" type="text" PLACEHOLDER="搜索"/><button><span class="icon-font"></span></button>
        </form>
    </div>
</header>
<div class="body clearfix" >
    <div class="left" id="particles-js">
        <div class="left-avatar">
            <img src="images/avatar.png"/>
        </div>
        <p class="left-name"><?php echo($row->name);?></p><br>
        <p class="left-motto"><?php echo($row->motto);?></p>
        <a href="index.php" class="left-links">首页</a>
        <a href="#" class="left-links">随笔</a>
        <a href="#" class="left-links current">文章</a>
        <a href="#" class="left-links">关于</a>
    </div>
    <div class="main article" style="padding:60px 60px 60px 360px;">

        <a class="main-articles-a standard" href="index.php?id=0">
            <img src="upload/{{imgURL}}" />
            <div class="articles-desc">
                <p>{{title}}</p>
                <p>{{articles-desc}}</p>

            </div>
            <div class="author-info">
                <span class="author-name">{{name}}</span>
                <span class="complete-date">{{date}}</span>
                <span class="like"><span class="icon-font"> {{num1}}</span><span class="icon-font"> {{num2}}</span></span>
            </div>
        </a>

    </div>
</div>
</body>
</html>