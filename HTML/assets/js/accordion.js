const right_arrow = './assets/img/general/static/faq/right_arrow.png';
const down_arrow = './assets/img/general/static/faq/down_arrow.png';

// ACCORDION IMPLEMENTATION...
var acc_btn = document.getElementsByClassName("accordion_btn");

for (let i = 0; i < acc_btn.length; i++) {

	acc_btn[i].addEventListener("click", function() {
		
		var acc_content = this.nextElementSibling;
		if(acc_content.classList.contains('d_none')){
			// CHANGE RIGHT_ARROW -> DOWN_ARROW
			acc_btn[i].children[0].src = down_arrow;
			acc_content.classList.remove('d_none');
		}
		else{
			// CHANGE DOWN_ARROW -> RIGHT_ARROW
			acc_btn[i].children[0].src = right_arrow;
			acc_content.classList.add('d_none');
		}
	});
}
