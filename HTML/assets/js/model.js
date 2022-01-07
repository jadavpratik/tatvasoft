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
