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
            <label for="txt_descripcion" class="col-md-4 col-form-label">Nombre de la Bodega :</label>
            <div class="col-md-8">
                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="Descripción" value="<?php echo $resultado['descripcion'] ;?>" tabindex="1">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_comentario" class="col-md-4 col-form-label">Comentario :</label>
            <div class="col-md-8">
                <input type="text" name="txt_comentario" id="txt_comentario" class="form-control"  placeholder="Comentario relacionado a  la Bodega" value="<?php echo $resultado['comentario'] ;?>" tabindex="2">
            </div>
        </div>
        <!-- <div class="mb-2 row">
            <label for="val_encargado_id" class="col-md-4 col-form-label">ID Encargado :</label>
            <div class="col-md-8">
                <input type="text" name="val_encargado_id" id="val_encargado_id" class="form-control"  placeholder="ID de Encargado" value="<?php echo $resultado['encargado_id'] ;?>" tabindex="3">
            </div>
        </div> -->
        <div class="mb-2 row">

            <label for="val_encargado_id" class="form-label">Encargado :</label>
            <span class="text-danger font-side-11">(* Requerido)</span>
            <select class="form-select" name="val_encargado_id" id="val_encargado_id" tabindex="3" placeholder=".col-xs-3" onchange="funcion(this);">
                <option></option>
                <?php
                for($i=0; $i < count($funcionarios); $i++) {
                    $selected = ($funcionarios[$i]['id'] == $resultado['encargado_id']) ? ' selected="selected"' : '';
                    echo '<option value="' . $funcionarios[$i]['id'] . '"' . $selected . '>' . $funcionarios[$i]['nombres'] . " " . $funcionarios[$i]['apellido_uno'] . " " . $funcionarios[$i]['apellido_dos'] . '</option>';
                    // echo '<option value="' . $funcionarios[$i]['id'] . '"' . $selected . '>' . $funcionarios[$i]['nombre_completo'] . '</option>';
                }
                ?>
            </select>
            
            <!-- <div class="col-md-8">
                <input type="text" name="val_encargado_id" id="val_encargado_id" class="form-control"  placeholder="ID de Encargado" value="<?php echo $resultado['encargado_id'] ;?>" tabindex="3">
            </div> -->
        </div>
        <div class="mb-2 row">
            <label for="txt_encargado_nombre" class="col-md-4 col-form-label">Nombre del Encargado :</label>
            <div class="col-md-8">
                <input type="text" name="txt_encargado_nombre" id="txt_encargado_nombre" class="form-control"  placeholder="Nombre de Encargado" value="<?php echo $resultado['encargado_nombre'] ;?>" tabindex="4">

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="hf_accion" id="hf_accion" value="<?php echo $formulario['accion']; ?>">
 
        <input type="hidden" name="hf_id_bodega" id="hf_id_bodega" value="<?php echo $resultado['id'] ;?>">
        <button type="button" class="btn btn-secondary" id="btn_cancelar" data-bs-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close-thick me-1"></i>Cancelar
        </button>
        <button type="button" class="btn btn-success" id="btn_guardar">
            <i class="mdi mdi-content-save me-1"></i><?php echo $formulario['btn_guardar']; ?>
        </button>
    </div>
</form>
<script>
function funcion(e) {
    var option = e.options[e.selectedIndex];
    var inputAux = document.getElementById('inputAux');
    $encargado=option.text;
    document.getElementById("txt_encargado_nombre").value = option.text;
    /* alert("Valor Option: " + option.value + ", Texto Option: " + $encargado); */
    alert("Valor Input: " + inputAux.value);}
</script>

