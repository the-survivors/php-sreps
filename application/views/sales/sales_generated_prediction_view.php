<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 font-weight-bold" style="color: black">Generated Sales Prediction</h1>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-8">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('users/Dashboard/Manager'); ?>"><i class="fas fa-tachometer-alt pr-2"></i>Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('sales/Sales_prediction'); ?>">Monthly Sales Prediction</a>
                                </li>
                                <li class="breadcrumb-item active">Generated Sales Prediction</li>
                            </ol>
                        </div>
                        <div class="col-xl-4">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="<?= base_url('sales/Sales_prediction'); ?>" class="btn" style="background-color: #FF545D; color: white;">Back<i class="fas fa-undo pl-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                    </div> -->
                    <div class="row" style="color: black">
                    <!-- <php foreach ($item_sale_data as $item_d): echo $item_d->sale_month;?><php endforeach ?> -->
                        <h6 class="col-xl-4 font-weight-bold">Item Subcategory</h6>
                        <h6 class="col-xl-5 font-weight-bold">Item</h6>
                        <h6 class="col-xl-3 font-weight-bold">Start Date</h6>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-4">
                            <input type="text" readonly class="form-control-plaintext" style="background-color: #9B9B9B; color:white;" value=" <?= $item_subcategory_data[0]->item_subcategory_name ?>">
                        </div>
                        <div class="col-xl-5">
                            <input type="text" readonly class="form-control-plaintext" style="background-color: #9B9B9B; color:white;" <?php if ($item_id != "all_items") { ?>value=" #<?= $item_data->item_id ?> - <?= $item_data->item_name?>" <?php } else { ?>value=" All Items"<?php } ?>>
                        </div>
                        <div class="col-xl-3">
                            <input type="text" readonly class="form-control-plaintext" style="background-color: #9B9B9B; color:white;" id="staticEmail" value=" November 2021">
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="mt-3 font-weight-bold" style="color: black;">Prediction based on Sales from the past 3 months</h5>
                    </div>
                    <div class="row">
                        <table class="table table-bordered" width="100%" style="background-color: white;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <!--the foreach must begin here. foreach month-->
                                    <!-- <th scope="col">January</th>
                                    <th scope="col">February</th>
                                    <th scope="col" style="background-color:#FF545D">March</th>
                                    <th scope="col">April</th>
                                    <th scope="col">May</th> -->
                                    <?php $grand_total_units = 0; $grand_total_sales = 0;?>
                                    <?php foreach($item_sale_data as $item_s_d): ?>
                                        <th scope="col"><?= $item_s_d->sale_month?></th>
                                    <?php endforeach ?>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Number of Units Sold</th>
                                    <?php foreach($item_sale_data as $item_s_d): ?>
                                        <td><?= $item_s_d->units_sold?></td>
                                        <?php $grand_total_units += $item_s_d->units_sold?></td>
                                    <?php endforeach ?>
                                    <td><?= $grand_total_units ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Price per Unit</th>
                                    <?php foreach($item_sale_data as $item_s_d): ?>
                                        <td><?= $item_s_d->item_price?></td>
                                    <?php endforeach ?>
                                </tr>
                                <tr>
                                    <th scope="row">Total Sales</th>
                                    <?php foreach($item_sale_data as $item_s_d): ?>
                                        <td><?= $item_s_d->total_sales?></td>
                                        <?php $grand_total_sales += $item_s_d->total_sales?></td>
                                    <?php endforeach ?>
                                    <td><?= $grand_total_sales ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- End of Main Content -->

                <script>
                    $('.select2').select2();
                </script>