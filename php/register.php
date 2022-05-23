<?php
include_once 'sql.php';
include_once 'mail.php';

$usr=$_GET["usr"];
$pwd=md5($_GET["pwd"]);
$email=$_GET["email"];

$con=getCon();
$sql='select * from usr_login where usrname="'.$usr.'";';
$res=$con->query($sql);

if($res->num_rows>0){
    $res=$res->fetch_assoc();
    if($res["active"]==0){
        if($res["pwd"]!=$pwd){
            $sql='update usr_login set pwd="'.$pwd.'" where usr="'.$usr.'";';
            $con->query($sql);
        }

        $sql='select link from activelink where usrname="'.$usr.'";';
        $link=$con->query($sql);

        if($link->num_rows>0){
            $link=($link->fetch_assoc())["link"];
            if(send_mail($usr,$link,$email)==0){
                $con->close();
                echo "ok";
                return;
            }
            else {
                $con->close();
                echo "error";
                return;
            }
        }
        else {
            $con->close();
            echo "error";
            return;
        }
    }
    else {
        $con->close();
        echo "exist";
        return;
    }
}
else{
    $sql='insert into usr_login(usrname,pwd,email) values ("'.$usr.'","'.$pwd.'","'.$email.'");';
    $con->query($sql);

    $mt=md5(time());
    $sql='insert into activelink (link,usrname) values ("'.$mt.'","'.$usr.'");';
    $con->query($sql);

    if(send_mail($usr,$mt,$email)==0)
        echo "ok";
    else echo "error";
}

$con->close();
?>