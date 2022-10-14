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

                        <!-- TABLA DATOS -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h4 class="card-title mb-4">Listado de Carros Paro:</h4>
                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="btn_nuevo">Nuevo</button>
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
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    <!-- MODAL GESTIONAR CARROS DE PARO INSUMO-->
    <div id="modal_gestionar_carro_paro_insumo" class="modal fade" tabindex="-1"  aria-labelledby="myModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_gestionar_carro_paro_insumo_titulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input class="form-control" type="hidden" id="modal_gestionar_carro_paro_insumo_id">
                </div>
                <div class="modal-body" >
                            <div class="row">
                                
                                <div class="col-12">
                                                
                                    <div>
                                        <label class="form-label">Carro Paro</label>
                                            <select class="form-control" id="modal_gestionar_carro_paro_insumo_select_carro_paro">
                                                <?= $option_carro_paro ?>
                                            </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Insumo</label>
                                            <select class="form-control" id="modal_gestionar_carro_paro_insumo_select_insumo">
                                                <?= $option_insumo ?>
                                            </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Cantidad Inicial</label>
                                        <input class="form-control" type="text" id="modal_gestionar_carro_paro_insumo_cantidadinicial" maxlength="255">
                                        <p class="form-label text-end mt-1" id="modal_gestionar_carro_paro_insumo_cantidadinicial_contador" maxlength="255"></p>
                                    </div>
                                    <div>
                                        <label class="form-label">Cantidad Final</label>
                                        <input class="form-control" type="text" id="modal_gestionar_carro_paro_insumo_cantidadfinal" maxlength="255">
                                        <p class="form-label text-end mt-1" id="modal_gestionar_carro_paro_insumo_cantidadfinal_contador" maxlength="255"></p>
                                    </div>
                                    <div>
                                        <label class="form-label">Nota</label>
                                        <input class="form-control" type="text" id="modal_gestionar_carro_paro_insumo_nota" maxlength="255">
                                        <p class="form-label text-end mt-1" id="modal_gestionar_carro_paro_insumo_nota_contador" maxlength="255"></p>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                                
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary waves-effect waves-light" id="modal_gestionar_carro_paro_insumo_btn_guardar">Guardar</button>
                        </div>
                    </div>
                </div>
    </div>
        <?= $this->include('partials/right-sidebar') ?>

        <?= $this->include('partials/vendor-scripts') ?>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/js/proyecto/mantenedor_carro_paro_insumo.js"></script>
    </body>
</html> 