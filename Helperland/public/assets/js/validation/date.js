// --------------FOR DATE VALIDATION---------
let date = new Date();
let currentYear = date.getFullYear();
let currentMonth = date.getMonth()+1;
let currentDate = date.getDate();
if(currentMonth<10){
    currentMonth = `0${currentMonth}`;
}
if(currentDate<10){
    currentDate = `0${currentDate}`;
}
let today = `${currentYear}-${currentMonth}-${currentDate}`;

export { today };