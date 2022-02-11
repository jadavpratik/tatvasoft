<?php

use core\Route;
use core\Mail;
// PROFILE-ACCOUNT CONTROLLER...
use app\controllers\profile\Account;

Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);
Route::post('/forgot-password', [new Account(), 'forgot_password']);
Route::post('/check-otp', [new Account(), 'check_otp']);
Route::post('/set-new-password', [new Account(), 'set_new_password']);


class TestMail{
    public function test(){
        $mail = new Mail();
        $mail->send();
    }
}

Route::get('/test-mail', [new TestMail(), 'test']);
