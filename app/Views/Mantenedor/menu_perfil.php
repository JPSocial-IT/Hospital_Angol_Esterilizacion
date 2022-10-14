<!DOCTYPE html>
<html lang="en">
    <head>
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

                        <div class="row mb-4 pb-3">
                            <div class="col-3 px-4">
                                <div>
                                    <label class="form-label">Perfil</label>
                                    <select class="form-control" id="select_perfil">
                                        <?= $option_perfil ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- TABLA DATOS -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="contenedor_tabla" class="pt-3">
                                            <?= $tabla_menu_perfil_defecto ?>
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
        
        <?= $this->include('partials/right-sidebar') ?>

        <?= $this->include('partials/vendor-scripts') ?>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/js/proyecto/mantenedor_menu_perfil.js"></script>
    </body>
</html> 