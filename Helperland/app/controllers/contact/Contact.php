<?php

namespace app\controllers\contact;

use core\Request;
use core\Response;
use core\Validation;
use core\File;
use core\Mail;

use app\models\Contact as ContactModel;

class Contact{

    public function submit(Request $req, Response $res){
        $validation = Validation::check($req->body, [
            'firstname' => ['text', 'min:3', 'max:10'],
            'lastname' => ['text', 'min:3', 'max:10'],
            'phone' => ['phone', 'length:10'],
            'email' => ['email'],
            'message' => ['text'],
            'subject' => ['text'],
        ]);
    
        if($validation==1){
    
            // SAVE A UPLOADED FILE PATH...
            $filePath = null;
            if(isset($req->files->attachment)){
                if($req->files->attachment['error']==0){
                    $filePath = File::upload($req->files->attachment, 'contact/');
                }	
            }
    
            $arr = array('Name' => $req->body->firstname.' '.$req->body->lastname,
                        'Email' => $req->body->email,
                        'PhoneNumber' => $req->body->phone,
                        'Subject' => $req->body->subject,
                        'Message' => $req->body->message,
                        'UploadFileName' => $filePath,
                        'CreatedOn' => timestamp());
    
            $contact = new ContactModel();
            if(!$contact->error){
                $result = $contact->create($arr);    
                if($result){
                    $res->status(200)->json(['message'=>"Form Submitted Successfully."]);
        
                    // $emailBody = $req->body->message;
                    // $emailSubject = $req->body->subject;
                    // $recipient = 'RECIPIENT EMAIL ADDRESS';
                    // if(Mail::send($recipient, $emailSubject, $emailBody)){
                    // 	$res->status(200)->json(['message'=>"Form Submitted Successfully."]);
                    // }
        
                }
                else{
                    $res->status(500)->json(['message'=>'Internal Server Error']);
                }	    
            }
            else{
                $res->status(500)->json(['message'=>'Database connection issue!']);
            }
        }
        else{
            $res->status(400)->json($validation);
        }
    }    
}