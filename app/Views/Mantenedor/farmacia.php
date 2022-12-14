<DOCTYPE html>
<html lang="en">
    <head>
        <?= $title_meta ?>
        <?= $this->include('partials/head-css') ?>
    </head>

    <?= $this->include('partials/body') ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?= $this->include('partials/menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?= $page_title ?>
                        <div class="row mb-4 pb-3">
                            <div class="col-3 px-4">
                                <div>
                                    <label class="form-label">Servicio</label>
                                    <select class="form-control" id="select_servicio">
                                        <?= $option_servicio ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- TABLA DATOS -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h4 class="card-title mb-4">Listado de Farmacias:</h4>
                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="btn_nuevo">Nuevo</button>
                                        </div>
                                        <div id="contenedor_tabla">
                                            <?= $tabla_farmacia_defecto ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?= $this->include('partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    <!-- MODAL GESTIONAR FARMACIAS -->
    <div id="modal_gestionar_farmacia" class="modal fade" tabindex="-1"  aria-labelledby="myModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_gestionar_farmacia_titulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input class="form-control" type="hidden" id="modal_gestionar_farmacia_id">
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <label class="form-label">Descripci??n</label>
                                <input class="form-control" type="text" id="modal_gestionar_farmacia_descripcion" maxlength="255">
                                <p class="form-label text-end mt-1" id="modal_gestionar_farmacia_descripcion_contador" maxlength="255"></p>
                            </div>
                            <div>
                                <label class="form-label">Cantidad Stock</label>
                                <input class="form-control" type="number" id="modal_gestionar_farmacia_stock" maxlength="255">
                                <p class="form-label text-end mt-1" id="modal_gestionar_farmacia_stock_contador" maxlength="255"></p>
                            </div>
                            <div>
                                <label class="form-label">Efectos Adversos</label>
                                <input class="form-control" type="text" id="modal_gestionar_farmacia_efecto" maxlength="255">
                                <p class="form-label text-end mt-1" id="modal_gestionar_farmacia_efecto_contador" maxlength="255"></p>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="modal_gestionar_farmacia_activo">
                                    <label class="form-check-label" for="formCheck2">
                                        Activo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" id="modal_gestionar_farmacia_btn_guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
        <?= $this->include('partials/right-sidebar') ?>

        <?= $this->include('partials/vendor-scripts') ?>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/js/proyecto/mantenedor_farmacia.js"></script>
    </body>
</html> 