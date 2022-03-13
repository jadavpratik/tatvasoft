<!-- **********RATING-POPUP********** -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- RATING_POPUP -->
    <form id="rating_popup" class="popup_main d_none">
        <!-- ON RATE SERVICE PROVIDER  -->
        <div class="service_provider">
            <img class="hat_style" src="<?= assets('assets/img/table/hat.png'); ?>" alt="">
            <div>
                <p>Lyum Watson</p>
                <div>
                    <i class="fas fa-star rated_star"></i>
                    <i class="fas fa-star rated_star"></i>
                    <i class="fas fa-star rated_star"></i>
                    <i class="fas fa-star rated_star"></i>
                    <i class="fas fa-star rated_star"></i>
                    <span>5</span>
                </div>
            </div>
        </div><!-- END-SERVICE-PROVIDER -->
        <div class="rate_type">
            <div class="rating_container">
                <p>On Time Arriaval</p>    
                <div class="rating_div">
                    <input type="radio" id="arrival_rating_5" name="arrival_rating" value="5">
                    <label for="arrival_rating_5"><i class="fas fa-star unrated_star"></i></label>    
                    <input type="radio" id="arrival_rating_4" name="arrival_rating" value="4">
                    <label for="arrival_rating_4"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="arrival_rating_3" name="arrival_rating" value="3">
                    <label for="arrival_rating_3"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="arrival_rating_2" name="arrival_rating" value="2">
                    <label for="arrival_rating_2"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="arrival_rating_1" name="arrival_rating" value="1">
                    <label for="arrival_rating_1"><i class="fas fa-star unrated_star"></i></label>
                </div>
            </div>
            <div class="rating_container">
                <p>Friendly</p>    
                <div class="rating_div">
                    <input type="radio" id="friendly_rating_5" name="friendly_rating" value="5">
                    <label for="friendly_rating_5"><i class="fas fa-star unrated_star"></i></label>    
                    <input type="radio" id="friendly_rating_4" name="friendly_rating" value="4">
                    <label for="friendly_rating_4"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="friendly_rating_3" name="friendly_rating" value="3">
                    <label for="friendly_rating_3"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="friendly_rating_2" name="friendly_rating" value="2">
                    <label for="friendly_rating_2"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="friendly_rating_1" name="friendly_rating" value="1">
                    <label for="friendly_rating_1"><i class="fas fa-star unrated_star"></i></label>
                </div>
            </div>
            <div class="rating_container">
                <p>Quality of Service</p>    
                <div class="rating_div">
                    <input type="radio" id="quality_rating_5" name="quality_rating" value="5">
                    <label for="quality_rating_5"><i class="fas fa-star unrated_star"></i></label>    
                    <input type="radio" id="quality_rating_4" name="quality_rating" value="4">
                    <label for="quality_rating_4"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="quality_rating_3" name="quality_rating" value="3">
                    <label for="quality_rating_3"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="quality_rating_2" name="quality_rating" value="2">
                    <label for="quality_rating_2"><i class="fas fa-star unrated_star"></i></label>
                    <input type="radio" id="quality_rating_1" name="quality_rating" value="1">
                    <label for="quality_rating_1"><i class="fas fa-star unrated_star"></i></label>
                </div>
            </div>                        
        </div>
        <div class="rating_feedback">
            <p>Feedback on Service Provider</p>
            <textarea class="textarea" name="rating_feedback"></textarea>
            <div class="validation_message d_none">
                <p>Validation Message!!</p>
            </div>
            <button class="popup_btn">Submit</button>            
        </div>
    </form><!-- END-RATING POPUP -->
</div><!-- END-MODEL -->

<!-- **********RATING-SCRIPTS********** -->
<script>
    $('#rating_popup').submit((e)=>{
        
        e.preventDefault();
        let validation = rating_feedback_validation();        

        if(validation){
            $.ajax({
                url : `${BASE_URL}/rate-sp/${state.rate_service_id}`,
                method : 'POST',
                data : $('#rating_popup').serialize(),
                success : function(res){
                    if(res!=="" && res!==undefined){
                        try{
                            const result = JSON.parse(res);
                            Swal.fire({
                                title : result.message,
                                icon : 'success'
                            });
                            $('#rating_popup').trigger('reset');
                            state.customer_service_history_table.ajax.reload();
                            close_model();
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
                            icon : 'warning'
                        });
                    }
                }
            });
        }
    });
</script>
