<div class="favourite_pros">
    <!-- CARD WILL BE DYNAMIC GENERATED BY JS  -->
</div><!-- END FAVOURITE_PROS -->

<!-- **********CUSTOMER-FAVORITE-SECTION-SCRIPTS********** -->
<script>
    function load_customer_favorite_section_data(){
        $.ajax({
            url : `${BASE_URL}/customer-my-service-provider`,
            method : 'GET',
            success : function(res){
                if(res!=="" && res!==undefined){
                    try{
                        const spList = JSON.parse(res);
                        let html = ``;    
                        for(sp of spList){
                            html += `<div class="favourite_pros_card">
                                        <div class="service_provider">
                                            <img class="hat_style" src="${BASE_URL}/assets/img/avatar/${sp.UserProfilePicture}.png" alt="">
                                            <div>
                                                <p>${sp.FirstName} ${sp.LastName}</p>    
                                                <div>
                                                    ${(function(){
                                                        let html = ``;
                                                        if(sp.Rating!==undefined && sp.Rating!==""){
                                                            for(let i=0; i<parseInt(sp.Rating); i++){
                                                                html += `<i class="fas fa-star rated_star"></i>`;
                                                            }
                                                            for(let i=0; i<5-parseInt(sp.Rating); i++){
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
                                                    <span>${sp.Rating!==undefined?parseFloat(sp.Rating):''}</span>
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
                                                    buttons += `<button class="remove_btn" onclick="action_on_sp(${sp.UserId}, 'remove');">Remove</button>`;
                                                }
                                                else{
                                                    buttons += `<button class="remove_btn" onclick="action_on_sp(${sp.UserId}, 'add');">Add</button>`;
                                                }
                                                if(sp.IsBlocked==1){
                                                    buttons += `<button class="block_btn" onclick="action_on_sp(${sp.UserId}, 'unblock');">Unblock</button>`;
                                                }
                                                else{
                                                    buttons += `<button class="block_btn" onclick="action_on_sp(${sp.UserId}, 'block');">Block</button>`;
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
    load_customer_favorite_section_data();
</script>


<!-- **********ACCTION-ON-SP-SCRIPTS********** -->
<script>
    function action_on_sp(sp_id, action){
        let url = ``;
        switch(action){
            case 'add':
                url = `${BASE_URL}/favorite/${sp_id}`;
                break;
            case 'remove':
                url = `${BASE_URL}/unfavorite/${sp_id}`;
                break;
            case 'block':
                url = `${BASE_URL}/block-sp/${sp_id}`;
                break;
            case 'unblock':
                url = `${BASE_URL}/unblock-sp/${sp_id}`;
                break;
        }
        if(url!==''){
            $.ajax({
                url : url,
                method : 'PATCH',
                success : function(res){
                    if(res!=="" && res!==undefined){
                        try{
                            const result = JSON.parse(res);
                            Swal.fire({
                                title : result.message,
                                icon : 'success'
                            });
                            load_customer_favorite_section_data();
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