<script src="<?php echo base_url()?>/assets/vendor/jquery/jquery.min.js"></script>

<style>
label{
    color:black;
}
.image-preview {
    width: 300px;
    height: 200px;
    border: 2px solid #dddddd;
    margin-top: 15px;

    display: flex;
    align-items:center;
    justify-content:center;
    font-weight: bold;
    color: #cccccc;
}

.image-preview__image{
    display: none;
    width: 295px;
    object-fit: contain;
    height: 145px;
}
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit an Item Category</h1>
                </div>

                <!-- Breadcrumb -->
                <div class="row" >
                    <div class="breadcrumb-wrapper col-xl-9">
                        <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('items/Items/items_categories'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('items/Item/items_categories'); ?>"></i>Items</a>
                            </li>
                            <li class="breadcrumb-item active">Edit an Item</li>
                        </ol>
                    </div>
                    <div class = "col-xl-3">
                        <div class = "d-flex justify-content-end">
                            <a type="button" href = "<?= base_url('items/Items/items_categories'); ?>" class="btn" style="background-color: #FF545D; color: white;">Back<i class="fas fa-undo pl-1"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Card-->
                        <div class="card ">
                            <div class="card-body">
                            <form method="post" action=" <?=base_url('items/Items/submit_edited_item_category/'.$item_category_data->item_category_id)?>" enctype="multipart/form-data">
                            <?= form_open_multipart('') ?>
                                    <div class="form-row pt-4">
                                        <div class="form-group col-md-12 px-4 pr-5">
                                            <label for="emp_title">Item Category Name</label>
                                            <input type="text" class="form-control" id="item_category_name" name="item_category_name" placeholder="Enter item category name" value="<?=$item_category_data->item_category_name?>" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Submit button -->
                                    <div class ="pr-4">
                                        <button  type="submit" class="btn" style="background-color: #FF545D; color: white; float:right;" >Submit<i class="fas fa-check pl-2"></i></button>
                                    </div>

                                </form>

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

                <!-- <script>
                // File appear on select
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
                </script> -->
