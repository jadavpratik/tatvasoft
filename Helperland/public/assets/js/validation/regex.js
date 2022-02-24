// ----------------------------RegEx---------------------------
const TextRegEx = /^[A-Za-z]/;
const EmailRegEx = /^[a-zA-Z0-9.]+@[a-zA-Z0-9]+(\.[a-zA-Z]{2,})+$/;
const PasswordRegEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
const PhoneRegEx = /^[0-9]{10}$/;
const PostalCodeRegEx = /^[0-9]{5,6}$/;
const HouseNumberRegEx = /^[0-9]{1,4}$/;

export {
        TextRegEx, 
        EmailRegEx, 
        PasswordRegEx, 
        PhoneRegEx, 
        PostalCodeRegEx, 
        HouseNumberRegEx
    };