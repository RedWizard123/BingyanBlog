<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-4
 * Time: 下午11:36
 */
include("MySQL.config.php");
header("Content-Type:application/json;charset=UTF-8");
switch ($_GET["req"]){
    case "articleList":
        $SQL = "SELECT * FROM `articles` LIMIT 0, 30 ";
        $r = mysql_query($SQL,$conn);

        if($r==false){
            echo(json_encode(["result"=>"failed","error"=>mysql_error()]));
        }
        $data=[];
        while($row=mssql_fetch_row($r)){
            $data[]=$row;
        }
        $res=[
            "result"=>"success",
            "data"=>$data
        ];
        echo(json_encode($res));



        break;



    default:




        break;
}


















