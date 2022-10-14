
<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Permiso</th>
            <th class="align-middle all" style="max-width: 4em !important;">Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($datos != null && count($datos) > 0)
            {
                foreach($datos as $dato)
                {?>
                    <tr>
                        <td><?php echo $dato['permiso_id'] ?></td>
                        <td><?php echo $dato['permiso_descripcion'] ?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input check_permiso" 
                                data-permiso-id="<?php echo $dato['permiso_id'] ?>" 
                                data-permiso-descripcion="<?php echo $dato['permiso_descripcion'] ?>" 
                                data-perfil-permiso-id="<?php echo $dato['id'] ?>" 
                                type="checkbox" <?php echo ($dato['id'] == 0 ? "" : 'checked="checked"') ?>>
                            </div>
                        </td>
                    </tr>
        <?php   }
            }
        ?>
    </tbody>
</table>