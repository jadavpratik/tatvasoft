// --------------FOR DATE VALIDATION---------
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

export { today };