<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/simditor.css" rel="stylesheet" type="text/css"/>
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <link href="css/clearfix.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="JavaScript/main.js"></script>
    <script type="text/javascript" src="JavaScript/request.js"></script>
    <script>var id=
            <?php
            include("php/MySQL.config.php");
            include("php/Function.php");
            $SQL="SELECT * FROM `blog_user`";
            $r=$mysql->query($SQL);
            $row=$r->fetch_object();

            if(!isset($_GET["id"])){
                $_mean_id=$row->mean_id;
            }else{
                $_mean_id =$_GET["id"];
            }
            echo($_mean_id);
            ?>;
    </script>
    <script>window.onload=_index_onload();</script>
    <title>
        <?php echo($row->name);?>的个人博客
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
<div class="body clearfix simditor" style="border: 0;">
    <div class="left" id="particles-js">
        <div class="left-avatar">
            <img src="upload/avatar"/>
        </div>
        <p class="left-name"><?php echo($row->name);?></p><br>
        <p class="left-motto"><?php echo($row->motto);?></p>
        <a href="#" class="left-links current">首页</a>
        <a href="#" class="left-links">随笔</a>
        <a href="article.php" class="left-links">文章</a>
        <a href="#" class="left-links">关于</a>
    </div>
    <div class="main simditor-body" style="padding:60px 60px 60px 360px;">
        <?php
        $SQL="SELECT * FROM `articles` WHERE `id`='{$_mean_id}' AND `type`=0;";
        $r=$mysql->query($SQL);
        if($r){
            $row=$r->fetch_object();
            echo("<h1 style='font-size:30px;font-weight: bold;'>".$row->title."</h1>");
            echo("<p style='color:#418CAF;'>创建时间：". $row->create_date ."</p>");
            echo("<p style='color:#418CAF;'>最后更正：". $row->change_date ."</p>");
            echo(urldecode($row->value));
        }
        ?>
    </div>
    <div class="comment">
        <div class="likes-and-comments">
            <div>
                <span class="icon-font"></span>
                <span id="comments-n">0</span>
            </div>
            <div>
                <span class="icon-font" onclick="like_plus();"></span>
                <span id="likes-n">0</span>
            </div>
        </div>
        <div class="comments-display">
            <h2>评论</h2>
            <div class="comments-items hidden">
                <p class="comments-name">{{comments-name}}<b>说：</b></p>
                <p class="comments-value">
                    {{comments-value}}
                </p>
                <div class="comments-info-opt">
                    <span class="comments-like">
                        <span class="icon-font"></span>
                        <span class="comments-like-num">{{like-num}}</span>
                    </span>
                    <span class="comments-date">{{comments-date}}</span>
                </div>
            </div>
            <div class="insert-to"></div>
        </div>
        <div class="input-comments">
            <h2>我要评论</h2>
            <input placeholder="输入姓名" type="text"/>
            <textarea placeholder="在此处键入评论"></textarea>
            <button onclick="add_comments();">提交评论</button>
        </div>
    </div>
</div>
</body>
</html>