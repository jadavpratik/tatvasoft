import { EmailRegEx } from './regex.js';

// ------------------------FORGOT-PASSWORD-EMAIL-ADDRESS-VALIDATION--------------------
function forgot_password_email_validation(){
    const input_value = $('[name="forgot_password_email"]').val();
    if(input_value==''){
        $('[name="forgot_password_email"]').next().removeClass('d_none').children().html('Please Enter Email Address !');
        return false;
    }
    else if(EmailRegEx.test(input_value)==false){
        $('[name="forgot_password_email"]').next().removeClass('d_none').children().html('Enter a Valid Email Address !');
        return false;
    }
    else{
        $('[name="forgot_password_email"]').next().addClass('d_none').children().html('');
        return true;
    }
}

export { forgot_password_email_validation };