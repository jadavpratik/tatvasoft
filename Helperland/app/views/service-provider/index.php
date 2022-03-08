<?= component('header'); ?>

<!-- **********SERVICE_PROVIDER********** -->
<main>

    <div class="welcome_message">
        <p>Welcome, <span><?= session('userName'); ?></span></p>
    </div>

    <div class="table_tab">
        <div class="table_tab_left">
            <div class="table_tab_list">
                <!-- <a href="javascript:void(0);" class="table_tab_btn">Dashboard</a> -->
                <a href="javascript:void(0);" class="table_tab_btn">New Service Request</a>
                <a href="javascript:void(0);" class="table_tab_btn">Upcoming Services</a>
                <a href="javascript:void(0);" class="table_tab_btn">Service Schedule</a>
                <a href="javascript:void(0);" class="table_tab_btn">Service History</a>
                <a href="javascript:void(0);" class="table_tab_btn">My Rating</a>
                <a href="javascript:void(0);" class="table_tab_btn">Block Customer</a>
                <!-- <a href="javascript:void(0);" class="table_tab_btn">Invoice</a> -->
                <!-- <a href="javascript:void(0);" class="table_tab_btn">Notification</a> -->
            </div>
        </div>
        <div class="table_tab_right">

            <!-- PROFILE -->
            <div class="table_tab_content">
                <?= component('service-provider/', 'profile'); ?>
            </div>

            <!-- DASHBOARD -->
            <!-- <div class="table_tab_content d_none"></div> -->

            <!-- NEW SERVICE REQUEST -->
            <div class="table_tab_content d_none">
                <?= component('service-provider/', 'new-service-request'); ?>
            </div>

            <!-- UPCOMING SERVICES -->
            <div class="table_tab_content d_none">
                <?= component('service-provider/', 'upcoming-services'); ?>
            </div>

            <!-- SERVICE SCHEDULE -->
            <div class="table_tab_content d_none"></div>

            <!-- SERVICE HISTORY -->
            <div class="table_tab_content d_none">
                <?= component('service-provider/', 'service-history'); ?>
            </div>

            <!-- MY RATING -->
            <div class="table_tab_content d_none">
                <?= component('service-provider/', 'my-rating'); ?>
            </div>

            <!-- BLOCK CUSTOMER -->
            <div class="table_tab_content d_none">
                <?= component('service-provider/', 'block-customer'); ?>
            </div>

            <!-- INVOICES -->
            <!-- <div class="table_tab_content d_none"></div> -->

            <!-- NORTIFICATIONS -->
            <!-- <div class="table_tab_content d_none"></div> -->

        </div><!-- END_TABLE_TAB_RIGHT -->
    </div><!-- END_TABLE_TAB -->
</main><!-- END_MAIN -->

<?= component('footer'); ?>