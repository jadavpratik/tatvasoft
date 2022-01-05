var show = 0;
const open_icon = `<i class="fas fa-bars"></i>`;
const close_icon = `<i class="fas fa-times"></i>`;
const open_obj = {'background-color':'lightgray','right':'250px'};
const close_obj = {'background-color':'transparent','right':'0px'};

$('.navbar_toggle_btn').click(()=>{
    if(show==0){
        $('.navbar_toggle_btn').html(close_icon).css(open_obj);
        $('.responsive_sidenav_menu').toggleClass('d_none');
        show=1;
    }
    else{
        $('.navbar_toggle_btn').html(open_icon).css(close_obj);
        show=0;
        $('.responsive_sidenav_menu').toggleClass('d_none');
    }
});
