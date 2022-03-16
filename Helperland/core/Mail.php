<?php

namespace core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use core\Response;

class Mail{

    public static function send($recipient, $subject, $body){

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug  = 1; // FOR SHOWING THE ERRORS
            $mail->Host       = 'smtp.mail.yahoo.com'; //SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = 'typeee29@yahoo.com';//EMAIL_ADDRESS;
            $mail->Password   = '';//EMAIL_PASSWORD;
            $mail->SMTPSecure = 'tls';      // 'ssl' 'tls'; // FOR GMAIL...                        
            $mail->Port       = 465; //EMAIL_PORT;                                  
            $mail->addAddress($recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
            // return true;
        }
        catch (Exception $e) {
            echo '<pre>';
            print_r($e);
            // return false;
        }

    }

}

