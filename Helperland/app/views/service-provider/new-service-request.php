<div class="sp_new_service_request" style="padding-bottom:10px;">
    <!-- <div>
        <p>Service Area</p>
        <select name="" id="">
            <option value="">25</option>
        </select>
    </div> -->
    <div>
        <input type="checkbox">
        <label for="">including pet at home</label>
    </div>    
</div>
<table id="sp_new_services_table">
    <thead>
        <tr>
            <th>Service Id</th>
            <th>Service Date</th>
            <th>Customer Details</th>
            <th>Payment</th>
            <!-- <th>Time Conflict</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- GENERATED BY DATATABLE -->
    </tbody>
</table>

<!-- **********ACCEPT-SERVICE********** -->
<script>
    // SETUP HTML FOR ACCEPT SERVICE POPUP...
    function accept_service_open_model(id){
        // $₹
        let data = state.sp_new_services_data.filter((service)=>{
            if(service.ServiceRequestId==id){
                return service;
            }
        });
        data = data[0];

        // FOR ACCEPT SERVICE ID STORE GLOBALLY...
        state.accept_service_id = data.ServiceRequestId;

        $('#accept_service_request_popup').html(`
            <p class="popup_title">Service Details</p>
            <div class=""><!-- FIRST DIV -->
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
                    <p>Total Amount : <span class="payment_text">₹${data.TotalCost}</span></p>
                </div>
                <div>
                    <p>Customer Name : <span>${data.CustomerName}</span></p>
                    <p>Service Address : <span>${data.AddressLine1} ${data.AddressLine2}, ${data.PostalCode} ${data.City} </span></p>			
                    <!-- <p>Distance : <span>296km</span></p>-->
                </div>
                <div>
                    <p>Conmments : <span>${data.Comments?data.Comments : ''}</span></p>
                </div>
                <div class="table_btn_container">
                    <button class="accept_btn" onclick="accept_service();"><i class="fas fa-check"></i>Accept</button>
                </div>		
            </div>
            <div><!-- SECOND DIV FOR MAP -->
                <img src="<?= assets('assets/img/static/contact/section_2/map.png'); ?>" alt="">
            </div>
        `);
        open_model('accept_service_request');
    }
</script>

<!-- **********NEW-SERVICE-REQUEST********** -->
<script>
    $(document).ready(function(){
        state.sp_new_services_table = $('#sp_new_services_table').DataTable({
            searching : false,
            serviceSide : true,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/sp-new-services`,
                cache : true,
                dataSrc : function(data){
                    // STORE DATA GLOBALLY...
                    state.sp_new_services_data = data;
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
                                        <p>${row.StartTime} to ${row.EndTime}</p>
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
                        // €
                        return `<p class="payment_text">₹<span>${row.TotalCost}</span></p>`;
                    }
                },
                // {
                //     mRender : function(data, type, row){
                //         // TIME CONFLICT...
                //         return ``;
                //     }
                // },
                {
                    mRender : function(data, type, row){
                        return `<div style="display:flex;">
                                    <button class="accept_btn" onclick="accept_service_open_model(${row.ServiceRequestId});">Accept</button>
                                    <button class="accept_btn" onclick="complete_service(${row.ServiceRequestId});">Complete</button>
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

