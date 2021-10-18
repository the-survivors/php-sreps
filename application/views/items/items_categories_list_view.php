
<style>
th{
    color:black;
}
td{
    color: rgba(0,0,0,0.7);
}
</style>
<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?= base_url();?>";
</script>

<!-- Pop up after user added a new item-->
<?php if($this->session->flashdata('insert_message')){?>
<script>
    var item_category_name = "<?= $this->session->flashdata('item_category_name');?>";
    Swal.fire({
        icon: 'success',
        text: '"' + item_category_name + '" has been added',
    })
</script>
<?php } ?>

<!-- Pop up after user edit an existing item-->
<?php if($this->session->flashdata('edit_message')){?>
<script>
    var item_category_name = "<?php echo $this->session->flashdata('item_category_name');?>";
    Swal.fire({
        icon: 'success',
        text: '"' + item_category_name + '" has been edited',
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
                    <h1 class="h3 mb-0 text-gray-800">Item Categories</h1>
                </div>

                <!-- Breadcrumb -->
                <div class="row" >
                    <div class="breadcrumb-wrapper col-xl-8">
                        <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('items/Items/items_categories');?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">Item Categories</li>
                        </ol>
                    </div>
                    <div class = "col-xl-4">
                        <div class = "d-flex justify-content-end">
                        <a type="button" href = "<?= base_url('items/Items/add_item_category'); ?>" class="btn" style="background-color: #FF545D; color: white;">Add New Item Category<i class="fas fa-plus pl-2"></i></a>
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
                                <table id="item_categories_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>No.</th>
                                        <th>Category</th>
                                        <th>Sub-Categories</th>
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

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->