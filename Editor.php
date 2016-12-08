<?php
include("php/MySQL.config.php");
include("php/Function.php");
if(!checkCookie()){
    header("location:admin/");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <link href="css/clearfix.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/simditor.css" />
    <script type="text/javascript" src="JavaScript/main.js"></script>
    <script type="text/javascript" src="JavaScript/jquery.min.js"></script>
    <script type="text/javascript" src="JavaScript/module.js"></script>
    <script type="text/javascript" src="JavaScript/hotkeys.js"></script>
    <script type="text/javascript" src="JavaScript/uploader.js"></script>
    <script type="text/javascript" src="JavaScript/simditor.js"></script>
    <script type="text/javascript" src="JavaScript/request.js"></script>
    <script>var id=<?php echo(isset($_GET["id"])?$_GET["id"]:-1);?>;</script>
    <script type="text/javascript" src="JavaScript/Editor.js"></script>

    <title>
        Faraway的个人博客
    </title>
</head>
<body>
<header class="normal Editor">
    <div class="search-box">
        <form>
            <label for="search-for"></label>
            <input id="search-for" type="text"/><button><span class="icon-font"></span></button>
        </form>
    </div>
</header>
<div class="body clearfix Editor" >
    <div class="main Editor">
        <div class="Editor-title">
            <h1>新建博文</h1>
        </div>
        <div class="article-info">
            <div class="img-upload">
                <img src="upload/title5.jpg">
                <div class="float-button">
                    <form id="uploadForm" name="uploadForm" action="php/putData.php?req=uploadAvatar" method= "post" enctype ="multipart/form-data">
                    <input class="file-select" type="file" name="avatar"/><input class="file-select" type="button" value="上传"/>
                    </form>
                </div>
                <div class="mask"></div>
            </div>
            <div class="title-input">
                <input placeholder="在此处写入标题"/>
                <textarea placeholder="在此处写入文章的描述"></textarea>
            </div>
        </div>
        <div class="textarea-con">
            <textarea id="editor" autofocus placeholder="输入正文，您可以使用标记框内的标题，但是若您设置了标题，将会使用您设置的标题"></textarea>
        </div>
        <button id="save-change">保存更改</button>
        <button id="commit-article">提交文章</button>
    </div>
</div>



</body>
</html>