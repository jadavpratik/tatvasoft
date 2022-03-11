<table id="sp_upcoming_services_table">
    <thead>
        <tr>
            <th>Service Id</th>
            <th>Service Date</th>
            <th>Customer Details</th>
            <th>Distance</th>
            <th>Actions</th>    
        </tr>
    </thead>
    <tbody>
        <!-- DYNAMIC TABLE GENERATED BY DATATABLE -->
    </tbody>
</table><!-- END_UPCOMING_SERVICE -->


<!-- **********SP-UPCOMING-SERVICE-REQUEST********** -->
<script>
    $(document).ready(function(){
        state.sp_upcoming_services_table = $('#sp_upcoming_services_table').DataTable({
            searching : false,
            serviceSide : true,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/sp-upcoming-services`,
                cache : true,
                dataSrc : function(data){
                    // STORE DATA GLOBALLY...
                    state.sp_upcoming_services_data = data;
                    return data;
                },
            },
            columns :[
                {
                    mRender : function(data, type, row){
                        return`<p class="service_id">${row.ServiceRequestId}</p>`;
                    },
                },
                {
                    mRender : function(data, type, row){
                        return `<div class="service_date">
                                    <div>
                                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                                        <p>${row.ServiceDate}</p>
                                    </div>
                                    <div>
                                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                                        <p>${row.StartTime} - ${row.EndTime}</p>                            
                                    </div>    
                                </div>`;
                    }
                },
                {
                    mRender : function(data, type, row){
                        return `<div class="customer_details">
                                    <p>${row.CustomerName}</p>
                                    <div>
                                        <img src="<?= assets('assets/img/table/home.png'); ?>" alt="">
                                        <p>${row.AddressLine1} ${row.AddressLine2}, ${row.PostalCode} ${row.City}</p>
                                    </div>
                                </div>`;
                    }
                },
                {
                    mRender : function(data, type, row){
                        return ``;
                        // return `<p class="distance">15 Km</p>`;
                    }
                },
                {
                    mRender : function(data, type, row){
                        return `<button class="cancel_btn" onclick="reject_service_by_sp(${row.ServiceRequestId});">Cancel</button>`;
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

<!-- **********CANCEL-SERVICE-SERVICE-BY-SP********** -->
<script>
    function reject_service_by_sp(id){
        Swal.fire({
            title : 'Are you sure?',
            showCancelButton: true, 
            icon : 'warning'
        }).then((res)=>{
            if(res.isConfirmed){

                $.ajax({
                    url : `${BASE_URL}/reject-service/${id}`,
                    method : 'PATCH',
                    success : function(res){
                        if(res!=="" && res!==undefined){
                            try{
                                const result = JSON.parse(res);
                                Swal.fire({
                                    title : result.message,
                                    icon : 'success'
                                });
                                close_model();
                                // RELOAD TABLE...
                                state.sp_upcoming_services_table.ajax.reload();
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
                });
            }
        });
    }
</script>