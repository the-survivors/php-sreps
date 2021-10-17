<style>

</style>

<?php 

$subcategory = $subcategory_data;

$subcategory_options = "";
foreach ($subcategory as $s) {
    $subcategory_options .= '<option value="' . $s->item_subcategory_id . '">' . $s->item_subcategory_name . '</option>';
}
?>
<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var subcategory_list = '<?php echo $subcategory_options; ?>';
    console.log(subcategory_list);
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
                        <h1 class="h3 mb-0 text-gray-800">Sales</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url(''); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ol>
                        </div>
                        <div class="col-xl-3 ">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#add_sales">Add Sale</button>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row (Start here)-->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="table_sales_list" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>sales ID</th>
                                                    <th>Sales Date</th>
                                                    <th>Sales Total Price</th>
                                                    <th>Items</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- /. Card -->

                        </div>
                    </div>
                    <!-- /. Content Row -->

                    <!-- Modal for adding sales-->
                    <div class="modal fade" id="add_sales" tabindex="-1" role="dialog" aria-labelledby="add_salesLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#FF545D;">
                                    <h5 class="modal-title" id="add_salesLabel" style="color:white;">Add a sale</h5>
                                    <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Add sale form -->
                                <form method="post" action=" <?= base_url(''); ?>">
                                    <div class="modal-body">
                                        <div class="mb-4" style="background-color:#1dd3b0; border-radius:10px; width:23.0em; height:auto;">
                                            <div class="px-3 pt-2 pb-1">
                                                <h4 style=" font-weight:600;"><span style="color:white;">DATE: <?php echo date('Y-m-d H:i:s'); ?></span></h4>
                                            </div>
                                        </div>
                                        <table class="table" id="item_list">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Discount</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_body">
                                                <tr>
                                                    <td>
                                                        <select name="addmore[][item_subcategory_id]" id="item_subcategory_id" class="form-control form-select form-select-md item_subcategory_id">
                                                            <option value="" selected disabled>Select subcategory</option>
                                                            <?php
                                                            foreach ($subcategory as $s) {
                                                                echo '<option value="' . $s->item_subcategory_id . '">' . $s->item_subcategory_name . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" name="addmore[][sale_item_quantity]" placeholder="Enter quantity" class="form-control sale_item_quantity" value="1" required /></td>
                                                    <td><input type="number" name="addmore[][sale_item_discount]" placeholder="Enter discount" class="form-control sale_item_discount" value="0" required /></td>
                                                    <td><input type="number" name="addmore[][sale_item_price]" value="0" class="form-control sale_item_price" disabled /></td>
                                                    <td><button type="button" name="add" id="add" class="btn btn-success"><span class="fas fa-plus"></span></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                                <!-- End of add sale form -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php


?>

<script type="text/javascript">
</script>
