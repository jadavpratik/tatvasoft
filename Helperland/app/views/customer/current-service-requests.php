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
    <tbody>
        <!-- GENERATED BY DATATABLE -->
    </tbody>
</table>

<!-- **********CUSTOMER-CURRENT-SERVICES-SCRIPTS********** -->
<script>


    $(document).ready(()=>{
        store.customer.table.dashboard = $('#current_service_requests_table').DataTable({
            searching : false,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/customer/service/current/`,
                method : 'GET',
                cache : true,
                dataSrc : function(data){
                    store.customer.data.current_services = data;
                    return data;
                }
            },
            columns :[
                {
                    render : function(data, type, row){
                        return`<p class="service_id" onclick="show_service_details(${row.Service.Id})">${row.Service.Id}</p>`;
                    },
                },
                {
                    render : function(data, type, row){
                        return` <div class="service_date" onclick="show_service_details(${row.Service.Id})">
                                    <div>
                                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                                        <p>${row.Service.ServiceDate}</p>
                                    </div>
                                    <div>
                                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                                        <p><span>${row.Service.StartTime}</span> - <span>${row.Service.EndTime}</span></p>
                                    </div>
                                </div>`;
                    }
                },
                {
                    render : function(data, type, row){
                        if(row.ServiceProvider.Id!==0){
                            return `
                                <div class="service_provider" onclick="show_service_details(${row.Service.Id})">
                                    <img class="hat_style" src="${BASE_URL}/assets/img/avatar/${row.ServiceProvider.ProfilePicture}.png" alt="">
                                    <div>
                                        <p>${row.ServiceProvider.Name}</p>    
                                        <div>
                                            ${(function(){
                                                let rating_html = ``;
                                                if(row.ServiceProvider.Ratings!==undefined){
                                                    // FOR RATED STAR...
                                                    for(let i=0; i<parseInt(row.ServiceProvider.Ratings); i++){
                                                        rating_html +=`<i class="fas fa-star rated_star"></i>`;
                                                    }
                                                    // FOR UNRATED STAR...
                                                    for(let i=0; i<(5-parseInt(row.ServiceProvider.Ratings)); i++){
                                                        rating_html +=`<i class="fas fa-star unrated_star"></i>`;
                                                    }
                                                }
                                                else{
                                                    for(let i=0; i<5; i++){
                                                        rating_html +=`<i class="fas fa-star unrated_star"></i>`;
                                                    }
                                                }
                                                return rating_html;
                                            })()}
                                            <span>${row.ServiceProvider.Ratings!==null?parseFloat(row.ServiceProvider.Ratings):''}</span>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        else{
                            return `<p onclick="show_service_details(${row.Service.Id})">No SP</p>`;
                        }
                    }
                },
                {
                    render : function(data, type, row){
                        return `<p class="payment_text" onclick="show_service_details(${row.Service.Id})">€<span>${row.Service.TotalCost}</span></p>`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `<div class="table_btn_container">
                                    <button class="reschedule_btn" onclick='reschedule_service_open_model(${row.Service.Id})'>Reschedule</button>
                                    <button class="cancel_btn" onclick='cancel_service_open_model(${row.Service.Id});'>Cancel</button>    
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
        store.id.reschedule = id;
        open_model('reschedule_service_request');
    }

    // CANCEL SERVICE REQUEST...
    function cancel_service_open_model(id){
        store.id.cancel = id;
        open_model('cancel_service_request');
    }

</script>