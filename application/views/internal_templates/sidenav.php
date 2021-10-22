<style>
    .nav-link {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .nav-link:hover, .nav-link.active, .fas:hover, .fas.active {
        color: #4D252A !important;
    }
</style>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar FF545D-->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #e56b6f">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-text mx-3">PHP-SRePS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- set $data = ['user_role' == session->userdata('user_role')] in controller-->
    <!-- <php $user_role = $this->session->userdata['user_role'];?>
    
    <php switch ($user_role) { 

        case "manager": ?> -->

        <!-- <php break; 
        
        // Admin
        default: ?> -->

        <!-- Nav Item - Items -->
        <li class="nav-item">
            <a class="nav-link <?php if ($selected == "items") echo 'active'; ?>"  href="<?=base_url('items/Items/');?>">
            <i class="fas fa-shopping-cart <?php if ($selected == "items") echo 'active'; ?>"></i>
                <span>Items</span>
            </a>
        </li>

        <!-- Nav Item - Item Categories -->
        <li class="nav-item">
            <a class="nav-link <?php if ($selected == "items_categories") echo 'active'; ?>" href="<?=base_url('items/Items/items_categories');?>">
            <i class="fas fa-tags <?php if ($selected == "items_categories") echo 'active'; ?>"></i>
                <span>Item Categories</span>
            </a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link <?php if ($selected == "dashboard") echo 'active'; ?>"  href="<?=base_url('items/Items');?>">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
            </a>
        </li>

        <!-- Nav Item - Sales >-->
        <li class="nav-item">
            <a class="nav-link <?php if ($selected == "sales") echo 'active'; ?>" href="<?=base_url('items/Items/items_categories');?>">
            <i class="fas fa-dollar-sign"></i>
                <span>Sales</span>
            </a>
        </li>

        <!-- Nav Item - Inventory >-->
        <li class="nav-item">
            <a class="nav-link <?php if ($selected == "inventory") echo 'active'; ?>"  href="<?=base_url('items/Items/items_categories');?>">
            <i class="fas fa-dolly-flatbed"></i>
                <span>Inventory</span>
            </a>
        </li>

        <!-- Nav Item - Reports >-->
        <li class="nav-item">
            <a class="nav-link <?php if ($selected == "reports") echo 'active'; ?>"  href="<?=base_url('items/Items/items_categories');?>">
            <i class="fas fa-chart-bar"></i>
                <span>Reports</span>
            </a>
        </li>

    <!-- <php break;

    } ?> -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->