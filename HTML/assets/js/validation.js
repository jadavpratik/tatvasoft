// const NameRegEx = /^[A-Za-z]/;
// const EmailRegEx = /^[a-zA-Z0-9.]+@[a-zA-Z0-9]+(\.[a-zA-Z]{2,})+$/;
// const PasswordRegEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
// const PhoneRegEx = /^[0-9]{10}$/;
// const SelectRegEx = ``;
// const TextRegEx = ``;
// const FileRegEx = ``;

const firstname = $('[name="firstname"]');
const lastname = $('[name="lastname"]');
const email = $('[name="email"]');
const phone = $('[name="phone"]');
const subject = $('[name="subject"]');
const message = $('[name="message"]');

$('[name="firstname"]').focusout(function(){
    if($(this).val()==''){
        console.log($(this).siblings('validation-msg')[0]);
    }
});