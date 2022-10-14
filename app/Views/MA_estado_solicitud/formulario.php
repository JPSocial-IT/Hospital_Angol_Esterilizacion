<form name="FormUsuario" id="FormUsuario" role="form" enctype="multipart/form-data">
    <div class="modal-header">
        <h5 class="modal-title" id="modalFormularioLabel">
            <i class="mdi <?php echo $formulario['icono']; ?> me-2 font-size-24"></i><?php echo $formulario['titulo']; ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <script>
            $('#txt_descripcion').focus();
        </script>

        <p><?php echo $formulario['subtitulo']; ?></p>
        <div class="mb-2 row">
            <label for="txt_descripcion" class="col-md-4 col-form-label">Estado :</label>
            <div class="col-md-8">
                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="Descripción" value="<?php echo $resultado['descripcion'] ;?>" tabindex="1">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_descripcion_estado" class="col-md-4 col-form-label">Descripción :</label>
            <div class="col-md-8">
                <input type="text" name="txt_descripcion_estado" id="txt_descripcion_estado" class="form-control"  placeholder="Descripción detallada" value="<?php echo $resultado['descripcion_estado'] ;?>" tabindex="2">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="hf_accion" id="hf_accion" value="<?php echo $formulario['accion']; ?>">
 
        <input type="hidden" name="hf_id_estado" id="hf_id_estado" value="<?php echo $resultado['id'] ;?>">
        <button type="button" class="btn btn-secondary" id="btn_cancelar" data-bs-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close-thick me-1"></i>Cancelar
        </button>
        <button type="button" class="btn btn-success" id="btn_guardar">
            <i class="mdi mdi-content-save me-1"></i><?php echo $formulario['btn_guardar']; ?>
        </button>
    </div>
</form>
