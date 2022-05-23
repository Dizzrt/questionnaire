<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

function send_mail($_u,$_l,$_e){
    $mail = new PHPMailer(true);                           
try {
    $mail->CharSet ="UTF-8";                     
    $mail->SMTPDebug = 0;                        
    $mail->isSMTP();                             
    $mail->Host = 'smtp.qq.com';                
    $mail->SMTPAuth = true;                      
    $mail->Username = 'dizzrtshi@qq.com';        
    $mail->Password = 'zbmyxhfouwvcijfj';        
    $mail->SMTPSecure = 'ssl';                   
    $mail->Port = 465;                           
    $mail->setFrom('dizzrtshi@qq.com', 'Dizzrt');

    $mail->addAddress($_e, $_u); 

    $mail->isHTML(true);                                
    $mail->Subject = '问卷星系统';
    $mail->Body    = '
    <!DOCTYPE html>
    <html lang="zh-cn">
    
    <head>
      <meta charset="utf-8">
      <title>问卷星系统</title>
    </head>
    
    <body>
      <h1 style="width: 300px; top: 61.8px; margin-left: auto; margin-right: auto; text-align: center;">
        感谢注册问卷星系统</h1>
      <a id="Btn" target="_self" href="http://127.0.0.1/active.html?link='.$_l.'">
        <p
          style="width: 100px; top: 61.8px; margin-left: auto; margin-right: auto; text-align: center; color: #dc6c7a; background-color: #2d3035;">
          点我激活</p>
      </a>
    </body>
    
    </html>';

    // echo $mail->Body;
    $mail->AltBody = '点此链接激活：127.0.0.1/active.html?link='.$_l;

    $mail->send();
    return 0;
} catch (Exception $e) {
    return 1;
}

}
?>