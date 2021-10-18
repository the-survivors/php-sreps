$(document).ready(function(){
    var t = $("#items_table").DataTable({
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

    var t = $("#item_categories_table").DataTable({
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

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

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
        text: "You won't be able to revert this!",
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