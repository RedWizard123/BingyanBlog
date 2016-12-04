<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-4
 * Time: 下午11:36
 */
include("MySQL.config.php");
switch ($_GET["req"]){
    case "articleList":
        $r = mysql_query($SQL,$conn);
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


















