function change_password_old_validation(){
    const input_value = $('[name="change_password_old"]').val();
    if(input_value==''){
        $('[name="change_password_old"]').next().removeClass('d_none').children().html('Please Enter Old Password !');
        return false;
    }
    // else if(PasswordRegEx.test(input_value)==false){
    //     $('[name="change_password_old"]').next().removeClass('d_none').children().html('Please a Valid Password!');
    //     return false;
    // }
    else{
        $('[name="change_password_old"]').next().addClass('d_none').children().html('');
        return true;
    }
}

function change_password_new_validation(){
    const input_value = $('[name="change_password_new"]').val();
    if(input_value==''){
        $('[name="change_password_new"]').next().removeClass('d_none').children().html('Please Enter a New Password !');
        return false;
    }
    // else if(PasswordRegEx.test(input_value)==false){
    //     $('[name="change_password_new"]').next().removeClass('d_none').children().html('Please a Valid Password!');
    //     return false;
    // }
    else{
        $('[name="change_password_new"]').next().addClass('d_none').children().html('');
        return true;
    }
    
}

function change_password_confirm_validation(){
    const password = $('[name="change_password_new"]').val();
    const cpassword = $('[name="change_password_confirm"]').val();
    if(cpassword==''){
        $('[name="change_password_confirm"]').next().removeClass('d_none').children().html('Please Enter a Confirm Password !');
        return false;
    }
    else if(PasswordRegEx.test(cpassword)==false){
        $('[name="change_password_confirm"]').next().removeClass('d_none').children().html('Please a Valid Password!');
        return false;
    }
    else if(cpassword!==password){
        $('[name="change_password_confirm"]').next().removeClass('d_none').children().html('Password & Confirm Password not Matched!');
        return false;
    }
    else{
        $('[name="change_password_confirm"]').next().addClass('d_none').children().html('');
        return true;
    }    
}

export { change_password_old_validation, 
         change_password_new_validation, 
         change_password_confirm_validation };