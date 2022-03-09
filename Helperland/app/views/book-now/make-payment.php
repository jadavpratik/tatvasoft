<div class="make_payment">
    <div>
        <p>Pay Securely with Helperland payment gateway!</p>
        <div>
            <div class="label_input">
                <label class="label" for="">Promo Code (Optional)</label>
                <input class="input" type="text" placeholder="Optional" name="promo_code" readonly>
            </div>
            <button class="book_service_outline_btn">Apply</button>	
        </div>
    </div>
    <div class="label_input">
        <div>
            <input type="text" placeholder="XXXX-XXXX-XXXX-XXXX" value="1111-1111-1111-1111" readonly>
            <input type="text" placeholder="MM/YY" value="11/24" readonly>	
            <input type="text" placeholder="CVV/CVC" value="123" readonly>
        </div>
        <div>
            <p>Accepeted Card</p>
            <div>
                <img title="Visa Card" src="<?= assets('assets/img/customer/book_service/visa.png'); ?>" alt="">
                <img title="Master Card" src="<?= assets('assets/img/customer/book_service/master_card.png'); ?>" alt="">
                <img title="American Express" src="<?= assets('assets/img/customer/book_service/american_express.png'); ?>" alt="">
            </div>
        </div>
    </div>
    <div>
        <input type="checkbox" name="TermCheckBox">
        <label for="">I accept the <a href="javascript:void(0);">term and condition</a>. the <a href="javascript:void(0);">cancellation policy</a> and the <a href="javascript:void(0);">privacy policy</a>. i confirm that helperland start to execute that contract before the expiry of the withdrawal period and i lose my right of withdrawal as consumer with full performance of the contract.</label>
    </div>
    <button id="confirm_booking_submit_btn" class="book_service_btn" disabled>Complete Booking</button>
</div>

<!-- **********BOOK-SERVICE-S4-SCRIPTS********** -->
<script>
    $('[name="TermCheckBox"]').click(()=>{
        if($('[name="TermCheckBox"]').prop('checked')){
            $('#confirm_booking_submit_btn').prop('disabled', false);
        }
        else{
            $('#confirm_booking_submit_btn').prop('disabled', true);
        }
    });

    // SECTION-4-BTN-CLICK...
    $('#confirm_booking_submit_btn').click(function(){
        $.ajax({
            url : `${BASE_URL}/book-now`,
            method : 'POST',
            contentType : 'application/json',
            data : JSON.stringify(service_request),
            success : function(res){
                if(res!=="" || res!==undefined){
                    try{
                        const result = JSON.parse(res);
                        Swal.fire({
                            title : result.message,
                            text : `Service Request Id = ${result.id}`,
                            icon : 'success'
                        }).then((res)=>{
                            if(res.isConfirmed){
                                location.reload();
                            }
                        });
                    }
                    catch(e){
                        Swal.fire({
                            title : 'Invalid Json Response!',
                            icon : 'error'
                        });
                    }
                }
            },
            error : function(obj){
                if(obj!==undefined){
                    const {status, responseText} = obj;
                    const error = JSON.parse(responseText);
                    Swal.fire({
                        title : 'Error',
                        text : error.message,
                        icon : 'error'
                    })
                }
            }
        });
    });
</script>