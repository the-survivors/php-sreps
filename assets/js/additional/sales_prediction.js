$(document).ready(function(){
    //alert('hi');
    // items dropdown (dependent on what was chosen for item's subcategory)
    $('#item_subcategory').change(function () {
        var item_subcategory = document.getElementById("item_subcategory").value;

        if(item_subcategory != ""){
            $.ajax({
                url: base_url + "sales/Sales_prediction/fetch_items",
                method:"POST",
                data:{item_subcategory_id:$("#item_subcategory").val()},
                success:function(data)
                {   
                $('#item').html(data);
                }
            });
        }
    });
});


