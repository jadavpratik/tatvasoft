<div class="customer_current_service_requests">
    <p>Current Service Requests</p>
    <button class="add_new_service_request_btn" onclick="window.location.href='<?=url('/book-now')?>' ">Add New Service Request</button>
</div>

<table id="current_service_requests_table">
    <thead>
        <tr>
            <th>Service Id</th>
            <th>Service Date</th>
            <th>Service Provider</th>
            <th>Payment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody><!-- GENERATED BY DATATABLE --></tbody>
</table>

<!-- **********CUSTOMER-CURRENT-SERVICES-SCRIPTS********** -->
<script>

    $(document).ready(()=>{
        state.customer_dashboard_table = $('#current_service_requests_table').DataTable({
            searching : false,
            serviceSide : true,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/customer-current-services`,
                cache : true,
                dataSrc : function(data){
                    // STORE DATA GLOBALLY...
                    state.customer_dashboard_data = data;
                    return data;
                },
            },
            columns :[
                {
                    mRender : function(data, type, row){
                        return`<p class="service_id" onclick="show_service_details(${row.ServiceRequestId});">${row.ServiceRequestId}</p>`;
                    },
                },
                {
                    mRender : function(data, type, row){
                        return` <div class="service_date" onclick="show_service_details(${row.ServiceRequestId});">
                                    <div>
                                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                                        <p>${row.ServiceDate}</p>
                                    </div>
                                    <div>
                                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                                        <p><span>${row.StartTime}</span> - <span>${row.EndTime}</span></p>
                                    </div>
                                </div>`;
                    }
                },
                {
                    mRender : function(data, type, row){
                        if(row.ServiceProvider!==undefined){
                            if(row.Rating!==undefined){
                                return `<div class="service_provider">
                                        <img class="hat_style" src="${BASE_URL}/assets/avatar/${row.ServiceProvider.UserProfilePicture}.png" alt="">
                                        <div>
                                            <p>${row.ServiceProvider.FirstName} ${row.ServiceProvider.LastName}</p>    
                                            <div>
                                                <i class="fas fa-star rated_star"></i>
                                                <i class="fas fa-star rated_star"></i>
                                                <i class="fas fa-star rated_star"></i>
                                                <i class="fas fa-star rated_star"></i>
                                                <i class="fas fa-star unrated_star"></i>
                                                <span>${row.Rating}</span>
                                            </div>
                                        </div>
                                    </div>`;
                            }
                            else{
                                return `<div class="service_provider">
                                        <img class="hat_style" src="${BASE_URL}/${row.ServiceProvider.UserProfilePicture}" alt="">
                                        <div>
                                            <p>${row.ServiceProvider.FirstName} ${row.ServiceProvider.LastName}</p>    
                                            <div>
                                                <i class="fas fa-star unrated_star"></i>
                                                <i class="fas fa-star unrated_star"></i>
                                                <i class="fas fa-star unrated_star"></i>
                                                <i class="fas fa-star unrated_star"></i>
                                                <i class="fas fa-star unrated_star"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>`;
                            }
                        }
                        else{
                            return 'No SP';
                        }
                    }
                },
                {
                    mRender : function(data, type, row){
                    // €₹
                    return `<p class="payment_text">₹<span>${row.TotalCost}</span></p>`;
                    }
                },
                {
                    mRender : function(data, type, row){
                        return `<div class="table_btn_container">
                                    <button class="reschedule_btn" onclick='reschedule_service_open_model(${row.ServiceRequestId});'>Reschedule</button>
                                    <button class="cancel_btn" onclick='cancel_service_open_model(${row.ServiceRequestId});'>Cancel</button>    
                                </div>`;
                    }
                }
            ],
            pagingType : 'full_numbers',
            language : {
                paginate : {
                    first    :'<i class="fa-solid fa-backward-step"></i>',
                    previous :'<i class="fas fa-angle-left">',  
                    next     :'<i class="fas fa-angle-right">',
                    last     :'<i class="fa-solid fa-forward-step"></i>'  
                },
            }
        });
    });
</script>


<!-- **********CUSTOMER-RESCHEDULE-CANCEL-SERVICE-SCRIPTS********** -->
<script>

    // CANCEL SERVICE REQUEST...
    function reschedule_service_open_model(id){
        state.reschedule_service_id = id;
        open_model('reschedule_service_request');
    }

    // CANCEL SERVICE REQUEST...
    function cancel_service_open_model(id){
        state.cancel_service_id = id;
        open_model('cancel_service_request');
    }

</script>