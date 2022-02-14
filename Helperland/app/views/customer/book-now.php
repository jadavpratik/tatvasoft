<?= component('header'); ?>

<!-- --------------------------------------------------- -->
                    <!-- BOOK A SERVICE -->
<!-- --------------------------------------------------- -->

<!-- BOOK A SERVICE -->
<div class="banner">
    <img src="<?= assets('assets/img/banner/book_service.png'); ?>" alt="">
</div>

<main class="book_service">

    <div class="title_with_icon">
        <p>Set up your Cleaning Service</p>
        <div>
            <div><img src="<?= assets('assets/img/global/separator.png'); ?>" alt=""></div>
        </div>
    </div>

    <div class="book_service_container">
        <!-- BOOK SERVICES TABS -->
        <div class="book_service_tabs">
            <!-- TAB BTNS CONTAINER -->
            <div>
                <button class="tab_btn">
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/setup_service.png'); ?>" alt="">
                    </div>
                    <p>Setup Service</p>
                </button>
                <button class="tab_btn">
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/schedule_plan.png'); ?>" alt="">
                    </div>
                    <p>Schedule & Plan</p>
                </button>
                <button class="tab_btn">
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/user_details.png'); ?>" alt="">
                    </div>
                    <p>Your Details</p>
                </button>
                <button class="tab_btn active_book_service_tab">
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/payment.png'); ?>" alt="">
                    </div> 
                    <p>Make Payment</p>
                </button>
            </div>

            <!-- TAB BODY FOR CONTENTS -->
            <div>

                <!-- SETUP_SERVICE -->
                <div class="tab_content d_none">
                    <div class="setup_service">
                        <div class="label_input">
                            <label class="label" for="">Enter your Postal Code</label>
                            <input class="input" type="text" placeholder="Postal Code">
                        </div>
                        <button class="book_service_btn">Check Availability</button>
                    </div>
                </div>

                <!-- SCHEDULE_PLAN -->
                <div class="tab_content d_none">
                    <div class="schedule_plan">
                        <!-- FIRST DIV... -->
                        <div class="label_select">
                            <label class="label" for="">Select Number of Rooms and Bath</label>
                            <div>
                                <select class="select" name="" id="">
                                    <option value="">1 Bed</option>
                                </select>
                                <select class="select" name="" id="">
                                    <option value="">1 Bath</option>
                                </select>
                            </div>
                        </div>
                        <!-- SECOND_DIV -->
                        <div>
                            <div class="label_select">
                                <label class="label" for="">When do you need cleaner?</label>
                                <div>
                                    <div class="from_date">
                                        <label style="padding-bottom:0;" for=""><img src="<?= assets('assets/img/table/calendar_blue.png'); ?>" alt=""></label>
                                        <input type="date">
                                    </div>
                                    <select class="select" name="" id="">
                                        <option value="">2:00PM</option>
                                    </select>	
                                </div>
                            </div>
                            <div class="label_select">
                                <label class="label" for="">How long do you need your cleaner to stay?</label>
                                <select class="select" name="" id="">
                                    <option value="">3.00 Hrs</option>
                                </select>
                            </div>
                        </div>
                        <!-- THIRD DIV -->
                        <div>
                            <label for="">Extra Services</label>
                            <!-- EXTRA SERVIES CONTAINER...	 -->
                            <div>
                                <div>
                                    <input id="cabinet" type="checkbox" checked>
                                    <label for="cabinet">
                                        <div><img src="<?= assets('assets/img/customer/book_service/cabinet_green.png'); ?>" alt=""></div>
                                        <p>Inside Cabinets</p>
                                    </label>
                                </div>
                                <div>
                                    <input id="fridge" type="checkbox">
                                    <label for="fridge">
                                        <div><img src="<?= assets('assets/img/customer/book_service/fridge.png'); ?>" alt=""></div>
                                        <p>Inside Fridge</p>
                                    </label>
                                </div>
                                <div>
                                    <input id="oven" type="checkbox">
                                    <label for="oven">
                                        <div><img src="<?= assets('assets/img/customer/book_service/oven.png'); ?>" alt=""></div>
                                        <p>Inside Oven</p>
                                    </label>
                                </div>
                                <div>
                                    <input id="laundry" type="checkbox">
                                    <label for="laundry">
                                        <div><img src="<?= assets('assets/img/customer/book_service/laundry.png'); ?>" alt=""></div>
                                        <p>Laundry Wash & Dry</p>
                                    </label>
                                </div>
                                <div>
                                    <input id="window" type="checkbox">
                                    <label for="window">
                                        <div><img src="<?= assets('assets/img/customer/book_service/window.png'); ?>" alt=""></div>
                                        <p>Interior Windows</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- FOURTH DIV -->
                        <div>
                            <div class="label_input">
                                <label class="label" for="">Comments</label>
                                <textarea name="" class="textarea"></textarea>
                            </div>
                            <div>
                                <input type="checkbox">
                                <label for="">I have a Pets at Home</label>
                            </div>
                        </div>
                        <button class="book_service_btn">Continue</button>
                    </div>
                </div>

                <!-- YOUR DETAILS -->
                <div class="tab_content d_none">
                    <div class="your_details">
                        <!-- ADDRESS INFORM OF RADIO BUTTON -->
                        <div class="label_input">
                            <label class="label" for="">Enter your contact details so we can serve you in better way!</label>
                            <!-- ADDRESS_1 -->
                            <div class="radio_address">
                                <input type="radio" id="booking_address_1" name="address">
                                <label for="booking_address_1">
                                    <div>
                                        <p><span>Address</span> : Koenigstrasse 112, 99897 Tambach-Dietharz</p>
                                        <p><span>Phone Number</span> : 9955648797</p>
                                    </div>
                                </label>
                            </div>
                            <!-- ADDRESS_2 -->
                            <div class="radio_address">
                                <input type="radio" id="booking_address_2" name="address">
                                <label for="booking_address_2">
                                    <div>
                                        <p><span>Address</span> : Koenigstrasse 112, 99897 Tambach-Dietharz</p>
                                        <p><span>Phone Number</span> : 9955648797</p>
                                    </div>
                                </label>
                            </div>
                            <button class="book_service_outline_btn" id="open_address_form_btn"><i class="fas fa-plus"></i>Add Address</button>
                            <!-- ADDRESS FORM AUTOMETIC FILL BY CHOOSE A RADIO BUTTON -->
                            <div class="d_none" id="address_form">
                                <div class="label_input">
                                    <label class="label" for="">Street Name</label>
                                    <input class="input" type="text">
                                </div>
                                <div class="label_input">
                                    <label class="label" for="">House Number</label>
                                    <input class="input" type="text">
                                </div>
                                <div class="label_input">
                                    <label class="label" for="">Postal Code</label>
                                    <input class="input" type="text">
                                </div>
                                <div class="label_input">
                                    <label class="label" for="">City</label>
                                    <input class="input" type="text">
                                </div>
                                <div class="label_input">
                                    <label class="label" for="">Phone Number</label>
                                    <div class="phone_number">
                                        <label for="">+49</label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div>
                                    <button class="book_service_btn">Save</button>
                                    <button class="book_service_outline_btn" id="close_address_form_btn">Cancel</button>
                                </div>
                            </div>								
                        </div>
                        <div>
                            <label class="label" for="">Your Favourite Service Providers</label>
                            <p>You can choose your favourite service provider from the below list</p>
                            <!-- LIST OF SERVICE PROVIDER -->
                            <div>
                                <div>
                                    <img src="<?= assets('assets/img/avatar/hat.png'); ?>" alt="">
                                    <p>Ram Patel</p>
                                    <button class="book_service_outline_btn">Select</button>
                                </div>
                                <div>
                                    <img src="<?= assets('assets/img/avatar/hat.png'); ?>" alt="">
                                    <p>Laxman Chaudhari</p>
                                    <button class="book_service_outline_btn">Select</button>
                                </div>
                            </div>
                        </div>
                        <button class="book_service_btn">Continue</button>
                    </div>
                </div>

                <!-- MAKE_PAYMENT -->
                <div class="tab_content active_tab_content">
                    <div class="make_payment">
                        <div>
                            <p>Pay Securely with Helperland payment gateway!</p>
                            <div>
                                <div class="label_input">
                                    <label class="label" for="">Promo Code (Optional)</label>
                                    <input class="input" type="text">
                                </div>
                                <button class="book_service_outline_btn">Apply</button>	
                            </div>
                        </div>
                        <div class="label_input">
                            <div>
                                <input type="text" placeholder="XXXX-XXXX-XXXX-XXXX" id="card_no" maxlength="19">
                                <input type="text" placeholder="MM/YY">	
                                <input type="text" placeholder="CVV/CVC">
                                <script>
                                    // FOR SPACE BETWEEN CARD NUMBER...
                                    $('#card_no').on('keyup', function() {
                                        var foo = $(this).val().split(" ").join(""); 
                                        if (foo.length > 0) {
                                            foo = foo.match(new RegExp('.{1,4}', 'g')).join(" ");
                                        }
                                        $(this).val(foo);
                                    });
                                </script>
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
                            <input type="checkbox">
                            <label for="">I accept the <a href="#">term and condition</a>. the <a href="#">cancellation policy</a> and the <a href="#">privacy policy</a>. i confirm that helperland start to execute that contract before the expiry of the withdrawal period and i lose my right of withdrawal as consumer with full performance of the contract.</label>
                        </div>
                        <button class="book_service_btn">Complete Booking</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOOK SERVIES RIGHT -->
        <div class="book_service_right">
            <!-- MODEL_CLOSE -->
            <button class="model_close_btn">&times;</button>
            <!-- PAYMENT -->
            <div class="payment_summary">
                <p>Payment Summary</p>
                <div>
                    <div>
                        <p>07/10/2021 08:00</p>
                        <p><span>1 bed</span> <span>1 bath</span></p>	
                    </div>
                    <div>
                        <p>Duration</p>
                        <div>
                            <p>Basic</p>
                            <p>3 Hrs</p>
                        </div>
                        <div>
                            <p>Inside Cabinets(Extra)</p>
                            <p>30 Mins</p>
                        </div>
                        <div>
                            <p>Total Service Time</p>
                            <p>3.5 Hrs</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p>Per Cleaning</p>	
                            <p>$87</p>
                        </div>
                        <div>
                            <p>Discount</p>	
                            <p>-$27</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p>Total Payment</p>
                            <p>$63</p>	
                        </div>
                        <div>
                            <p>Effective Price</p>
                            <p>$50.4</p>
                        </div>
                        <p><span>*</span>You will save 20% according to §35a EStG.</p>
                    </div>
                    <button onclick="open_model('included_services')">
                        <i class="far fa-smile"></i>
                        <p>See what is always included</p>
                    </button>
                </div>
            </div>

            <!-- QUESTIONS -->
            <div class="book_service_questions">
                <p>Questions?</p>
                <div class="accordion">
                    <button class="accordion_btn"><i class="fas fa-angle-right"></i> What's including in a Cleaning?</button>
                    <div class="accordion_content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi tempora asperiores facilis blanditiis libero porro culpa enim quo animi cumque quidem veritatis, nihil similique hic qui non fuga debitis delectus!</p>
                    </div>	
                </div>
                <div class="accordion">
                    <button class="accordion_btn"><i class="fas fa-angle-right"></i> Can i skip or reschedule booking?</button>
                    <div class="accordion_content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi tempora asperiores facilis blanditiis libero porro culpa enim quo animi cumque quidem veritatis, nihil similique hic qui non fuga debitis delectus!</p>
                    </div>	
                </div>
                <div class="accordion">
                    <button class="accordion_btn"><i class="fas fa-angle-right"></i> Which helperland professional will come to my place?</button>
                    <div class="accordion_content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi tempora asperiores facilis blanditiis libero porro culpa enim quo animi cumque quidem veritatis, nihil similique hic qui non fuga debitis delectus!</p>
                    </div>	
                </div>
                <a href="#">For more Help</a>
            </div>

        </div>

        <!-- INCLUDED SERVICES POPUP-MODEL -->
        <div class="model">
            <!-- MODEL_CLOSE -->
            <button class="included_services_close_btn">&times;</button>
            <!-- INCLUDED_SERVICES -->
            <div class="popup_main" id="included_services_popup">
                <!-- MAIN TITLE -->
                <p>What cleaning included with us</p>
                <div>
                    <!-- LIVING ROOM -->
                    <div>
                        <p>Living room and bedrooms</p>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Dust all accessible surfaces</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Wipe down all mirrors and glass fixtures</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Clean all floor surfaces</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Take out garbage and recycling</p></div>
                    </div>
                    <!-- BATHROOM -->
                    <div>
                        <p>Bathroom</p>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Wash and sanitize the toilet, shower, tub, sink</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Dust all accessible surfaces </p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Wipe down all mirrors and glass fixtures</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Clean all floor surfaces</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Take out garbage and recycling</p></div>
                    </div>
                    <!-- KITCHEN -->
                    <div>
                        <p>Kitchen</p>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Dust all accessible surfaces</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Empty sink and load up dishwasher</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Wipe down exterior of stove, oven and fridge </p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Clean all floor surfaces</p></div>
                        <div><img src="<?= assets('assets/img/customer/book_service/included.png'); ?>" alt=""><p>Take out garbage and recycling</p></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- VISIBLE BELOWER 1280PX -->
        <button class="payment_summary_btn">Payment Summary</button>

    </div>	
</main>

<?= component('footer'); ?>