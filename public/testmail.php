<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('SMTP', "alustatalo.com");
ini_set('smtp_port', "25");
ini_set('sendmail_from', "nishant.gupta@alustatalo.com");

// the message
$msg = "test";
 

// send email
if(mail("guptanishantmca@gmail.com","My subject",$msg)){
    echo 'ok';
}else{
    echo 'not';
}
?>