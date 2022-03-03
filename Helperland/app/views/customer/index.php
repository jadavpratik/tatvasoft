<?= component('header'); ?>

<!-- **********MAIN********** -->
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
                <a href="javascript:void(0);" class="table_tab_btn active_table_tab" onclick="load_customer_dashboard_data()">Dashboard</a>
                <a href="javascript:void(0);" class="table_tab_btn" onclick="load_customer_service_history_data()">Service History</a>
                <a href="javascript:void(0);" class="table_tab_btn">Service Schedule</a>
                <a href="javascript:void(0);" class="table_tab_btn" onclick="load_customer_favourite_data()">Favourite Pros</a>
                <a href="javascript:void(0);" class="table_tab_btn">Invoices</a>
                <a href="javascript:void(0);" class="table_tab_btn">Notifications</a>    
            </div>
        </div>

        <!-- RIGHT -->
        <div class="table_tab_right">

            <!-- PROFILE -->
            <div class="table_tab_content d_none">
                <?= component('customer/', 'profile'); ?>
            </div>
            
            <!-- CUSTOMER_SERVICE_REQUESTS -->
            <div class="table_tab_content">
                <?= component('customer/', 'current-service-requests'); ?>
            </div>

            <!-- SERVICE_HISTORY -->
            <div class="table_tab_content d_none">
                <?= component('customer/', 'service-history'); ?>
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- SERVICE SCHEDULE -->
            <div class="table_tab_content d_none">
                <div style="display:flex;align-items:center;justify-content:center">
                    <p style="font-size:20px; text-center;">No Content Available</p>
                </div>
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- FAVOURITE PROS -->
            <div class="table_tab_content d_none">
                <?= component('customer/', 'favourite-sp'); ?>
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- INVOICES -->
            <div class="table_tab_content d_none">
                <div style="display:flex;align-items:center;justify-content:center">
                    <p style="font-size:20px; text-center;">No Content Available</p>
                </div>
            </div><!-- END_TABLE_TAB_CONTENT -->

            <!-- NORTIFICATIONS -->
            <div class="table_tab_content d_none">
                <div style="display:flex;align-items:center;justify-content:center">
                    <p style="font-size:20px; text-center;">No Content Available</p>
                </div>
            </div><!-- END_TABLE_TAB_CONTENT -->

        </div><!-- END_TABLE_TAB_RIGHT -->
    </div><!-- END_TABLE_TAB -->
</main><!-- END_MAIN -->

<script>

    // LOAD CUSTOMER DASHBOARD DATA...
    function load_customer_dashboard_data(){
        const table = state.customer_dashboard_table;
        table.ajax.reload();
    }

    // LOAD CUSTOMER HISTORY DATA...
    function load_customer_service_history_data(){
        const table = state.customer_service_history_table;
        table.ajax.reload();
    }

    // LOAD CUSTOMER FAVOURITE DATA...
    function load_customer_favourite_data(){
        
    }

    // SHOW SERVICE DETAILS...
    function show_service_details(id){

        let data = state.customer_service_history_data;
        
        data = data.filter((service)=>{
            if(id===service.ServiceRequestId){
                return service;
            }
        });

        // SERVICE DATA...
        data = data[0];

        // IF EXTRA SERVICE TAKEN...
        let extraService = ``;
        if(data.ExtraService!==undefined){
            for(let i=0; i<data.ExtraService.length; i++){
                if(data.ExtraService[i]==1){
                    extraService += `<p>Extras : <span>Inside Cabinet</span></p>`;
                }
                else if(data.ExtraService[i]==2){
                    extraService += `<p>Extras : <span>Inside Fridge</span></p>`;
                }
                else if(data.ExtraService[i]==3){
                    extraService += `<p>Extras : <span>Inside Oven</span></p>`;
                }
                else if(data.ExtraService[i]==4){
                    extraService += `<p>Extras : <span>Inside Laundry</span></p>`;
                }
                else if(data.ExtraService[i]==5){
                    extraService += `<p>Extras : <span>Inside Window</span></p>`;
                }
            }
        }

        // SETUP HTML... $ ₹
        $('#service_details_popup').html(`
            <p class="popup_title">Service Details</p>
            <div>
                <p>${data.ServiceDate} | ${data.StartTime} - ${data.EndTime}</p>
                <p>Duration : <span>${data.Duration} Hours</span></p>
            </div>
            <div>
                <p>Service Id : <span>${data.ServiceRequestId}</span></p>
                ${extraService}
                <p>Net Amout : <span class="price_text">${data.TotalCost} ₹</span></p>
            </div>
            <div>
                <p>Service Address : <span>${data.AddressLine1} ${data.AddressLine2}, ${data.PostalCode} ${data.City} </span></p>			
                <p>Billing Address : <span>Same as Cleaning Address</span></p>
                <p>Phone : <span>+49 ${data.Mobile}</span></p>
                <p>Email : <span>${data.Email}</span></p>
            </div>
            <div>
                <p>Conmments : <span>${data.Comments}</span></p>
            </div>
            <div class="table_btn_container">
                <button class="reschedule_btn" onclick="reschedule_service(${data.ServiceRequestId});"><i class="fas fa-redo-alt"></i> Reschdule</button>
                <button class="cancel_btn" onclick="cancel_service(${data.ServiceRequestId});"><i class="fas fa-times"></i> Cancel</button>
            </div>`
        );

        open_model('service_details');
    }

</script>

<?= component('footer'); ?>