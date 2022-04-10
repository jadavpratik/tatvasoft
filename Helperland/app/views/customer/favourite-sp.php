<div class="favourite_pros">
    <!-- CARD WILL BE DYNAMIC GENERATED BY JS  -->
</div><!-- END FAVOURITE_PROS -->

<!-- **********CUSTOMER-FAVORITE-SECTION-SCRIPTS********** -->
<script>
    function load_customer_sp_data(){
        $.ajax({
            url : `${BASE_URL}/customer/sp`,
            method : 'GET',
            success : function(res){
                if(res!=="" && res!==undefined){
                    try{
                        const spList = JSON.parse(res);
                        // STORE DATA GLOBALLY...
                        store.customer.data.service_providers = spList;
                        let html = ``;    
                        for(sp of spList){
                            html += `<div class="favourite_pros_card">
                                        <div class="service_provider">
                                            <img class="hat_style" src="${BASE_URL}/assets/img/avatar/${sp.ProfilePicture}.png" alt="">
                                            <div>
                                                <p>${sp.Name}</p>    
                                                <div>
                                                    ${(function(){
                                                        let html = ``;
                                                        if(sp.Ratings!==null){
                                                            for(let i=0; i<parseInt(sp.Ratings); i++){
                                                                html += `<i class="fas fa-star rated_star"></i>`;
                                                            }
                                                            for(let i=0; i<5-parseInt(sp.Ratings); i++){
                                                                html += `<i class="fas fa-star unrated_star"></i>`;
                                                            }
                                                        }
                                                        else{
                                                            html = `<i class="fas fa-star unrated_star"></i>
                                                                    <i class="fas fa-star unrated_star"></i>
                                                                    <i class="fas fa-star unrated_star"></i>
                                                                    <i class="fas fa-star unrated_star"></i>
                                                                    <i class="fas fa-star unrated_star"></i>`;
                                                        }
                                                        return html;
                                                    })()}
                                                    <span>${sp.Ratings!==null?parseFloat(sp.Ratings):''}</span>
                                                </div>
                                            </div>
                                        </div><!-- END SERVICE PROVIDER -->
                                        <!-- <div>
                                            <p><span>16</span> Cleaning</p>
                                        </div> -->
                                        <div class="table_btn_container">
                                            ${(function(){
                                                let buttons = ``;
                                                if(sp.IsFavorite==1){
                                                    buttons += `<button class="remove_btn" onclick="action_on_sp(${sp.Id}, 'remove')">Favorite</button>`;
                                                }
                                                else{
                                                    buttons += `<button class="remove_btn" onclick="action_on_sp(${sp.Id}, 'add')">Add Favorite</button>`;
                                                }
                                                if(sp.IsBlocked==1){
                                                    buttons += `<button class="block_btn" onclick="action_on_sp(${sp.Id}, 'unblock')">Blocked</button>`;
                                                }
                                                else{
                                                    buttons += `<button class="block_btn" onclick="action_on_sp(${sp.Id}, 'block')">Block Customer</button>`;
                                                }
                                                return buttons;
                                            })()}
                                        </div><!-- END TABLE BTN CONTAINER -->    
                                    </div><!-- END FAVOURITE_PROS_CARD -->`;
                        }
                        $('.favourite_pros').html(html);
                    }
                    catch(e){
                        Swal.fire({
                            title : 'Invalid JSON Response!',
                            icon : 'error'
                        })
                    }
                }
            },
            error : function(obj){
                if(obj!==undefined && obj!==""){
                    const {responseText} = obj;
                    const error = JSON.parse(responseText);
                    Swal.fire({
                        title : error.message,
                        icon : 'error'
                    });
                }
            }
        });
    }
    load_customer_sp_data();
</script>


<!-- **********ACCTION-ON-SP-SCRIPTS********** -->
<script>
    function action_on_sp(sp_id, action){
        let url = ``;
        switch(action){
            case 'add':
                url = `${BASE_URL}/customer/sp/favorite/${sp_id}`;
                break;
            case 'remove':
                url = `${BASE_URL}/customer/sp/unfavorite/${sp_id}`;
                break;
            case 'block':
                url = `${BASE_URL}/customer/sp/block/${sp_id}`;
                break;
            case 'unblock':
                url = `${BASE_URL}/customer/sp/unblock/${sp_id}`;
                break;
        }
        if(url!==''){
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
                    if(res!=="" && res!==undefined){
                        try{
                            const result = JSON.parse(res);
                            Swal.fire({
                                title : result.message,
                                icon : 'success'
                            });
                            load_customer_sp_data();
                        }
                        catch(e){
                            Swal.fire({
                                title : 'Invalid JSON Response!',
                                icon : 'error'
                            })
                        }
                    }
                },
                error : function(obj){
                    if(obj!==undefined && obj!==""){
                        const {responseText} = obj;
                        const error = JSON.parse(responseText);
                        Swal.fire({
                            title : error.message,
                            icon : 'error'
                        });
                    }
                }
            });
        }
    }
</script>