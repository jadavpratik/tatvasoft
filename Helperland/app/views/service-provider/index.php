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
                <a href="javascript:void(0);" class="table_tab_btn" onclick="load_sp_new_services_data();">New Service Request</a>
                <a href="javascript:void(0);" class="table_tab_btn" onclick="load_sp_upcoming_services_data();">Upcoming Services</a>
                <a href="javascript:void(0);" class="table_tab_btn">Service Schedule</a>
                <a href="javascript:void(0);" class="table_tab_btn" onclick="load_sp_service_history_data();">Service History</a>
                <a href="javascript:void(0);" class="table_tab_btn" onclick="load_sp_my_rating_data();">My Rating</a>
                <a href="javascript:void(0);" class="table_tab_btn" onclick="load_sp_my_customer_data();">Block Customer</a>
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

<script>

    function load_sp_new_services_data(){
        state.sp_new_services_table.ajax.reload();
    }

    function load_sp_upcoming_services_data(){
        state.sp_upcoming_services_table.ajax.reload();
    }

    function load_sp_service_history_data(){
        state.sp_service_history_table.ajax.reload();
    }

    function load_sp_my_rating_data(){
        state.sp_my_rating_table.ajax.reload();
    }

    function load_sp_my_customer_data(){
        load_my_customers();
    }

    // SHOW SERVICE DETAILS...
    //  THIS POPUP MODEL FOR SERVICE PROVIDER WHERE SP ACCEPT REJECT, AND COMPLETE THE SERVICE....
    function show_service_details(id){
        // MERGE ALL TABLE DATA... BY SPREAD OBJECT...
        let data = [...state.sp_service_history_data,
                    ...state.sp_new_services_data,
                    ...state.sp_upcoming_services_data];

        data = data.filter((service)=>{
            if(id===service.ServiceRequestId){
                return service;
            }
        });

        // SERVICE DATA...
        data = data[0];

        // SETUP HTML... $ ₹
        $('#service_details_popup').html(`
            <p class="popup_title">Service Details</p>
            <div>
                <p>${data.ServiceDate} | ${data.StartTime} - ${data.EndTime}</p>
                <p>Duration : <span>${data.Duration} Hours</span></p>
            </div>
            <div>
                <p>Service Id : <span>${data.ServiceRequestId}</span></p>
                ${(function(){
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
                        return extraService;
                    }
                    else{
                        return extraService;
                    }
                })()}
                <p>Net Amout : <span class="price_text">${data.TotalCost} ₹</span></p>
            </div>
            <div>
                <p>Service Address : <span>${data.AddressLine1} ${data.AddressLine2}, ${data.PostalCode} ${data.City} </span></p>			
                <p>Billing Address : <span>Same as Cleaning Address</span></p>
                <p>Phone : <span>+49 ${data.Mobile}</span></p>
                <p>Email : <span>${data.Email}</span></p>
            </div>
            <div>
                <p>Conmments : <span>${data.Comments? data.Comments:''}</span></p>
            </div>
            <!--<div class="table_btn_container">
                <button class="reschedule_btn" onclick="reschedule_service(${data.ServiceRequestId});"><i class="fas fa-redo-alt"></i> Reschdule</button>
                <button class="cancel_btn" onclick="cancel_service(${data.ServiceRequestId});"><i class="fas fa-times"></i> Cancel</button>
            </div>-->`
        );

        open_model('service_details');
    }
</script>

<?= component('footer'); ?>