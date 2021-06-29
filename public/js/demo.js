//
// Demo.js
// only for preview purposes - remove it when starting your project
//

'use strict';

$(document).ready(function() {
    $('[data-toggle="sweet-alert"]').on('click', function(){
        var type = $(this).data('sweet-alert');

        switch (type) {
            case 'basic':
                swal({
                    title: "Here's a message!",
                    text: 'A few words about this sweet alert ...',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-primary'
                })
            break;

            case 'info':
                swal({
                    title: 'Info',
                    text: 'A few words about this sweet alert ...',
                    type: 'info',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-info'
                })
            break;

            case 'info':
                swal({
                    title: 'Info',
                    text: 'A few words about this sweet alert ...',
                    type: 'info',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-info'
                })
            break;

            case 'success':
                swal({
                    title: 'Success',
                    text: 'A few words about this sweet alert ...',
                    type: 'success',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-success'
                })
            break;

            case 'warning':
                swal({
                    title: 'Warning',
                    text: 'A few words about this sweet alert ...',
                    type: 'warning',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-warning'
                })
            break;

            case 'question':
                swal({
                    title: 'Are you sure?',
                    text: 'A few words about this sweet alert ...',
                    type: 'question',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-dark'
                })
            break;

            case 'confirm':
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonClass: 'btn btn-secondary'
                }).then(function(result) {
                    if (result.value) {
                        // Show confirmation
                        swal({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            type: 'success',
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-primary'
                        });
                    }
                })
            break;

            case 'image':
                swal({
                    title: 'Sweet',
                    text: "Modal with a custom image ...",
                    imageUrl: '../../assets/img/prv/splash.png',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-primary',
                    confirmButtonText: 'Super!'
            });
            break;

            case 'timer':
                swal({
                    title: 'Auto close alert!',
                    text: 'I will close in 2 seconds.',
                    timer: 2000,
                    showConfirmButton: false
                });
            break;
        }
    });
});
