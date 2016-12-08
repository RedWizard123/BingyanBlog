<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-6
 * Time: 下午4:08
 */



include("../php/MySQL.config.php");
include("../php/Function.php");
if(!checkCookie()){
    header("location:../admin/");
}else{
    if(isset($_POST["code"])){
        $SQL=$_POST["code"];
        $r=$mysql->query($SQL);
        if($r){
            $out=[];
            while($row=$r->fetch_object()){
                $out[]=$row;
            }
            header("Content-Type:application/json;charset=UTF-8");
            echo(json_encode($out));
            exit();
        }else{
            die("Error:".$mysql->error);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SQL Terminal</title>
</head>
<body>
    <form action="SQL.php" method="post">
        <textarea name="code" placeholder="SQL Here"></textarea><br>
        <button>Submit</button>
    </form>


</body>

</html>

