import { EmailRegEx, PasswordRegEx } from './regex.js';

// ------------------------LOGIN-EMAIL-ADDRESS-VALIDATION--------------------
function login_email_validation(){
    const input_value = $('[name="login_email"]').val();
    if(input_value==''){
        $('[name="login_email"]').parent().next().removeClass('d_none').children().html('Please Enter Email Address !');
        return false;
    }
    else if(EmailRegEx.test(input_value)==false){
        $('[name="login_email"]').parent().next().removeClass('d_none').children().html('Enter a Valid Email Address !');
        return false;
    }
    else{
        $('[name="login_email"]').parent().next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------LOGIN -PASSWORD-VALIDATON--------------------
function login_password_validation(){
    const input_value = $('[name="login_password"]').val();
    if(input_value==''){
        $('[name="login_password"]').parent().next().removeClass('d_none').children().html('Please Enter Password !');
        return false;
    }
    else if(PasswordRegEx.test(input_value)==false){
        $('[name="login_password"]').parent().next().removeClass('d_none').children().html('Please a Valid Password!');
        return false;
    }
    else{
        $('[name="login_password"]').parent().next().addClass('d_none').children().html('');
        return true;
    }
}

export { login_email_validation, login_password_validation };