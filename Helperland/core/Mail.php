<?php

namespace core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail{

    public static function send($recipient, $subject, $body){

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_ADDRESS;
            $mail->Password   = EMAIL_PASSWORD;
            $mail->SMTPSecure = 'tls';                         
            $mail->Port       = 587;                                  
            $mail->addAddress($recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
            return true;
        }
        catch (Exception $e) {
            return false;
        }

    }

}

