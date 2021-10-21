
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
img {
    transition:transform 0.25s ease;
}

img:hover {
    -webkit-transform:scale(2.0);
    transform:scale(2.0);
}
</style>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?= base_url();?>";
</script>

<body id="page-top">

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
                    <h1 class="h3 pt-4 mb-0 text-gray-800">Items Running Low on Stock</h1>
                </div>

                <!-- Breadcrumb -->
                <div class="row" >
                    <div class="breadcrumb-wrapper col-xl-8">
                        <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('items/Items/items_categories');?>"><i class="fas fa-tachometer-alt pr-2"></i>Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Items Running Low on Stock</li>
                        </ol>
                    </div>
                    <!-- Employee Dashboard -->
                    <div class = "col-xl-4">
                        <div class = "d-flex justify-content-end">
                            <a type="button" href="<?= base_url('');?>" class="btn" style="background-color: #B6666F; color: white;">Back<i class="fas fa-undo pl-1"></i></a>
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
                                <table id="items_low_on_stock_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Subcategory</th>
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
                
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->