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

        case "IT": ?> -->

            <!-- Nav Item - Dashboard <php echo base_url('');?> -->
            <!-- <li class="nav-item active">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span style="color: black">Dashboard</span>
                </a>
            </li>

            <!- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <div class="pt-2 sidebar-heading">Master Data</div>

             <!-- Nav Item - Items -->
             <li class="nav-item">
                <a class="nav-link" href="<?=base_url('items/Items');?>">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Items</span>
                </a>
            </li>

            <!-- Nav Item -Item Categories >-->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('items/Items/items_categories');?>">
                <i class="fas fa-tags"></i>
                    <span>Item Categories</span>
                </a>
            </li>

        <!-- <php break; 
        
        // Admin
        default: ?> -->
    
    <!-- <php break;

    } ?> -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->