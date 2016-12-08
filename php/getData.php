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
switch ($_GET["req"]){
    case "articleList":
        $SQL = "SELECT * FROM `articles` WHERE `type`=0 ORDER BY `articles`.`id` DESC";
        $r = $mysql->query($SQL);
        $data=[];
        while($row=$r->fetch_object()){
            $value=urldecode($row->value);
            $obj=[
                "id"=>$row->id,
                "writer"=>$row->writer,
                "sub_articles"=>delete_comma($row->sub_articles),
                "like"=>delete_comma($row->like),
                "value"=>urldecode($row->value),
                "title"=>$row->title,
                "desp"=>$row->desp,
                "pic"=>$row->pic,
                "create_date"=>$row->create_date
            ];
            $data[]=$obj;
        }
        $res=[
            "result"=>"success",
            "data"=>$data
        ];
        echo(json_encode($res));
        break;
    case "articleListAll":
        $SQL = "SELECT * FROM `articles`";
        $r = $mysql->query($SQL);
        $data=[];
        while($row=$r->fetch_object()){
            $value=urldecode($row->value);
            $obj=[
                "id"=>$row->id,
                "writer"=>$row->writer,
                "sub_articles"=>delete_comma($row->sub_articles),
                "like"=>delete_comma($row->like),
                "value"=>urldecode($row->value),
                "title"=>$row->title,
                "desp"=>$row->desp,
                "pic"=>$row->pic,
                "type"=>$row->type,
                "create_date"=>$row->create_date
            ];
            $data[]=$obj;
        }
        $res=[
            "result"=>"success",
            "data"=>$data
        ];
        echo(json_encode($res));
        break;
    case "getValue":
        $SQL = "SELECT * FROM `articles` WHERE `id`={$_GET["id"]};";
        $r = $mysql->query($SQL);
        if($r->num_rows==0){
            die(json_encode(["result"=>"failed","error"=>"No Article Selected!"]));
        }else{
            $row=$r->fetch_object();
            $row->value=urldecode($row->value);
            $row->like=delete_comma($row->like);
            $row->sub_articles=delete_comma($row->sub_articles);

            echo(json_encode(["result"=>"success","data"=>$row]));
        }
        break;
    case "getComments":
        if(isset($_GET["id"])){
            $SQL="SELECT * FROM `articles` WHERE `id`={$_GET["id"]} AND `type`=0;";
            $r=$mysql->query($SQL);
            $row=$r->fetch_object();
            $comments=delete_comma($row->sub_articles);
            $SQL="SELECT * FROM `articles` WHERE `id` in({$comments}) AND `type`=1;";
            $r=$mysql->query($SQL);
            $data=[];
            while($row=$r->fetch_object()){
                $row->writer=urldecode($row->writer);
                $row->value=urldecode($row->value);
                $data[]=$row;
            }
            echo(json_encode(["result"=>"success","data"=>$data]));
        }else{
            die(json_encode(["result"=>"failed","error"=>"No Article Selected!"]));
        }
        break;
    default:




        break;
};
