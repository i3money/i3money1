$(document).ready(function () {

    var currentUrl = window.location.href;
    $('.menu-link').each(function() {
      if ($(this).attr('href') === currentUrl) {
        $(this).parent().addClass('active');
      }
    });

    $('.menu-link').click(function() {
        $('.menu-item').removeClass('active');
        $(this).parent().addClass('active');
    })

    $(".modulo").click(function (e) {
      e.preventDefault();
      var url = $(this).attr("href");
      var module = $(this).attr("data-module");
      
      $.ajax({
      url: baseurl + "verify/permissions/" + module,
      data: module,
      type: "post",
      dataType: "json",
      beforeSend: function () {

      },
      success: function (data) {
          if (data.status == true) {
            window.location.href = url;
          } else {
          Swal.fire({
            icon: "error",
            text: "No tiene permitido el Acceso",
            timer: 2000,
          });
          }
      },
      error: function () {
          Swal.fire("Error!", "Server failure", "error");
      },
      });

    });

});