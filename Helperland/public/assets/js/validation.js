const NameRegEx = /^[A-Za-z]/;
const EmailRegEx = /^[a-zA-Z0-9.]+@[a-zA-Z0-9]+(\.[a-zA-Z]{2,})+$/;
const PasswordRegEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
const PhoneRegEx = /^[0-9]{10}$/;

// ------------------------FIRST-NAME-VALIDATION--------------------
$('[name="firstname"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).next().removeClass('d_none').children().html('Please Enter First Name !');
    }
    else if(NameRegEx.test(input_value)==false){
        $(this).next().removeClass('d_none').children().html('Numbers Not Allowed !');
    }
    else{
        $(this).next().addClass('d_none').children().html('');
    }
});

// ------------------------LAST-NAME-VALIDATION--------------------
$('[name="lastname"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).next().removeClass('d_none').children().html('Please Enter Last Name !');
    }
    else if(NameRegEx.test(input_value)==false){
        $(this).next().removeClass('d_none').children().html('Numbers Not Allowed !');
    }
    else{
        $(this).next().addClass('d_none').children().html('');
    }
});

// ------------------------PHONE-NUMBER-VALIDATION--------------------
$('[name="phone"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).parent().next().removeClass('d_none').children().html('Please Enter Phone Number !');
    }
    else if(PhoneRegEx.test(input_value)==false){
        $(this).parent().next().removeClass('d_none').children().html('Enter a Valid Phone Number !');
    }
    else{
        $(this).parent().next().addClass('d_none').children().html('');
    }
});

// ------------------------EMAIL-ADDRESS-VALIDATION--------------------
$('[name="email"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).next().removeClass('d_none').children().html('Please Enter Email Address !');
    }
    else if(EmailRegEx.test(input_value)==false){
        $(this).next().removeClass('d_none').children().html('Enter a Valid Email Address !');
    }
    else{
        $(this).next().addClass('d_none').children().html('');
    }
});


// ------------------------LOGIN-EMAIL-ADDRESS-VALIDATION--------------------
$('[name="login_email"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).parent().next().removeClass('d_none').children().html('Please Enter Email Address !');
    }
    else if(EmailRegEx.test(input_value)==false){
        $(this).parent().next().removeClass('d_none').children().html('Enter a Valid Email Address !');
    }
    else{
        $(this).parent().next().addClass('d_none').children().html('');
    }
});

// ------------------------MESSAGE-VALIDATON--------------------
$('[name="message"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).next().removeClass('d_none').children().html('Please Enter Message !');
    }
    else{
        $(this).next().addClass('d_none').children().html('');
    }
});

// ------------------------SUBJECT-VALIDATON--------------------
$('[name="subject"]').focusout(function(){
    const input_value = $(this).val();
    console.log(input_value);
    if(input_value==''){
        $(this).next().removeClass('d_none').children().html('Please Select a Subject !');
    }
    else{
        $(this).next().addClass('d_none').children().html('');
    }
});


// ------------------------PASSWORD-VALIDATON--------------------
$('[name="password"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).next().removeClass('d_none').children().html('Please Enter Password !');
    }
    else if(PasswordRegEx.test(input_value)==false){
        $(this).next().removeClass('d_none').children().html('Please a Valid Password!');
    }
    else{
        $(this).next().addClass('d_none').children().html('');
    }
});

// ------------------------LOGIN -PASSWORD-VALIDATON--------------------
$('[name="login_password"]').focusout(function(){
    const input_value = $(this).val();
    if(input_value==''){
        $(this).parent().next().removeClass('d_none').children().html('Please Enter Password !');
    }
    else if(PasswordRegEx.test(input_value)==false){
        $(this).parent().next().removeClass('d_none').children().html('Please a Valid Password!');
    }
    else{
        $(this).parent().next().addClass('d_none').children().html('');
    }
});

// ------------------------CONFIRM-PASSWORD-VALIDATON--------------------
$('[name="cpassword"]').focusout(function(){
    const password = $('[name="password"]').val();
    const cpassword = $('[name="cpassword"]').val();
    if(cpassword==''){
        $(this).next().removeClass('d_none').children().html('Please Enter a Confirm Password !');
    }
    else if(PasswordRegEx.test(cpassword)==false){
        $(this).next().removeClass('d_none').children().html('Please a Valid Password!');
    }
    else if(cpassword!==password){
        $(this).next().removeClass('d_none').children().html('Password & Confirm Password not Matched!');
    }
    else{
        $(this).next().addClass('d_none').children().html('');
    }
});
