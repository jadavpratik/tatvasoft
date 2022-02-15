<div class="your_details">
    <!-- ADDRESS INFORM OF RADIO BUTTON -->
    <div class="label_input">
        <label class="label" for="">Enter your contact details so we can serve you in better way!</label>
        <div id="user_radio_address_container">
            <!-- ADDRESS DYNAMIC LOADED BY JAVASCRIPT -->
        </div>
        <button class="book_service_outline_btn" id="open_address_form_btn"><i class="fas fa-plus"></i>Add Address</button>
        <!-- ADDRESS FORM AUTOMETIC FILL BY CHOOSE A RADIO BUTTON -->
        <form class="address_form d_none" id="address_form">
            <div class="label_input">
                <label class="label" for="">Street Name</label>
                <input class="input" type="text" name="address_form_street_name">
                <div class="validation_message d_none">
                    <p>Validation Message</p>
                </div>
            </div>
            <div class="label_input">
                <label class="label" for="">House Number</label>
                <input class="input" type="text" name="address_form_house_number">
                <div class="validation_message d_none">
                    <p>Validation Message</p>
                </div>
            </div>
            <div class="label_input">
                <label class="label" for="">Postal Code</label>
                <input class="input" type="text" name="address_form_postal_code">
                <div class="validation_message d_none">
                    <p>Validation Message</p>
                </div>
            </div>
            <div class="label_input">
                <label class="label" for="">City</label>
                <input class="input" type="text" name="address_form_city">
                <div class="validation_message d_none">
                    <p>Validation Message</p>
                </div>
            </div>
            <div class="label_input">
                <label class="label" for="">Phone Number</label>
                <div class="phone_number" name="address_form_phone">
                    <label for="">+49</label>
                    <input type="text">
                </div>
                <div class="validation_message d_none">
                    <p>Validation Message</p>
                </div>
            </div>
            <div>
                <button class="book_service_btn">Save</button>
                <button class="book_service_outline_btn" id="close_address_form_btn">Cancel</button>
            </div>
        </form>								
    </div>
    <div>
        <label class="label" for="">Your Favourite Service Providers</label>
        <p>You can choose your favourite service provider from the below list</p>
        <!-- LIST OF SERVICE PROVIDER -->
        <div>
            <div class="form_group">
                <input type="radio" id="favourite_sp1" name="favourite_sp">
                <label class="your_details_sp_card" for="favourite_sp1">
                    <img src="<?= assets('assets/img/avatar/hat.png'); ?>" alt="">
                    <p>Ram Patel</p>
                    <p class="book_service_outline_btn">Select</p>
                </label>	
            </div>
            <div class="form_group">
                <input type="radio" name="favourite_sp" id="favourite_sp2">
                <label class="your_details_sp_card" for="favourite_sp2">
                    <img src="<?= assets('assets/img/avatar/hat.png'); ?>" alt="">
                    <p>Laxman Chaudhari</p>
                    <p class="book_service_outline_btn">Select</p>
                </label>	
            </div>
            <div class="form_group">
                <input type="radio" name="favourite_sp" id="favourite_sp3">
                <label class="your_details_sp_card" for="favourite_sp3">
                    <img src="<?= assets('assets/img/avatar/hat.png'); ?>" alt="">
                    <p>Laxman Chaudhari</p>
                    <p class="book_service_outline_btn">Select</p>
                </label>
            </div>
            <div class="form_group">
                <input type="radio" name="favourite_sp" id="favourite_sp4">
                <label class="your_details_sp_card" for="favourite_sp4">
                    <img src="<?= assets('assets/img/avatar/hat.png'); ?>" alt="">
                    <p>Laxman Chaudhari</p>
                    <p class="book_service_outline_btn">Select</p>
                </label>
            </div>
        </div>
    </div>
    <div class="validation_message d_none">
        <p>Validation Message</p>
    </div>
    <button id="your_details_submit_btn" class="book_service_btn">Continue</button>
</div>


<script>
    let loggedUserId = `<?php echo session('userId'); ?>`;
    $.ajax({
        url : `${proxy_url}/get-user-address/${loggedUserId}`,
        method : 'GET',
        success : function(res){
            if(res!=="" || res!==undefined){
                const result = JSON.parse(res);
                const addressArr = result.address;
                const addressContainer = document.getElementById('user_radio_address_container');
                addressContainer.innerHTML = '';
                addressArr.forEach((i)=>{
                    addressContainer.innerHTML += `<div class="radio_address">
                        <input type="radio" id="radio_address_${i.AddressId}" name="service_booking_address" value="${i.AddressId}">
                        <label for="radio_address_${i.AddressId}">
                            <div>
                                <p><span>Address</span> : ${i.AddressLine1} ${i.AddressLine2}, ${i.PostalCode}, ${i.City}</p>
                                <p><span>Phone Number</span> : ${i.Mobile}</p>
                            </div>
                        </label>
                    </div>`;
                });
            }
        },
        error : function(obj){

        }
    });

    // IF USER HAS NOT A ADDRESS...
    $('#address_form').submit((e)=>{
        e.preventDefault();
        let validation = true;
        const validationArr = [address_form_street_name_validation(),
                               address_form_house_number_validation(),
                               address_form_postal_code_validation(),
                               address_form_city_validation(),
                               address_form_phone_validation()]
        for(let i=0; i<validationArr.length; i++){
            validationArr
        }
        console.log();
    });

</script>