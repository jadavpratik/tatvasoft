<!-- **********CANCEL_SERVICE_REQUEST********** -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- CANCEL_SERVICE_REQUEST -->
    <form class="popup_main d_none" id="cancel_service_request_popup">
        <p class="popup_title">Cancel Service Request</p>
        <div class="form_group">
            <label class="label" for="">Why you want to cancel the service request?</label>
            <textarea class="textarea" name="cancel_service_reason"></textarea>
            <div class="validation_message d_none">
                <p>Validation message!!!</p>
            </div>
        </div>
        <button class="popup_btn">Cancel Now</button>
    </form>
</div>

<script>
    $('#cancel_service_request_popup').submit((e)=>{
        e.preventDefault();

        let validation = cancel_service_validation();

        if(validation){
            let json = JSON.stringify({
                reason : $('[name="cancel_service_reason"]').val(),
                service_id : state.cancel_service_id
            });
            $.ajax({
                url : `${BASE_URL}/cancel-service/${state.cancel_service_id}`,
                method : 'PATCH',
                contentType : 'application/json',
                data : json,
                success : function(res){
                    if(res!=="" && res!==undefined){
                        try{
                            const result = JSON.parse(res);
                            Swal.fire({
                                title : result.message,
                                icon : 'success'
                            });
                            $('[name="cancel_service_reason"]').val('');
                            // RELOAD CURRENT SERVICE REQUESTS TABLE...
                            state.customer_dashboard_table.ajax.reload();
                            close_model();
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
    });
</script>