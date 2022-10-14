<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- <script src="js/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#modal_gestionar_servicio").on('shown.bs.modal', function(){
                    $(this).find('#modal_gestionar_servicio_codigo').focus();
                });
            });
        </script> -->
        <?= $title_meta ?>
        <?= $this->include('partials/head-css') ?>
    </head>

    <?= $this->include('partials/body') ?>

        <div id="layout-wrapper">

            <?= $this->include('partials/menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?= $page_title ?>

                        <!-- TABLA DATOS -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end mb-3">
                                            <!-- <button type="button" class="btn btn-primary waves-effect waves-light" id="btn_nuevo">Nuevo Servicio</button> -->
                                            <button type="button" class="btn btn-success float-endt" id="btn_nuevo">
                                                <i class="fa fa-plus-square"></i> Nuevo Servicio
                                            </button>
                                        </div>
                                        <div id="contenedor_tabla">
                                            Cargando datos...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?= $this->include('partials/footer') ?>
            </div>

        </div>

        <!-- MODAL GESTIONAR SERVICIO -->
        <div id="modal_gestionar_servicio" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_gestionar_servicio_titulo"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input class="form-control" type="hidden" id="modal_gestionar_servicio_id">
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="mb-2 row">
                                <label for="modal_gestionar_servicio_codigo" class="col-md-4 col-form-label">Código DEIS :</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="modal_gestionar_servicio_codigo" autofocus>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <!-- <div>
                                    <label class="form-label">Código deis</label>
                                    <input class="form-control" type="text" id="modal_gestionar_servicio_descripcion" maxlength="255">
                                </div> -->
                                <label for="modal_gestionar_servicio_descripcion" class="col-md-4 col-form-label">Descripción :</label>
                                <!-- <label class="form-label">Descripción *</label> -->
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="modal_gestionar_servicio_descripcion" maxlength="255">
                                    <p class="form-label text-end mt-1" id="modal_gestionar_servicio_descripcion_contador" maxlength="255"></p>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="modal_gestionar_servicio_activo">
                                    <label class="form-check-label" for="formCheck2">
                                        Activo para Esterilización
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" id="modal_gestionar_servicio_btn_guardar">
                            <i class="mdi mdi-content-save me-1"></i>Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->include('partials/right-sidebar') ?>

        <?= $this->include('partials/vendor-scripts') ?>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/js/proyecto/mantenedor_servicio.js"></script>
    </body>
</html> 