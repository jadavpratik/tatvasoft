import {TextRegEx, PhoneRegEx, EmailRegEx, PasswordRegEx} from './regex.js';

// ------------------------FIRST-NAME-VALIDATION--------------------
function firstname_validation(){
    const input_value = $('[name="firstname"]').val();
    if(input_value==''){
        $('[name="firstname"]').next().removeClass('d_none').children().html('Please Enter First Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="firstname"]').next().removeClass('d_none').children().html('Numbers Not Allowed !');
        return false;
    }
    else{
        $('[name="firstname"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------LAST-NAME-VALIDATION--------------------
function lastname_validation(){
    const input_value = $('[name="lastname"]').val();
    if(input_value==''){
        $('[name="lastname"]').next().removeClass('d_none').children().html('Please Enter Last Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="lastname"]').next().removeClass('d_none').children().html('Numbers Not Allowed !');
        return false;
    }
    else{
        $('[name="lastname"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------PHONE-NUMBER-VALIDATION--------------------
function phone_validation(){
    const input_value = $('[name="phone"]').val();
    if(input_value==''){
        $('[name="phone"]').parent().next().removeClass('d_none').children().html('Please Enter Phone Number !');
        return false;
    }
    else if(PhoneRegEx.test(input_value)==false){
        $('[name="phone"]').parent().next().removeClass('d_none').children().html('Enter a Valid Phone Number !');
        return false;
    }
    else{
        $('[name="phone"]').parent().next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------EMAIL-ADDRESS-VALIDATION--------------------
function email_validation(){
    const input_value = $('[name="email"]').val();
    if(input_value==""){
        $('[name="email"]').next().removeClass('d_none').children().html('Please Enter Email Address !');
        return false;
    }
    else if(EmailRegEx.test(input_value)==false){        
        $('[name="email"]').next().removeClass('d_none').children().html('Enter a Valid Email Address !');
        return false;
    }
    else{
        $('[name="email"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------MESSAGE-VALIDATON--------------------
function message_validation(){
    const input_value = $('[name="message"]').val();
    if(input_value==''){
        $('[name="message"]').next().removeClass('d_none').children().html('Please Enter Message !');
        return false;
    }
    else{
        $('[name="message"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------SUBJECT-VALIDATON--------------------
function subject_validation(){
    const input_value = $('[name="subject"]').val();
    if(input_value==''){
        $('[name="subject"]').next().removeClass('d_none').children().html('Please Select a Subject !');
        return false;
    }
    else{
        $('[name="subject"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------SUBJECT-VALIDATON--------------------
function language_validation(){
    const input_value = $('[name="language"]').val();
    if(input_value==''){
        $('[name="language"]').next().removeClass('d_none').children().html('Please Select a language !');
        return false;
    }
    else{
        $('[name="language"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------PASSWORD-VALIDATON--------------------
function password_validation(){
    const input_value = $('[name="password"]').val();
    if(input_value==''){
        $('[name="password"]').next().removeClass('d_none').children().html('Please Enter Password !');
        return false;
    }
    else if(PasswordRegEx.test(input_value)==false){
        $('[name="password"]').next().removeClass('d_none').children().html('Please a Valid Password!');
        return false;
    }
    else{
        $('[name="password"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------CONFIRM-PASSWORD-VALIDATON--------------------
function cpassword_validation(){
    const password = $('[name="password"]').val();
    const cpassword = $('[name="cpassword"]').val();
    if(cpassword==''){
        $('[name="cpassword"]').next().removeClass('d_none').children().html('Please Enter a Confirm Password !');
        return false;
    }
    else if(PasswordRegEx.test(cpassword)==false){
        $('[name="cpassword"]').next().removeClass('d_none').children().html('Please a Valid Password!');
        return false;
    }
    else if(cpassword!==password){
        $('[name="cpassword"]').next().removeClass('d_none').children().html('Password & Confirm Password not Matched!');
        return false;
    }
    else{
        $('[name="cpassword"]').next().addClass('d_none').children().html('');
        return true;
    }
}

export { 
        firstname_validation,
        lastname_validation,
        phone_validation,
        email_validation,
        message_validation,
        subject_validation,
        language_validation,
        password_validation,  
        cpassword_validation
    };