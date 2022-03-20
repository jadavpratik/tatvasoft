<!-- **********ADD_ADDRESS********** -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- EDIT_ADDRESS -->
    <form class="popup_main d_none" id="add_address_popup">
        <p class="popup_title">Add Address</p>
        <div class="form_group">
            <label class="label" for="">Steet Name</label>
            <input class="input" type="text" name="add_address_street_name">
            <div class="validation_message d_none">
                <p>Enter Stree name!</p>
            </div>
        </div>
        <div class="form_group">
            <label class="label" for="">House Number</label>
            <input class="input" type="text" name="add_address_house_number">
            <div class="validation_message d_none">
                <p>Enter Stree name!</p>
            </div>
        </div>
        <div class="form_group">
            <label class="label" for="">Postal Code</label>
            <input class="input" type="text" name="add_address_postal_code">
            <div class="validation_message d_none">
                <p>Enter Stree name!</p>
            </div>
        </div>
        <div class="form_group">
            <label class="label" for="">City</label>
            <input class="input" type="text" name="add_address_city">
            <div class="validation_message d_none">
                <p>Enter Stree name!</p>
            </div>
        </div>
        <div class="form_group">
            <label class="label" for="">Phone Number</label>
            <div class="phone_number" >
                <label for="">+49</label>
                <input type="text" name="add_address_phone">
            </div>
            <div class="validation_message d_none">
                <p>Enter Stree name!</p>
            </div>
        </div>
        <button class="popup_btn">Add</button>
    </form>
</div>


<!-- **********ADD ADDRESS SCRIPT********** -->
<script>
    $('#add_address_popup').submit((e)=>{
        e.preventDefault();
        let validation = true;

        const validationArr = [add_address_phone_validation(),
                               add_address_street_name_validation(),
                               add_address_house_number_validation(),
                               add_address_city_validation(),
                               add_address_postal_code_validation()];

        for(let i =0; i<validationArr.length; i++){
            if(validationArr[i]==false){
                validation = false;
                break;
            }
        }

        if(validation){
            $.ajax({
                url : `${BASE_URL}/user/address`,
                method : 'POST',
                data : $('#add_address_popup').serialize(),
                success : function(res){
                    if(res!=="" && res!==undefined){
                        try{
                            const result = JSON.parse(res);
                            Swal.fire({
                                title : result.message,
                                icon : 'success'
                            });
                            $('#add_address_popup').trigger('reset');
                            close_model();
                            customer_my_address();
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
    });
</script>