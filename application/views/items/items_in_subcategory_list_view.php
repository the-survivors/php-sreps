
<style>
.table-striped tbody tr:nth-of-type(odd) {
    background: white;
}

.table-striped tbody tr:nth-of-type(even) {
    background: #E4C2C1;
}

.table-striped thead tr:nth-of-type(odd) {
    background: #EBE8E8;
}

.table-striped {
    color: black;
}
</style>
<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?= base_url();?>";
</script>

<!-- Pop up after user added a new item-->
<?php if($this->session->flashdata('insert_message')){?>
<script>
    var item_name = "<?= $this->session->flashdata('item_name');?>";
    Swal.fire({
        icon: 'success',
        text: '"' + item_name + '" has been added',
    })
</script>
<?php } ?>

<!-- Pop up after user edit an existing item-->
<?php if($this->session->flashdata('edit_message')){?>
<script>
    var item_name = "<?php echo $this->session->flashdata('item_name');?>";
    Swal.fire({
        icon: 'success',
        text: '"' + item_name + '" has been edited',
    })
</script>
<?php } ?>

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
                    <h1 class="h3 font-weight-bold" style="color: black"><?=$item_subcategory_data->item_subcategory_name?></h1>
                </div>

                <!-- Breadcrumb -->
                <div class="row" >
                    <div class="breadcrumb-wrapper col-xl-8">
                        <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('items/Items/items_categories');?>"><i class="fas fa-tags mr-2"></i>Item Categories</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('items/Items/items_subcategories/'.$item_subcategory_data->item_category_id);?>"><?=$item_subcategory_data->item_category_name?></a>
                            </li>
                            <li class="breadcrumb-item active"><?= $item_subcategory_data->item_subcategory_name ?></li>
                        </ol>
                    </div>
                    <div class = "col-xl-4">
                        <div class = "d-flex justify-content-end">
                            <a type="button" href="<?= base_url('items/Items/items_subcategories/'.$item_subcategory_data->item_category_id);?>" class="btn" style="background-color: #B6666F; color: white;">Back<i class="fas fa-undo pl-1"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Content Row (Start here)-->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Card-->
                        <div class="card ">
                        <!-- <=$this->session->flashdata('message')?>  -->
                            <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="items_in_subcategory_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Restock Level</th>
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

                <!-- Modal -->
                <div class="modal fade" id="view_item" tabindex="-1" role="dialog" aria-labelledby="view_itemLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style = "background-color:#e56b6f;">
                            <h5 class="modal-title" id="view_itemLabel" style ="color:white;">Item Information</h5>
                            <button style ="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div id="item_information">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- /.Modal -->

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->