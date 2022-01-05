const nav_tab = document.getElementsByClassName('nav_tab');
const nav_tab_content = document.getElementsByClassName('nav_tab_content');

for(let i=0; i<nav_tab.length; i++){
	nav_tab[i].addEventListener('click', ()=>{

		$('.nav_tab').removeClass('faq_active_tab');
		nav_tab[i].classList.add('faq_active_tab');

		$('.nav_tab_content').addClass('d_none');
		nav_tab_content[i].classList.remove('d_none');

	});
}
