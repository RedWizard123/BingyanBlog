<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-5
 * Time: 下午11:51
 */


function checkCookie(){
    global $mysql;
    if(isset($_COOKIE["username"])&&isset($_COOKIE["key"])){
        $SQL = "SELECT * FROM `blog_user` WHERE SHA1(CONCAT(SHA1('{$_COOKIE["username"]}'),`sha1_password`))='{$_COOKIE["key"]}';";
        $r=$mysql->query($SQL);
        $n = $r->num_rows;
        if($n>=1){
            return(true);
        }else{
            return(false);
        }
    }else{
        return(false);
    }
}
function delete_tags($str){
    return(preg_replace("/<.*?>/","",$str));
}

function delete_comma($str){
    if(substr($str,0,1)==","){
        return(substr($str,1));
    }else{
        return($str);
    }
}



