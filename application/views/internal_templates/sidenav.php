<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #FF545D">

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

            <!-- Nav Item - Chat <=base_url('user/chat/Chat');?>-->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-comment"></i>
                    <span>Items</span>
                </a>
            </li>

            <!-- Nav Item - Course Applicants <=base_url('internal/level_2/academic_counsellor/Ac_course_applicants');?>-->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-file-alt"></i>
                    <span>Users</span>
                </a>
            </li>

        <!-- <php break; 
        
        // Admin
        default: ?> -->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">Master Data</div>

        <!-- Nav Item - Accounts Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accounts_collapse"
                aria-expanded="true" aria-controls="accounts_collapse">
                <i class="fas fa-user"></i>
                <span>User Accounts</span>
            </a>
            <div id="accounts_collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/Admin_user_acc');?>">All Users</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/Users_information/students_info');?>">Students</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/Users_information/ac_info');?>">Academic Counsellors</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/Users_information/ea_info');?>">Education Agents</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/Users_information/ep_info');?>">Education Partners</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/Users_information/employer_info');?>">Employers</a>
                </div>
            </div>
        </li>
    
    <!-- <php break;

    } ?> -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->