import { TextRegEx, PostalCodeRegEx, HouseNumberRegEx, PhoneRegEx } from './regex.js';


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
    currentMonth = parseInt(currentMonth);
    currentDate = parseInt(currentDate);
    if(selectedDate==undefined || selectedDate==""){
        $('[name="schedule_date"]').parent().next().removeClass('d_none').children().html('Please Select Date !');
        return false;
    }
    else if(currentMonth==12 && newYear > currentYear){
        // ASSUME THAT NEW YEAR WILL BE START SOON, 
        // AND ASSUME USER BOOK SERVICE IN DECEMBER MONTH..
        console.log('Nothing to Do...');
        return true;
    }
    else if(tempYear < currentYear || tempYear > currentYear){
        $('[name="schedule_date"]').parent().next().removeClass('d_none').children().html('Year is Invalid !');
        return false;
    }
    else if((tempYear == currentYear) && (tempMonth < currentMonth)){
        $('[name="schedule_date"]').parent().next().removeClass('d_none').children().html('Month is Invalid !');
        return false;
    }
    else if((tempYear == currentYear) && (tempMonth == currentMonth) && (tempDate < currentDate)){
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

// ------------------------HOUSE-NUMBER-VALIDATON--------------------
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
        $('[name="address_form_city"]').next().removeClass('d_none').children().html('Please Enter CityName !');
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

// ------------------------ADDRESS-FORM-PHONE-VALIDATON--------------------
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

export {
    setup_service_postal_code_validation,
    schedule_date_validation,
    schedule_time_validation,
    address_form_street_name_validation,
    address_form_house_number_validation,
    address_form_postal_code_validation,
    address_form_city_validation,
    address_form_phone_validation,
    book_service_address_validation
}
