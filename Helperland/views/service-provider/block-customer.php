<div class="block_customer">
    <!-- GENERATED BY JAVASCRIPT -->
</div>

<!-- **********SP-BLOCK-CUSTOMER********** -->
<script>
    function load_sp_customer_data(){
        $.ajax({
            url : `${BASE_URL}/service-provider/customer`,
            method : 'GET',
            success : function(res){
                if(res!=="" && res!==undefined){
                    try{
                        const result = JSON.parse(res);
                        store.service_provider.customer = result;
                        let html = ``;
                        for(let i=0; i<result.length; i++){
                            html += `<div class="block_customer_card">
                                        <div>
                                            <img src="<?= assets('assets/img/table/hat.png'); ?>" alt="">
                                        </div>
                                        <p>${result[i].Name}</p>
                                        ${(function(){
                                            if(result[i].IsBlocked!==undefined && result[i].IsBlocked==1){
                                                return `<button class="block_btn" onclick="action_on_customer(${result[i].Id}, 'unblock')">Blocked</button>`;
                                            }
                                            else{
                                                return `<button class="block_btn" onclick="action_on_customer(${result[i].Id}, 'block')">Block to Customer</button>`;
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
    load_sp_customer_data();
</script>

<!-- **********SP-BLOCK-CUSTOMER********** -->
<script>
    function action_on_customer(id, action){
        let url = ``;
        switch(action){
            case 'block':
                url = `${BASE_URL}/service-provider/customer/block/${id}`;
                break;
            case 'unblock':
                url = `${BASE_URL}/service-provider/customer/unblock/${id}`;
                break;
        }

        $.ajax({
            url : url,
            method : 'PATCH',
            beforeSend : function(){
                // SET LOADER...
                open_loader();
            },
            complete : function(){
                // REMOVE LOADER...
                close_loader();
            },
            success : function(res){
                if(res!==undefined && res!==""){
                    try{
                        const result = JSON.parse(res);
                        Swal.fire({
                            title : result.message,
                            icon : 'success'
                        })
                        load_sp_customer_data();
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