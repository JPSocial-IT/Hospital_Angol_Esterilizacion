<form name="FormServicio" id="FormServicio" role="form" enctype="multipart/form-data">
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
            <label for="val_cod_deis" class="col-md-4 col-form-label">Código DEIS :</label>
            <div class="col-md-8">
                <input type="number" name="val_cod_deis" id="val_cod_deis" class="form-control" placeholder="Código DEIS" value="<?php echo $resultado['cod_deis'] ;?>" tabindex="1">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="txt_descripcion" class="col-md-4 col-form-label">Descripción :</label>
            <div class="col-md-8">
                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control"  placeholder="Descripción del Servicio" value="<?php echo $resultado['descripcion'] ;?>" tabindex="2">
            </div>
        </div>
        <div class="mb-2 row">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="chk_activo_es" id="chk_activo_es" value="<?php echo $resultado['activo_es'] ;?>" <?php if ($resultado['activo_es'] == 't') echo "checked";?>>
                <label class="form-check-label" for="formCheck">
                    Activo para Esterilización
                </label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="hf_accion" id="hf_accion" value="<?php echo $formulario['accion']; ?>">
 
        <input type="hidden" name="hf_id_servicio" id="hf_id_servicio" value="<?php echo $resultado['id'] ;?>">
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
    document.getElementById("txt_nombre_encargado_servicio").value = option.text;
    /* alert("Valor Option: " + option.value + ", Texto Option: " + $encargado); */
    alert("Valor Input: " + inputAux.value);}
</script>

