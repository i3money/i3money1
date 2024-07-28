$(document).ready(function () {

    $("#frm-register").submit(function (e) {
    e.preventDefault();
        $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        type: "post",
        dataType: "json",
        beforeSend: function () {
            Swal.fire({
            title: "<strong>Cargando...</strong>",
            html:
                '<img src="' +
                logo +
                '" height="50" alt="logo"><span class="sr-only"></span><h5 class="text-primary"><b>Por favor espere...</b></h5>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            });
        },
        success: function (data) {
            if (data.status == true) {
            Swal.fire({
                icon: "success",
                text: data.msg,
                timer: 2000,
            }).then(function () {
                location.href = baseurl+"/login";
            });
            } else {
            // console.log(data.errors);
            Swal.fire({
                icon: "error",
                text: Object.values(data.error)[0],
                timer: 3000,
            });
            }
        },
        error: function () {
            Swal.fire("Error!", "Server failure", "error");
        },
        });
    });

    // Manipular el evento de cambio del checkbox
    $("#view_password").on("change", function () {
        // Mostrar u ocultar la contraseña según el estado del checkbox
        $("#tx_clave_usuario").attr("type", $(this).is(":checked") ? "text" : "password");
    });

});