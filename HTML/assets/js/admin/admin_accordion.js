            const accordion_btn = document.getElementsByClassName('accordion_btn');
            const accordion_content = document.getElementsByClassName('accordion_content');
            for(let i = 0; i<accordion_btn.length; i++){
                accordion_btn[i].addEventListener('click', function(){
                    if(accordion_btn[i].children[0].classList[1]=='fa-angle-right'){
                        accordion_btn[i].children[0].classList = 'fas fa-angle-down';
                    }
                    else{
                        accordion_btn[i].children[0].classList = 'fas fa-angle-right';
                    }
                    accordion_content[i].classList.toggle('d_none');
                });
            }
