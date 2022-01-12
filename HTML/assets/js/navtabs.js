const tab_btn = document.getElementsByClassName('tab_btn');
const tab_content = document.getElementsByClassName('tab_content');
var   faq_tabs = document.getElementsByClassName('faq_tabs');
var   faq_tab;
if(faq_tabs.length){
	faq_tab = document.getElementsByClassName('faq_tabs')[0].children;
}

for(let i=0; i<tab_btn.length; i++){
	tab_btn[i].addEventListener('click', ()=>{
		// REMOVE ACTIVE COLOR CLASS FROM TAB_BTNS
		$('.tab_btn').removeClass('active_faq_tab active_profile_tab');
		// HIDE ALL TAB CONTENTS, 
		$('.tab_content').addClass('d_none');
		// REMOVE TRANSITION + OPACITY CLASS->active_tab_content
		tab_content[i].classList.remove('active_tab_content');
		// SHOW ONLY PERTICULAR TAB CONTENT
		tab_content[i].classList.remove('d_none');
		setTimeout(()=>{
			// APPLY ACTIVE COLORS CLASS TO TAB_BTNS
			if(faq_tab!==undefined)
				tab_btn[i].classList.add('active_faq_tab');
			else
				tab_btn[i].classList.add('active_profile_tab');
			// ADD TRANSITION + OPACITY CLASS->active_tab_content
			tab_content[i].classList.add('active_tab_content');
		}, 10);
	});
}
