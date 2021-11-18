$(document).ready(function () {
    //alert('hi');
    // items dropdown (dependent on what was chosen for item's subcategory)
    $('#item_subcategory').change(function () {
        var item_subcategory = document.getElementById("item_subcategory").value;

        if (item_subcategory != "") {
            $.ajax({
                url: base_url + "sales/Sales_prediction/fetch_items",
                method: "POST",
                data: { item_subcategory_id: $("#item_subcategory").val() },
                success: function (data) {
                    $('#item').html(data);
                }
            });
        }
    });

    function update_most_sold_item_count() {
        $('#most_sold_items_counter').animate({
            counter: counter1
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_most_sold_item_count
        });
    };
    update_most_sold_item_count();

});