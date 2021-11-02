$(document).ready(function() {

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

//function will trigger when user click on any of the month in the button group
function load_table(month) {
    var year = document.getElementById("year").value;
    window.location.href = base_url + "sales/sales_report/monthly_sales_report/" + month + "/" + year;
}