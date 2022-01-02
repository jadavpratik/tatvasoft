function showContent(id){
	// HIDE ALL TAB_CONTENT...
	$('.tab_content').addClass('d_none');
	// SHOW PERTICULAR CONTENT...
	$(`#${id}`).removeClass('d_none');
}

$('.left_tab').click(()=>{
	$('.left_tab').addClass('active_tab');
	$('.right_tab').removeClass('active_tab');
	showContent('left');
});

$('.right_tab').click(()=>{
	$('.right_tab').addClass('active_tab');
	$('.left_tab').removeClass('active_tab');
	showContent('right');
});

// BY DEFAULT LEFT CONTENT...
showContent('left');


// ACCORDION IMPLEMENTATION...
var acc = document.getElementsByClassName("accordion");

for (let i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		var panel = this.nextElementSibling;
		const close_img = './assets/img/faq/right_arrow.png';
		const open_img = './assets/img/faq/down_arrow.png';

		if(this.classList.contains('close_accordion')){
			this.firstChild.src = open_img;
			this.classList.remove('close_accordion');
		}
		else{
			this.firstChild.src = close_img;
			this.classList.add('close_accordion');
		}
		panel.classList.toggle('d_none');
	});
}
