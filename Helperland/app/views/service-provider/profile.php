<div class="profile">
    <div class="tab_container">
        <div class="tab_indicator profile_tabs">
            <button class="tab_btn active_profile_tab"><div><img src="<?= assets('assets/img/profile/Details.png'); ?>"></div><span>My Details</span></button>
            <button class="tab_btn "><div><img src="<?= assets('assets/img/profile/Password.png'); ?>" alt=""></div><span>Change Password</span></button>
        </div>
        <div class="tab_body">
            <div class="tab_content active_tab_content">
                <div class="sp_my_details">
                    <p class="sp_account_status">Account Status : <span>Active</span></p>
                    <!-- BASIC DETAILS -->
                    <div class="sp_basic_details_container">
                        <!-- TITLE -->
                        <div class="sp_basic_details_title_avatar">
                            <p>Basic Details</p>
                            <div><img class="avatar" src="<?= assets('assets/img/avatar/car.png'); ?>" alt=""></div>
                        </div>
                        <div class="form_group">
                            <label class="label" for="">First Name</label>
                            <input class="input" type="text" name="firstname">
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                        <div class="form_group">
                            <label class="label" for="">Last Name</label>
                            <input class="input" type="text" name="lastname">
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                        <div class="form_group">
                            <label class="label" for="">Email Address</label>
                            <input class="input" type="text" name="email">
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                        <div class="label_phone_number form_group">
                            <label class="label" for="">Phone Number</label>
                            <div class="phone_number">
                                <label for="">+49</label>
                                <input type="text" name="phone">
                            </div>
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                        <div class="label_input">
                            <label class="label" for="">Date of Birth</label>
                            <input class="input" type="date" name="dob">
                            <div class="validation_message d_none">
                                <p>Validaton Message!!!</p>
                            </div>
                        </div>
                        <div class="label_select">
                            <label class="label" for="">Nationality</label>
                            <select class="select" name="" id="">
                                <option value="1">English</option>
                                <option value="2">Hindi</option>
                            </select>
                        </div>
                        <!-- GENDER -->
                        <div class="gender_div">
                            <!-- MALE -->
                            <div>
                                <input type="radio" id="male" name="gender">
                                <label for="male">Male</label>
                            </div>
                            <!-- FEMALE -->
                            <div>
                                <input type="radio" id="female" name="gender">
                                <label for="female">Female</label>
                            </div>
                            <!-- NOT SAY -->
                            <div>
                                <input type="radio" id="no_gender" name="gender" checked>
                                <label for="no_gender">Rather Not to say</label>
                            </div>
                            <!-- <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div> -->
                        </div>
                        <!-- SELECT AVATAR -->
                        <div class="select_avatar_container">
                            <p>Select Avatar</p>
                            <div>
                                <div>
                                    <input type="radio" name="avatar" value="car" checked id="avatar_car">
                                    <label for="avatar_car"><img src="<?= assets('assets/img/avatar/car.png'); ?>" alt=""></label>
                                </div>
                                <div>
                                    <input type="radio" name="avatar" value="female" id="avatar_female">
                                    <label for="avatar_female"><img src="<?= assets('assets/img/avatar/female.png'); ?>" alt=""></label>
                                </div>
                                <div>
                                    <input type="radio" name="avatar" value="hat" id="avatar_hat">
                                    <label for="avatar_hat"><img src="<?= assets('assets/img/avatar/hat.png'); ?>" alt=""></label>
                                </div>
                                <div>
                                    <input type="radio" name="avatar" value="iron" id="avatar_iron">
                                    <label for="avatar_iron"><img src="<?= assets('assets/img/avatar/iron.png'); ?>" alt=""></label>
                                </div>
                                <div>
                                    <input type="radio" name="avatar" value="male" id="avatar_male">
                                    <label for="avatar_male"><img src="<?= assets('assets/img/avatar/male.png'); ?>" alt=""></label>
                                </div>
                                <div>
                                    <input type="radio" name="avatar" value="ship" id="avatar_ship">
                                    <label for="avatar_ship"><img src="<?= assets('assets/img/avatar/ship.png'); ?>" alt=""></label>
                                </div>
                            </div>
                        </div>
                    </div><!-- END BASIC DETAILS CONTAINER -->
                    <!-- MY ADDRESS -->
                    <div class="sp_my_address_container">
                        <div>
                            <p>My Address</p>
                        </div>
                        <div class="form_group">
                            <label class="label" for="">Street Name</label>
                            <input class="input" type="text" name="street_name">
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                        <div class="form_group">
                            <label class="label" for="">House Number</label>
                            <input class="input" type="text" name="house_number">
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                        <div class="form_group">
                            <label class="label" for="">Postal Code</label>
                            <input class="input" type="text" name="postal_code">
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                        <div class="form_group">
                            <label class="label" for="">City</label>
                            <input class="input" type="text" name="city">
                            <div class="validation_message d_none">
                                <p>Validation Message!!!</p>
                            </div>
                        </div>
                    </div><!-- END BASIC DETAILS CONTAINER -->
                    <button class="profile_save_btn">Save</button>
                </div><!-- END SP MY DETAILS -->
            </div><!-- END TAB CONTENT -->
            <div class="tab_content d_none">
                <form class="change_password">
                    <div class="form_group">
                        <label class="label" for="">Old Password</label>
                        <input class="input" type="text" placeholder="Current Password" name="change_password_old">
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <div class="form_group">
                        <label class="label" for="">New Password</label>
                        <input class="input" type="text" placeholder="Password" name="change_password_new">                                            
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <div class="form_group">
                        <label class="label" for="">Confirm Password</label>
                        <input class="input" type="text" placeholder="Confirm Password" name="change_password_confirm">
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <button class="profile_save_btn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

</script>