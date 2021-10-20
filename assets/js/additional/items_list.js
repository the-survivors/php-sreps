$(document).ready(function(){
    var t1 = $("#items_table").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "items/Items/items_list",
            type: "GET",
        },
        "columnDefs": [{
            "width": "18%",
            "targets": [5]
        }, 
        {
            "searchable": false,
            "targets": 0
        }
        ]
    });

    var t2 = $("#item_categories_table").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "items/Items/items_categories_list",
            type: "GET",
        },
        "columnDefs": [
            {
                "searchable": false,
                "targets": 0
            }
        ]
    });

    // getting sub category id from url path
    var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);

    var t3 = $("#item_subcategories_table").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "items/Items/items_subcategories_list/" + id,
            type: "GET",
        },
        "columnDefs": [
            {
                "searchable": false,
                "targets": 0
            }
        ]
    });

    // getting sub category id from url path
    var url2 = window.location.pathname;
    var id2 = url2.substring(url2.lastIndexOf('/') + 1);

    var t4 = $("#items_in_subcategory_table").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "items/Items/items_in_subcategory_list/" + id2,
            type: "GET",
        },
        "columnDefs": [
            {
                "searchable": false,
                "targets": 0
            }
        ]
    });

    t1.on( 'order.dt search.dt', function () {
        t1.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    t2.on( 'order.dt search.dt', function () {
        t2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    t3.on( 'order.dt search.dt', function () {
        t3.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    t4.on( 'order.dt search.dt', function () {
        t4.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    // item's subcategory dropdown (dependent on what was chosen for item's category)
    $('#item_category').change(function () {
        var item_category = document.getElementById("item_category").value;

        if(item_category != ""){
            $.ajax({
                url: base_url + "items/Items/fetch_subcategories",
                method:"POST",
                data:{item_category_id:$("#item_category").val()},
                success:function(data)
                {   
                 $('#item_subcategory').html(data);
                }
            });
        }
    });

}); // end of ready function

function delete_item(item_id){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: base_url + "items/Items/delete_item",
                method:"POST",
                data:{ item_id:item_id},
                success:function(data)
                {
                    Swal.fire(
                        'Deleted!',
                        'Item has been deleted.',
                        'success'
                    )

                    //reload datatable
                    var xin_table = $("#items_table").DataTable();
                    xin_table.ajax.reload(null, false);
                }
            });
          
        }
      })
}

function view_item(item_id){

    $.ajax({
        url: base_url + "items/Items/view_item",
        method:"POST",
        data:{ item_id:item_id},
        success:function(data)
        {
            $('#item_information').html(data);
        }
    });
}

// --------------------- ITEM CATEGORIES --------------------------//
function delete_item_category(item_category_id){

    Swal.fire({
        title: 'Are you sure?',
        text: "Deleting this will delete ALL ITS RELATED SUB-CATEGORIES (if any). You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: base_url + "items/Items/delete_item_category",
                method:"POST",
                data:{ item_category_id:item_category_id},
                success:function(data)
                {
                    Swal.fire(
                        'Deleted!',
                        'Item category has been deleted.',
                        'success'
                    )

                    //reload datatable
                    var xin_table = $("#item_categories_table").DataTable();
                    xin_table.ajax.reload(null, false);
                }
            });
          
        }
      })
}

function edit_item_category (item_category_id){
$.ajax({
    url: base_url + "items/Items/edit_item_category",
    method:"POST",
    data:{ item_category_id:item_category_id},
    success:function(data)
    {
        $('#edit_item_category_information').html(data);
    }
});
}

// --------------------- ITEM SUBCATEGORIES --------------------------//
function delete_item_subcategory(item_subcategory_id){

    Swal.fire({
        title: 'Are you sure?',
        text: "Deleting this will delete ALL ITS RELATED ITEMS (if any). You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: base_url + "items/Items/delete_item_subcategory",
                method:"POST",
                data:{ item_subcategory_id:item_subcategory_id},
                success:function(data)
                {
                    Swal.fire(
                        'Deleted!',
                        'Item subcategory has been deleted.',
                        'success'
                    )

                    //reload datatable
                    var xin_table = $("#item_subcategories_table").DataTable();
                    xin_table.ajax.reload(null, false);
                }
            });
          
        }
      })
}

function edit_item_subcategory (item_subcategory_id){
    $.ajax({
        url: base_url + "items/Items/edit_item_subcategory",
        method:"POST",
        data:{ item_subcategory_id:item_subcategory_id},
        success:function(data)
        {
            $('#edit_item_subcategory_information').html(data);
        }
    });
}