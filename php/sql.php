<?php

function getCon(){
    $con=new mysqli("127.0.0.1","root","123456","questionnaire",3306);

    if($con->connect_error){
        die("连接失败".$con->connect_error);
    }

    return $con;
}

?>