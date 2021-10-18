$(document).ready(function () {
    var t = $("#table_sales_list").DataTable({
        //make table responsive
        "bAutoWidth": false,
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

    t.on('order.dt search.dt', function () {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();



    //function to add item row upon clicking the green add button
    var i = 0;
    $('#add').click(function () {

        var item_name = document.getElementById("item_id").value;
        var item_id = $("#item_id").find(':selected').data('id');
        var item_price = $("#item_id").find(':selected').data('price')
        i++;
        $('#table_body').append('<tr id="row' + i + '" class="dynamic-added">' +
            '<td style = "width:10%;"><input type="number" name="addmore[][item_id]" class="form-control item_id1" value = "'+item_id+'" readonly  required/></td>' +
            '<td><input type="text" class="form-control item_name" value = "'+item_name+'"/></td>'+
            '<td style = "width:5%;"><input type="number" name="addmore[][sale_item_quantity]" placeholder="Enter quantity" class="form-control sale_item_quantity" min="1" value = "1" required/></td>' +
            '<td style = "width:5%;"><input type="number" name="addmore[][sale_item_discount]" placeholder="Enter discount" class="form-control sale_item_discount" min="0" max = "100" value = "0" required/></td>' +
            '<td style = "width:22%;:">' +
            '<input type="number" style = "display:none" class="form-control one_item_price" value = "' + item_price + '"/>' +
            '<input type="number" style = "display:none" class="form-control ori_one_item_price" value = "' + item_price + '"/>' +
            '<div class="input-group-prepend">'+
            '<span class="input-group-text" id="basic-addon1">RM</span>'+
            '<input type="number" name="addmore[][sale_item_price]" class="form-control sale_item_price" value = "'+item_price+'" readonly/></div>' +
            '</td>' +
            '<td style = "width:2%;"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><span class="fas fa-times"></span></button></td>' +
            '</tr>');

            update_total_sales_price();
    });

    //function to remove item row upon clicking the red remove button
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
        update_total_sales_price();

    });

    //ajax for 1st item row item selection dropdown
    $('#item_subcategory_id',).change(function () {
        var item_subcategory_id = document.getElementById("item_subcategory_id").value;

        $.ajax({
            url: base_url + "sales/sales/fetch_item",
            method: "POST",
            data: { item_subcategory_id: $("#item_subcategory_id").val() },
            success: function (data) {
                $('#item_id').html(data);
            }
        });
    });

    //function is trigger when the quantity and discount input field from any row is changed or modified                 
    $("#item_list").on("change", 'input', function () {
        var row = $(this).closest("tr");

        if (row.find(".sale_item_quantity").val() >= 1 && row.find(".sale_item_discount").val() >= 0) {
            console.log(row.find(".sale_item_quantity").val());

            //update sale_item_price when quantity and discount input field in any row is changed
            var sale_item_quantity = row.find(".sale_item_quantity").val();
            sale_item_discount = row.find(".sale_item_discount").val();
            one_item_price = row.find(".one_item_price").val();

            var sale_item_price = sale_item_quantity * one_item_price * ((100 - sale_item_discount) / 100);
            sale_item_price = sale_item_price.toFixed(2);
            $('.sale_item_price', row).val(sale_item_price);
            
            var ori_total_sale_item_price = sale_item_quantity * one_item_price;
            ori_total_sale_item_price = ori_total_sale_item_price.toFixed(2);
            $('.ori_one_item_price', row).val(ori_total_sale_item_price);

            update_total_sales_price();

        }
    });


}); // end of ready function

//update sale_total_price & sale_discounted_price  when quantity and discount input field in any row is changed
function update_total_sales_price() {

    var total_discounted_price = 0;
    $("#item_list .sale_item_price").each(function () {
        var get_value = $(this).val();
        total_discounted_price += parseFloat(get_value);
    });
    $("#sale_discounted_price").val(total_discounted_price);

    var total_sales_price = 0;
    $("#item_list .ori_one_item_price").each(function () {
        var get_value = $(this).val();
        total_sales_price += parseFloat(get_value);
    });
    $("#sale_total_price").val(total_sales_price);

}

var item_subcategory_id = document.getElementById("item_subcategory_id").value;

$.ajax({
    url: base_url + "sales/sales/fetch_item",
    method: "POST",
    data: { item_subcategory_id: $("#item_subcategory_id").val() },
    success: function (data) {
        $('#item_id').html(data);
    }
});
