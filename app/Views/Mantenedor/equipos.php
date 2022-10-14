<!DOCTYPE html>
<html lang="es">
        <?php echo $title_meta; ?>
        <?php echo $this->include('partials/head-css'); ?>
        <style type="text/css">
            #btn_modalFormulario .btn_agregar {
                display: none;
            }
        </style>
    </head>

    <?php echo $this->include('partials/body'); ?>
        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php echo $this->include('partials/menu') ?>
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
                                        <div class="row">
                                            <div class="col-sm-4">
                                            <!--    <h4 class="card-title mb-4"><?= lang('Files.'.$title.'')?></h4>       -->
                                                <label for="val_tipo_id" class="form-label">Tipo de Equipo :</label>
                                                <!-- <select class="form-select" name="val_tipo_id" id="val_tipo_id" tabindex="5" placeholder=".col-xs-3" onchange="funcion(this);"> -->

                                                <select class="form-select" name="val_tipo_id" id="val_tipo_id" style="width:70% !important;">
                                                    <option></option>
                                                        <?php
                                                        for($i=0; $i < count($tipos); $i++) {
                                                            // $selected = ($tipos[$i]['id'] == $resultado['tipo_id']) ? ' selected="selected"' : '';
                                                            // echo '<option value="' . $tipos[$i]['id'] . '"' . $selected . '>' . $tipos[$i]['descripcion'] . '</option>';
                                                            $selected ='0';
                                                            echo '<option value="' . $tipos[$i]['id'] . '"' . $selected . '>' . $tipos[$i]['descripcion'] . '</option>';
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-8" id="btn_modalFormulario">
                                                <!-- <a href="#" class="btn btn-success btn_agregar float-end" style="float: right;">Agregar Equipo</a> -->
                                                <button id="btnFA" class="btn btn-success btn_agregar float-end">
                                                <!-- <button type="button" class="btn btn-success btn-sm btn_agregar float-end"> -->
                                                <i class="fa fa-plus-square"></i> Agregar Equipo
                                                </button>
                                            </div>
                                        </div>
                                        <div id="contenedor_tabla">
                                            <div class="alert alert-info" role="alert">
                                                <i class="mdi mdi-magnify me-2"></i>Obteniendo datos...
                                            </div>
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

            <!-- MODALS -->
            <div class="modal fade" id="modalFormulario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormularioLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
        <!-- END layout-wrapper -->
        <?= $this->include('partials/right-sidebar') ?>
        <?= $this->include('partials/vendor-scripts') ?>
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/js/proyecto/equipos.js"></script>
    </body>
</html> 