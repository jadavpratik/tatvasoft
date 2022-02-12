<?php

namespace core;

require_once __DIR__.'/PHPMailer/PHPMailer.php';
require_once __DIR__.'/PHPMailer/SMTP.php';
require_once __DIR__.'/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail{

    public static function send($recipient, $subject, $body){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // SMTP::DEBUG_SERVER
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = SMTP_HOST;                              //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_ADDRESS;                          //SMTP username
            $mail->Password   = EMAIL_PASSWORD;                         //SMTP password
            $mail->SMTPSecure = 'tls';                                  //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_ADDRESS, 'Helperland');
            $mail->addAddress($recipient);                              //Add a recipient
            // $mail->addAddress('ellen@example.com');                        //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');                 //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');            //Optional name

            //Content
            $mail->isHTML(true);                                             //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            return true;
            // echo 'Message has been sent successfully.';
        }
        catch (Exception $e) {
            return false;
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

