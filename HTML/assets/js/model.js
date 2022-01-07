// --------------OPEN_MODEL------------------
$('.open_login_popup').click(()=>{
    $('.model').fadeIn(100, ()=>{
        $('.model').removeClass('d_none');
        $('.sidenav').animate({'right':'-250px'}, 500);
        $('.forgot_password_popup').addClass('d_none');
        $('.login_popup').removeClass('d_none');
        $('.backlight_container').addClass('backlight');
        $('body').css({'overflow-y':'hidden'});
    });
});

$('.open_forgot_password_popup').click(()=>{
    $('.model').fadeIn(100, ()=>{
        $('.model').removeClass('d_none');
        $('.sidenav').animate({'right':'-250px'}, 500);
        $('.forgot_password_popup').removeClass('d_none');
        $('.login_popup').addClass('d_none');
        $('.backlight_container').addClass('backlight');
        $('body').css({'overflow-y':'hidden'});
    });
});

// ---------------CLOSE_MODEL------------------
$('.model_close_btn').click(()=>{
    $('.backlight_container').removeClass('backlight');
    $('.model').addClass('d_none');
    $('body').css({'overflow-y':'auto'});
})

$('.backlight_container').click(()=>{
    $('.backlight_container').removeClass('backlight');
    $('.model').addClass('d_none');
    $('body').css({'overflow-y':'auto'});
});
