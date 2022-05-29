<?php

include_once "sql.php";

$qtbaleID=$_GET["id"];

$con=getCon();
$sql='select * from ques where qtableID="'.$qtbaleID.'";';

$ret=array();

$res=$con->query($sql);
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $temp=array();
        $temp["id"]=$row["queID"];
        $temp["des"]=$row["queDes"];
        $temp["type"]=$row["queType"];

        if($row["queType"]==0){
            $sql='select ans from eqans where queID="'.$row["queID"].'";';
            $ans=$con->query($sql);
            
            $tans=array();
            while($r=$ans->fetch_row()){
                $tans[]=$r[0];
            }

            $temp["ans"]=$tans;
        }
        else if($row["queType"]==1){
            $sql='select ops,cnt from cqans where queID="'.$row["queID"].'";';
            
            $ans=$con->query($sql);

            $tans=array();
            while($r=$ans->fetch_assoc()){
                $tans[$r["ops"]]=$r["cnt"];
            }
            
            $temp["ans"]=$tans;
        }

        $ret[]=$temp;
    }
}

echo json_encode($ret);

?>