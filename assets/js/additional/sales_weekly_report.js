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

//trigger function when the date input is changed
$('.date').change(function() {
    var start_date = document.getElementById("start_date").value;
    var end_date = document.getElementById("end_date").value;
    window.location.href = base_url + "sales/sales_report/weekly_sales_report/" + start_date + "/" + end_date;
});