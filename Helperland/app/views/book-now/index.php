<?= component('header'); ?>

<!-- **********BOOK A SERVICE********** -->

<script>
    // FOR STORING A DATA AS GLOBALLY...
    let default_service_request = {
        postal_code : null,
        date : '00/00/0000',
        time : '00:00',
        duration : 0,
        comments : null,
        has_pets : false,
        extra : [],
        extra_time : 0,
        sp_id : null,
        per_price : 70,
        total_price : 0,
        address : {},
    }
    let service_request = default_service_request;
    let user_address = {};
</script>


<!-- **********BOOK A SERVICE********** -->
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
                <button class="tab_btn active_book_service_tab">
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/setup_service.png'); ?>" alt="">
                    </div>
                    <p>Setup Service</p>
                </button>
                <button class="tab_btn" disabled>
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/schedule_plan.png'); ?>" alt="">
                    </div>
                    <p>Schedule & Plan</p>
                </button>
                <button class="tab_btn" disabled>
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/user_details.png'); ?>" alt="">
                    </div>
                    <p>Your Details</p>
                </button>
                <button class="tab_btn" disabled>
                    <div>
                        <img src="<?= assets('assets/img/customer/book_service/payment.png'); ?>" alt="">
                    </div> 
                    <p>Make Payment</p>
                </button>
            </div>

            <!-- TAB BODY FOR CONTENTS -->
            <div>

                <!-- SETUP_SERVICE -->
                <div class="tab_content active_tab_content">
                    <?= component('book-now/', 'setup-service'); ?>
                </div>

                <!-- SCHEDULE_PLAN -->
                <div class="tab_content d_none">
                    <?= component('book-now/', 'schedule-plan'); ?>
                </div>

                <!-- YOUR DETAILS -->
                <div class="tab_content d_none">
                    <?= component('book-now/', 'your-details'); ?>
                </div>

                <!-- MAKE_PAYMENT -->
                <div class="tab_content d_none">
                    <?= component('book-now/', 'make-payment'); ?>
                </div>
            </div>
        </div>

        <!-- BOOK SERVIES RIGHT -->
        <div class="book_service_right">
            <!-- MODEL_CLOSE -->
            <button class="model_close_btn">&times;</button>
            <!-- PAYMENT -->
            <?= component('book-now/', 'payment-summary'); ?>
            <!-- QUESTIONS -->
            <?= component('book-now/', 'questions'); ?>
        </div>

        <!-- VISIBLE BELOWER 1280PX -->
        <button class="payment_summary_btn">Payment Summary</button>
    </div>	
</main>

<script>

    function change_book_service_tabs(i){
        tab_btn[i].removeAttribute('disabled');
        $('.tab_content').addClass('d_none');
        tab_content[i].classList.remove('d_none');

        $('.tab_btn').removeClass('active_book_service_tab');
        tab_btn[i].classList.add('active_book_service_tab');
    }

</script>

<?= component('footer'); ?>