<div class="payment_summary">
    <p>Payment Summary</p>
    <div>
        <div>
            <p><span id="service_date">00/00/0000</span>&nbsp;&nbsp;<span id="service_time">00:00</span>&nbsp;&nbsp;</p>
            <!-- NOT INCLUDED IN SRS... -->
            <!-- <p><span>1 bed</span> <span>1 bath</span></p>	 -->
        </div>
        <div>
            <p>Duration</p>
            <div>
                <p>Basic</p>
                <p id="service_duration">0 Hours</p>
            </div>
            <div id="service_extra_container">
                <!-- DYNAMICLY RENDER BY JAVASCRIPT -->
                <!-- <div>
                    <p>Inside Cabinets(Extra)</p>
                    <p>30 Mins</p>
                </div> -->
            </div>
            <div>
                <p>Total Service Time</p>
                <p id="service_total_time">0 Hours</p>
            </div>
        </div>
        <div>
            <div>
                <p>Per Hour Cleaning</p>	
                <p id="service_per_hour_price">₹0</p>
                <!-- $ -->
            </div>
            <!-- NOT INCLUDED IN SRS... -->
            <!-- <div>
                <p>Discount</p>	
                <p>-$27</p>
            </div> -->
        </div>
        <div>
            <div>
                <p>Total Payment</p>
                <p id="service_total_price">₹0</p>	
                <!-- $ -->                
            </div>
            <!-- NOT INCLUDED IN SRS... -->
            <!-- <div>
                <p>Effective Price</p>
                <p>$50.4</p>
            </div>
            <p><span>*</span>You will save 20% according to §35a EStG.</p> -->
        </div>
        <button onclick="open_model('included_services')">
            <i class="far fa-smile"></i>
            <p>See what is always included</p>
        </button>
    </div>
</div>

<!-- **********UPDATE-PAYMENT-SUMMARY-SCRIPTS********** -->
<script>

    function update_payment_summary(){
        let serviceDate = moment(store.book_service.date, 'YYYY-MM-DD').format('DD/MM/YYYY');
        store.book_service.total_price = store.book_service.per_hour_price*store.book_service.duration 
                                      + (store.book_service.per_hour_price/2)*store.book_service.extra.length;

        $('#service_date').html(serviceDate);
        $('#service_time').html(store.book_service.time);
        $('#service_duration').html(`${store.book_service.duration} Hours`);
        $('#service_total_time').html(`${parseInt(store.book_service.duration) + parseInt(store.book_service.extra_time)} Hours`);
        $('#service_extra_container').html(extra_services_html());
        $('#service_per_hour_price').html(`₹${store.book_service.per_hour_price}`);
        $('#service_total_price').html(`₹${store.book_service.total_price}`);

        // EXTRA SERVICES HTML...
        function extra_services_html(){
            // 1 => 'Cabinet'
            // 2 => 'Fridge'
            // 3 => 'Oven'
            // 4 => 'Laundry'
            // 5 => 'Window'
            let extra_services = ``;
            for(let i=0; i<store.book_service.extra.length; i++){
                if(store.book_service.extra[i] == 1)
                    extra_services += `<div><p>Inside Cabinet (Extra)</p><p>30 Mins</p></div>`; 
                else if(store.book_service.extra[i] == 2)
                    extra_services += `<div><p>Inside Fridge (Extra)</p><p>30 Mins</p></div>`; 
                else if(store.book_service.extra[i] == 3)
                    extra_services += `<div><p>Inside Oven (Extra)</p><p>30 Mins</p></div>`; 
                else if(store.book_service.extra[i] == 4)
                    extra_services += `<div><p>Inside Laundry (Extra)</p><p>30 Mins</p></div>`; 
                else if(store.book_service.extra[i] == 5)
                    extra_services += `<div><p>Inside Window (Extra)</p><p>30 Mins</p></div>`; 
            }
            return extra_services;
        }
    }

</script>

