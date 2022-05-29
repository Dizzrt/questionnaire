<?php

include_once "sql.php";

$qtableID=$_GET["queID"];

$con=getCon();
$sql='select title,des from qtables where qtableID="'.$qtableID.'";';
$res=$con->query($sql);

$ret=array();
if($res->num_rows>0){
    $res=$res->fetch_assoc();
    $ret["title"]=$res["title"];
    $ret["des"]=$res["des"];
}
else{
    echo "error";
    return;
}

$sql='select queID,queType,queDes from ques where qtableID="'.$qtableID.'";';
$res=$con->query($sql);

$arr=array();
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $temp=array("queID"=>$row["queID"],"queType"=>$row["queType"],"queDes"=>$row["queDes"]);
        $arr[]=$temp;
    }
}

$ret["ques"]=$arr;
echo json_encode($ret);
return;
?>