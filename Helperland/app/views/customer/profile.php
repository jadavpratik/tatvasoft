<div class="profile">
    <div class="tab_container">
        <div class="tab_indicator profile_tabs">
            <button class="tab_btn active_profile_tab"><div><img src="<?= assets('assets/img/profile/Details.png'); ?>"></div><span>My Details</span></button>
            <button class="tab_btn"><div><img src="<?= assets('assets/img/profile/Address.png'); ?>"></div><span>My Addresses</span></button>
            <button class="tab_btn"><div><img src="<?= assets('assets/img/profile/Password.png'); ?>" alt=""></div><span>Change Password</span></button>
        </div>
        <div class="tab_body">
            <div class="tab_content active_tab_content">
                <form class="my_details">
                    <div class="my_details_inner_div_1">
                        <div class="label_input">
                            <label class="label" for="">First Name</label>
                            <input class="input" type="text" name="firstname">
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="label_input">
                            <label class="label" for="">Last Name</label>
                            <input class="input" type="text" name="lastname">
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="label_input">
                            <label class="label" for="">Email Address</label>
                            <input class="input" type="text" name="email">
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="label_phone_number">
                            <label class="label" for="">Phone Number</label>
                            <div class="phone_number">
                                <label for="">+49</label>
                                <input type="text" name="phone">
                            </div>
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <div class="date_of_birth">
                            <label class="label" for="">Date of Birth</label>
                            <div>
                                <select class="select" name="" id="">
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                                <select class="select" name="" id="">
                                    <option value="">March</option>
                                    <option value="">April</option>
                                </select>
                                <select class="select" name="" id="">
                                    <option value="">2000</option>
                                    <option value="">2001</option>
                                </select>
                            </div><!-- END_INNER_DIV -->
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div><!-- END_GRID_DIV -->
                    </div><!-- END_GRID_DIV -->
                    <div class="my_details_inner_div_2">
                        <div class="label_select">
                            <label class="label" for="">My Preferred Language</label>
                            <select class="select" name="language" id="">
                                <option value=""></option>
                                <option value="english">English</option>
                                <option value="hindi">Hindi</option>
                                <option value="gujarati">Gujarati</option>
                            </select>    
                            <div class="validation_message d_none">
                                <p>Validation Message!</p>
                            </div>
                        </div>
                        <button class="profile_save_btn">Save</button>
                    </div><!-- END_GRID_DIV -->
                </form><!-- END_MY_DETAILS_FORM -->
            </div><!-- END_TAB_CONTENT -->
            <div class="tab_content d_none">
                <div class="my_addresses">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Addresses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <p><span>Address</span> : Koenigstrasse 112, 99897 Tambach-Dietharz</p>
                                        <p><span>Phone Number</span> : 9955648797</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <button onclick="open_model('edit_address');"><i class="fas fa-edit"></i></button>
                                        <button><i class="fas fa-trash-alt"></i></button>    
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <p><span>Address</span> : Koenigstrasse 112, 99897 Tambach-Dietharz</p>
                                        <p><span>Phone Number</span> : 9955648797</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <button><i class="fas fa-edit"></i></button>
                                        <button><i class="fas fa-trash-alt"></i></button>    
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <p><span>Address</span> : Koenigstrasse 112, 99897 Tambach-Dietharz</p>
                                        <p><span>Phone Number</span> : 9955648797</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <button><i class="fas fa-edit"></i></button>
                                        <button><i class="fas fa-trash-alt"></i></button>    
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <p><span>Address</span> : Koenigstrasse 112, 99897 Tambach-Dietharz</p>
                                        <p><span>Phone Number</span> : 9955648797</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <button><i class="fas fa-edit"></i></button>
                                        <button><i class="fas fa-trash-alt"></i></button>    
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button  onclick="open_model('add_address');" class="profile_save_btn">Add New Address</button>
                </div><!-- MY ADDRESSES -->
            </div><!-- TAB CONTENT -->
            <div class="tab_content d_none">
                <form class="change_password">
                    <div class="label_input">
                        <label class="label" for="">Old Password</label>
                        <input class="input" type="text" placeholder="Current Password" name="change_password_old">
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <div class="label_input">
                        <label class="label" for="">New Password</label>
                        <input class="input" type="text" placeholder="Password" name="change_password_new">
                        <div class="validation_message d_none">
                            <p>Validation Message!!!</p>
                        </div>
                    </div>
                    <div class="label_input">
                        <label class="label" for="">Confirm Password</label>
                        <input class="input" type="text" placeholder="Confirm Password" name="change_password_confirm">
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
