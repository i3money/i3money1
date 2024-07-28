<?php echo $this->extend('Views/ViBase');?>

<?php echo $this->section('css') ?>

    <!-- DataTables -->
    <link href="<?= base_url(); ?>/themplate/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/themplate/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url(); ?>/themplate/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuarios /</span> Gestión</h4>

    <div class="row">

        <div class="col-12 mb-4">
            <div class="text-end">
                <button type="button" title="Nuevo Usuario" class="col-12 col-md-3 col-lg-3 col-xl-3 btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#modal-add-user">
                <i class="bx bx-user me-1"></i><b>Nuevo Usuario</b>
                </button>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
            
            <div class="card mb-4">
                <h5 class="card-header">Listado de Usuarios</h5>
                <!-- Account -->

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tbl-user" data-url="<?php echo base_url('api/v1/alluser'); ?>" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Activo?</th>
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

    <!-- Modal Add User -->
    <div class="modal fade" id="modal-add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <form id="frmAddUser" action="<?php echo base_url('user-add'); ?>" method="post" enctype="multipart/form-data">
                    
                    <h6 class="text-muted fw-400 mt-3">Nombre <b class="text-danger">*</b></h6>
                    <div>
                        <input type="text" class="form-control" maxlength="100" name="tx_nombre_usuario"
                        placeholder="Nombre" />
                    </div>

                    <h6 class="text-muted fw-400 mt-3">Apellido <b class="text-danger">*</b></h6>
                    <div>
                        <input type="text" class="form-control" maxlength="100" name="tx_apellido_usuario"
                        placeholder="Apellido"  />
                    </div>

                    <h6 class="text-muted fw-400 mt-3">Usuario <b class="text-danger">*</b></h6>
                    <div>
                        <input type="text" class="form-control" maxlength="100" name="tx_alias_usuario"
                        placeholder="Usuario"  />
                    </div>

                    <h6 class="text-muted fw-400 mt-3">Contraseña <b class="text-danger">*</b></h6>
                    <div>
                        <input type="password" class="form-control" maxlength="100" name="tx_clave_usuario"
                        placeholder="Contraseña"  />
                    </div>
                    
                    <h6 class="text-muted fw-400 mt-3">Confirmar Contraseña <b class="text-danger">*</b></h6>
                    <div>
                        <input type="password" class="form-control" maxlength="100" name="tx_confirma_clave_usuario"
                        placeholder="Contraseña"  />
                    </div>

                    <h6 class="text-muted fw-400 mt-3">Rol <b class="text-danger">*</b></h6>
                    <div>
                        <select class="form-control" name="in_tipo_usuario" id="in_tipo_usuario">
                            <option value="">Seleccionar</option>
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>

                    <button type="submit" class="col-12 btn btn-primary waves-effect mt-2"><i class="bx bx-save me-1"></i><b>Guardar</b></button>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x me-1"></i><b>Cancelar</b></button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Upd User -->
    <div class="modal fade" id="modal-upd-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <form id="frmUpdUser" action="#" method="post">
                    
                    <h6 class="text-muted fw-400 mt-3">Nombre <b class="text-danger">*</b></h6>
                    <div>
                        <input type="text" class="form-control" maxlength="100" name="tx_nombre_usuario" id="tx_nombre_usuario"
                        placeholder="Nombre" />
                    </div>

                    <h6 class="text-muted fw-400 mt-3">Apellido <b class="text-danger">*</b></h6>
                    <div>
                        <input type="text" class="form-control" maxlength="100" name="tx_apellido_usuario" id="tx_apellido_usuario"
                        placeholder="Apellido" />
                    </div>

                    <button type="submit" class="col-12 btn btn-primary waves-effect mt-2"><i class="bx bx-save me-1"></i><b>Guardar</b></button>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x me-1"></i><b>Cancelar</b></button>
            </div>
            </div>
        </div>
    </div>

<?php echo $this->endSection() ?>

<?php echo $this->section('js') ?>

    <!-- Js Personalized -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/IuViUsuario.js"></script>

    <!-- Required datatable js -->
    <script src="<?= base_url(); ?>/themplate/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/themplate/libs/datatables/dataTables.bootstrap4.min.js"></script>

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