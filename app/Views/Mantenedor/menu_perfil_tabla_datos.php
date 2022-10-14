
<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Menú</th>
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
                        <td><?php echo $dato['menu_id'] ?></td>
                        <td><?php echo $dato['menu_descripcion'] ?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input check_perfil" 
                                data-id="<?php echo $dato['id'] ?>" 
                                data-perfil_id="<?php echo $dato['perfil_id'] ?>" 
                                data-descripcion="<?php echo $dato['menu_descripcion'] ?>" 
                                data-menu_id="<?php echo $dato['menu_id'] ?>" 
                                data-orden="<?php echo $dato['orden'] ?>" 
                                type="checkbox" <?php echo ($dato['marca'] == 0 ? "" : 'checked="checked"') ?>>
                            </div>
                        </td>
                    </tr>
        <?php   }
            }
        ?>
    </tbody>
</table>