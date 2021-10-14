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

    // t.on( 'order.dt search.dt', function () {
    //     t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //         cell.innerHTML = i+1;
    //     } );
    // } ).draw();

}); // end of ready function

// function delete_emp(emp_id){

//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//       }).then((result) => {
//         if (result.isConfirmed) {

//             $.ajax({
//                 url: base_url + "internal/level_2/employer/employer_emps/delete_emp",
//                 method:"POST",
//                 data:{ emp_id:emp_id},
//                 success:function(data)
//                 {
//                     Swal.fire(
//                         'Deleted!',
//                         'Employer Project has been deleted.',
//                         'success'
//                     )

//                     //reload datatable
//                     var xin_table = $("#table_emps").DataTable();
//                     xin_table.ajax.reload(null, false);
//                 }
//             });
          
//         }
//       })
// }

// function view_emp(emp_id){

//     $.ajax({
//         url: base_url + "internal/level_2/employer/employer_emps/view_emp",
//         method:"POST",
//         data:{ emp_id:emp_id},
//         success:function(data)
//         {
//             $('#emp_information').html(data);

//         }
//     });
// }