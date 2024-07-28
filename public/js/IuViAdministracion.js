$(document).ready(function () {

    const urlJsonTblSolicitud = $("#tbl-solicitud").data("url");

    $("#tbl-solicitud").DataTable({
    responsive: false,
    dom: "Bfrtip",
    lengthChange: false,
    autoWidth: false,
    searching: true,
    buttons: [],//["copy", "pdf"],
    order: [[0, "desc"]],
    info: false,
    ajax: urlJsonTblSolicitud,
    columns: [
        { data: "id" },
        {
            data: null,
            render: function (data, type, full) {
            var result =
                '<b>'+full.tx_nombre_usuario+' '+full.tx_apellido_usuario+'</b>';
            return result;
            },
        },
        { data: "tx_alias_usuario" },
        { data: "tx_solicitud" },
        { data: "tx_cantidad" },
        { data: "fecha_add" },
        {
            data: null,
            render: function (data, type, full) {
            var result =
                '<div class="btn-group" role="group" aria-label="Basic example"><button title="Aprobar" data-table-name="tbl-solicitud" data-url="'+baseurl+'/admin/aceptarsoli/" data-id="' +
                full.id +
                '" class="text-white btn btn-success btnAprobarSolicitud" ><i class="bx bx-check-double me-1"></i></button><button title="Rechazar" data-table-name="tbl-solicitud" data-url="'+baseurl+'/admin/rechazarsoli/" data-id="' +
                full.id +
                '" class="text-white btn btn-danger btnRechazarSolicitud" ><i class="bx bx-x-circle me-1"></i></button></div>';
            return result;
            },
        },
    ],
    });

    $(document).on('click', '.btnAprobarSolicitud', aceptarSolicitud);
    $(document).on('click', '.btnRechazarSolicitud', rechazarSolicitud);

    /* FUNCTIONS */

    $("#btnHistorial").on("click", function() {
        $('#tbl-historial').DataTable().destroy();
        const urlJsonTblHistorial = $("#tbl-historial").data("url");

        $("#tbl-historial").DataTable({
            responsive: false,
            dom: "Bfrtip",
            lengthChange: false,
            autoWidth: false,
            searching: true,
            buttons: [],
            order: [[0, "desc"]],
            info: true,
            ajax: urlJsonTblHistorial,
            columns: [
                { data: "id" },
                {
                    data: null,
                    render: function (data, type, full) {
                    var result =
                        '<b>'+full.tx_nombre_usuario+' '+full.tx_apellido_usuario+'</b>';
                    return result;
                    },
                },
                { data: "tx_alias_usuario" },
                { data: "tx_solicitud" },
                { data: "tx_cantidad" },
                {
                    data: "in_estatus",
                    render: function (data, type, row) {
                        var text = "";
                        if (data === "0") {
                        text = '<b class="text-danger">Rechazada</b>';
                        } else if(data === "2"){
                            text = '<b class="text-success">Aprobada</b>';
                        }else{
                            text = '<b class="text-warning">N/E</b>';
                        }
                        data = text;
            
                        return data;
                    },
                },
            ],
        });

        $("#modal-historial").modal("show");
    });

    // Alert Before Senf Form (GENERAL FUNCTION)
    function beforeSend(){
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
    }

    // Aceptar Solicitud
    function aceptarSolicitud() {
        var id = $(this).attr("data-id");
        let url = $(this).attr("data-url") + id;
        let tbl = $(this).attr("data-table-name");
        
        Swal.fire({

            title: "Aceptar esta Solicitud?",
            text: "Esta acción no se puede deshacer.",
            icon: "success",
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

    // Rechazar Solicitud
    function rechazarSolicitud() {
        var id = $(this).attr("data-id");
        let url = $(this).attr("data-url") + id;
        let tbl = $(this).attr("data-table-name");
        
        Swal.fire({

            title: "Rechazar esta Solicitud?",
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