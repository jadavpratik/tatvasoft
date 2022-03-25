<script>
    let BASE_URL = `<?= BASE_URL; ?>`; 
    let store = {};

    // ----------ID----------
    store.id = {        
        accept:null,
        reject:null,
        cancel:null,
        rate_sp:null,
        complete:null,
        reschedule:null,
        update:null,
        delete:null,
    };

    // ----------BOOK SERVICE----------
    store.book_service = {            
        postal_code : '',
        date : moment().format('DD/MM/YYYY'),
        time : moment().format('H:m'),
        duration : 3,
        comments : '',
        has_pets : false,
        extra : [],
        extra_time : 0,
        sp_id : null,
        per_hour_price : 20,
        total_price : 0,
        address : {},
    };

    // ----------CUSTOMER----------
    store.customer = {
        address : [],
        table:{
            current_services : null,
            service_history : null
        },
        data:{
            current_services : [],
            service_history : [],
            service_providers : []
        }
    };

    // ----------SERVICE PROVIDER----------
    store.service_provider = {
        table:{
            new_services : null,
            upcoming_services : null,
            service_history : null,
            rating : null,
        },
        data:{
            new_services : [],
            upcoming_services : [],
            service_history : [],
            rating : [],
            customers : []
        }
    };

    // ----------ADMIN----------
    store.admin = {
        table:{
            service_requests : null,
            user_management : null
        },
        data:{
            service_requests : [],
            user_management : []
        }
    };
</script>


<script>
    // IF USER IS LOGGED THEN FETCH THEIR DATA AND STORE IT...
    <?php if(session('isLogged')){ ?>    
        $.ajax({
            url : `${BASE_URL}/user/details`,
            method : 'GET',
            success : function(res){
                if(res!==undefined || res!==undefined){
                    const result = JSON.parse(res);
                    store.user = result; 
                }
            },
            error : function(obj){
                if(obj!==undefined){
                    const error = JSON.parse(res);
                    console.log(error.message);
                }
            }
        });
    <?php } ?>
</script>

