<div class="user_management">
    <div>
        <p>User Management</p>
        <!-- <button class="add_new_user_btn"><i class="fas fa-plus"></i> Add New User</button> -->
    </div>
    <div>
        <!-- <select class="select" name="" >
            <option value="">User Name</option>
        </select> -->
        <input class="input" type="text" placeholder="User Name" onkeyup="search_by_username(this.value)">
        <select class="select" name="userRoleSelect" onchange="search_by_userrole(this.value)">
            <option value="">All</option>
            <option value="Customer">Customer</option>
            <option value="Service Provider">Service Provider</option>
        </select>
        <div class="phone_number">
            <label for="">+46</label>
            <input type="text" placeholder="Phone Number" onkeyup="search_by_phone(this.value)">
        </div>
        <input class="input" type="text" placeholder="Zip Code" onkeyup="search_by_zipcode(this.value)">
        <!-- <button class="search_btn" onclick="search_by_all_value()">Search</button> -->
        <button class="clear_btn" onclick="clear_all_value()">Clear</button>
    </div>
</div><!-- END_USER_MANAGEMENT -->

<table id="admin_user_management_table">
    <thead>
        <tr>
            <th>User Name</th>
            <!-- <th>User Type</th> -->
            <th>Date of Registration</th>
            <th>Role</th>
            <th>Phone</th>
            <th>Postal Code</th>
            <!-- <th>City</th>
            <th>Radius</th> -->
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- GENERATED BY DATATABLE -->
    </tbody>
</table><!-- END_USER_MANAGEMENT_TABLE -->

<!-- **********ADMIN-USER-MANAGEMENT********** -->
<script>
    $(document).ready(function(){
        store.admin.table.user_management = $('#admin_user_management_table').DataTable({
            searching : true,
            serviceSide : true,
            autoWidth : false,
            dom : 't<"datatable_bottom"lp>',
            ajax : {
                url : `${BASE_URL}/admin/user-management`,
                cache : true,
                dataSrc : function(data){
                    data = data.filter((i)=>{
                        if(i.RoleId!==3){
                            return i;
                        }
                    })                    
                    store.admin.data.user_management = data;
                    return data;
                }
            },
            columns : [
                {
                    render : function(data, type, row){
                        return `${row.FirstName} ${row.LastName}`;
                    }
                },
                {
                    render : function(data, type, row){
                        return `${row.CreatedDate}`;
                    }
                },
                {
                    render : function(data, type, row){
                        switch(row.RoleId){
                            case 1:
                                return `Customer`;
                            case 2:
                                return `Service Provider`;
                            default:
                                return ``;
                        }
                    }
                },
                {
                    render : function(data, type, row){
                        return `${row.Mobile}`;
                    }
                },
                {
                    render : function(data, type, row){
                        if(row.ZipCode!=null)
                            return `${row.ZipCode}`;
                        else
                            return ``;
                    }
                },
                {
                    render : function(data, type, row){
                        switch(row.IsActive){
                            case 0:
                                return `<p class="inactive_status">Inactive</p>`;
                            case 1:
                                return `<p class="active_status">Active</p>`;
                            default:
                                return `<p class="inactive_status">InActive</p>`;
                        } 
                    }
                },
                {
                    render : function(data, type, row){
                        return `<div class="dropdown">
                                    <button class="dropdown_btn"><i class="fas fa-ellipsis-v"></i></button>
                                    <div class="dropdown_menu d_none">
                                        <a href="javascript:void(0)" onclick="action_on_user('active', ${row.UserId});" >Active</a>
                                        <a href="javascript:void(0)" onclick="action_on_user('inactive', ${row.UserId})">Inactive</a>
                                        <!--<a href="javascript:void(0)">Service History</a>-->
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

    // DATATABLE COLUMN START FROM ZERO...
    function search_by_username(val){
        store.admin.table.user_management.column(0).search(val).draw();
    }

    function search_by_userrole(val){
        store.admin.table.user_management.column(2).search(val).draw();
    }

    function search_by_phone(val){
        store.admin.table.user_management.column(3).search(val).draw();
    }

    function search_by_zipcode(val){
        store.admin.table.user_management.column(4).search(val).draw();
    }

    function clear_all_value(){
        $('input').val('').keyup();
        $('[name="userRoleSelect"]').val('').change();
    }

</script>

<!-- **********MAKE-USER-ACTIVE-INACTIVE********** -->
<script>
    // MAKE USER ACTIVE & INACTIVE...
    function action_on_user(type, id){
        $.ajax({
            url : `${BASE_URL}/admin/user/${type}/${id}`,
            method : 'PATCH',
            success : function(res){
                if(res!=="" && res!==undefined){
                    try{
                        const result = JSON.parse(res);
                        Swal.fire({
                            title : result.message,
                            icon : 'success'
                        });
                        store.admin.table.user_management.ajax.reload();
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
</script>