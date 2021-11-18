<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<style>
    /* .table-striped tbody tr:nth-of-type(odd) {
        background: #E8BCBC;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background: #F8DCDC;
    }

    .table-striped thead tr:nth-of-type(odd) {
        background: #C04C4C;
    } */
</style>

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
                        <h6 class="col-xl-3 font-weight-bold">Item Subcategory</h6>
                        <h6 class="col-xl-7 font-weight-bold">Item</h6>
                        <h6 class="col-xl-2 font-weight-bold">Start Date</h6>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3">
                            <input type="text" readonly class="form-control-plaintext font-weight-bold" style="background-color: #706868; color:white;" value=" <?= $item_subcategory_data[0]->item_subcategory_name ?>">
                        </div>
                        <div class="col-xl-7">
                            <input type="text" readonly class="form-control-plaintext" style="background-color: #706868; color:white;" <?php if ($item_id != "all_items") { ?>value=" #<?= $item_data->item_id ?> - <?= $item_data->item_name?>" <?php } else { ?>value=" All Items"<?php } ?>>
                        </div>
                        <div class="col-xl-2">
                            <input type="text" readonly class="form-control-plaintext" style="background-color: #706868; color:white;" id="staticEmail" value=" November 2021">
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="mt-3 font-weight-bold" style="color: black;">Prediction based on Sales from the past 3 months</h5>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" style="background-color: white;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"></th>
                                        <!--the foreach must begin here. foreach month-->
                                        <!-- <th scope="col">January</th>
                                        <th scope="col">February</th>
                                        <th scope="col" style="background-color:#FF545D">March</th>
                                        <th scope="col">April</th>
                                        <th scope="col">May</th> -->
                                        <?php $grand_total_units = 0; $grand_total_sales = 0;
                                            $average_total_units = 0;
                                            $average_total_sales = 0;
                                            $current_month_year = date('Y-m');
                                        ?>
                                        <?php foreach($date_within_range as $item_d): ?>
                                            <?php $month_year = date('Y-m', strtotime($item_d))?>
                                            <th scope="col" <?php if ($month_year == $current_month_year) { echo "style='background-color:#FF545D'"; } elseif ($month_year > $current_month_year) { echo "style='background-color:#B6666F'";} ?>>
                                                <?php echo date('F Y', strtotime($item_d)) ?>
                                            </th>
                                        <?php endforeach ?>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody style="color:black">
                                    <tr>
                                        <th scope="row">Number of Units Sold</th>
                                        <?php foreach($value_of_date as $item_s_d): ?>
                                            <td><?php if ($item_s_d[0]->units_sold == null) { echo '0'; } else { echo $item_s_d[0]->units_sold; } ?></td>
                                            <?php $average_total_units += $item_s_d[0]->units_sold?>
                                        <?php endforeach ?>
                                        <?php $future_month_1_units = round($average_total_units/count($value_of_date)); ?>
                                            <td><?=$future_month_1_units; ?></td>
                                        <?php $future_month_2_units = round(($average_total_units - $value_of_date[0][0]->units_sold + $future_month_1_units)/(count($value_of_date))); ?>
                                            <td><?= $future_month_2_units; ?></td>
                                            <td><?= ($average_total_units + $future_month_1_units + $future_month_2_units) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Price per Unit (RM)</th>
                                        <?php foreach($value_of_date as $item_s_d): ?>
                                            <td><?= $item_data->item_price; ?> <!--ya --></td>
                                        <?php endforeach ?>
                                        <td><?= $item_data->item_price ?></td>
                                        <td><?= $item_data->item_price ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Sales (RM)</th>
                                        <?php foreach($value_of_date as $item_s_d): ?>
                                            <td><?php if ($item_s_d[0]->total_sales == null) { echo '0'; } else { echo number_format($item_s_d[0]->total_sales, 2, '.', ''); } ?></td>
                                            <?php $grand_total_sales += $item_s_d[0]->total_sales?>
                                        <?php endforeach ?>
                                        <?php $future_month_1_sales = ($future_month_1_units * $item_data->item_price) ?>
                                            <td><?= number_format($future_month_1_sales, 2, '.', '') ?></td>
                                        <?php $future_month_2_sales = ($future_month_2_units * $item_data->item_price) ?>
                                            <td><?= number_format($future_month_2_sales, 2, '.', '') ?></td>
                                        <?php $grand_total_sales = $grand_total_sales + $future_month_1_sales + $future_month_2_sales ?>
                                            <td><?= number_format($grand_total_sales, 2, '.', '') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- End of Main Content -->

                <script>
                    $('.select2').select2();
                </script>


<!------------------------------------------------------------------------------------ -->

<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<style>
    /* .table-striped tbody tr:nth-of-type(odd) {
        background: #E8BCBC;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background: #F8DCDC;
    }

    .table-striped thead tr:nth-of-type(odd) {
        background: #C04C4C;
    } */
</style>

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
                        <h6 class="col-xl-3 font-weight-bold">Item Subcategory</h6>
                        <h6 class="col-xl-7 font-weight-bold">Item</h6>
                        <h6 class="col-xl-2 font-weight-bold">Start Date</h6>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3">
                            <input type="text" readonly class="form-control-plaintext font-weight-bold" style="background-color: #706868; color:white;" value=" <?= $item_subcategory_data[0]->item_subcategory_name ?>">
                        </div>
                        <div class="col-xl-7">
                            <input type="text" readonly class="form-control-plaintext" style="background-color: #706868; color:white;" <?php if ($item_id != "all_items") { ?>value=" #<?= $item_data->item_id ?> - <?= $item_data->item_name ?>" <?php } else { ?>value=" All Items" <?php } ?>>
                        </div>
                        <div class="col-xl-2">
                            <input type="text" readonly class="form-control-plaintext" style="background-color: #706868; color:white;" id="staticEmail" value=" November 2021">
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="mt-3 font-weight-bold" style="color: black;">Prediction based on Sales from the past 3 months</h5>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
<?php foreach($value_of_date as $d): ?>
     <?php var_dump($d); endforeach?>
                            <?php if ($item_id == "all_items" && $value_of_date != null) {
                                //$average_total_units = 0;                        
                                foreach ($all_items as $item) : ?>
                                    <?php
                                    $total_units = 0;
                                    $average_total_units = 0;
                                    $x = 0;
                                    $grand_total_sales = 0
                                    ?>
                                    <hr>
                                    <div class="mt-3 mb-4" style="color:black; background-color:pink">
                                        <h5 class="font-weight-bold">Item: <?php echo "#" . $item->item_id . " - " . $item->item_name; ?></h5>
                                    </div>
                                    <table class="table table-bordered table-striped mb-5" style="background-color: white;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col"></th>
                                                <?php foreach ($date_within_range as $item_d) : ?>
                                                    <?php $month_year = date('Y-m', strtotime($item_d)) ?>
                                                    <th scope="col">
                                                        <?php echo date('F Y', strtotime($item_d)) ?>
                                                    </th>
                                                <?php endforeach ?>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color:black">
                                            <tr>
                                                <th scope="row">Number of Units Sold<?= count($value_of_date)?></th>
                                                <?php do { ?>
                                                    <?php if ($value_of_date[$x][0]->item_id == $item->item_id) { ?>
                                                        <td><?= $value_of_date[$x][0]->units_sold; ?></td>
                                                    <?php $total_units += $value_of_date[$x][0]->units_sold;
                                                    } else { ?>
                                                        <td>0</td>
                                                <?php }
                                                    $x++;  //if THERE ARE sales for this item // it will never be null or 0
                                                } while ($x != count($value_of_date));
                                                $x = 0;
                                                $future_month_1_units = round($total_units / 3);
                                                if ($value_of_date[0][0]->item_id == $item->item_id) {
                                                    $average_total_units = $total_units - $value_of_date[0][0]->units_sold + $future_month_1_units;
                                                } else {
                                                    $average_total_units = $total_units + $future_month_1_units;
                                                }
                                                ?>
                                                 <td>fff</td>
                                                <td><?= $future_month_1_units ?></td>
                                                <?php $future_month_2_units = round(($average_total_units) / 3); ?>
                                                <!-- <td><= $future_month_2_units; ?></td> -->
                                                <td><?= ($total_units + $future_month_2_units) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Price per Unit (RM)</th>
                                                <?php foreach ($value_of_date as $item_s_d) : ?>
                                                    <td><?= $item->item_price; ?></td>
                                                <?php endforeach ?>
                                                <td>fff</td>
                                                <td><?= $item->item_price ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total Sales (RM)</th>
                                                <?php do { ?>
                                                    <?php if ($value_of_date[$x][0]->item_id == $item->item_id) { ?>
                                                        <td><?= number_format($value_of_date[$x][0]->total_sales, 2, '.', ''); ?></td>
                                                    <?php $grand_total_sales += $value_of_date[$x][0]->total_sales;
                                                    } else { ?>
                                                        <td>0.00</td>
                                                <?php }
                                                    $x++;
                                                } while ($x != count($value_of_date));
                                                $future_month_1_sales = ($future_month_1_units * $item->item_price); ?>
                                                <td><?= number_format($future_month_1_sales, 2, '.', '') ?></td>
                                                <?php $future_month_2_sales = ($future_month_2_units * $item->item_price) ?>
                                                <td><?= number_format($future_month_2_sales, 2, '.', '') ?></td>
                                                <?php $grand_total_sales = $grand_total_sales + $future_month_1_sales + $future_month_2_sales ?>
                                                <td><?= number_format($grand_total_sales, 2, '.', '') ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--All items table-->

                                <?php endforeach;
                            } elseif ($value_of_date != null) { ?>
                                <table class="table table-bordered table-striped" style="background-color: white;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col"></th>
                                            <?php
                                            $grand_total_units = 0;
                                            $grand_total_sales = 0;
                                            $average_total_units = 0;
                                            $average_total_sales = 0;
                                            $current_month_year = date('Y-m');
                                            ?>
                                            <?php foreach ($date_within_range as $item_d) : ?>
                                                <?php $month_year = date('Y-m', strtotime($item_d)) ?>
                                                <th scope="col" <?php if ($month_year == $current_month_year) {
                                                                    echo "style='background-color:#FF545D'";
                                                                } elseif ($month_year > $current_month_year) {
                                                                    echo "style='background-color:#B6666F'";
                                                                } ?>>
                                                    <?php echo date('F Y', strtotime($item_d)) ?>
                                                </th>
                                            <?php endforeach ?>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="color:black">
                                        <tr>
                                            <th scope="row">Number of Units Sold</th>
                                            <?php foreach ($value_of_date as $item_s_d) : ?>
                                                <td><?php if ($item_s_d[0]->units_sold == null) {
                                                        echo '0';
                                                    } else {
                                                        echo $item_s_d[0]->units_sold;
                                                    } ?></td>
                                                <?php $average_total_units += $item_s_d[0]->units_sold ?>
                                            <?php endforeach ?>
                                            <?php $future_month_1_units = round($average_total_units / count($value_of_date)); ?>
                                            <td><?= $future_month_1_units; ?></td>
                                            <?php $future_month_2_units = round(($average_total_units - $value_of_date[0][0]->units_sold + $future_month_1_units) / (count($value_of_date))); ?>
                                            <td><?= $future_month_2_units; ?></td>
                                            <td><?= ($average_total_units + $future_month_1_units + $future_month_2_units) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Price per Unit (RM)</th>
                                            <?php foreach ($value_of_date as $item_s_d) : ?>
                                                <td><?= $item_data->item_price; ?>
                                                    <!--ya -->
                                                </td>
                                            <?php endforeach ?>
                                            <td><?= $item_data->item_price ?></td>
                                            <td><?= $item_data->item_price ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Sales (RM)</th>
                                            <?php foreach ($value_of_date as $item_s_d) : ?>
                                                <td><?php if ($item_s_d[0]->total_sales == null) {
                                                        echo '0';
                                                    } else {
                                                        echo number_format($item_s_d[0]->total_sales, 2, '.', '');
                                                    } ?></td>
                                                <?php $grand_total_sales += $item_s_d[0]->total_sales ?>
                                            <?php endforeach ?>
                                            <?php $future_month_1_sales = ($future_month_1_units * $item_data->item_price) ?>
                                            <td><?= number_format($future_month_1_sales, 2, '.', '') ?></td>
                                            <?php $future_month_2_sales = ($future_month_2_units * $item_data->item_price) ?>
                                            <td><?= number_format($future_month_2_sales, 2, '.', '') ?></td>
                                            <?php $grand_total_sales = $grand_total_sales + $future_month_1_sales + $future_month_2_sales ?>
                                            <td><?= number_format($grand_total_sales, 2, '.', '') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--Specfic item table-->

                            <?php } else { ?>
                                <?php foreach ($all_items as $item) : ?>
                                    <hr>
                                    <div class="mt-3 mb-4" style="color:black; background-color:pink">
                                        <h5 class="font-weight-bold">Item: <?php echo "#" . $item->item_id . " - " . $item->item_name; ?></h5>
                                    </div>
                                    <table class="table table-bordered table-striped mb-5" style="background-color: white;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col"></th>
                                                <?php foreach ($date_within_range as $item_d) : ?>
                                                    <?php $month_year = date('Y-m', strtotime($item_d)) ?>
                                                    <th scope="col">
                                                        <?php echo date('F Y', strtotime($item_d)) ?>
                                                    </th>
                                                <?php endforeach ?>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color:black">
                                            <tr>
                                                <th scope="row">Number of Units Sold</th>
                                                <?php for($x = 0; $x < 6; $x++) { ?>
                                                    <td>0</td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th scope="row">Price per Unit (RM)</th>
                                                <?php for($x = 0; $x < 5; $x++) { ?>
                                                    <td><?= $item->item_price ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total Sales (RM)</th>
                                                <?php for($x = 0; $x < 6; $x++) { ?>
                                                    <td>0</td>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endforeach; ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- End of Main Content -->

                <script>
                    $('.select2').select2();
                </script>