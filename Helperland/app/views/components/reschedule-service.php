<!-- **********RESCHEDULE_SERVICE********** -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- RESCHEDULE_SERVICE_REQUEST -->
    <form class="popup_main d_none" id="reschedule_service_request_popup">
        <p class="popup_title">Reschedule Service Request</p>
        <div class="form_group">
            <label class="label" for="">Select New Date & Time</label>
            <div>
                <input class="input" type="date" name="reschedule_service_date">
                <input class="input" type="time" name="reschedule_service_time">
            </div>
            <div class="validation_message d_none">
                <p>validaton message!!!</p>
            </div>
            <button class="popup_btn">Update</button>
        </div>
    </form>
</div>
    
<script>
    $('#reschedule_service_request_popup').submit((e)=>{

        e.preventDefault();

        let validation = reschedule_service_validation();
        
        if(validation){
            let json = JSON.stringify({
                new_service_date : $('[name="reschedule_service_date"]').val(),
                new_service_time : $('[name="reschedule_service_time"]').val(),
                service_id : state.cancel_service_id,
            });

            $.ajax({
                url : `${BASE_URL}/reschedule-service/${state.cancel_service_id}`,
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