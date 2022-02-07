// ---------------OPEN_MODEL------------------
function open_model(popup_name){
    // HIDE ALL MODELS...
    $('.model').removeClass('active_model');
    $('.popup_main').addClass('d_none');
    $('.sidenav').animate({'right':'-250px'}, 500);
    $('.admin_tab_list').animate({'left':'-272px'}, 500);

    // SELECT THE POPUP CLASS
    const popup_id = `${popup_name}_popup`;
    // FOR SHOWING MODEL AND POPUP
    $('.model').addClass('active_model');
    $(`#${popup_id}`).removeClass('d_none');
    $('.backlight_container').addClass('backlight');
    $('body').css({'overflow-y':'hidden'});

}

// ---------------CLOSE_MODEL------------------
function close_model(){
    $('.backlight_container').removeClass('backlight');
    $('.model').removeClass('active_model');
    $('.popup_main').addClass('d_none');
    $('body').css({'overflow-y':'auto'});
}

$('.model_close_btn').click(()=>{
    close_model();
})

$('.backlight_container').click(()=>{
    close_model();
});

