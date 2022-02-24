// ------------------HORIZONTAL NAVTABS [FAQs, Profile, Book_Service]--------------------------
const tab_btn = document.getElementsByClassName('tab_btn');
const tab_content = document.getElementsByClassName('tab_content');
const faq_tabs = document.getElementsByClassName('faq_tabs');
const book_service_tabs = document.getElementsByClassName('book_service_tabs');
var faq_tab, book_service_tab;

if(faq_tabs.length){
	faq_tab = document.getElementsByClassName('faq_tabs')[0].children;
}

if(book_service_tabs.length){
	book_service_tab = document.getElementsByClassName('book_service_tabs')[0].children;
}

for(let i=0; i<tab_btn.length; i++){
	tab_btn[i].addEventListener('click', ()=>{
		$('.tab_content').addClass('d_none');
		tab_content[i].classList.remove('d_none');

		$('.tab_btn').removeClass('active_faq_tab active_profile_tab active_book_service_tab');
		if(faq_tab!==undefined)
			tab_btn[i].classList.add('active_faq_tab');
		else if(book_service_tab!==undefined)
			tab_btn[i].classList.add('active_book_service_tab');
		else
			tab_btn[i].classList.add('active_profile_tab');
	});
}