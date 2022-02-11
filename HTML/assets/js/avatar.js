// const car_url = `${proxy_url}/assets/img/avatar/car.png`;
// const female_url = `${proxy_url}/assets/img/avatar/female.png`;
// const male_url = `${proxy_url}/assets/img/avatar/male.png`;
// const ship_url = `${proxy_url}/assets/img/avatar/ship.png`;
// const iron_url = `${proxy_url}/assets/img/avatar/iron.png`;
// const hat_url = `${proxy_url}/assets/img/avatar/hat.png`;

const car_url = "../assets/img/avatar/car.png";
const female_url = "../assets/img/avatar/female.png";
const male_url = "../assets/img/avatar/male.png";
const ship_url = "../assets/img/avatar/ship.png";
const iron_url = "../assets/img/avatar/iron.png";
const hat_url = "../assets/img/avatar/hat.png";

const avatar_input = document.getElementsByName('avatar');
const profile_avatar = document.getElementsByClassName('avatar')[0];

for(let i=0; i<avatar_input.length; i++){
    avatar_input[i].addEventListener('change', ()=>{
        selected_avatar = avatar_input[i].value;
        switch(selected_avatar){
            case 'car': profile_avatar.src = car_url;
                break;
            case 'hat': profile_avatar.src = hat_url;
                break;
            case 'male': profile_avatar.src = male_url;
                break;
            case 'female': profile_avatar.src = female_url;
                break;
            case 'iron': profile_avatar.src = iron_url;
                break;
            case 'ship': profile_avatar.src = ship_url;
                break;
        }
    });
}
