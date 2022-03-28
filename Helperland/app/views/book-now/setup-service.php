<div class="setup_service">
    <div class="form_group">
        <label class="label" for="">Enter your Postal Code</label>
        <input class="input" type="text" placeholder="Postal Code" name="setup_service_postal_code">
        <div class="validation_message d_none">
            <p>Please Enter Postal Code!</p>
        </div>
    </div>
    <div class="form_group">
        <label for="">Temp Label</label>
        <button id="setup_service_submit_btn" class="book_service_btn">Check Availability</button>
    </div>
</div>


<!-- **********BOOK-SERVICE-S1-SCRIPTS********** -->
<script>

    $('#setup_service_submit_btn').click(function(){

        let validation = setup_service_postal_code_validation();
        
        if(validation){
            const postal_code = $('[name="setup_service_postal_code"]').val();
            let json = JSON.stringify({postal_code});
            $.ajax({
                url :  `${BASE_URL}/book-service/check-postal-code`,
                method : 'POST',
                contentType : 'application/json',
                data : json,
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
                            // STORE POSTAL CODE...
                            store.book_service.postal_code = parseInt(postal_code);
                            change_book_service_tabs(1);
                        }
                        catch(e){
                            Swal.fire({
                                title : 'Invalid JSON Response!',
                                icon : 'error'
                            });
                        }
                    }
                },
                error : function(obj){
                    if(obj!==undefined){
                        const {responseText, status} = obj;
                        const error = JSON.parse(responseText);
                        Swal.fire({
                            title : error.message,
                            icon : 'error'
                        });
                    }
                }
            });
        }
    });    
</script>

<script>
    // ON CHANGE POSTAL CODE STORE IN SERVICE REQUEST OBJECT...
    $('[name="setup_service_postal_code"]').focusout(function(){
        const postal_code = $('[name="setup_service_postal_code"]').val();
        store.book_service.postal_code = parseInt(postal_code);
    });
</script>