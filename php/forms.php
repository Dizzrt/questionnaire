<?php

include_once "sql.php";

$uid=$_GET["uid"];

$con=getCon();

$sql='select qtableID,title,des,answerCount from qtables where uid="'.$uid.'";';
$res=$con->query($sql);

$rarr=array();
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $temp=array("qtableID"=>$row["qtableID"],"title"=>$row["title"],"des"=>$row["des"],"ansCount"=>$row["answerCount"]);
        $rarr[]=$temp;
    }
}

echo json_encode($rarr);
return;
?>