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


<script>

    $('#setup_service_submit_btn').click(function(){

        let validation = setup_service_postal_code_validation();
        
        if(validation){
            const postal_code = $('[name="setup_service_postal_code"]').val();
            let data = JSON.stringify({postal_code});

            $.ajax({
                url :  `${proxy_url}/check-postal-code`,
                method : 'POST',
                contentType : 'application/json',
                data : data,
                success : function(res){
                    if(res!=="" || res!==undefined){
                        const result = JSON.parse(res);
                        if(result.message!=""){
                            // STORE POSTAL CODE...
                            service_request.postal_code = parseInt(postal_code);
                            change_book_service_tabs(1);
                        }
                        else{
                            Swal.fire({
                                title : 'Something Went Wrong!',
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