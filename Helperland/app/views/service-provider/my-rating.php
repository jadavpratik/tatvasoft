<div class="my_rating">
    <table id="sp_my_rating_table">
        <thead>
            <tr>
                <th>Service Id</th>
                <th>Service Date</th>
                <th>Customer Name</th>
                <th>My Rating</th>
                <th>Customer Comment</th>
            </tr>
        </thead>
        <tbody>
            <!-- DYNAMIC GENERTED BY DATATABLE... -->
        </tbody>
    </table>
</div>

<!-- **********SP-MY-RATING********** -->
<script>
    $(document).ready(function(){
        state.sp_my_rating_table = $('#sp_my_rating_table').DataTable({
            searching : false,
            serviceSide : true,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/sp-my-rating`,
                cache : true,
                dataSrc : function(data){
                    // STORE DATA GLOBALLY...
                    state.sp_my_rating_data = data;
                    return data;
                },
            },
            columns :[
                {
                    render : function(data, type, row){
                        return`<p class="service_id">${row.ServiceRequestId}</p>`;
                    },
                },
                {
                    render : function(data, type, row){
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
                    render : function(data, type, row){
                        return `<p class="customer_name">${row.CustomerName}</p>`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `<div class="sp_my_rating">
                                    <div>
                                        ${(function(){
                                            let html = ``;
                                            // FOR RATED STAR...
                                            for(let i=0; i<parseInt(row.Ratings); i++){
                                                html += `<i class="fas fa-star rated_star"></i>`;
                                            }
                                            // FOR UNRATED STAR....
                                            for(let i=0; i<5-parseInt(row.Ratings); i++){
                                                html += `<i class="fas fa-star unrated_star"></i>`;
                                            }
                                            return html;
                                        })()}
                                    </div>
                                    <p>${row.HighestRating}</p>
                                </div>`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `<p>${row.Comments}</p>`;
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

