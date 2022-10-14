<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>
    <div class="pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="text-muted">Módulo Servicio de Esterilización</h2>
                        <div class="row justify-content-center">
                            <div class="col-sm-3">
                                <div class="maintenance-img">
                                    <img src="assets/images/coming-soon.svg" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $user_id?>" id="txt_user_id"/>
                        <h4 class="mt-5 text-muted">Bienvenido <?php echo $user_nombres ?></h4>
                        <p class="text-muted" id="lbl_mensaje">Obteniendo información usuario...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="<?php echo getenv("baseURL_principal")?>" id="formulario_redireccionar_principal">
    </form>
    <input type="hidden" name="user_id" id="url_principal" value="<?php echo getenv("baseURL_principal")?>"/>
    <input type="hidden" name="user_id" id="url_acceso_sistema" value="<?php echo getenv("baseURL_acceso_sistema")?>"/>

    <?= $this->include('partials/vendor-scripts') ?>

    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/proyecto/ini_page.js"></script>
</body>

</html>