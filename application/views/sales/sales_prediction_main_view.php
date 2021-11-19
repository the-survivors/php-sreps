<script src="<?php echo base_url()?>/assets/vendor/jquery/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 font-weight-bold" style="color: black">Monthly Sales Prediction</h1>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-8">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('users/Dashboard/Manager'); ?>"><i class="fas fa-tachometer-alt pr-2"></i>Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Monthly Sales Prediction</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Card 1 - Total Sales -->
                        <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2" style="background-color: #fdcfb2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #EB6612">Most Popular Item Sold In This Month</div>
                                                <div class = "mr-2 h5 mb-0 font-weight-bold text-gray-800" style="float: left;" >#<?php echo $most_sold_item->item_id ?> - <?php echo $most_sold_item->item_name ?></div><br>
                                                <div class = "mr-2 h5 mb-0 font-weight-bold text-gray-800" style="float: left;">Units Sold: </div><div id="most_sold_items_counter" style="float: left;" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <i class="fas fa-fire fa-2x" style="color: #F66306"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- Card 2 - Total Item -->
                        <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2" style="background-color: #ffb3c1">
                                    <div class="card-body" href="">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #ED2D50">Most popular subcategory</div>
                                                <div id="most_sold_subcategory_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number"><?php echo $most_sold_item_subcategory->item_subcategory_name ?></div>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <i class="fas fa-tags fa-2x" style="color: #ED2D50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Prediction Form -->
                    <div class="row mb-4">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card h-100 shadow mb-4">
                                <div class="card-header py-3" style="background-color: #e4c2c1">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Generate Monthly Sales Prediction</div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action=" <?= base_url('sales/Sales_prediction/generate_sales_prediction/') ?>" enctype="multipart/form-data">
                                        <?= form_open_multipart('') ?>
                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4 pr-5">
                                                <label for="item_subcategory_id">Item Subcategory</label>
                                                <select name="item_subcategory_id" id="item_subcategory" class="form-control form-select form-select-md" required>
                                                    <option value="" selected disabled>Item Subcategory</option>
                                                    <?php
                                                    foreach ($item_subcategories_data as $item_subcategory) {
                                                        echo '<option value="' . $item_subcategory->item_subcategory_id . '">' . $item_subcategory->item_subcategory_name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 px-4 pr-5">
                                            <label for="item_id">Item</label>
                                            <select name="item_id" id="item" class="form-control form-select form-select-md select2" required>
                                                <option value="all_items" selected>All Items</option>
                                                <!-- <php
                                                foreach($item_subcategories_data as $item_subcategory) {
                                                    echo '<option value="'.$item_subcategory->item_subcategory_id.'">'.$item_subcategory->item_subcategory_name.'</option>';
                                                }
                                                ?> -->
                                            </select>
                                        </div>
                                        <!-- Submit button -->
                                        <div class="pr-4">
                                            <button type="submit" class="btn" style="background-color: #FF545D; color: white; float:right;">Submit<i class="fas fa-check pl-2"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- End of Main Content -->

                <script>
                    $('.select2').select2();
                    var counter1 = <?=$most_sold_item->total_quantity?>;
                </script>