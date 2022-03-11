<div class="block_customer">
    <!-- CARD GENERATED BY JAVASCRIPT -->
</div>

<!-- **********SP-BLOCK-CUSTOMER********** -->
<script>
    function load_my_customers(){
        $.ajax({
            url : `${BASE_URL}/sp-my-customer`,
            method : 'GET',
            success : function(res){
                if(res!=="" && res!==undefined){
                    try{
                        const result = JSON.parse(res);
                        state.sp_my_customer = result;
                        let html = ``;
                        for(let i=0; i<result.length; i++){
                            html += `<div class="block_customer_card">
                                        <div>
                                            <img src="<?= assets('assets/img/table/hat.png'); ?>" alt="">
                                        </div>
                                        <p>${result[i].FirstName} ${result[i].LastName}</p>
                                        ${(function(){
                                            if(result[i].IsBlocked!==undefined && result[i].IsBlocked==1){
                                                return `<button class="block_btn" onclick="action_on_customer(${result[i].UserId}, 'unblock')">Unblock</button>`;
                                            }
                                            else{
                                                return `<button class="block_btn" onclick="action_on_customer(${result[i].UserId}, 'block')">Block</button>`;
                                            }
                                        })()}
                                    </div>`;
                        }
                        $('.block_customer').html(html);
                    }
                    catch(e){
                        console.log('Invalid JSON Response!');
                    }
                }
            },
            error : function(obj){
                if(obj!==undefined){
                    const {responseText} = obj;
                    const error = JSON.parse(responseText);
                    console.log(error.message);
                }
            }
        });
    }

    load_my_customers();
</script>

<!-- **********SP-BLOCK-CUSTOMER********** -->
<script>
    function action_on_customer(id, action){
        let url = ``;
        switch(action){
            case 'block':
                url = `${BASE_URL}/block-customer/${id}`;
                break;
            case 'unblock':
                url = `${BASE_URL}/unblock-customer/${id}`;
                break;
        }

        $.ajax({
            url : url,
            method : 'PATCH',
            success : function(res){
                if(res!==undefined && res!==""){
                    try{
                        const result = JSON.parse(res);
                        Swal.fire({
                            title : result.message,
                            icon : 'success'
                        })
                        load_my_customers();
                    }
                    catch(e){
                        console.log(e);
                        Swal.fire({
                            title : 'Invalid JSON response!',
                            icon : 'error'
                        })
                    }
                }
            },
            error : function(obj){
                if(obj!==undefined){
                    const {responseText} = obj;
                    const error = JSON.parse(responseText);
                    console.log(error.message);
                    Swal.fire({
                        title : error.message,
                        icon : 'error'
                    })
                }
            }
        });
    }
</script>