<form name="FormUsuario" id="FormUsuario" role="form" enctype="multipart/form-data">
    <div class="modal-header">
        <h5 class="modal-title" id="modalFormularioLabel">
            <i class="mdi <?php echo $formulario['icono']; ?> me-2 font-size-24"></i><?php echo $formulario['titulo']; ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <script>
            $('#txt_rut').focus();
        </script>

        <p><?php echo $formulario['subtitulo']; ?></p>
        <div class="mb-3">
            <label for="username" class="form-label">RUT</label>
            <input type="text" class="form-control formato_rut" id="userrut" placeholder="Ingrese usuario" autocomplete="off">
        </div>
        <div class="mb-2 row">
            <label for="txt_rut" class="col-md-4 col-form-label">Nombre del Equipo :</label>
            <div class="col-md-8">
                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="Descripción" value="<?php echo $resultado['descripcion'] ;?>" tabindex="1">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_descripcion_equipo" class="col-md-4 col-form-label">Descripción :</label>
            <div class="col-md-8">
                <input type="text" name="txt_descripcion_equipo" id="txt_descripcion_equipo" class="form-control"  placeholder="Comentario relacionado al Equipo" value="<?php echo $resultado['descripcion_equipo'] ;?>" tabindex="2">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="val_area_id" class="form-label">Área Esterilización :</label>
            <span class="text-danger font-side-11">(* Requerido)</span>
            <select class="form-select" name="val_area_id" id="val_area_id" tabindex="3" placeholder=".col-xs-3" onchange="funcion(this);">
                <option></option>
                <?php
                for($i=0; $i < count($areas); $i++) {
                    $selected = ($areas[$i]['id'] == $resultado['area_id']) ? ' selected="selected"' : '';
                    echo '<option value="' . $areas[$i]['id'] . '"' . $selected . '>' . $areas[$i]['nombre'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-2 row">
            <label for="txt_descripcion_area" class="col-md-4 col-form-label">Nombre Área Esterilización :</label>
            <div class="col-md-8">
                <input type="text" name="txt_descripcion_area" id="txt_descripcion_area" class="form-control"  placeholder="Descripcion del Área de Esterilización" value="<?php echo $resultado['descripcion_area'] ;?>" tabindex="4">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="val_centro_costo" class="col-md-4 col-form-label">Centro Costo :</label>
            <div class="col-md-8">
                <input type="text" name="val_centro_costo" id="val_centro_costo" class="form-control"  placeholder="Centro Costos Contable" value="<?php echo $resultado['centro_costo'] ;?>" tabindex="5">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="hf_accion" id="hf_accion" value="<?php echo $formulario['accion']; ?>">
 
        <input type="hidden" name="hf_id_equipo" id="hf_id_equipo" value="<?php echo $resultado['id'] ;?>">
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
    // var inputAux = document.getElementById('inputAux');
    var inputAux = document.getElementById('txt_descripcion_area');
    $encargado=option.text;
    document.getElementById("txt_descripcion_area").value = option.text;
    /* alert("Valor Option: " + option.value + ", Texto Option: " + $encargado); 
    alert("Valor Input: " + inputAux.value); */
    alert("Valor Input: " + inputAux.value);
    }
</script>

