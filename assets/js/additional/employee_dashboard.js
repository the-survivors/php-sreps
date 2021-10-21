$(document).ready(function () {


    function update_sales_count() {
        $('#sales_counter').animate({
            counter: counter1
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Number(now).toFixed(2));
            },
            complete: update_sales_count
        });
    };
    update_sales_count();

    function update_items_count() {
        $('#items_counter').animate({
            counter: counter2
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_items_count
        });
    };
    update_items_count();

    function update_items_low_on_stock_count() {
        $('#items_low_on_stock').animate({
            counter: counter3
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_items_low_on_stock_count
        });
    };
    update_items_low_on_stock_count();

}); // end of ready function