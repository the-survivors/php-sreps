$(document).ready(function(){
    var t = $("#table_sales_list").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "sales/sales/sales_list",
            type: "GET",
        },
        "columnDefs": [{
            "width": "5%",
            "targets": [0]
        },
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


    //function to add item row upon clicking the green add button
    var i=1;  
    $('#add').click(function(){  
         i++;  
         $('#item_list').append('<tr id="row'+i+'" class="dynamic-added">'+
                                    '<td><select name="addmore[][item_subcategory_id]" id="item_subcategory_id" class="form-control form-select form-select-md item_subcategory_id">'+
                                    '<option value="" selected disabled>Select subcategory</option>'+
                                    subcategory_list+'</select></td>'+
                                    '<td><input type="number" name="addmore[][sale_item_quantity]" placeholder="Enter quantity" class="form-control sale_item_quantity" required/></td>'+
                                    '<td><input type="number" name="addmore[][sale_item_discount]" placeholder="Enter discount" class="form-control sale_item_discount" required/></td>'+
                                    '<td><input type="number" name="addmore[][sale_item_price]" placeholder="Enter discount" class="form-control sale_item_price" disabled/></td>'+
                                    '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-times"></span></button></td>'+
                                '</tr>');  
    });

    //function to remove item row upon clicking the red remove button
    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#row'+button_id+'').remove();  
    });  

    $("item_list").on("change", "input", function() {
        var row = $(this).closest("tr");

        if(row.find(".Driver_ID").val()){

        }
        var Driver_ID = row.find(".Driver_ID").val();
        var DriverRating = row.find(".DriverRating").val();
        var OrderID = row.find(".OrderID").val();
        var rating = $('input[name="rating' + OrderID + '"]:checked').val();

        $.ajax({
          url: "./save_rating.php",
          method: 'get',
          data: {
            'Driver_ID': Driver_ID,
            'DriverRating': DriverRating,
            'OrderID': OrderID,
            'rating': rating
          },
          success: function(data) {}
        });



      });

}); // end of ready function