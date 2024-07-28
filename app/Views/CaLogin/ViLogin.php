<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>I3 MONEY | Iniciar Sesión</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/themplate/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url(); ?>/themplate/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/themplate/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/themplate/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/themplate/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/themplate/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url(); ?>/themplate/assets/vendor/css/pages/page-auth.css" />

    <!-- Sweet Alert 2 -->
    <link href="<?= base_url(); ?>/themplate/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <!-- Helpers -->
    <script src="<?= base_url(); ?>/themplate/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url(); ?>/themplate/assets/js/config.js"></script>

    <script type="text/javascript">const baseurl = "<?php echo base_url ();?>";</script>
    <script type="text/javascript">const logo = "<?php echo base_url(); ?>/themplate/assets/img/logos/logo.png";</script>

  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="<?= base_url(); ?>" class="app-brand-link d-flex justify-content-center">
                    <span>
                        <img src="<?= base_url(); ?>/themplate/assets/img/logos/logo.png" width="200" height="200" class="img-fluid">
                    </span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2 text-center">¡Bienvenido!</h4>

              <form id="frm-login" action="<?= base_url('login-validate'); ?>" >
                <div class="mb-3">
                  <label for="email" class="form-label">Usuario</label>
                  <input type="text" class="form-control" id="tx_alias_usuario" name="tx_alias_usuario" placeholder="Ingrese su Usuario" autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Contraseña</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" id="tx_clave_usuario" class="form-control" name="tx_clave_usuario" placeholder="........." aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit"><b><i class="bx bx-log-in-circle me-1"></i>Iniciar Sesión</b></button>
                </div>
              </form>

              <p class="text-center">
                <span>No estas Registrado?</span>
                <a href="<?= base_url('register'); ?>">
                  <span>Registrarse</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url(); ?>/themplate/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url(); ?>/themplate/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url(); ?>/themplate/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url(); ?>/themplate/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= base_url(); ?>/themplate/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= base_url(); ?>/themplate/assets/js/main.js"></script>

    <!-- Page JS -->

        <!-- Sweet Alert 2  -->
    <script src="<?= base_url(); ?>/themplate/libs/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Js Personalized -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/IuViLogin.js"></script>

    <link href="<?= base_url(); ?>/themplate/assets/css/personalized_sweetalert.css" rel="stylesheet" type="text/css" />

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>