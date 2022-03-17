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
            // $mail->SMTPDebug  = 1; // FOR SHOWING THE ERRORS
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_ADDRESS;
            $mail->Password   = EMAIL_PASSWORD;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port       = EMAIL_PORT;
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

