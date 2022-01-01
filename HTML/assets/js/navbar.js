var show_nav_menu = 0;
const nav_menu = $('.nav_menu')[0];
const navbar = $('.navbar')[0];			
const logo = $('.logo')[0];

// RESPONSIVE NAVBAR
$('.nav_menu_btn').click(()=>{
    if(show_nav_menu == 0){
        nav_menu.style.right = 0;
        show_nav_menu = 1;
        $('.nav_menu_btn').html(`<i class="fas fa-times"></i>`);
    }
    else if(show_nav_menu == 1){
        nav_menu.style.right = '-3000px';
        show_nav_menu = 0;
        $('.nav_menu_btn').html(`<i class="fas fa-bars"></i>`);
    }
});

// ON SCROLL SET NAVBAR HEIGHT
window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.documentElement.scrollTop > 50) {
        // WHEN WE GO BOTTOM...
        navbar.style.height = '64px';
        navbar.style.backgroundColor = 'rgba(82,82,82,0.8)';
        logo.style.width = '73px';
        logo.style.height = '54px';
        logo.style.paddingTop = '6px';
        logo.style.paddingBottom = '4px';
        $('.navbar_focus_btn').addClass('navbar_colored_btn');
    } 
    else {
        // WHEN WE GO TOP...
        navbar.style.backgroundColor = 'transparent';
        navbar.style.height = '130px';
        logo.style.width = '175px';
        logo.style.height = '130px';
        $('.navbar_focus_btn').removeClass('navbar_colored_btn');
    }
}

// DROPDOWN
$('.dropdown_btn').click(()=>{
    $('.dropdown_content').toggleClass('d_none');
});
