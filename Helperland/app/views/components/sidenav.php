<aside class="sidenav">

    <?php if(session('isLogged')==true){ ?>
        <!-- FOR_LOGGED_USER -->
        <div class="sidenav_header">
            <p>Warm Welcome</p>
            <p class="sidenav_logged_username"><?= session('userName'); ?></p>
        </div>
        <hr>
    <?php } ?>

    <div class="sidenav_main">
        <!-- GUEST_USER -->
        <a href="<?= url('/book-now'); ?>">Book Now</a>
        <a href="<?= url('/prices'); ?>">Prices & Services</a>
        <a href="<?= url('/guarantee'); ?>">Guarantee</a>
        <a href="<?= url('/blog'); ?>">Blog</a>
        <a href="<?= url('/contact'); ?>">Contact</a>
        <a href="javascript:void(0);" onclick="open_model('login')">Login</a>
        <a href="<?= url('/service-provider/signup'); ?>">Become a Helper!</a>


        <?php if(session('isLogged')==true){ ?>

            <!-- CUSTOMER -->
            <?php if(session('userRole')=='customer'){ ?>
                <a href="javascript:void(0);">Overview</a>
                <a href="javascript:void(0);">Completed Service Orders</a>
                <a href="javascript:void(0);">Calander view</a>
                <a href="javascript:void(0);">My Favorites</a>
                <a href="javascript:void(0);">Bills</a>
            <?php } ?>

            <!-- SERVICE_PROVIDER -->
            <?php if(session('userRole')=='service_provider'){ ?>
                <a href="javascript:void(0);">Overview</a>
                <a href="javascript:void(0);">New Inquiries</a>
                <a href="javascript:void(0);">Accepted Requests</a>
                <a href="javascript:void(0);">Calander view</a>
                <a href="javascript:void(0);">Completed Service Orders</a>
                <a href="javascript:void(0);">My Reviews</a>
                <a href="javascript:void(0);">Block Customer</a>
                <a href="javascript:void(0);">Bills</a>
            <?php } ?>

            <!-- COMMAN_LINKS FOR LOGGED_USER -->
            <a href="<?= url('/my-setting'); ?>">My Setting</a>
            <a href="<?= url('/logout'); ?>">Logout</a>

        <?php } ?>

    </div>
    <hr>

    <?php if(session('isLogged')==true){ ?>
        <!-- COMMAN_LINKS FOR LOGGED_USER -->
        <div class="sidenav_comman_links">
            <!-- BOOK NOW FOR CUSTOMER -->
            <a href="<?= url('/book-now'); ?>">Book Now</a>
            <a href="<?= url('/prices'); ?>">Prices & Services</a>
            <a href="<?= url('/guarantee'); ?>">Guarantee</a>
            <a href="<?= url('/blog'); ?>">Blog</a>
            <a href="<?= url('/contact'); ?>">Contact</a>
        </div>
        <hr>
    <?php } ?>

    <div class="sidenav_footer">
        <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
        <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
    </div>

</aside>
