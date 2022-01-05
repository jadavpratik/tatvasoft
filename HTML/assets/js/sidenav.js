$('.sidenav_btn').click(()=>{
    $('.backlight_container').addClass('backlight');
    $('.sidenav').removeClass('d_none').animate({'right':'0px'});
});

$('.backlight_container').click(()=>{
    $('.backlight_container').removeClass('backlight');
    $('.sidenav').addClass('d_none').animate({'right':'-250px'});
});
