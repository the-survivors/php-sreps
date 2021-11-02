<!-- Plug in for sweetalert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .period {
        background: #FF545D !important;
    }

    .period:hover {
        background-color: #e04a51 !important;
    }
</style>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold" style="color: black">Weekly Sales Report</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url(''); ?>"><i class="fas fa-tachometer-alt pr-2"></i>Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Sales</li>
                                <li class="breadcrumb-item active">Weekly Sales Report</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-9">
                            <div class="" style="background-color:#FFE699; border-radius:10px; width:39.0em; height:auto;">
                                <div class="px-3 py-2 "> <span style="color:white;">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label style="color:black;" class="mr-2 " for="start_date">Start Date</label>
                                                <!-- Date input -->
                                                <?php date_default_timezone_set("Asia/Kuala_Lumpur"); ?>
                                                <input type="date" class="form-control date" id="start_date" value="<?= $start_date ?>">

                                                <label style="color:black;" class="mr-2 ml-5" for="end_date">End Date</label>
                                                <!-- Date input -->
                                                <?php date_default_timezone_set("Asia/Kuala_Lumpur"); ?>
                                                <input type="date" class="form-control date" id="end_date" value="<?= $end_date ?>">
                                            </div>

                                        </form>

                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-3">
                            <!-- Button group for daily, weekly & monthly -->
                            <div class="d-flex justify-content-end">
                                <div class="btn-group" role="group" aria-label="page_chooser">
                                    <a style="color:white; <?php if ($selected_period == 'weekly') {
                                                                echo 'background:#e04a51 !important ';
                                                            } ?>" id="period2" type="button" class="btn btn-lg period">Weekly</a>
                                    <a style="color:white; <?php if ($selected_period == 'monthly') {
                                                                echo 'background:#e04a51 !important ';
                                                            } ?>" id="period3" type="button" href="<?php echo base_url('sales/sales_report/monthly_sales_report/' . date('m') . '/' . date('Y')); ?>" class="btn btn-lg period">Monthly</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row (Start here)-->
                    <div class="row">
                        <div class="col-xl-12">


                        </div>
                    </div>
                    <!-- /. Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->