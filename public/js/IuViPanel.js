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
        { data: "tx_solicitud" },
        { data: "tx_cantidad" },
        { data: "fecha_add" },
        {
            data: null,
            render: function (data, type, full) {
            var result =
                '<div class="btn-group" role="group" aria-label="Basic example"><button title="Eliminar" data-table-name="tbl-solicitud" data-url="'+baseurl+'/panel/delsoli/" data-id="' +
                full.id +
                '" class="text-white btn btn-danger btnDeleteCustomer" ><i class="bx bx-trash-alt me-1"></i></button></div>';
            return result;
            },
        },
    ],
    });

    // $(document).on('click', '.btnEdt', updRowTable);
    // $(document).on('click', '.btnView', viewCustomer);
    // $(document).on('click', '.btnEstatus', updRowEstatusTable);
    $(document).on('click', '.btnDeleteCustomer', delRow);

    /* FORMS */

    // Fmr add Deposito
    $("#frmAddDeposito").submit(function (e) {
    e.preventDefault();
        $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        type: "post",
        dataType: "json",
        beforeSend: function () {
            beforeSend();
        },
        success: function (data) {
            if (data.status == true) {
            Swal.fire({
                icon: "success",
                text: data.msg,
                timer: 2000,
            }).then(function () {
                $("#modal-add-deposito").modal("hide");
                $("#tbl-solicitud").DataTable().ajax.reload();
                $("#frmAddDeposito")[0].reset();

            });
            }else if(data.status == false){
                Swal.fire({
                    icon: "error",
                    text: data.msg,
                    timer: 4000,
                });

            }else{
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

    // Fmr add Retiro
    $("#frmAddRetiro").submit(function (e) {
    e.preventDefault();
        $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        type: "post",
        dataType: "json",
        beforeSend: function () {
            beforeSend();
        },
        success: function (data) {
            if (data.status == true) {
            Swal.fire({
                icon: "success",
                text: data.msg,
                timer: 2000,
            }).then(function () {
                $("#modal-add-retiro").modal("hide");
                $("#tbl-solicitud").DataTable().ajax.reload();
                $("#frmAddRetiro")[0].reset();

            });
            }else if(data.status == false){
                Swal.fire({
                    icon: "error",
                    text: data.msg,
                    timer: 4000,
                });

            }else{
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

    function viewRfs()
    {
        var idRfs = $(this).attr("data-id");

        $.ajax({
            url: baseurl + "/rfs/edt/" + idRfs,
            data: { id: idRfs },
            type: "get",
            dataType: "json",
            success: function (res) {

                if(res.status === true ){

                    var insp = res.insp;
                    var rfs = res.rfs;

                    $("#modal-view-rfs #tx_lugar_trabajo").html(insp.tx_lugar_trabajo);
                    $("#modal-view-rfs #fecha_inspeccion").html(rfs.fecha_inspeccion);

                    $("#modal-view-rfs #tx_nombre_barco_plataforma").html(insp.tx_nombre_barco_plataforma);
                    $("#modal-view-rfs #tx_imo_barco").html(insp.tx_imo_barco);
                    $("#modal-view-rfs #tx_bandera_barco").html(insp.tx_bandera_barco);
                    $("#modal-view-rfs #tx_puerto_registro_barco").html(insp.tx_puerto_registro_barco);
                    $("#modal-view-rfs #tx_tipo_barco").html(insp.tx_tipo_barco);
                    $("#modal-view-rfs #tx_propietario_manager").html(insp.tx_propietario_manager);

                    $("#modal-view-rfs #tx_empresa_agente_local").html(insp.tx_empresa_agente_local);
                    $("#modal-view-rfs #tx_nombre_agente_local").html(insp.tx_nombre_agente_local);
                    $("#modal-view-rfs #tx_telefono_agente_local").html(insp.tx_telefono_agente_local);
                    $("#modal-view-rfs #tx_correo_agente_local").html(insp.tx_correo_agente_local);

                    $("#modal-view-rfs #tx_sociedad_clase_principal").html(insp.tx_sociedad_clase_principal);
                    $("#modal-view-rfs #tx_telefono_inspector_clase").html(insp.tx_telefono_inspector_clase);

                    $("#modal-view-rfs #tx_observacion_inspeccion").html(rfs.tx_observacion_inspeccion);

                    $("#modal-view-rfs").modal("show");

                }else{

                    Swal.fire({
                        icon: "error",
                        text: res.msg,
                        timer: 2000,
                    });

                }

                $.ajax({
                    url: baseurl + "/api/v1/allmessagerfs/" + idRfs,
                    data: { id: idRfs },
                    type: "get",
                    dataType: "json",
                    success: function (res) {

                        $("#modal-view-rfs #fecha_hora_mensaje").html('');
                        $("#modal-view-rfs #tx_descripcion_mensaje").html('');
                        
                        $.each(res.data, function(index, item) {
                            $("#modal-view-rfs #fecha_hora_mensaje").append(item.fecha_hora_mensaje + "<br>");
                            $("#modal-view-rfs #tx_descripcion_mensaje").append(item.tx_descripcion_mensaje + "<br>");
                        });                        

                    }
                });

                $.ajax({
                    url: baseurl + "api/v1/allserviceinsp/" + res.insp.id,
                    data: { id: res.insp.id },
                    type: "get",
                    dataType: "json",
                    success: function (res) {

                        // $("#modal-view-rfs #tx_cantidad_servicio_insp").html('');
                        $("#modal-view-rfs #tx_descripcion_servicio_insp").html('');
                        
                        $.each(res.data, function(index, item) {
                            // $("#modal-view-rfs #tx_cantidad_servicio_insp").append(item.tx_cantidad_servicio_insp + "<hr>");
                            $("#modal-view-rfs #tx_descripcion_servicio_insp").append('Cant: '+ item.tx_cantidad_servicio_insp +' | '+ item.tx_descripcion_servicio_insp + "<hr>");
                        });                        

                    }
                });
            
            }
        });

    }

    function updRowTable()
    {
        var idRfs = $(this).attr("data-id");
        var url = $(this).attr("data-url-name") + idRfs;

        $.ajax({
            url: baseurl + "api/v1/allactivesocietyclass",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $("#modal-upd-rfs #tx_sociedad_clase_principal").html('');
                $('#modal-upd-rfs #tx_sociedad_clase_principal').append('<option value="">' + 'Seleccione una Sociedad' + '</option>');
    
                $.each(response.data, function(index, item) {
                    $('#modal-upd-rfs #tx_sociedad_clase_principal').append('<option data-id="'+item.id+'" value="' + item.tx_nombre_sociedad + '">' + item.tx_nombre_sociedad + '</option>');
                });
            },
            error: function() {
                console.log('Error al obtener los datos del servidor');
            }
        });

        $("#frmUpdRfs")[0].reset();
        $('#frmUpdRfs').attr("action", url);

        $.ajax({
            url: baseurl + "/rfs/edt/" + idRfs,
            data: { id: idRfs },
            type: "get",
            dataType: "json",
            success: function (res) {

                if(res.status === true ){

                    var insp = res.insp;
                    var rfs = res.rfs;

                    flatpickr("#fecha_inspeccion", {
                        minDate: "today",
                    });

                    $("#modal-upd-rfs #tx_lugar_trabajo").val(insp.tx_lugar_trabajo);
                    $("#modal-upd-rfs #fecha_inspeccion").val(rfs.fecha_inspeccion);

                    $("#modal-upd-rfs #tx_nombre_barco_plataforma").val(insp.tx_nombre_barco_plataforma);
                    $("#modal-upd-rfs #tx_imo_barco").val(insp.tx_imo_barco);
                    $("#modal-upd-rfs #tx_bandera_barco").val(insp.tx_bandera_barco);
                    $("#modal-upd-rfs #tx_puerto_registro_barco").val(insp.tx_puerto_registro_barco);
                    $("#modal-upd-rfs #tx_tipo_barco").val(insp.tx_tipo_barco);
                    $("#modal-upd-rfs #tx_propietario_manager").val(insp.tx_propietario_manager);

                    $("#modal-upd-rfs #tx_empresa_agente_local").val(insp.tx_empresa_agente_local);
                    $("#modal-upd-rfs #tx_nombre_agente_local").val(insp.tx_nombre_agente_local);
                    $("#modal-upd-rfs #tx_telefono_agente_local").val(insp.tx_telefono_agente_local);
                    $("#modal-upd-rfs #tx_correo_agente_local").val(insp.tx_correo_agente_local);

                    $("#modal-upd-rfs #tx_sociedad_clase_principal").val(insp.tx_sociedad_clase_principal);
                    $("#modal-upd-rfs #tx_telefono_inspector_clase").val(insp.tx_telefono_inspector_clase);

                    $("#modal-upd-rfs #tx_observacion_inspeccion").val(rfs.tx_observacion_inspeccion);

                    $("#modal-upd-rfs").modal("show");

                }else{

                    Swal.fire({
                        icon: "error",
                        text: res.msg,
                        timer: 2000,
                    });

                }
            
            }

        });

    }

    function addMessageRfs()
    {
        var idRfs = $(this).attr("data-id");
        var url = $(this).attr("data-url-name") + idRfs;

        $("#frmAddMessageRfs")[0].reset();
        $('#frmAddMessageRfs').attr("action", url);

        flatpickr("#fecha_hora_mensaje", {
            dateFormat: "Y-m-d",
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                  shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                  longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                }, 
                months: {
                  shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                  longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
              },
        });

        $('#tbl-message-rfs').DataTable().destroy();
        var urlJson = $("#tbl-message-rfs").data("url");
        const urlJsonTblMessageRfs = urlJson + idRfs;

        $("#tbl-message-rfs").DataTable({
        responsive: false,
        dom: "Bfrtip",
        lengthChange: false,
        autoWidth: false,
        searching: true,
        buttons: [],
        order: [[0, "desc"]],
        info: false,
        ajax: urlJsonTblMessageRfs,
        columns: [
            { data: "id" },
            { data: "fecha_hora_mensaje" },
            { data: "tx_descripcion_mensaje" },
            {
                data: null,
                render: function (data, type, full) {
                var result =
                    '<div class="btn-group" role="group" aria-label="Basic example"><button title="Editar Mensage" data-url="'+baseurl+'rfs/edtmessage/" data-url-name="'+baseurl+'rfs/updmessage/" data-id="' +
                    full.id +
                    '" type="button" class="btn btn-primary btnEdtMessageRfs"><i class="bx bx-edit-alt me-1"></i></button><button type="button" title="Eliminar" data-table-name="tbl-message-rfs" data-url="'+baseurl+'/rfs/delmessage/" data-id="' +
                    full.id +
                    '" class="text-white btn btn-danger btnDeleteMessageRfs" ><i class="bx bx-trash-alt me-1"></i></button></div>';
                return result;
                },
            },
        ],
        });

        $(document).off('click', '.btnEdtMessageRfs').on('click', '.btnEdtMessageRfs', udpRowMessageRfs);
        $(document).on('click', '.btnDeleteMessageRfs', delRow);

        $("#modal-add-message-rfs").modal("show");
    }

    function udpRowMessageRfs()
    {
        var idMessage = $(this).attr("data-id");
        var url = $(this).attr("data-url") + idMessage;
        var urlFrm = $(this).attr("data-url-name") + idMessage;

        $("#frmUpdMessageRfs")[0].reset();
        $('#frmUpdMessageRfs').attr("action", urlFrm);

        $.ajax({
            url: url,
            data: { id: idMessage },
            type: "get",
            dataType: "json",
            success: function (res) {

                if(res.status === true ){

                    var message = res.data;

                    flatpickr("#fecha_inspeccion", {
                        minDate: "today",
                    });

                    $("#modal-upd-message-rfs #fecha_hora_mensaje").val(message.fecha_hora_mensaje);
                    $("#modal-upd-message-rfs #tx_descripcion_mensaje").val(message.tx_descripcion_mensaje);

                    $("#modal-upd-message-rfs").modal("show");

                }else{

                    Swal.fire({
                        icon: "error",
                        text: res.msg,
                        timer: 2000,
                    });

                }
            
            }

        });

    }

    function viewPdfRfs(){
        var idRfs = $(this).attr("data-id");

        window.open(baseurl + "/rfs/createpdfrfs/" + idRfs);
    }

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

    // Delete Row (GENERAL FUNCTION)
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