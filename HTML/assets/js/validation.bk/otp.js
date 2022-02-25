// ------------------------OTP-VALIDATON--------------------
function otp_validation(){
    const input_value = parseInt($('[name="otp"]').val());
    if(input_value==''){
        $('[name="otp"]').next().removeClass('d_none').children().html('Please Enter OTP !');
        return false;
    }
    else if(digits_count(input_value)!==4){
        $('[name="otp"]').next().removeClass('d_none').children().html('Invalid OTP !');
        return false;
    }
    else{
        $('[name="otp"]').next().addClass('d_none').children().html('');
        return true;
    }
}

function digits_count(n) {
    var count = 0;
    if (n >= 1) ++count;
  
    while (n / 10 >= 1) {
      n /= 10;
      ++count;
    }  
    return count;
}

export {otp_validation};