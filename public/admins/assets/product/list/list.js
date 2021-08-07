$(function () {
 $('.delete_product').click(function () {
     var url = $(this).data('url');
     var element = $(this);
     Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
         if (result.isConfirmed) {

             $.ajax({
                 showLoader: true,
                 url: url,
                 type: "GET",
                 success: function (result) {
                     if(result.code == 200) {
                         element.parent().parent().remove();
                         Swal.fire(
                             'Deleted!',
                             result.message,
                             'success'
                         );
                     }
                 },
                 fail:function (jqXHR) {
                     console.log(jqXHR);
                     Swal.fire(
                         'Can\'t delete product.',
                         '',
                         'error'
                     )
                 }
             })
         }
     })
 })
});