const angle_right_circle = './assets/img/buttons/angle/angle_right_circle.png';
const angle_down_circle = './assets/img/buttons/angle/angle_down_circle.png';

// ACCORDION IMPLEMENTATION...
var acc_btn = document.getElementsByClassName("accordion_btn");

for (let i = 0; i < acc_btn.length; i++) {

	acc_btn[i].addEventListener("click", function() {
		
		var acc_content = this.nextElementSibling;
		if(acc_content.classList.contains('d_none')){
			// CHANGE RIGHT_ARROW -> DOWN_ARROW
			acc_btn[i].children[0].src = angle_down_circle;
			acc_content.classList.remove('d_none');
		}
		else{
			// CHANGE DOWN_ARROW -> RIGHT_ARROW
			acc_btn[i].children[0].src = angle_right_circle;
			acc_content.classList.add('d_none');
		}
	});
}
