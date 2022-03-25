<div class="customer_service_history">
    <p>Service History</p>
    <button class="export_btn" onclick="export_table_data()">Export</button>
</div>
<table id="customer_service_history_table">
    <thead>
        <tr>
            <th>Service Details</th>
            <th>Service Provider</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Rate SP</th>    
        </tr>
    </thead>
    <tbody>
        <!-- GENERATED BY DATATABLE -->
    </tbody>
</table>

<!-- **********CUSTOMER SERVICE-HISTORY SCRIPTS********** -->
<script>

    // EXPORT TABLE AS EXCEL....
    function export_table_data(){
        $("#customer_service_history_table").table2excel({
            exclude_img: true,
            filename: "Customer Service History.xls"
        });
    }

    $(document).ready(function(){
        store.customer.table.service_history = $('#customer_service_history_table').DataTable({
            searching : false,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/customer/service/history/`,
                method : 'GET',
                cache : true,
                dataSrc : function(data){
                    store.customer.data.service_history = data;
                    return data;
                }
            },
            columns :[
                {
                    render : function(data, type, row){
                        return`<div class="service_details" onclick="show_service_details(${row.ServiceRequestId})">
                                    <div>
                                        <img src="<?= assets('assets/img/table/calendar_black.png'); ?>" alt="">
                                        <p>${row.ServiceDate}</p>
                                    </div>
                                    <div>
                                        <i class="far fa-clock"></i>
                                        <p>${row.StartTime} - ${row.EndTime}</p>
                                    </div>
                                </div>`;
                    },
                },
                {
                    render : function(data, type, row){
                        if(row.ServiceProvider!==undefined){
                            return `
                                <div class="service_provider" onclick="show_service_details(${row.ServiceRequestId})">
                                    <img class="hat_style" src="${BASE_URL}/assets/img/avatar/${row.ServiceProvider.UserProfilePicture}.png" alt="">
                                    <div>
                                        <p>${row.ServiceProvider.FirstName} ${row.ServiceProvider.LastName}</p>    
                                        <div>
                                            ${(function(){
                                                let rating_html = ``;
                                                if(row.Rating!==undefined){
                                                    // FOR RATED STAR...
                                                    for(let i=0; i<parseInt(row.Rating); i++){
                                                        rating_html +=`<i class="fas fa-star rated_star"></i>`;
                                                    }
                                                    // FOR UNRATED STAR...
                                                    for(let i=0; i<(5-parseInt(row.Rating)); i++){
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
                                            <span>${row.Rating!==undefined?parseFloat(row.Rating):''}</span>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        else{
                            return `<p onclick="show_service_details(${row.ServiceRequestId})">No SP</p>`;
                        }
                    }
                },
                {
                    render : function(data, type, row){
                        // €
                        return `<p class="payment_text" onclick="show_service_details(${row.ServiceRequestId})">€<span>${row.TotalCost}</span></p>`;
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
                {
                    render : function(data, type, row){
                        // 0    : NEW
                        // 1    : PENDING
                        // 2    : COMPLETED
                        // 3    : CANCALLED
                        if(row.Status==2){
                            return `<button class="rate_sp_btn" onclick="rate_sp_open_model(${row.ServiceRequestId})">Rate SP</button>`;
                        }
                        else{
                            return `<button class="rate_sp_btn" disabled>Rate SP</button>`;
                        }
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

<!-- **********RATE-SP-SETUP-HTML-SCRIPTS********** -->
<script>

    function rate_sp_open_model(id){
        store.id.rate_sp = id;
        let data = store.customer.data.service_history;
        data = data.filter((service)=>{
            if(service.ServiceRequestId==id){
                return service;
            }
        });

        data = data[0];

        // ASSIGN HTML BEFORE OPEN MODEL
        $('#rating_popup').html(`
            <!-- ON RATE SERVICE PROVIDER  -->
            <div class="service_provider">
                <img class="hat_style" src="${BASE_URL}/assets/img/avatar/${data.ServiceProvider.UserProfilePicture}.png" alt="">
                <div>
                    <p>${data.ServiceProvider.FirstName} ${data.ServiceProvider.LastName}</p>
                    <div>
                        ${(function(){
                            let rating_html = ``;
                            if(data.Rating!==undefined){
                                // FOR RATED STAR...
                                for(let i=0; i<parseInt(data.Rating); i++){
                                    rating_html +=`<i class="fas fa-star rated_star"></i>`;
                                }
                                // FOR UNRATED STAR...
                                for(let i=0; i<(5-parseInt(data.Rating)); i++){
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
                        <span>${data.Rating!==undefined?parseInt(data.Rating) : ''}</span>
                    </div>
                </div>
            </div><!-- END-SERVICE-PROVIDER -->
            <div class="rate_type">
                <div class="rating_container">
                    <p>On Time Arriaval</p>    
                    <div class="rating_div">
                        <input type="radio" id="arrival_rating_5" name="arrival_rating" value="5">
                        <label for="arrival_rating_5"><i class="fas fa-star unrated_star"></i></label>    
                        <input type="radio" id="arrival_rating_4" name="arrival_rating" value="4">
                        <label for="arrival_rating_4"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="arrival_rating_3" name="arrival_rating" value="3">
                        <label for="arrival_rating_3"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="arrival_rating_2" name="arrival_rating" value="2">
                        <label for="arrival_rating_2"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="arrival_rating_1" name="arrival_rating" value="1">
                        <label for="arrival_rating_1"><i class="fas fa-star unrated_star"></i></label>
                    </div>
                </div>
                <div class="rating_container">
                    <p>Friendly</p>    
                    <div class="rating_div">
                        <input type="radio" id="friendly_rating_5" name="friendly_rating" value="5">
                        <label for="friendly_rating_5"><i class="fas fa-star unrated_star"></i></label>    
                        <input type="radio" id="friendly_rating_4" name="friendly_rating" value="4">
                        <label for="friendly_rating_4"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="friendly_rating_3" name="friendly_rating" value="3">
                        <label for="friendly_rating_3"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="friendly_rating_2" name="friendly_rating" value="2">
                        <label for="friendly_rating_2"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="friendly_rating_1" name="friendly_rating" value="1">
                        <label for="friendly_rating_1"><i class="fas fa-star unrated_star"></i></label>
                    </div>
                </div>
                <div class="rating_container">
                    <p>Quality of Service</p>    
                    <div class="rating_div">
                        <input type="radio" id="quality_rating_5" name="quality_rating" value="5">
                        <label for="quality_rating_5"><i class="fas fa-star unrated_star"></i></label>    
                        <input type="radio" id="quality_rating_4" name="quality_rating" value="4">
                        <label for="quality_rating_4"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="quality_rating_3" name="quality_rating" value="3">
                        <label for="quality_rating_3"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="quality_rating_2" name="quality_rating" value="2">
                        <label for="quality_rating_2"><i class="fas fa-star unrated_star"></i></label>
                        <input type="radio" id="quality_rating_1" name="quality_rating" value="1">
                        <label for="quality_rating_1"><i class="fas fa-star unrated_star"></i></label>
                    </div>
                </div>                        
            </div>
            <div class="rating_feedback">
                <p>Feedback on Service Provider</p>
                <textarea class="textarea" name="rating_feedback"></textarea>
                <button class="popup_btn">Submit</button>
            </div>
        `);
        open_model('rating');
    }

</script>