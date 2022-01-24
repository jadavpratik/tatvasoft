$('.sidenav_btn').click(()=>{
    $('.backlight_container').addClass('backlight');
    $('.sidenav').animate({'right':'0px'}, 500);
    $('body').css({'overflow':'hidden'});
});

$('.admin_dashboard_btn').click(()=>{
    $('.backlight_container').addClass('backlight');
    $('.admin_tab_list').animate({'left':'0px'}, 500);
    $('body').css({'overflow':'hidden'});
});

$('.backlight_container').click(()=>{
    $('.backlight_container').removeClass('backlight');
    $('.sidenav').animate({'right':'-250px'}, 500);
    $('.admin_tab_list').animate({'left':'-272px'}, 500);
    $('body').css({'overflow-y':'auto'});
});

// --------------FOR_PAYMENT_SUMMARY-----------------
if($(window). width() < 992){
    $('.book_service_right').toggleClass('d_none');
}

$('.payment_summary_btn').click(()=>{
    $('.book_service_right').toggleClass('d_none');
    $('.backlight_container').toggleClass('backlight');
    $('body').css({'overflow':'hidden'});
});

$('.backlight_container').click(()=>{
    $('.book_service_right').toggleClass('d_none');
});