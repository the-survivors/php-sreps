//Fetch the item list with the default subcategory when the page is loaded
var item_subcategory_id = document.getElementById("item_subcategory_id").value;
$.ajax({
    url: base_url + "sales/sales/fetch_item",
    method: "POST",
    data: { item_subcategory_id: $("#item_subcategory_id").val() },
    success: function (data) {
        $('#item_id').html(data);
    }
});

$(document).ready(function () {

    //ajax for fetching items selection dropdown
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

    //function to add item row upon clicking the green add button
    $('#add').click(function () {

        var item_name = document.getElementById("item_id").value;
        var item_id = $("#item_id").find(':selected').data('id');
        var item_price = $("#item_id").find(':selected').data('price');
        var item_quantity = $("#item_id").find(':selected').data('quantity');

        //check if the same item has already been added into the table list
        var already_exist = false;
        $("#item_list .item_id1").each(function () {
            var get_value = $(this).val();
            if (get_value == item_id) {
                already_exist = true;
            }
        });

        //Add item row if the item is a new item
        if (already_exist == false) {
            i++;
            $('#table_body').append('<tr id="row' + i + '" class="dynamic-added">' +
                '<td style = "width:8%;"><input type="number" name="item_id[]" class="form-control item_id1" value = "' + item_id + '" readonly/></td>' +
                '<td><input type="text" class="form-control item_name" value = "' + item_name + '" readonly/></td>' +
                '<td style = "width:10%;">'+
                '<div class="input-group-prepend">' +
                '<input type="number" name="sale_item_quantity[]" placeholder="Enter quantity" class="form-control sale_item_quantity" min="1" max = "' + item_quantity + '" value = "1" required/>'+
                '<span class="input-group-text" id="basic-addon">/ '+item_quantity+'</span></div>' +
                '</td>' +
                '<td style = "width:10%;"><input type="number" name="sale_item_discount[]" placeholder="Enter discount" class="form-control sale_item_discount" min="0" max = "100" value = "0" required/></td>' +
                '<td style = "width:15%;">' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text" id="basic-addon1">RM</span>' +
                '<input type="number"  class="form-control ori_sale_item_price" value = "' + item_price + '" readonly/></div>' +
                '</td>' +
                '<td style = "width:15%;:">' +
                '<input type="number" style = "display:none" class="form-control one_item_price" value = "' + item_price + '"/>' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text" id="basic-addon1">RM</span>' +
                '<input type="number" name="sale_item_price[]" class="form-control sale_item_price" value = "' + item_price + '" readonly/></div>' +
                '</td>' +
                '<td style = "width:2%;">' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><span class="fas fa-times"></span></button></td>' +
                '</tr>');

            update_total_sales_price();
        }
        else{
            //Display sweetalert pop up message if item has already been added to the list
            Swal.fire({
                icon: 'info',
                text: 'The item has already been added',
              })
        }
    });

    //function to remove item row upon clicking the red remove button
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
        update_total_sales_price();

    });

    //function is trigger when the quantity and discount input field from any row is changed or modified                 
    $("#item_list").on("change", 'input', function () {
        var row = $(this).closest("tr");

        if (row.find(".sale_item_quantity").val() > 0 && row.find(".sale_item_discount").val() >= 0) {

            var sale_item_discount = row.find(".sale_item_discount").val();
            var one_item_price = row.find(".one_item_price").val();
            var sale_item_quantity = row.find(".sale_item_quantity").val();

            //update sale_item_price when quantity and discount input field in any row is changed
            var sale_item_price = sale_item_quantity * one_item_price * ((100 - sale_item_discount) / 100);
            sale_item_price = sale_item_price.toFixed(2);
            $('.sale_item_price', row).val(sale_item_price);

            //update original sale_item_price when quantity and discount input field in any row is changed
            var ori_total_sale_item_price = sale_item_quantity * one_item_price;
            ori_total_sale_item_price = ori_total_sale_item_price.toFixed(2);
            $('.ori_sale_item_price', row).val(ori_total_sale_item_price);

            update_total_sales_price();

        }
    });

}); // end of ready function

//update sale_total_price & sale_discounted_price  when quantity and discount input field in any row is changed
function update_total_sales_price() {

    //update sale_total_price when quantity and discount input field in any row is changed
    var total_discounted_price = 0;
    $("#item_list .sale_item_price").each(function () {
        var get_value = $(this).val();
        total_discounted_price += parseFloat(get_value);
    });
    $("#sale_discounted_price").val(total_discounted_price);

    //update sale_discounted_price  when quantity and discount input field in any row is changed
    var total_sales_price = 0;
    $("#item_list .ori_sale_item_price").each(function () {
        var get_value = $(this).val();
        total_sales_price += parseFloat(get_value);
    });
    $("#sale_total_price").val(total_sales_price);

}