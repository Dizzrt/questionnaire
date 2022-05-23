<?php

include_once "sql.php";

$uid=$_GET["uid"];
$title=$_GET["title"];
$des=$_GET["des"];

$eqCnt=$_GET["eqCnt"];
$cqCnt=$_GET["cqCnt"];

$eqs=array();

for($i=0;$i<$eqCnt;$i++){
    $eqs[$i]=$_GET["eq".$i];
}

$cqs=array();
for($i=0;$i<$cqCnt;$i++){
    $que=array();
    $que_des=$_GET["cq".$i];
    $que_op=array();

    $opCnt=$_GET["cq".$i."_opCnt"];
    $que_op["opCnt"]=$opCnt;
    for($j=0;$j<$opCnt;$j++){
        $que_op["op".$j]=$_GET["cq".$i."_op".$j];
    }

    $que["des"]=$que_des;
    $que["ops"]=$que_op;

    $cqs[$i]=$que;
}

$con=getCon();
$qtableID=time();

$sql='insert into qtables (qtableID,uid,title,des) values ("'.$qtableID.'","'.$uid.'","'.$title.'","'.$des.'");';
if ($con->query($sql) == FALSE) {
    echo "error";
    return;
}

//queType 0 => 问答题
//queType 1 => 单选题
$queID=$qtableID-1;

foreach($eqs as $key=>$val){
    $t=json_encode(array("des:"=>$val));
    $sql='insert into ques (queID,qtableID,queType,queDes) values ("'.$queID.'","'.$qtableID.'","0",\''.$t.'\');';
    $queID-=1;
    
    if ($con->query($sql) == FALSE) {
        echo "error";
        return;
    }
}

foreach($cqs as $key=>$val){
    $t=json_encode($val);
    $sql='insert into ques (queID,qtableID,queType,queDes) values ("'.$queID.'","'.$qtableID.'","1",\''.$t.'\');';
    $queID-=1;

    if ($con->query($sql) == FALSE) {
        echo "error";
        return;
    }
}

echo $qtableID;
?>