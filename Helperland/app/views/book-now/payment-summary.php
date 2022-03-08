<div class="payment_summary">
    <p>Payment Summary</p>
    <div>
        <div>
            <p><span id="service_date">00/00/0000</span>&nbsp;&nbsp;<span id="service_time">00:00</span>&nbsp;&nbsp;(Time in 24hr format)</p>
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
                <p>Per Cleaning</p>	
                <p id="service_per_price">₹0</p>
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
        let serviceDateObj = new Date(service_request.date);
        let serviceYear = serviceDateObj.getFullYear();
        let serviceMonth = serviceDateObj.getMonth()+1;
        let serviceDate = serviceDateObj.getDate();
        if(serviceMonth<10){
            serviceMonth = `0${serviceMonth}`;
        }
        if(serviceDate<10){
            serviceDate = `0${serviceDate}`;
        }

        $('#service_date').html(`${serviceDate}/${serviceMonth}/${serviceYear}`);
        $('#service_time').html(`${service_request.time}`);
        $('#service_duration').html(`${service_request.duration} Hours`);
        $('#service_total_time').html(`${service_request.duration + service_request.extra_time} Hours`);
        $('#service_extra_container').html(`${(function(){
            let extra_services = ``;
            for(let i=0; i<service_request.extra.length; i++){
                extra_services += `
                    <div>
                        <p>Inside ${service_request.extra[i]} (Extra)</p>
                        <p>30 Mins</p>
                    </div>`; 
            }
            return extra_services;
        })()}`);
        $('#service_per_price').html(`₹${service_request.per_price}`);
        //  TOTAL PRICES = BASIC PRICE(3 SERVICE) + EXTRA SERVICE(DYNAMICS);
        service_request.total_price = service_request.per_price*3 + (service_request.per_price/2)*service_request.extra.length;
        $('#service_total_price').html(`₹${service_request.total_price}`);
    }

</script>