<!-- **********RATING-POPUP********** -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- RATING_POPUP -->
    <form class="popup_main d_none" id="rating_popup">
        <div class="service_provider">
            <img class="hat_style" src="<?= assets('assets/img/table/hat.png'); ?>" alt="">
            <div>
                <p>Lyum Watson</p>    
                <div>
                    <i class="fas fa-star unrated_star"></i>
                    <i class="fas fa-star unrated_star"></i>
                    <i class="fas fa-star unrated_star"></i>
                    <i class="fas fa-star unrated_star"></i>
                    <i class="fas fa-star unrated_star"></i>
                    <span>4</span>
                </div>
            </div>
        </div>
        <!-- NEED TO TEXT ALIGN LEFT -->
        <p class="popup_title" style="text-align: left;">Rate your Service Provider</p>
        <div class="rate_type">
            <div>
                <p>On time arrival</p>    
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star unrated_star"></i>
                <i class="fas fa-star unrated_star"></i>
                <i class="fas fa-star unrated_star"></i>
            </div>
            <div>
                <p>Friendly</p>    
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star unrated_star"></i>
                <i class="fas fa-star unrated_star"></i>
            </div>
            <div>
                <p>Quality of Service</p>
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star rated_star"></i>
                <i class="fas fa-star unrated_star"></i>
            </div>
        </div><!-- RATE TYPE -->
        <div>
            <div class="form_group">
                <label class="label" for="">Feedback on service provider</label>
                <textarea class="textarea" name="rating_feedback"></textarea>
                <div class="validation_message d_none">
                    <p>Enter Feedback</p>
                </div>
            </div>
            <button class="popup_btn">Submit</button>
        </div>
    </form><!-- RATING POPUP -->
</div>

