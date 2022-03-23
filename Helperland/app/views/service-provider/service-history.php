<div class="sp_service_history">
    <!-- <div>
        <p>Payment Status</p>
        <select name="" id="">
            <option value="">All</option>
        </select>
    </div> -->
    <button class="export_btn" onclick="export_table_data()">Export</button>
</div>
<table id="sp_service_history_table">
    <thead>
        <tr>
            <th>Service Id</th>
            <th>Service Date</th>
            <th>Customer Details</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <!-- GENERATED BY DATATABLE -->
    </tbody>
</table>


<!-- **********SP-SERVICES-HISTORY********** -->
<script>

    // EXPORT TABLE AS EXCEL....
    function export_table_data(){
        $("#sp_service_history_table").table2excel({
            exclude_img: true,
            filename: "Service Provider Service History.xls"
        });
    }

    $(document).ready(function(){
        store.service_provider.table.service_history = $('#sp_service_history_table').DataTable({
            searching : false,
            serviceSide : true,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/service-provider/service/history`,
                cache : true,
                dataSrc : function(data){
                    store.service_provider.data.service_history = data;
                    return data;
                },
            },
            columns :[
                {
                    render : function(data, type, row){
                        return`<p class="service_id" onclick="show_service_details(${row.ServiceRequestId})">${row.ServiceRequestId}</p>`;
                    },
                },
                {
                    render : function(data, type, row){
                        return `<div class="service_date" onclick="show_service_details(${row.ServiceRequestId})">
                                    <div>
                                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                                        <p>${row.ServiceDate}</p>
                                    </div>
                                    <div>
                                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                                        <p>${row.StartTime} to ${row.EndTime}</p>
                                    </div>
                                </div>`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `<div class="customer_details" onclick="show_service_details(${row.ServiceRequestId})"> 
                                    <p>${row.CustomerName}</p>
                                    <div>
                                        <img src="<?= assets('assets/img/table/home.png'); ?>" alt="">
                                        <p>${row.AddressLine1} ${row.AddressLine2}, ${row.PostalCode} ${row.City}</p>
                                    </div>
                                </div>`;
                    }
                },
                {
                    render : function(data, type, row){
                        switch(row.Status){
                            case 2:
                                return `<p class="completed_status" onclick="show_service_details(${row.ServiceRequestId})">Completed</p>`;
                            case 3:
                                return `<p class="cancelled_status" onclick="show_service_details(${row.ServiceRequestId})">Cancelled</p>`;
                        }
                    }
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
            }
        });
    });
</script>
