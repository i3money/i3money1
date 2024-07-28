<?php echo $this->extend('Views/ViBase');?>

<?php echo $this->section('css') ?>

    <!-- DataTables -->
    <link href="<?= base_url(); ?>/themplate/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/themplate/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url(); ?>/themplate/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Date Picker -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" defer>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>

<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mi Panel /</span> Gestión</h4>

    <div class="row">

        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Bienvenido <?= session('tx_nombre_usuario').' '.session('tx_apellido_usuario') ; ?></h5>
                        <p>Saldo Disponible: <?= $saldo_usuario ?> USD</p>

                        <div class="row g-3">

                            <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                <button type="button" title="Depositar" class="btn btn-success col-12"  data-id-user="<?= session('nu_session_user_id'); ?>" data-bs-toggle="modal" data-bs-target="#modal-add-deposito">
                                    <i class="bx bx-wallet me-1"></i><b>Depositar</b>
                                </button>
                            </div>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                <button type="button" title="Retirar" class="btn btn-warning col-12" data-id-user="<?= session('nu_session_user_id'); ?>" data-bs-toggle="modal" data-bs-target="#modal-add-retiro">
                                    <i class="bx bx-money me-1"></i><b>Retirar</b>
                                </button>
                            </div>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                <button type="button" title="Historial de Transacciones" class="btn btn-primary col-12" id="btnHistorial" >
                                    <i class="bx bx-list-check me-1"></i><b>Mi Historial</b>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
              <!-- <div class="col-sm-4 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="<?= base_url(); ?>/themplate/assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div> -->
            </div>
          </div>
        </div>       

        <!-- <div class="col-12 mb-4">
            <div class="text-end">
                <button type="button" title="Nuevo Rol" class="col-12 col-md-3 col-lg-3 col-xl-3 btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#modal-add-rol">
                <i class="bx bx-id-card me-1"></i><b>Nuevo Rol</b>
                </button>
            </div>
        </div> -->

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
            
            <div class="card mb-4">
                <h5 class="card-header">Mis Solicitudes</h5>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tbl-solicitud" data-url="<?php echo base_url('api/v1/allmysoli'); ?>" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Solicitud</th>
                                    <th>Cantidad</th>
                                    <th>Fecha Add</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<!-- / Content -->

    <!-- Modals -->

    <!-- Modal Add Deposito  -->
    <div class="modal fade" id="modal-add-deposito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitar Deposito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <form id="frmAddDeposito" action="<?= base_url("/panel/adddeposito"); ?>" method="post">
                    
                    <div class="row g-3">

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h6 class="text-muted fw-400">Cantidad (USD) <b class="text-danger">*</b></h6>
                            <input type="text" class="form-control" name="tx_cantidad" id="tx_cantidad" placeholder="0.00" />
                        </div>


                    </div>

                    <div class="text-start">
                        <button type="submit" class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 btn btn-primary waves-effect mt-4 mb-2"><i class="bx bx-save me-1"></i><b>Guardar</b></button>
                    </div>

                    </form>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x me-1"></i><b>Cerrar</b></button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Retiro  -->
    <div class="modal fade" id="modal-add-retiro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitar Retiro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <form id="frmAddRetiro" action="<?= base_url("/panel/addretiro"); ?>" method="post">
                    
                    <div class="row g-3">

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h6 class="text-muted fw-400">Cantidad (USD) <b class="text-danger">*</b></h6>
                            <input type="text" class="form-control" name="tx_cantidad" id="tx_cantidad" placeholder="0.00" />
                        </div>


                    </div>

                    <div class="text-start">
                        <button type="submit" class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 btn btn-primary waves-effect mt-4 mb-2"><i class="bx bx-save me-1"></i><b>Guardar</b></button>
                    </div>

                    </form>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x me-1"></i><b>Cerrar</b></button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Historial  -->
    <div class="modal fade" id="modal-historial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mi Historial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table id="tbl-historial" data-url="<?php echo base_url('api/v1/allmysolihistory'); ?>" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Solicitud</th>
                                    <th>Cantidad</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x me-1"></i><b>Cerrar</b></button>
            </div>
            </div>
        </div>
    </div>


<?php echo $this->endSection() ?>

<?php echo $this->section('js') ?>

    <!-- Required datatable js -->
    <script src="<?= base_url(); ?>/themplate/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Js Personalized -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/IuViPanel.js"></script>

    <!-- Buttons examples -->
    <script src="<?= base_url(); ?>/themplate/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/jszip.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?= base_url(); ?>/themplate/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/responsive.bootstrap4.min.js"></script>

    <link href="<?= base_url(); ?>/themplate/assets/css/personalized_sweetalert.css" rel="stylesheet" type="text/css" />

<?php echo $this->endSection() ?>