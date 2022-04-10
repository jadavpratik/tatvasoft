<div class="service_requests">
    <div>
        <p>Service Requests</p>
    </div>
    <div>
        <input class="input" type="text" placeholder="Service ID"  onkeyup="search_by_service_id(this.value)">
        <input class="input" type="text" placeholder="Postal Code"  onkeyup="search_by_postal_code(this.value)">
        <input class="input" type="text" placeholder="Customer"  onkeyup="search_by_customer(this.value)">
        <input class="input" type="text" placeholder="Service Provider" onkeyup="search_by_service_provider(this.value)">
        <select class="select" name="serviceStatusSelect" id="" onchange="search_by_service_status(this.value)">
            <option value="">All</option>
            <option value="New">New</option>
            <option value="Assigned">Assigned</option>
            <option value="Completed">Completed</option>
            <option value="Cancelled">Cancelled</option>
        </select>
        <div class="from_date">
            <label for="from_date">
                <img src="<?= assets('assets/img/table/calendar_blue.png'); ?>" alt="">
            </label>
            <input type="date" id="from_date" onchange="search_by_from_date(this.value)">
            <span>From</span>
        </div>
        <div class="to_date">
            <label for="to_date">
                <img src="<?= assets('assets/img/table/calendar_blue.png'); ?>" alt="">
            </label>
            <input type="date" id="to_date" onchange="search_by_to_date(this.value)">
            <span>To</span>
        </div>
        <button class="clear_btn" onclick="clear_all_value()">Clear</button>
    </div>
</div><!-- END_SERVICE_REQUESTS -->

<table id="admin_service_requests_table">
    <thead>
        <tr>
            <th>Service ID</th>
            <th>Service Date</th>
            <th>Customer Details</th>
            <th>Service Provider</th>
            <th>Status</th>
            <th>Total Payment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- GENERATED BY DATATABLE -->
    </tbody>
</table>

<script>
    $(document).ready(function(){        
        store.admin.table.service_requests = $('#admin_service_requests_table').DataTable({
            searching : true,
            serviceSide : true,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/admin/service-requests`,
                cache : true,
                dataSrc : function(data){
                    store.admin.data.service_requests = data;
                    return data;
                }
            },
            columns : [
                {
                    render : function(data, type, row){
                        return `${row.Service.Id}`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `<div class="service_date">
                                    <div>
                                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                                        <p>${row.Service.ServiceDate}</p>
                                    </div>
                                    <div>
                                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                                        <p>${row.Service.StartTime} - ${row.Service.EndTime}</p>
                                    </div>    
                                </div>`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `<div class="customer_details">
                                    <p>${row.Customer.Name}</p>
                                    <div>
                                        <img src="<?= assets('assets/img/table/home.png'); ?>" alt="">
                                        <p>${row.ServiceAddress.AddressLine1} ${row.ServiceAddress.AddressLine2}, ${row.ServiceAddress.PostalCode} ${row.ServiceAddress.City}</p>
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
                                                if(row.ServiceProvider.Ratings!==null){
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
                            return `NO SP`;
                        }
                    }
                },
                {
                    render : function(data, type, row){
                        switch(row.Service.Status){
                            case 0:
                                return `<p class="new_status">New</p>`;
                            case 1:
                                return `<p class="pending_status">Assigned</p>`;
                            case 2:
                                return `<p class="completed_status" onclick="show_service_details(${row.ServiceRequestId})">Completed</p>`;
                            case 3:
                                return `<p class="cancelled_status" onclick="show_service_details(${row.ServiceRequestId})">Cancelled</p>`;
                        }
                    }
                },
                {
                    render : function(data, type, row){
                        return `<p class="payment_text">€${row.Service.TotalCost}</p>`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `<div class="dropdown">
                                    <button class="dropdown_btn"><i class="fas fa-ellipsis-v"></i></button>
                                    <div class="dropdown_menu d_none">
                                        <a href="javascript:void(0)" onclick="open_edit_service_model(${row.Service.Id})">Edit & Reschedule</a>
                                        ${(function(){
                                            // MEANS NEW AND ASSIGNED REQUEST ONLY ALLOWED TO CANCEL
                                            if(row.Service.Status==0 || row.Service.Status==1){
                                                return `<a href="javascript:void(0)" onclick="cancel_service(${row.Service.Id})">Cancel</a>`;
                                            }
                                            else{
                                                return ``;
                                            }
                                        })()}
                                        <!--
                                        <a href="javascript:void(0)">Edit</a>
                                        <a href="javascript:void(0)">Change SP</a>
                                        <a href="javascript:void(0)">Escalate</a>
                                        <a href="javascript:void(0)">History Log</a>
                                        <a href="javascript:void(0)">Download Invoice</a>
                                        -->
                                    </div>
                                </div>`;                    
                    },
                    sortable : false
                },
            ],
            pagingType : 'full_numbers',
            language : {
                paginate : {
                    first    :'<i class="fa-solid fa-backward-step"></i>',
                    previous :'<i class="fas fa-angle-left">',  
                    next     :'<i class="fas fa-angle-right">',
                    last     :'<i class="fa-solid fa-forward-step"></i>'  
                },
            },
        }).on('click', '.dropdown_btn', ()=>{
            dropdown_issue_callback();
        });
    });

    let dateFilter = {
        fromData : [],
        toData : []
    };

    function search_by_service_id(val){        
        store.admin.table.service_requests.column(0).search(val).draw();
    }

    function search_by_postal_code(val){
        store.admin.table.service_requests.column(2).search(val).draw();
    }

    function search_by_customer(val){
        store.admin.table.service_requests.column(2).search(val).draw();
    }

    function search_by_service_provider(val){
        store.admin.table.service_requests.column(3).search(val).draw();
    }

    function search_by_service_status(val){
        store.admin.table.service_requests.column(4).search(val).draw();
    }

    function search_by_from_date(val){
        let fromDate = new Date(val);
        let data = [];
        let filter = [];
        if(dateFilter.toData.length==0){
            data = store.admin.data.service_requests;
        }
        else{
            data = dateFilter.toData;
        }
        for(let i=0; i<data.length; i++){
            let serviceDate = new Date(moment(data[i].Service.ServiceStartDate, 'YYYY-MM-DD').format('YYYY-MM-DD'));
            if(serviceDate.getTime() >= fromDate.getTime()){ 
                filter.push(data[i]);
            }
        }
        dateFilter.fromData = filter;
        store.admin.table.service_requests
        .clear()
        .rows.add(filter)
        .draw();
    }

    function search_by_to_date(val){
        let toDate = new Date(val);
        let data = [];
        let filter = [];
        if(dateFilter.fromData.length==0){
            data = store.admin.data.service_requests;
        }
        else{
            data = dateFilter.fromData;
        }
        for(let i=0; i<data.length; i++){
            let serviceDate = new Date(moment(data[i].Service.ServiceStartDate, 'YYYY-MM-DD').format('YYYY-MM-DD'));
            if(serviceDate.getTime() <= toDate.getTime()){ 
                filter.push(data[i]);
            }
        }
        dateFilter.toData = filter;
        store.admin.table.service_requests
        .clear()
        .rows.add(filter)
        .draw();
    }

    function clear_all_value(){
        $('input').val('').keyup();
        $('[name="userRoleSelect"]').val('').change();
        $('[name="serviceStatusSelect"]').val('').change();

        // REMOVE FILTERED DATA...
        dateFilter.fromData = [];
        dateFilter.toData = [];

        store.admin.table.service_requests
        .clear()
        .rows.add(store.admin.data.service_requests)
        .draw();

        store.admin.table.user_management
        .clear()
        .rows.add(store.admin.data.user_management)
        .draw();
    }

</script>

<script>

    function open_edit_service_model(id){        
        let filterData = store.admin.data.service_requests.filter((i)=>{
            if(i.Service.Id == id){
                return i;
            }
        });
        filterData = filterData[0];
        store.id.reschedule = filterData.Service.Id;
        // ---------- DATE ----------
        const serviceDate = moment(filterData.Service.ServiceStartDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
        $('[name="edit_service_date"]').val(serviceDate);
        $('[name="edit_service_time"]').val(filterData.Service.StartTime);
        $('[name="edit_service_street_name"]').val(filterData.ServiceAddress.AddressLine1);
        $('[name="edit_service_street_name_readonly"]').val(filterData.ServiceAddress.AddressLine1);
        $('[name="edit_service_house_number"]').val(filterData.ServiceAddress.AddressLine2);
        $('[name="edit_service_house_number_readonly"]').val(filterData.ServiceAddress.AddressLine2);
        $('[name="edit_service_city"]').val(filterData.ServiceAddress.City);
        $('[name="edit_service_city_readonly"]').val(filterData.ServiceAddress.City);
        $('[name="edit_service_postal_code"]').val(filterData.ServiceAddress.PostalCode);
        $('[name="edit_service_postal_code_readonly"]').val(filterData.ServiceAddress.PostalCode);
        open_model('edit_service_request');
    }

    function cancel_service(id){
        Swal.fire({
            title : 'Are you Sure?',
            icon : 'warning',
            showCancelButton: true
        })
        .then((res)=>{
            if(res.isConfirmed){
                $.ajax({
                    url : `${BASE_URL}/admin/service/cancel/${id}`,
                    method : 'PATCH',
                    beforeSend : function(){
                        // SET LOADER...
                        open_loader();
                    },
                    complete : function(){
                        // REMOVE LOADER...
                        close_loader();
                    },
                    success : function(res){
                        if(res!=="" && res!==undefined){
                            try{
                                const result = JSON.parse(res);
                                Swal.fire({
                                    title : result.message,
                                    icon : 'success'
                                });
                                store.admin.table.service_requests.ajax.reload();
                            }
                            catch(e){
                                Swal.fire({
                                    title : 'Invalid JSON Response!',
                                    icon : 'error'
                                })
                            }
                        }
                    },
                    error : function(obj){
                        if(obj!==undefined && obj!==""){
                            const {responseText} = obj;
                            const error = JSON.parse(responseText);
                            Swal.fire({
                                title : error.message,
                                icon : 'error'
                            });
                        }
                    }
                })
            }
        })
    }
</script>