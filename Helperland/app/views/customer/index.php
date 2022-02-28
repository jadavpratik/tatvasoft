<?= component('header'); ?>

<main>

    <!-- WELCOME_MESSAGE -->
    <div class="welcome_message">
        <p>Welcome, <span><?= session('userName'); ?></span></p>
    </div>

    <!-- TAB AND TABLE -->
    <div class="table_tab">
        <!-- LEFT -->
        <div class="table_tab_left">
            <!-- TAB AND TABLE LIST -->
            <div class="table_tab_list">
                <a href="javascript:void(0);" class="table_tab_btn">Dashboard</a>
                <a href="javascript:void(0);" class="table_tab_btn">Service History</a>
                <a href="javascript:void(0);" class="table_tab_btn">Service Schedule</a>
                <a href="javascript:void(0);" class="table_tab_btn">Favourite Pros</a>
                <a href="javascript:void(0);" class="table_tab_btn">Invoices</a>
                <a href="javascript:void(0);" class="table_tab_btn">Notifications</a>    
            </div>
        </div>

        <!-- RIGHT -->
        <div class="table_tab_right">

            <!-- PROFILE -->
            <div class="table_tab_content">
                <?= component('customer/', 'profile', ['details'=>$details, 'address'=>$address]); ?>
            </div>
            
            <!-- CUSTOMER_SERVICE_REQUESTS -->
            <div class="table_tab_content d_none">
                <?= component('customer/', 'current-service-requests'); ?>
            </div>

            <!-- SERVICE_HISTORY -->
            <div class="table_tab_content d_none">
                <?= component('customer/', 'service-history'); ?>
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- SERVICE SCHEDULE -->
            <div class="table_tab_content d_none">
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- FAVOURITE PROS -->
            <div class="table_tab_content d_none">
                <?= component('customer/', 'favourite-sp'); ?>
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- INVOICES -->
            <div class="table_tab_content d_none">
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- NORTIFICATIONS -->
            <div class="table_tab_content d_none">
            </div><!-- END_TABLE_TAB_CONTENT -->

        </div><!-- END_TABLE_TAB_RIGHT -->
    </div><!-- END_TABLE_TAB -->
</main><!-- END_MAIN -->


<?= component('footer'); ?>