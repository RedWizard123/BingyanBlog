<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-4
 * Time: 下午11:41
 */
/*
$host="sqld.duapp.com:4050";
$AK="7d4383b2f5454519b051bc52ea3253fc";
$SK="9838ffbe0ea34e3c9afc5e7200b145e2";
//$db_name="kxvvFqSopwFJKrIMEjPT";
$db_name="dfakvRTwBRhPbzbToIUz";
$conn= mysql_connect($host,$AK,$SK);
*/
$host="localhost";
$AK="root";
$SK="hzylovelyl";
$db_name="blog";
$mysql=new mysqli();
$mysql->connect($host,$AK,$SK,$db_name);
?>






