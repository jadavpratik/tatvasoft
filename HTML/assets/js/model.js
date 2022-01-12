// ---------------OPEN_MODEL------------------
function open_model(popup_name){
    // SELECT THE POPUP CLASS
    const popup_id = `${popup_name}_popup`;
    // GET THE HTML OF POPUP 
    const popup_html = $(`#${popup_id}`).removeClass('d_none').prop('outerHTML');
    // AGAIN ADD D_NONE CLASS ON POPUP 
    $(`#${popup_id}`).addClass('d_none');

    // FOR SHOWING MODEL AND POPUP
    $('.model').removeClass('d_none');
    $('.popup_container').html(popup_html);
    $('.backlight_container').addClass('backlight');
    $('body').css({'overflow-y':'hidden'});

}

// ---------------CLOSE_MODEL------------------
function close_model(){
    $('.backlight_container').removeClass('backlight');
    $('.model').addClass('d_none');
    $('.popup_container').html(``);
    $('body').css({'overflow-y':'auto'});
}

$('.model_close_btn').click(()=>{
    $('.backlight_container').removeClass('backlight');
    $('.model').addClass('d_none');
    $('.popup_container').html(``);
    $('body').css({'overflow-y':'auto'});
})

$('.backlight_container').click(()=>{
    $('.backlight_container').removeClass('backlight');
    $('.model').addClass('d_none');
    $('.popup_container').html(``);
    $('body').css({'overflow-y':'auto'});
});
