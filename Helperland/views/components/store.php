<!-- ----------GLOBAL FUNCTIONS---------- -->
<script>
    // ----------CLOSE-POPUP----------
    function close_popup(){
        $('.backlight_container').removeClass('backlight');
        $('.model').removeClass('active_model');
        $('.popup_main').addClass('d_none');
        if($(window).width() <= 1280){
            $('.book_service_right').addClass('d_none');
        }
        $('body').css({'overflow-y':'auto'});
    }

    // ----------SET LOADER----------
    function open_loader(){
        $('.backlight_container').addClass('loader');
        $('body').css({'overflow-y':'hidden'});
    }

    // ----------CLOSE LOADER----------
    function close_loader(){
        $('.backlight_container').removeClass('loader');
        $('body').css({'overflow-y':'auto'});
    }

    // ----------SET-CSRF-TOKEN----------
    function set_csrf_token(){
        let cookie = document.cookie.split(';');
        cookie = cookie.map((i)=> {
            arr = [];
            key = i.split('=')[0].trim();
            value = i.split('=')[1].trim();
            arr[key]=value;
            return arr;
        });
        let filtered = cookie.filter((i)=> {
            return i['CSRF-TOKEN'];
        } );
        CSRF_TOKEN = filtered[0]['CSRF-TOKEN'];
    }
</script>

<!-- ----------AJAX-PRE-SETUP---------- -->
<script>
    let CSRF_TOKEN = ``;

    $.ajaxSetup({
        headers : {
            'CSRF-TOKEN' : CSRF_TOKEN
        },
        beforeSend : function(xhr, req){
            if(req.type!=='GET'){
                open_loader();
            }
            close_popup();
            set_csrf_token();
        },
        complete : function(){
            close_loader();
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
</script>

<!-- STORE OBJECT FOR GLOBAL DATA STORING -->
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

<!-- LOGGED-USER-DETAILS -->
<script>    
    <?php if(session('isLogged')){ ?>    
        $.ajax({
            url : `${BASE_URL}/user/details`,
            method : 'GET',
            success : function(res){
                if(res!==undefined || res!==undefined){
                    const result = JSON.parse(res);
                    store.user = result; 
                }
            }
        });
    <?php } ?>
</script>

