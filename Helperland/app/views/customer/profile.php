<div class="profile">
    <div class="tab_container">
        <div class="tab_indicator profile_tabs">
            <button class="tab_btn active_profile_tab"><div><img src="<?= assets('assets/img/profile/Details.png'); ?>"></div><span>My Details</span></button>
            <button class="tab_btn"><div><img src="<?= assets('assets/img/profile/Address.png'); ?>"></div><span>My Addresses</span></button>
            <button class="tab_btn"><div><img src="<?= assets('assets/img/profile/Password.png'); ?>" alt=""></div><span>Change Password</span></button>
        </div>
        <div class="tab_body">

            <!-- MY DETAILS -->
            <div class="tab_content">
                <form class="my_details" id="customer_my_details">
                    <div class="my_details_inner_div_1">
                        <div class="label_input">
                            <label class="label" for="">First Name</label>
                            <input class="input" type="text" name="firstname" value="<?= isset($details->FirstName)? $details->FirstName : '' ?>">
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="label_input">
                            <label class="label" for="">Last Name</label>
                            <input class="input" type="text" name="lastname" value="<?= isset($details->LastName)? $details->LastName : '' ?>">
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="label_input">
                            <label class="label" for="">Email Address</label>
                            <input class="input" type="text" name="email" value="<?= isset($details->Email)? $details->Email : '' ?>">
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="label_phone_number">
                            <label class="label" for="">Phone Number</label>
                            <div class="phone_number">
                                <label for="">+49</label>
                                <input type="text" name="phone" value="<?= isset($details->Mobile)? $details->Mobile : '' ?>">
                            </div>
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="label_input">
                            <label class="label" for="">Date of Birth</label>
                            <input class="input" type="date" name="dob" value="<?= isset($details->DateOfBirth)? $details->DateOfBirth : '' ?>">
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div><!-- END_GRID_DIV -->
                    </div><!-- END_GRID_DIV -->
                    <div class="my_details_inner_div_2">
                        <div class="label_select">
                            <label class="label" for="">My Preferred Language</label>                            
                            <select class="select" name="language">
                                <option value="1">English</option>
                                <option value="2">Hindi</option>
                            </select>    
                            <script>
                                $('[name="language"]').val(`<?= $details->LanguageId; ?>`);
                            </script>
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <button class="profile_save_btn">Save</button>
                    </div><!-- END_GRID_DIV -->
                </form><!-- END_MY_DETAILS_FORM -->
            </div><!-- END_TAB_CONTENT -->

            <!-- MY ADDRESS -->
            <div class="tab_content d_none">
                <div class="my_addresses">
                    <table>
                        <thead>
                            <tr>
                                <th>Addresses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                             
                            <?php foreach($address as $i){ ?>
                                <tr>
                                    <td>
                                        <div>
                                            <p><span>Address</span> : <?= $i->AddressLine1; ?> <?= $i->AddressLine2; ?>, <?= $i->PostalCode; ?> <?= $i->City; ?></p>
                                            <p><span>Phone Number</span> : <?= $i->Mobile; ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button onclick="open_model('edit_address');"><i class="fas fa-edit"></i></button>
                                            <button><i class="fas fa-trash-alt"></i></button>    
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <button  onclick="open_model('add_address');" class="profile_save_btn">Add New Address</button>
                </div><!-- MY ADDRESSES -->
            </div><!-- TAB CONTENT -->

            <!-- CHANGE-PASSWORD -->
            <div class="tab_content d_none">
                <form class="change_password" id="change_password">
                    <div class="label_input">
                        <label class="label" for="">Old Password</label>
                        <input class="input" type="password" placeholder="Current Password" name="change_password_old">
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <div class="label_input">
                        <label class="label" for="">New Password</label>
                        <input class="input" type="password" placeholder="Password" name="change_password_new">
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <div class="label_input">
                        <label class="label" for="">Confirm Password</label>
                        <input class="input" type="password" placeholder="Confirm Password" name="change_password_confirm">
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <button class="profile_save_btn">Save</button>
                </form>
            </div><!-- END_TAB_CONTENT -->
        </div><!-- END_TAB_BODY -->
    </div><!-- END_TAB_CONTAINER -->
</div><!-- END_PROFILE -->

<!-- UPDATE MY DETAILS SCRIPTS... -->
<script>
    $('#customer_my_details').submit((e)=>{
        e.preventDefault();
        let validation = true;

        validationArr = [firstname_validation(),
                         lastname_validation(),
                         email_validation(),
                         phone_validation(),
                         dob_validation()];

        for(let i=0; i<validationArr.length; i++){
            if(validationArr[i]==false){
                validation = false;
                break;
            }
        }

        if(validation){
            // CONVERTING A FORM DATA INTO JSON DATA....
            let json = form_to_json($('#customer_my_details').serializeArray());
            $.ajax({
                url :  `${proxy_url}/my-details`,
                method : 'PATCH',
                contentType : 'application/json',
                data : JSON.stringify(json),
                success : function(res){
                    if(res!=="" || res!==undefined){
                        try{
                            const result = JSON.parse(res);
                            console.log(result.message);
                            Swal.fire({
                                title : `${result.message}`,
                                icon : 'success'
                            }).then((res)=>{
                                if(res.isConfirmed){
                                    $('#customer_my_details').trigger('reset');
                                    close_model();
                                }
                            });
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
                            title : `${error.message}`,
                            icon : 'error'
                        });
                    }
                }
            });
        }
    });
</script>

<!-- CHANGE PASSWORD SCRIPTS... -->
<script>
    $('#change_password').submit((e)=>{
        e.preventDefault();
        let validation = true;

        const validationArr = [change_password_new_validation(),
                               change_password_old_validation(),
                               change_password_confirm_validation()];

        for(i of validationArr){
            if(i==false){
                validation = false;
                break;
            }
        }

        if(validation){

            let json = form_to_json($('#change_password').serializeArray());

            $.ajax({
                url : `${proxy_url}/change-password`,
                method : 'PATCH',
                contentType : 'application/json',
                data : JSON.stringify(json),
                success : function(res){
                    if(res!=="" || res!==undefined){
                        try{
                            const result = JSON.parse(res);
                            console.log(result.message);
                            Swal.fire({
                                title : `${result.message}`,
                                icon : 'success'
                            }).then((res)=>{
                                if(res.isConfirmed){
                                    $('#change_password').trigger('reset');
                                    close_model();
                                }
                            });
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
                            title : `${error.message}`,
                            icon : 'error'
                        });
                    }
                }
            })
        }

    })
</script>