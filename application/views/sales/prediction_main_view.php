<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/vendor/chart.js/Chart.min.js"></script>

<body id="page-top">

     <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" style="background-color: #fef2f2">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-xl-6 col-md-6">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h1 class="h3 mb-0 mt-4 font-weight-bold mt-5" style="color: black">Monthly Prediction</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Card 1 - Most Sold Item (this month) -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href = "<?=base_url('')?>" style = "text-decoration:none">
                                <div class="card border-left-success shadow h-100 py-2" style="background-color: #c5e9d2 ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Most Sold Item (this month)</div>
                                                <div class = "mr-2 h5 mb-0 font-weight-bold text-gray-800 " style="float: left;" ></div><div id="most_sold_item" style="float: left;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <i class="fas fa-hand-holding-usd fa-2x" style="color: #40916c"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Card 2 - Most Sold Item Subcategory (this month)  -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href = "" style = "text-decoration:none">
                            <a href="<?php echo base_url('items/Items/items_categories_log'); ?>" style="text-decoration:none">
                                <div class="card border-left-primary shadow h-100 py-2" style="background-color: #bbdefb">
                                    <div class="card-body" href="">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Most Sold Item Subcategory (this month)</div>
                                                <div id="most_sold_item_subcategory" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <i class="fas fa-prescription-bottle-alt fa-2x" style="color: #1565c0"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Prediction Form -->
                    <div class="row mb-4">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card h-100 shadow mb-4">
                                <div class="card-header py-3" style="background-color: #e4c2c1">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Generate Prediction</div>
                            </div>
                            <div class="card-body">
                                <form method="post" action=" <?=base_url('sales/Prediction/generate_prediction/')?>" enctype="multipart/form-data">
                                <?= form_open_multipart('') ?>
                                    <div class="form-row pt-4">
                                        <div class="form-group col-md-6 px-4 pr-5">
                                            <label for="item_subcategory_id">Item Subcategory</label>
                                            <select name="item_subcategory_id" id="item" class="form-control form-select form-select-md" required>
                                                <option value="" selected disabled>Item Subcategory</option>
                                                <?php
                                                    foreach($item_categories_data as $item_category) {
                                                        echo '<option value="'.$item_category->item_category_id.'">'.$item_category->item_category_name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 px-4 pr-5">
                                            <label for="item_id">Item</label>
                                            <select name="item_id" id="item" class="form-control form-select form-select-md" required>
                                                <option value="" selected disabled>Item</option>
                                                <!-- <php
                                                    foreach($item_subcategories_data as $item_subcategory) {
                                                        echo '<option value="'.$item_subcategory->item_subcategory_id.'">'.$item_subcategory->item_subcategory_name.'</option>';
                                                    }
                                                ?> -->
                                            </select>
                                    </div>
                                    <!-- Submit button -->
                                    <div class ="pr-4">
                                        <button  type="submit" class="btn" style="background-color: #FF545D; color: white; float:right;" >Submit<i class="fas fa-check pl-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

            <!-- End of Main Content -->
