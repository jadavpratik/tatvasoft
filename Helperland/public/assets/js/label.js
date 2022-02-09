const input_arr = [`cabinet`, `fridge`, `oven`, `laundry`, `window`];
const img_path = `${proxy_url}/assets/img/customer/book_service`;

for(let i=0; i<input_arr.length; i++){

    const input = document.getElementById(`${input_arr[i]}`);
    const label_div_img = input.nextElementSibling.children[0].children[0];

    input.addEventListener('change', ()=>{
        if(input.checked)
            label_div_img.src = `${img_path}/${input_arr[i]}_green.png`;
        else
            label_div_img.src = `${img_path}/${input_arr[i]}.png`;
    });

}