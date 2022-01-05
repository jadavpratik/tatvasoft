// ACCORDION IMPLEMENTATION...
var acc = document.getElementsByClassName("accordion");

for (let i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		var panel = this.nextElementSibling;
		const close_img = './assets/img/general/static/faq/right_arrow.png';
		const open_img = './assets/img/general/static/faq/down_arrow.png';
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
