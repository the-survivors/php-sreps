$(document).ready(function () {


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

    

}); // end of ready function