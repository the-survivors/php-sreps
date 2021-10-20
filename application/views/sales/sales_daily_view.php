<!-- Plug in for sweetalert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<style>
    .table-striped tbody tr:nth-of-type(odd) {
        background: white;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background: #E4C2C1;
    }

    .table-striped thead tr:nth-of-type(odd) {
        background: #C4C4C4;
    }

    .table-striped {
        color: black;
    }
</style>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<body id="page-top" style="background:#FEF2F2;">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid" style="background:#FEF2F2;">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daily Sales</h1>
                    </div>

                    <div class="row my-5">
                        <div class="col-xl-3">
                            <!-- Date input -->
                            <?php date_default_timezone_set("Asia/Kuala_Lumpur");?> 
                            <input type="date" class = "form-control" id="date" value="<?=$date?>">
                        </div>
                        <div class="col-xl-9">
                            <!-- Button group for daily, weekly & monthly -->
                            <div class="d-flex justify-content-end">
                                <div class="btn-group" role="group" aria-label="page_chooser">
                                    <a type="button" class="btn btn-danger <?php if ($selected == 'daily') {
                                                                                echo 'active';
                                                                            } ?>">Daily</a>
                                    <a type="button" class="btn btn-danger <?php if ($selected == 'weekly') {
                                                                                echo 'active';
                                                                            } ?>">Weekly</a>
                                    <a type="button" href = "<?php echo base_url('sales/sales/');?>" class="btn btn-danger <?php if ($selected == 'monthly') {
                                                                                echo 'active';
                                                                            } ?>">Monthly</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row (Start here)-->
                    <div class="row">
                        <div class="col-xl-12">

                            <div class="row">
                                <div class="col-xl-12">
                                    <!-- Card-->
                                    <div class="card " style="color:black;">
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="table_monthly_sales_list" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Sales ID</th>
                                                            <th>Sales Date</th>
                                                            <th>Sales Total Price (RM)</th>
                                                            <th>Total Discounted Price (RM)</th>
                                                            <th>Person in charge</th>
                                                            <th>Categories</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                        <?php 
                                                            
                                                        ?>
                                                        <?php foreach ($sales_data as $row) { 
                                                            //get category list for each sale in point form
                                                            $sales_category_data = $this->sales_model->get_category_only($row->sale_id);
                                                            $list_html ='';
                                                            foreach ($sales_category_data as $q) {
                                                                $list_html .= '<li>' . $q->item_category_name . '</li>';
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?= $row->sale_id ?></td>
                                                                <td><?= $row->sale_date ?></td>
                                                                <td>RM <?= number_format($row->sale_total_price, 2, '.', '') ?></td>
                                                                <td>RM <?= number_format($row->sale_discounted_price, 2, '.', '') ?></td>
                                                                <td><?= $row->user_fname . " " . $row->user_lname ?></td>
                                                                <td><ul><?= $list_html ?></ul></td>
                                                                <td><span><button type="button" onclick="view_sale(<?= $row->sale_id ?>)" class="btn icon-btn btn-lg btn-white waves-effect waves-light" data-toggle="modal" data-target="#view_sales"><span style="color:black;" class="fas fa-eye"></span></button></span></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /. Card -->

                                </div>
                            </div>
                            <!-- /. Content Row -->
                            <!-- Modal for viewing sales-->
                            <div class="modal fade" id="view_sales" tabindex="-1" role="dialog" aria-labelledby="view_salesLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:#FF545D;">
                                            <h5 class="modal-title" id="view_salesLabel" style="color:white;">View Sale Detail</h5>
                                            <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="view_sale_model">
                                            <!-- Sales detail will be appended here with ajax upon clicking the view button-->
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of modal for viewing sales-->

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->


                    <script>
                        $(document).ready(function() {
                            var t = $("#table_monthly_sales_list").DataTable({
                                //make table responsive
                                "bAutoWidth": false,
                                "columnDefs": [{
                                        "width": "10%",
                                        "targets": [1]
                                    },
                                    {
                                        "width": "5%",
                                        "targets": [0]
                                    },
                                    {
                                        "searchable": false,
                                        "targets": 0
                                    }
                                ]
                            });

                            t.on('order.dt search.dt', function() {
                                t.column(0, {
                                    search: 'applied',
                                    order: 'applied'
                                }).nodes().each(function(cell, i) {
                                    cell.innerHTML = i + 1;
                                });
                            }).draw();


                        }); // end of ready function

                        //function will trigger when user click on the view button
                        function view_sale(sale_id) {

                            $.ajax({
                                url: base_url + "sales/sales/view_sale",
                                method: "POST",
                                data: {
                                    sale_id: sale_id
                                },
                                success: function(data) {
                                    $('#view_sale_model').html(data);

                                }
                            });
                        }

                        $('#date').change(function() {
                            var date = document.getElementById("date").value;
                            window.location.href = base_url + "sales/sales/daily_sales_list/"+date;
                        });

                    </script>