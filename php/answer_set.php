<?php 

include_once "sql.php";

$form=$_GET["form"];
$form=json_decode($form,true);

$eqCnt=$form["eqCnt"];
$cqCnt=$form["cqCnt"];

$eqs=$form["eqs"];
$cqs=$form["cqs"];

$con=getCon();
for($i=0;$i<$eqCnt;$i++){
    $id=$eqs[$i]["id"];
    $res=$eqs[$i]["res"];

    $sql='insert into eqans (queID,ans) values ("'.$id.'","'.$res.'");';
    if ($con->query($sql) == FALSE) {
        echo "error";
        return;
    }
}

for($i=0;$i<$cqCnt;$i++){
    $id=$cqs[$i]["id"];
    $op=$cqs[$i]["op"];

    $sql='update cqans set cnt=cnt+1 where queID="'.$id.'" and ops="'.$op.'";';
    if ($con->query($sql) == FALSE) {
        echo "error";
        return;
    }
}

$sql='update qtables set answerCount=answerCount+1 where qtableID="'.$form["qtableID"].'";';
if ($con->query($sql) == FALSE) {
    echo "error";
    return;
}

echo "ok";

?>