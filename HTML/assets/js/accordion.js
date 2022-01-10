// ACCORDION IMPLEMENTATION...
const acc_btn = document.getElementsByClassName("accordion_btn");
const acc_content = document.getElementsByClassName("accordion_content");

for (let i = 0; i < acc_btn.length; i++) {

	acc_btn[i].addEventListener("click", function() {
		
		const panel = acc_content[i];
		if(panel.style.maxHeight){//close
			acc_btn[i].children[0].style = 'transform:rotate(0deg)';
			panel.style.maxHeight = null;
		}
		else{//open
			acc_btn[i].children[0].style = 'transform:rotate(90deg)';
			panel.style.maxHeight = panel.scrollHeight + 'px';
		}
	});
}
