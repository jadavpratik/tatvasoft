<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Validation;
use core\File;
use core\Mail;

use app\models\Contact as ContactModel;

class Contact{

    // ----------CONTACT SUBMIT----------
    public function submit(Request $req, Response $res){
        Validation::check($req->body, [
            'firstname' => ['text', 'min:3', 'max:10'],
            'lastname' => ['text', 'min:3', 'max:10'],
            'phone' => ['phone', 'length:10'],
            'email' => ['email'],
            'message' => ['text'],
            'subject' => ['text'],
        ]);
        // SAVE A UPLOADED FILE PATH...
        $filePath = null;
        if(isset($req->files->attachment)){
            if($req->files->attachment['error']==0){
                $filePath = File::upload($req->files->attachment, 'contact/');
            }	
        }
        $contact = new ContactModel();
        $contact->create([
            'Name' => $req->body->firstname.' '.$req->body->lastname,
            'Email' => $req->body->email,
            'PhoneNumber' => $req->body->phone,
            'Subject' => $req->body->subject,
            'Message' => $req->body->message,
            'UploadFileName' => $filePath,
            'CreatedOn' => date('Y-m-d H:i:s')
        ]);    
        $res->status(200)->json(['message'=>"Form submitted successfully."]);
        // $emailBody = $req->body->message;
        // $emailSubject = $req->body->subject;
        // $recipient = 'ADMIN EMAIL ADDRESS';
        // if(Mail::send($recipient, $emailSubject, $emailBody)){
        // 	$res->status(200)->json(['message'=>"Form Submitted Successfully."]);
        // }
    }    
}