// ------------------------SET_NEW_PASSWORD-VALIDATON--------------------
function set_new_password_validation(){
    const input_value = $('[name="set_new_password"]').val();
    if(input_value==''){
        $('[name="set_new_password"]').next().removeClass('d_none').children().html('Please Enter Password !');
        return false;
    }
    else if(PasswordRegEx.test(input_value)==false){
        $('[name="set_new_password"]').next().removeClass('d_none').children().html('Please a Valid Password!');
        return false;
    }
    else{
        $('[name="set_new_password"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------SET_NEW_CONFIRM-PASSWORD-VALIDATON--------------------
function set_new_cpassword_validation(){
    const password = $('[name="set_new_password"]').val();
    const cpassword = $('[name="set_new_cpassword"]').val();
    if(cpassword==''){
        $('[name="set_new_cpassword"]').next().removeClass('d_none').children().html('Please Enter a Confirm Password !');
        return false;
    }
    else if(PasswordRegEx.test(cpassword)==false){
        $('[name="set_new_cpassword"]').next().removeClass('d_none').children().html('Please a Valid Password!');
        return false;
    }
    else if(cpassword!==password){
        $('[name="set_new_cpassword"]').next().removeClass('d_none').children().html('Password & Confirm Password not Matched!');
        return false;
    }
    else{
        $('[name="set_new_cpassword"]').next().addClass('d_none').children().html('');
        return true;
    }
}

export { set_new_password_validation, set_new_cpassword_validation };