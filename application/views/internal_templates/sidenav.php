<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #6B9080">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-text mx-3">iJEES</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- set $data = ['user_role' == session->userdata('user_role')] in controller-->
    <?php $user_role = $this->session->userdata['user_role'];?>
    
    <?php switch ($user_role) { 

        case "Academic Counsellor": ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('internal/level_2/academic_counsellor/ac_dashboard');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Chat -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('user/chat/Chat');?>">
                    <i class="fas fa-comment"></i>
                    <span>Chat Room</span>
                </a>
            </li>

            <!-- Nav Item - Course Applicants -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('internal/level_2/academic_counsellor/Ac_course_applicants');?>">
                    <i class="fas fa-file-alt"></i>
                    <span>Course Applications</span>
                </a>
            </li>

        <?php break; 
        
        case "Education Agent": ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?=base_url('internal/level_2/education_agent/Ea_dashboard');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - New Course Application -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('internal/level_2/education_agent/ea_course_application');?>">
                    <i class="fas fa-plus-square"></i>
                    <span>Course Applications</span>
                </a>
            </li>

        <?php break; 
        
        case "Education Partner": ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - University -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('internal/level_2/educational_partner/ep_university');?>">
                    <i class="fas fa-university"></i>
                    <span>University</span>
                </a>
            </li>

            <!-- Nav Item - Course -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('internal/level_2/educational_partner/ep_courses');?>">
                    <i class="fas fa-book"></i>
                    <span>Courses</span>
                </a>
            </li>

            <!-- Nav Item - Browse R&DP -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('external/Rd_projects')  ;?>">
                    <i class="fas fa-search"></i>
                    <span>Browse R&D Projects</span>
                </a>
            </li>

            <!-- Nav Item - My R&DP Application -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('internal/level_2/educational_partner/Ep_my_rd_project');?>">
                    <i class="fas fa-list"></i>
                    <span>My R&D Projects</span>
                </a>
            </li>

            <!-- Nav Item - R&DP Application -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rd_applicants_collapse"
                    aria-expanded="true" aria-controls="rd_applicants_collapse">
                    <i class="fas fa-plus-square"></i>
                    <span>R&D Projects Application</span>
                </a>
                <div id="rd_applicants_collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?=base_url('internal/level_2/educational_partner/ep_rd_applicants');?>">My Applications</a>
                        <a class="collapse-item" href="<?=base_url('internal/level_2/educational_partner/ep_rd_applicants/project_partners_page');?>">Project Partners</a>
                    </div>
                </div>
            </li>

        <?php break; 
        
        case "Employer": ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?=base_url('internal/level_2/Employer/Employer_dashboard')  ;?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Chat -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('user/chat/Chat');?>">
                    <i class="fas fa-comment"></i>
                    <span>Chat Room</span>
                </a>
            </li>

            <!-- Nav Item - Employer Projects -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('internal/level_2/Employer/Employer_emps')  ;?>">
                    <i class="fas fa-user-tie"></i>
                    <span>Employer Projects (EPs)</span>
                </a>
            </li>

            <!-- Nav Item - Past Applications -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('internal/level_2/Employer/Employer_emp_applicants')  ;?>">
                    <i class="fas fa-user-edit"></i>
                    <span>EP Applications</span>
                </a>
            </li>

        <?php break; 
        
        // Admin
        default: ?>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?=base_url('internal/admin_panel/Admin_dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

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

        <!-- Nav Item - Student Applications Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#applications_collapse"
                aria-expanded="true" aria-controls="applications_collapse">
                <i class="fas fa-file-alt"></i>
                <span>Applications</span>
            </a>
            <div id="applications_collapse" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/applicants/Admin_course_application');?>">Courses</a>
                    <a class="collapse-item" href="<?= base_url('internal/admin_panel/applicants/Admin_emp_applicants');?>">Employer Projects (EPs)</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/applicants/Admin_rd_app');?>">R&D Projects (R&DPs)</a>                </div>
            </div>
        </li>

        <!-- Nav Item - Content Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#content_collapse"
                aria-expanded="true" aria-controls="content_collapse">
                <i class="fas fa-database"></i>
                <span>Content</span>
            </a>
            <div id="content_collapse" class="collapse" aria-labelledby="headingPages"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/content/Admin_universities');?>">Universities</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/content/Admin_courses');?>">Courses</a>
                    <a class="collapse-item" href="<?= base_url('internal/admin_panel/content/Admin_emps');?>">Employer Projects (EPs)</a>
                    <a class="collapse-item" href="<?=base_url('internal/admin_panel/content/Admin_rd_project');?>">R&D Projects (R&DPs)</a>
                </div>
            </div>
        </li>
    
    <?php break;

    } ?>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->