// CONTACT, SIGNUP & PROFILE....
import { firstname_validation, lastname_validation, 
         phone_validation, email_validation,
         message_validation, subject_validation, language_validation,
         password_validation, cpassword_validation } from './validation/profile.js';

//  CHANGE PASSWORD...
import { change_password_old_validation, 
        change_password_new_validation, 
        change_password_confirm_validation } from './validation/change_password.js';
        
// BOOK SERVICE...
import{ setup_service_postal_code_validation,
        schedule_date_validation, schedule_time_validation,
        address_form_street_name_validation,
        address_form_house_number_validation,
        address_form_postal_code_validation,
        address_form_city_validation,
        address_form_phone_validation,
        book_service_address_validation } from './validation/book_service.js';

// LOGIN...
import { login_email_validation, 
         login_password_validation } from './validation/login.js';        

// FORGOT PASSWORD...
import { forgot_password_email_validation } from './validation/forgot_password.js';

// OTP VALIDATON...
import { otp_validation } from './validation/otp.js';
         
// SET NEW PASSWORD...
import { set_new_cpassword_validation, 
         set_new_password_validation } from './validation/set_new_password.js';        

// DATE...
import { today } from './validation/date.js';         

// -------------------CONTACTUS, SIGNUP, PROFILE---------------------
$('[name="firstname"]').focusout(function(){
    firstname_validation();    
});

$('[name="lastname"]').focusout(function(){
    lastname_validation();
});

$('[name="phone"]').focusout(function(){
    phone_validation();
});

$('[name="email"]').focusout(function(){
    email_validation();
});

$('[name="password"]').focusout(function(){
    password_validation();
});

$('[name="cpassword"]').focusout(function(){
    cpassword_validation();
});

// --------------CONTACT-US-----------------
$('[name="message"]').focusout(function(){
    message_validation();
});

$('[name="subject"]').focusout(function(){
    subject_validation();
});    

$('[name="language"]').focusout(function(){
    language_validation();
});    

// -----------------LOGIN------------------------
$('[name="login_email"]').focusout(function(){
    login_email_validation();
});

$('[name="login_password"]').focusout(function(){
    login_password_validation();
});

// ----------------CHANGE-PASSWORD-----------------
$('[name="change_password_old"]').focusout(function(){
    change_password_old_validation();
});

$('[name="change_password_new"]').focusout(function(){
    change_password_new_validation();
});

$('[name="change_password_confirm"]').focusout(function(){
    change_password_confirm_validation();
});

// -----------------FORGOT-PASSWORD----------------------
$('[name="forgot_password_email"]').focusout(function(){
    forgot_password_email_validation();
});

$('[name="otp"]').focusout(function(){
    otp_validation();
});        

$('[name="set_new_password"]').focusout(function(){
    set_new_password_validation();
});

$('[name="set_new_cpassword"]').focusout(function(){
    set_new_cpassword_validation();
});

// ----------------------BOOK-SERVICE-S1-VALIDATION----------------------
$('[name="setup_service_postal_code"]').focusout(function(){
    setup_service_postal_code_validation();
});

// ----------------------BOOK-SERVICE-S2-VALIDATION----------------------
// DATE VALIDATION...
$('[name="schedule_date"]').attr('min',today);

$('[name="schedule_date"]').change(function(){
    schedule_date_validation();
});

$('[name="schedule_time"]').change(function(){
    schedule_time_validation();
});

// ----------------------BOOK-SERVICE-S3-VALIDATION----------------------
$('[name="address_form_street_name"]').focusout(function(){
    address_form_street_name_validation();
});

$('[name="address_form_house_number"]').focusout(function(){
    address_form_house_number_validation();
});

$('[name="address_form_postal_code"]').focusout(function(){
    address_form_postal_code_validation();
});

$('[name="address_form_city"]').focusout(function(){
    address_form_city_validation();
});

$('[name="address_form_phone"]').focusout(function(){
    address_form_phone_validation();
});
