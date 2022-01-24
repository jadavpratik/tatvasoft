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

		// REMOVE ACTIVE TAB CLASS...
		$('.tab_btn').removeClass('active_faq_tab active_profile_tab active_book_service_tab');

		// HIDE ALL TAB CONTENTS, and TRANSITION + OPACITY CLASS->active_tab_content
		$('.tab_content').addClass('d_none');
		tab_content[i].classList.remove('active_tab_content');

		// SHOW ONLY PERTICULAR TAB CONTENT
		tab_content[i].classList.remove('d_none');

		setTimeout(()=>{

			// ACTIVE BTNS...
			if(faq_tab!==undefined){// FAQS...
				tab_btn[i].classList.add('active_faq_tab');
			}
			else if(book_service_tab!==undefined){// BOOK SERVICES...
				tab_btn[i].classList.add('active_book_service_tab');
			}
			else{// PROFILE...
				tab_btn[i].classList.add('active_profile_tab');
			}

			// ADD TRANSITION + OPACITY CLASS->active_tab_content
			tab_content[i].classList.add('active_tab_content');

		}, 10);

	});
}
