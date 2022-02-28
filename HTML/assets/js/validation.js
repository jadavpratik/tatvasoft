const TextRegEx = /^[A-Za-z]/;
const EmailRegEx = /^[a-zA-Z0-9.]+@[a-zA-Z0-9]+(\.[a-zA-Z]{2,})+$/;
const PasswordRegEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
const PhoneRegEx = /^[0-9]{10}$/;
const PostalCodeRegEx = /^[0-9]{5,6}$/;
const HouseNumberRegEx = /^[0-9]{1,4}$/;

let date = new Date();
let yyyy = date.getFullYear();
let mm = date.getMonth()+1;
let dd = date.getDate();

if(mm<10){
    mm = `0${mm}`;
}
if(dd<10){
    dd = `0${dd}`;
}

let today = `${yyyy}-${mm}-${dd}`;



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

// ------------------------CHANGE-PASSWORD-OLD-VALIDATON--------------------
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

// ------------------------CHANGE-PASSWORD-NEW-VALIDATON--------------------
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

// ------------------------CHANGE-PASSWORD-CONFIRM-VALIDATON--------------------
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

// ------------------------SETUP-SERVICE-POSTAL-CODE-VALIDATON--------------------
function setup_service_postal_code_validation(){
    const postal_code = $('[name="setup_service_postal_code"]').val();
    if(postal_code==''){
        $('[name="setup_service_postal_code"]').next().removeClass('d_none').children().html('Please Enter Postal Code !');
        return false;
    }
    else if(PostalCodeRegEx.test(postal_code)==false){
        $('[name="setup_service_postal_code"]').next().removeClass('d_none').children().html('Postal Code Shoud be a Min:5 or Max:10 Digits !');
        return false;
    }
    else{
        $('[name="setup_service_postal_code"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------SCHEDULE-DATE-VALIDATON--------------------
function schedule_date_validation(){
    const selectedDate = $('[name="schedule_date"]').val();
    const temp = new Date(selectedDate);
    const tempYear = temp.getFullYear();
    const tempMonth = temp.getMonth()+1;
    const tempDate = temp.getDate();
    const newYear = tempYear+1;
    mm = parseInt(mm);
    dd = parseInt(dd);
    if(selectedDate==undefined || selectedDate==""){
        $('[name="schedule_date"]').parent().next().removeClass('d_none').children().html('Please Select Date !');
        return false;
    }
    else if(mm==12 && newYear > yyyy){
        // ASSUME THAT NEW YEAR WILL BE START SOON, 
        // AND ASSUME USER BOOK SERVICE IN DECEMBER MONTH..
        console.log('Nothing to Do...');
        return true;
    }
    else if(tempYear < yyyy || tempYear > yyyy){
        $('[name="schedule_date"]').parent().next().removeClass('d_none').children().html('Year is Invalid !');
        return false;
    }
    else if((tempYear == yyyy) && (tempMonth < mm)){
        $('[name="schedule_date"]').parent().next().removeClass('d_none').children().html('Month is Invalid !');
        return false;
    }
    else if((tempYear == yyyy) && (tempMonth == mm) && (tempDate < dd)){
        $('[name="schedule_date"]').parent().next().removeClass('d_none').children().html('Date is Invalid !');
        return false;
    }
    else{
        $('[name="schedule_date"]').parent().next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------SCHEDULE-TIME-VALIDATON--------------------
function schedule_time_validation(){
    const time = $('[name="schedule_time"]').val();
    if(time=="" || time==undefined){
        $('[name="schedule_time"]').next().removeClass('d_none').children().html('Please Select a Time !');
        return false;
    }
    else{
        $('[name="schedule_time"]').next().addClass('d_none').children().html('');        
        return true;
    }
}

// ------------------------ADDRESS-FORM-STREET-NAME-VALIDATON--------------------
function address_form_street_name_validation(){
    const input_value = $('[name="address_form_street_name"]').val();
    if(input_value==''){
        $('[name="address_form_street_name"]').next().removeClass('d_none').children().html('Please Enter Street Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="address_form_street_name"]').next().removeClass('d_none').children().html('Enter a Text in Valid Format !');
        return false;
    }
    else{
        $('[name="address_form_street_name"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADDRESS-FORM-HOUSE-NUMBER-VALIDATON--------------------
function address_form_house_number_validation(){
    const input_value = $('[name="address_form_house_number"]').val();
    if(input_value==''){
        $('[name="address_form_house_number"]').next().removeClass('d_none').children().html('Please Enter a House Number or (Enter 0) !');
        return false;
    }
    else if(HouseNumberRegEx.test(input_value)==false){
        $('[name="address_form_house_number"]').next().removeClass('d_none').children().html('House Number Should be Numbers !');
        return false;
    }
    else{
        $('[name="address_form_house_number"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADDRESS-FORM-POSTAL-CODE-VALIDATON--------------------
function address_form_postal_code_validation(){
    const input_value = $('[name="address_form_postal_code"]').val();
    if(input_value==''){
        $('[name="address_form_postal_code"]').next().removeClass('d_none').children().html('Please Enter Postal Code !');
        return false;
    }
    else if(PostalCodeRegEx.test(input_value)==false){
        $('[name="address_form_postal_code"]').next().removeClass('d_none').children().html('Postal Code Shoud be a Min:5 or Max:10 Digits !');
        return false;
    }
    else{
        $('[name="address_form_postal_code"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADDRESS-FORM-CITY-VALIDATON--------------------
function address_form_city_validation(){
    const input_value = $('[name="address_form_city"]').val();
    if(input_value==''){
        $('[name="address_form_city"]').next().removeClass('d_none').children().html('Please Enter City Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="address_form_city"]').next().removeClass('d_none').children().html('Enter a Text in Valid Format !');
        return false;
    }
    else{
        $('[name="address_form_city"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADDRESS-FORM-PHONE-VALIDATON--------------------
function address_form_phone_validation(){
    const input_value = $('[name="address_form_phone"]').val();
    if(input_value==''){
        $('[name="address_form_phone"]').next().removeClass('d_none').children().html('Please Enter Phone Number !');
        return false;
    }
    else if(PhoneRegEx.test(input_value)==false){
        $('[name="address_form_phone"]').next().removeClass('d_none').children().html('Phone Number Should be a 10 Digits !');
        return false;
    }
    else{
        $('[name="address_form_phone"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------BOOK-SERVICES-ADDRESS-VALIDATON--------------------
function book_service_address_validation(){
    const input_value = $('[name="service_booking_address"]:checked').val();
    if(input_value==undefined || input_value==""){
        $('#your_details_submit_btn').prev().removeClass('d_none').children().html('Please Add or Select Address !');
        return false;
    }
    else{
        $('#your_details_submit_btn').prev().addClass('d_none').children().html('');
        return true;
    }
}


// ------------------------ADD-ADDRESS-STREET-NAME-VALIDATON--------------------
function add_address_street_name_validation(){
    const input_value = $('[name="add_address_street_name"]').val();
    if(input_value==''){
        $('[name="add_address_street_name"]').next().removeClass('d_none').children().html('Please Enter Street Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="add_address_street_name"]').next().removeClass('d_none').children().html('Enter a Text in Valid Format !');
        return false;
    }
    else{
        $('[name="add_address_street_name"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADD-ADDRESS-STREET-NAME-VALIDATON--------------------
function add_address_street_name_validation(){
    const input_value = $('[name="add_address_street_name"]').val();
    if(input_value==''){
        $('[name="add_address_street_name"]').next().removeClass('d_none').children().html('Please Enter Street Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="add_address_street_name"]').next().removeClass('d_none').children().html('Enter a Text in Valid Format !');
        return false;
    }
    else{
        $('[name="add_address_street_name"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADD-ADDRESS-HOUSE-NUMBER-VALIDATON--------------------
function add_address_house_number_validation(){
    const input_value = $('[name="add_address_house_number"]').val();
    if(input_value==''){
        $('[name="add_address_house_number"]').next().removeClass('d_none').children().html('Please Enter a House Number or (Enter 0) !');
        return false;
    }
    else if(HouseNumberRegEx.test(input_value)==false){
        $('[name="add_address_house_number"]').next().removeClass('d_none').children().html('House Number Should be Numbers !');
        return false;
    }
    else{
        $('[name="add_address_house_number"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADD-ADDRESS-POSTAL-CODE-VALIDATON--------------------
function add_address_postal_code_validation(){
    const input_value = $('[name="add_address_postal_code"]').val();
    if(input_value==''){
        $('[name="add_address_postal_code"]').next().removeClass('d_none').children().html('Please Enter Postal Code !');
        return false;
    }
    else if(PostalCodeRegEx.test(input_value)==false){
        $('[name="add_address_postal_code"]').next().removeClass('d_none').children().html('Postal Code Shoud be a Min:5 or Max:10 Digits !');
        return false;
    }
    else{
        $('[name="add_address_postal_code"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADD-ADDRESS-CITY-VALIDATON--------------------
function add_address_city_validation(){
    const input_value = $('[name="add_address_city"]').val();
    if(input_value==''){
        $('[name="add_address_city"]').next().removeClass('d_none').children().html('Please Enter City Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="add_address_city"]').next().removeClass('d_none').children().html('Enter a Text in Valid Format !');
        return false;
    }
    else{
        $('[name="add_address_city"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------ADD-ADDRESS-PHONE-VALIDATON--------------------
function add_address_phone_validation(){
    const input_value = $('[name="add_address_phone"]').val();
    if(input_value==''){
        $('[name="add_address_phone"]').next().removeClass('d_none').children().html('Please Enter Phone Number !');
        return false;
    }
    else if(PhoneRegEx.test(input_value)==false){
        $('[name="add_address_phone"]').next().removeClass('d_none').children().html('Phone Number Should be a 10 Digits !');
        return false;
    }
    else{
        $('[name="add_address_phone"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------EDIT-ADDRESS-STREET-NAME-VALIDATON--------------------
function edit_address_street_name_validation(){
    const input_value = $('[name="edit_address_street_name"]').val();
    if(input_value==''){
        $('[name="edit_address_street_name"]').next().removeClass('d_none').children().html('Please Enter Street Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="edit_address_street_name"]').next().removeClass('d_none').children().html('Enter a Text in Valid Format !');
        return false;
    }
    else{
        $('[name="edit_address_street_name"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------EDIT-ADDRESS-HOUSE-NUMBER-VALIDATON--------------------
function edit_address_house_number_validation(){
    const input_value = $('[name="edit_address_house_number"]').val();
    if(input_value==''){
        $('[name="edit_address_house_number"]').next().removeClass('d_none').children().html('Please Enter a House Number or (Enter 0) !');
        return false;
    }
    else if(HouseNumberRegEx.test(input_value)==false){
        $('[name="edit_address_house_number"]').next().removeClass('d_none').children().html('House Number Should be Numbers !');
        return false;
    }
    else{
        $('[name="edit_address_house_number"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------EDIT-ADDRESS-POSTAL-CODE-VALIDATON--------------------
function edit_address_postal_code_validation(){
    const input_value = $('[name="edit_address_postal_code"]').val();
    if(input_value==''){
        $('[name="edit_address_postal_code"]').next().removeClass('d_none').children().html('Please Enter Postal Code !');
        return false;
    }
    else if(PostalCodeRegEx.test(input_value)==false){
        $('[name="edit_address_postal_code"]').next().removeClass('d_none').children().html('Postal Code Shoud be a Min:5 or Max:10 Digits !');
        return false;
    }
    else{
        $('[name="edit_address_postal_code"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------EDIT-ADDRESS-CITY-VALIDATON--------------------
function edit_address_city_validation(){
    const input_value = $('[name="edit_address_city"]').val();
    if(input_value==''){
        $('[name="edit_address_city"]').next().removeClass('d_none').children().html('Please Enter City Name !');
        return false;
    }
    else if(TextRegEx.test(input_value)==false){
        $('[name="edit_address_city"]').next().removeClass('d_none').children().html('Enter a Text in Valid Format !');
        return false;
    }
    else{
        $('[name="edit_address_city"]').next().addClass('d_none').children().html('');
        return true;
    }
}

// ------------------------EDIT-ADDRESS-PHONE-VALIDATON--------------------
function edit_address_phone_validation(){
    const input_value = $('[name="edit_address_phone"]').val();
    if(input_value==''){
        $('[name="edit_address_phone"]').next().removeClass('d_none').children().html('Please Enter Phone Number !');
        return false;
    }
    else if(PhoneRegEx.test(input_value)==false){
        $('[name="edit_address_phone"]').next().removeClass('d_none').children().html('Phone Number Should be a 10 Digits !');
        return false;
    }
    else{
        $('[name="edit_address_phone"]').next().addClass('d_none').children().html('');
        return true;
    }
}


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

// ---------------------ADD ADDRESS -POPUP-MODEL-------------------
$('[name="add_address_street_name"]').focusout(function(){
    add_address_street_name_validation();
});

$('[name="add_address_house_number"]').focusout(function(){
    add_address_house_number_validation();
});

$('[name="add_address_postal_code"]').focusout(function(){
    add_address_postal_code_validation();
});

$('[name="add_address_city"]').focusout(function(){
    add_address_city_validation();
});

$('[name="add_address_phone"]').focusout(function(){
    add_address_phone_validation();
});



// ---------------------EDIT ADDRESS -POPUP-MODEL-------------------
$('[name="edit_address_street_name"]').focusout(function(){
    edit_address_street_name_validation();
});

$('[name="edit_address_house_number"]').focusout(function(){
    edit_address_house_number_validation();
});

$('[name="edit_address_postal_code"]').focusout(function(){
    edit_address_postal_code_validation();
});

$('[name="edit_address_city"]').focusout(function(){
    edit_address_city_validation();
});

$('[name="edit_address_phone"]').focusout(function(){
    edit_address_phone_validation();
});


















// ********************MODULE FUNCTION CAN'T ACCESS OUTSIDE THIS FILE**********************...
// // CONTACT, SIGNUP & PROFILE....
// import { firstname_validation, lastname_validation, 
//          phone_validation, email_validation,
//          message_validation, subject_validation, language_validation,
//          password_validation, cpassword_validation } from './validation/profile.js';

// //  CHANGE PASSWORD...
// import { change_password_old_validation, 
//          change_password_new_validation, 
//          change_password_confirm_validation } from './validation/change_password.js';
        
// // BOOK SERVICE...
// import{ setup_service_postal_code_validation,
//         schedule_date_validation, 
//         schedule_time_validation,
//         address_form_street_name_validation,
//         address_form_house_number_validation,
//         address_form_postal_code_validation,
//         address_form_city_validation,
//         address_form_phone_validation,
//         book_service_address_validation } from './validation/book_service.js';

// // LOGIN...
// import { login_email_validation, 
//          login_password_validation } from './validation/login.js';        

// // FORGOT PASSWORD...
// import { forgot_password_email_validation } from './validation/forgot_password.js';

// // OTP VALIDATON...
// import { otp_validation } from './validation/otp.js';
         
// // SET NEW PASSWORD...
// import { set_new_cpassword_validation, 
//          set_new_password_validation } from './validation/set_new_password.js';        

// // DATE...
// import { today } from './validation/date.js';         

