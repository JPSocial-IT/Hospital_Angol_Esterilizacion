<form name="FormUsuario" id="FormUsuario" role="form" enctype="multipart/form-data">
    <div class="modal-header">
        <h5 class="modal-title" id="modalFormularioLabel">
            <i class="mdi <?php echo $formulario['icono']; ?> me-2 font-size-24"></i><?php echo $formulario['titulo']; ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <p><?php echo $formulario['subtitulo']; ?></p>
        <div class="mb-2 row">
            <label for="txt_rut" class="col-md-4 col-form-label">Rut :</label>
            <div class="col-md-8">
                <input type="text" name="txt_rut" id="txt_rut" class="form-control" placeholder="12345678-9" value="<?php echo $usuario['rut'] ;?>" tabindex="1">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_nombre" class="col-md-4 col-form-label">Nombre :</label>
            <div class="col-md-8">
                <input type="text" name="txt_nombre" id="txt_nombre" class="form-control" value="<?php echo $usuario['nombre'] ;?>" tabindex="2">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_apellido_p" class="col-md-4 col-form-label">Apellido Paterno :</label>
            <div class="col-md-8">
                <input type="text" name="txt_apellido_p" id="txt_apellido_p" class="form-control" value="<?php echo $usuario['apellido_p'] ;?>" tabindex="3">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_apellido_m" class="col-md-4 col-form-label">Apellido Materno :</label>
            <div class="col-md-8">
                <input type="text" name="txt_apellido_m" id="txt_apellido_m" class="form-control" value="<?php echo $usuario['apellido_m'] ;?>" tabindex="4">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_email" class="col-md-4 col-form-label">E-Mail :</label>
            <div class="col-md-8">
                <input type="email" name="txt_email" id="txt_email" class="form-control" placeholder=" ejemplo@correo.com" value="<?php echo $usuario['email'] ;?>" tabindex="5">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="hf_accion" id="hf_accion" value="<?php echo $formulario['accion']; ?>">
        <input type="hidden" name="hf_id_usuario" id="hf_id_usuario" value="<?php echo $usuario['id'] ;?>">
        <button type="button" class="btn btn-secondary" id="btn_cancelar" data-bs-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close-thick me-1"></i>Cancelar
        </button>
        <button type="button" class="btn btn-success" id="btn_guardar">
            <i class="mdi mdi-content-save me-1"></i><?php echo $formulario['btn_guardar']; ?>
        </button>
    </div>
</form>
