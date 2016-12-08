<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-4
 * Time: 下午11:36
 */
include("MySQL.config.php");
include("Function.php");
header("Content-Type:application/json;charset=UTF-8");
if(!isset($_GET["req"])){
    die(json_encode(["result"=>"failed","error"=>"No req data!"]));
}
switch ($_GET["req"]){
    case "addArticle":
        if(isset($_POST["writer"])&&isset($_POST["value"])){
            if(!checkCookie()){
                die(json_encode(["result"=>"failed","error"=>"Permission Denied!"]));
            }
            //$time=time();
            $value=$_POST["value"];
            if($_POST["title"]==""){
                preg_match("/<h1>(.+)<\/h1>/",$value,$title);
                if(count($title)<1){
                    $title=["未标题","未标题"];
                    $value="<h1>未标题</h1>".$value;
                }
            }else{
                $title=["",$_POST["title"]];
            }
            if($_POST["desp"]==""){
                preg_match("/<p.*?>(.+)<\/p>/",$value,$desp);
                if(count($desp)<1){
                    $desp=["暂无描述","暂无描述"];
                }
            }else{
                $desp=["",$_POST["desp"]];
            }
            if($_POST["pic"]==""){
                $_POST["pic"]="577705b7c057e2b0f961e160137b944fe5bf29e8";
            }
            $value=urlencode($value);
            $title[1]=delete_tags($title[1]);
            $desp[1]=delete_tags($desp[1]);
            $SQL = "INSERT INTO `{$db_name}`.`articles` (
            `id`,
            `writer`,
            `type`,
            `reply_to`,
            `sub_articles`,
            `like`,
            `value`,
            `title`,
            `desp`,
            `pic`,
            `create_date`,
            `change_date`
            )VALUES(
            NULL, 
            '{$_POST["writer"]}',
            '0',
            '0',
            '',
            '',
            '{$value}',
            '{$title[1]}',
            '{$desp[1]}',
            '{$_POST["pic"]}',
            NULL, 
            CURRENT_TIMESTAMP
            );";
            if($mysql->query($SQL)){
                $SQL="SELECT * FROM `articles` ORDER BY `articles`.`id` DESC;";
                $r=$mysql->query($SQL);
                $row=$r->fetch_object();
                echo(json_encode(["result"=>"success","id"=>$row->id]));
            }else{
                echo(json_encode(["result"=>"failed","error"=>$mysql->error]));
            }
        }else{
            echo(json_encode(["result"=>"failed","error"=>"No Post data!"]));
        }
        break;
    case "updateArticle":
        if(isset($_POST["id"])&&isset($_POST["value"])){
            if(!checkCookie()){
                die(json_encode(["result"=>"failed","error"=>"Permission Denied!"]));
            }
            $value=urlencode($_POST["value"]);
            $SQL = "UPDATE `{$db_name}`.`articles` SET 
            `value` = '{$value}',
            `title` = '{$_POST["title"]}',
            `desp` = '{$_POST["desp"]}',
            `pic` = '{$_POST["pic"]}'
            WHERE `articles`.`id` ={$_POST["id"]};
            ";
            if($mysql->query($SQL)){
                echo(json_encode(["result"=>"success"]));
            }else{
                echo(json_encode(["result"=>"failed","error"=>$mysql->error]));
            }
        }else{
            echo(json_encode(["result"=>"failed","error"=>"No Post data!"]));
        }
        break;
    case "uploadAvatar":
        if(isset($_FILES["avatar"])&&isset($_FILES["avatar"]["type"])){
            if((($_FILES["avatar"]["type"] == "image/gif") || ($_FILES["avatar"]["type"] == "image/jpeg") || ($_FILES["avatar"]["type"] == "image/jpg") || ($_FILES["avatar"]["type"] == "image/pjpeg") || ($_FILES["avatar"]["type"] == "image/x-png") || ($_FILES["avatar"]["type"] == "image/png")) && ($_FILES["avatar"]["size"] < 2048000)){
                move_uploaded_file($_FILES["avatar"]["tmp_name"], "../upload/".sha1(time()));
                echo(json_encode(["result"=>"success","URL"=>sha1(time())]));
            }else{
                echo(json_encode(["result"=>"failed","error"=>"Failed!"]));
            }
        }else{
            die(json_encode(["result"=>"failed","error"=>"No file data!"]));
        }
        break;
    case "login":
        if(isset($_POST["username"])&&isset($_POST["sha1_password"])){
            $SQL="SELECT * FROM `blog_user` WHERE `name`='{$_POST["username"]}' AND `sha1_password`='{$_POST["sha1_password"]}';";
            $r = $mysql->query($SQL);
            $n = $r->num_rows;
            if($n>=1){
                setcookie("username",$_POST["username"],time()+3600*15*24,"/");
                setcookie("key",sha1(sha1($_POST["username"]) . $_POST["sha1_password"]),time()+3600*15*24,"/");
                echo(json_encode(["result"=>"success"]));
            }else{
                echo(json_encode(["result"=>"failed","error"=>"No Matching User!"]));
            }
        }else{
            echo(json_encode(["result"=>"failed","error"=>"No Post data!"]));
        }








        break;
    case "likePlus":
        if(isset($_GET["id"])){
            $SQL="SELECT `like` FROM `articles` WHERE `id`={$_GET["id"]};";
            $r=$mysql->query($SQL);
            if($r->num_rows!=1){
                echo(json_encode(["result"=>"failed","error"=>"No Matching Article!"]));
            }else{
                $row=$r->fetch_object();
                $ips=explode(",",$row->like);
                if(array_search($_SERVER["HTTP_HOST"],$ips)){
                    echo(json_encode(["result"=>"failed","error"=>"Already Likes!"]));
                }else{
                    $SQL="UPDATE `articles` SET 
                    `like`=CONCAT(`like`,',{$_SERVER["HTTP_HOST"]}')
                    WHERE `id`={$_GET["id"]};";
                    $mysql->query($SQL);
                    echo(json_encode(["result"=>"success"/*,"likes_num"=>count($ips)+1*/]));
                }
            }
        }else{
            echo(json_encode(["result"=>"failed","error"=>"No ID data!"]));
        }
        break;
    case "addComment":
        if(isset($_POST['name'])&&isset($_POST["comment"])&&isset($_POST["id"])){
            $_POST["comment"]=urlencode($_POST["comment"]);
            $_POST["name"]=urlencode($_POST["name"]);
            $SQL="INSERT INTO `{$db_name}`.`articles` (
            `id`,
            `writer`,
            `type`,
            `reply_to`,
            `sub_articles`,
            `like`,
            `value`,
            `title`,
            `desp`,
            `pic`,
            `create_date`,
            `change_date`
            )VALUES(
                NULL,
                '{$_POST["name"]}',
                '1',
                '{$_POST["id"]}',
                '',
                '',
                '{$_POST["comment"]}',
                '',
                '',
                '',
                NULL,
                CURRENT_TIMESTAMP
            );";
            if($mysql->query($SQL)){
                $SQL="SELECT LAST_INSERT_ID() AS id";
                $r=$mysql->query($SQL);
                $row=$r->fetch_object();
                //echo(json_encode(["result"=>"success","id"=>$row->id]));
                $SQL="UPDATE `articles` SET 
                `sub_articles`=CONCAT(`sub_articles`,',{$row->id}')
                WHERE `id`={$_POST["id"]}";
                if($mysql->query($SQL)){
                    echo(json_encode(["result"=>"success","comments_num"=>$row->id]));
                }else{
                    echo(json_encode(["result"=>"failed","error"=>$mysql->error]));
                }
            }else{
                echo(json_encode(["result"=>"failed","error"=>$mysql->error]));
            }
        }else{
            echo(json_encode(["result"=>"failed","error"=>"No Post data!"]));
        }
        break;
    default:
        echo(json_encode(["result"=>"failed","error"=>"Unsolved request!"]));
        break;
}
?>