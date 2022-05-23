<?php
include_once 'sql.php';

$usr=$_GET["usr"];
$pwd=md5($_GET["pwd"]);

$con = getCon();
if($con==null){
    echo "error";
}

$sql='select * from usr_login where usrname ="'.$usr.'";';
$res= $con->query($sql);

if($res->num_rows>0){
    $res=$res->fetch_assoc();
    if($res["active"]==0){
        echo "none";
        return;
    }
    else if($res["pwd"]!=$pwd){
        echo "wpwd"; //wrong pwd
        return;
    }
    
    $res=array("uid"=>$res["uid"],"usrname"=>$res["usrname"],"email"=>$res["email"]);
    echo json_encode($res);
}
else {
    echo "none";
}

$con->close();
?>