<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-4
 * Time: 下午11:36
 */


include("MySQL.config.php");
switch ($_GET["req"]){
    case "addArticle":
        $time=time();
        $SQL = "INSERT INTO `dfakvRTwBRhPbzbToIUz`.`articles` (
        `id`,
        `writer`,
        `type`,
        `reply_to`,
        `sub_articles`,
        `like`,
        `value`,
        `create_date`,
        `change_date`
        )VALUES(
        NULL, 
        'Faraway',
        '0',
        '0',
        '',
        '0',
        'hbhvbehfcbhevcbjehdcbedfvgbedchcbfvdcgechbed',
        CURRENT_TIMESTAMP, 
        UNIX_TIMESTAMP()
        );";
        header("Content-Type:application/json;charset=UTF-8");
        if(mysql_query($SQL)){
            echo(json_encode(["result"=>"success"]));
        }else{
            echo(json_encode(["result"=>"failed","error"=>mysql_error()]));
        }
        break;



    default:




        break;
}