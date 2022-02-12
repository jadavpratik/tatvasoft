<?php

use core\Route;
// use core\Mail;
// PROFILE-ACCOUNT CONTROLLER...
use app\controllers\profile\Account;

Route::get('/my-setting', [new Account(), 'logout']);
Route::get('/logout', [new Account(), 'logout']);

Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);
Route::post('/forgot-password', [new Account(), 'forgot_password']);
Route::post('/check-otp', [new Account(), 'check_otp']);
Route::post('/set-new-password', [new Account(), 'set_new_password']);


// class TestMail{
//     public function test(){
//         $subject = 'Test';
//         $body = 'Hi Buddy';
//         $mail_res = Mail::send('pratikjadav29@gmail.com', $subject, $body);
//         if($mail_res==true){
//             echo 'true';
//         }
//         else{
//             echo 'false';
//         }
//     }
// }

// Route::get('/test-mail', [new TestMail(), 'test']);
