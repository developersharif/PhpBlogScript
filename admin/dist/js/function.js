  $(window).on('load', function() {
  $('#status').fadeOut(); // will first fade out the loading animation 
  $('#preloader').delay(350).fadeOut('fast'); // will fade out the white DIV that covers the website. 
  $('body').delay(350).css({'overflow':'visible'});
});
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').<?php if (isset($_GET['loged'])) {
      echo "ready";
    } else {
      echo 'click';
    }
     ?>(function() {
      Toast.fire({
        icon: 'success',
        title: ' successfully loged in'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'blablabla'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'blablabla'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'blablabla'
      })
    });

  });
