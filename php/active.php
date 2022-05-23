<?php

include_once "sql.php";

$link=$_GET["link"];

$con=getCon();
$sql_0='select usrname from activelink where link="'.$link.'";';

$res=$con->query($sql_0);

if($res->num_rows>0){
    $res=($res->fetch_assoc())["usrname"];
    $sql_1='UPDATE usr_login SET active =1 WHERE usrname ="'.$res.'";';
    $res=$con->query($sql_1);
    echo "ok";
}
else echo "error";

$con->close();
?>