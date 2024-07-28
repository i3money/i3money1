$(document).ready(function () {
    const urlJsonTblUser = $("#tbl-user").data("url");

    $("#tbl-user").DataTable({
    responsive: false,
    dom: "Bfrtip",
    lengthChange: false,
    autoWidth: false,
    searching: true,
    buttons: [],//["copy", "pdf"],
    order: [[1, "desc"]],
    info: false,
    ajax: urlJsonTblUser,
    columns: [
        { data: "id" },
        { data: "tx_nombre_usuario" },
        { data: "tx_apellido_usuario" },
        { data: "tx_alias_usuario" },

        {
            data: "in_tipo_usuario",
            render: function (data, type, row) {
                var text = "";
                if (data === "1") {
                text = '<b>Administrador</b>';
                } else {
                    text = '<b>Usuario</b>';
                }
                data = text;
    
                return data;
            },
        },

        {
        data: "in_estatus",
        render: function (data, type, row) {
            var text = "";
            if (data === "1") {
            text = '<h5><b><span class="text-success"><i class="mdi mdi-check"></i> Si</span></b></h5>';
            } else {
            text = '<h5><b><span class="text-danger"><i class="mdi mdi-eye-off"></i> No</span></b></h5>';
            }
            data = text;

            return data;
        },
        },
        {
            data: null,
            render: function (data, type, full) {
            var result =
                '<div class="btn-group" role="group" aria-label="Basic example"><button title="Editar Datos" data-url="'+baseurl+'/user-edt/" data-url-name="'+baseurl+'/user-upd/" data-id="' +
                full.id +
                '" type="button" class="btn btn-primary btnEdt"><i class="bx bx-edit-alt me-1"></i></button><button title="Cambiar Estatus" data-id="' +
                full.id +
                '" type="button" class="btn btn-success btnEstatus"><i class="bx bx-lock-alt me-1"></i></button></div>';
            return result;
            },
        },
    ],
    });
    
    $(document).on('click', '.btnEdt', updRowTable);
    $(document).on('click', '.btnEstatus', updRowEstatusTable);
    // $(document).on('click', '.btnDeleteUser', delRow);

    $.ajax({
        url: 'api/v1/allrolactive',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          $.each(response.data, function(index, item) {
            $('#id_rol').append('<option value="' + item.id + '">' + item.tx_nombre_rol + '</option>');
          });
        },
        error: function() {
          console.log('Error al obtener los datos del servidor');
        }
    });

    // Fmr Add User
    $("#frmAddUser").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($("#frmAddUser")[0]);
    // if (frmAddUserParsley.validationResult == true) {
        $.ajax({
        url: $(this).attr("action"),
        data: formData,
        type: "post",
        dataType: "json",
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
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
                $("#modal-add-user").modal("hide");

                $("#frmAddUser")[0].reset();
                $("#tbl-user").DataTable().ajax.reload();
            });
            } else {
            // console.log(data.errors);
            Swal.fire({
                icon: "error",
                text: Object.values(data.error)[0],
                timer: 2000,
            });
            }
        },
        error: function () {
            Swal.fire("Error!", "Server failure", "error");
        },
        });
    // }
    });

    // Frm Upd User
    $("#frmUpdUser").submit(function (e) {
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
                $("#modal-upd-user").modal("hide");

                $("#frmUpdUser")[0].reset();
                $("#tbl-user").DataTable().ajax.reload();
            });
            } else {
            Swal.fire({
                icon: "error",
                text: Object.values(data.error)[0],
                timer: 2000,
            });
            }
        },
        error: function () {
            Swal.fire("Error!", "Server failure", "error");
        },
        });
    });

    function updRowTable() {
        var id = $(this).attr("data-id");
        let url = $(this).attr("data-url") + id;
        let urlFrm = $(this).attr("data-url-name") + id;
        $.ajax({
        url: url,
        data: { id: id },
        type: "get",
        dataType: "json",
        success: function (res) {
            $("#modal-upd-user").modal("show");
            $("#frmUpdUser").attr("action", urlFrm);
            $("#modal-upd-user #tx_nombre_usuario").val(res.data.tx_nombre_usuario);
            $("#modal-upd-user #tx_apellido_usuario").val(res.data.tx_apellido_usuario);
        },
        error: function (data) {},
        });
    }

    function updRowEstatusTable() {
        var id = $(this).attr("data-id");
        $.ajax({
        url: baseurl + "/user-estatus/" + id,
        data: { id: id },
        type: "get",
        dataType: "json",
        success: function (res) {
            $("#tbl-user").DataTable().ajax.reload();
        },
        error: function (data) {},
        });
    }

    function delRow() {
        var id = $(this).attr("data-id");
        let url = $(this).attr("data-url") + id;
        let tbl = $(this).attr("data-table-name");
        
        Swal.fire({

            title: "Eliminar este registro?",
            text: "Esta acción no se puede deshacer.",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
      
          }).then(function (result) {
            if (result.value == true) {
              $.ajax({
                url: url,
                data: { id: id },
                type: "get",
                dataType: "json",
                success: function (res) {
                  if (res.status == true) {
                    Swal.fire({
                      icon: "success",
                      text: res.msg,
                      timer: 2000,
                    }).then(function () {
                      $("#" + tbl + "").DataTable().ajax.reload();
                    });
                  } else {
                    Swal.fire({ icon: "error", text: res.msg, timer: 2000 });
                  }
                },
                error: function (data) {},
              });
            }
        });
    }

});
