$(document).ready(function(){
    $('.go_top_btn').click(()=>{
        $("html, body").animate({scrollTop:0},1500);
    });
    
    $('#cookie_submit_btn').click(()=>{
        $('.cookie').hide();
    });
    
});