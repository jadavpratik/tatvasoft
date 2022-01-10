const tab_btn = document.getElementsByClassName('tab_btn');
const tab_content = document.getElementsByClassName('tab_content');

for(let i=0; i<tab_btn.length; i++){

	tab_btn[i].addEventListener('click', ()=>{

		$('.tab_btn').removeClass('faq_active_tab');
		$('.tab_content').removeClass('active_tab_content');
		$('.tab_content').addClass('d_none');
		tab_content[i].classList.remove('d_none');
		setTimeout(()=>{
			tab_content[i].classList.add('active_tab_content');
			tab_btn[i].classList.add('faq_active_tab');
		}, 20);

	});

}
