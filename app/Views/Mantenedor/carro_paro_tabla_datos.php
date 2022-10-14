<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Servicio</th>
            <th class="align-middle">Número</th>
            <th class="align-middle">Modelo</th>
            <th class="align-middle">Observación</th>
            <th class="align-middle">Activo</th>
            <th class="align-middle all" style="max-width: 4em !important;">Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($datos != null && count($datos) > 0)
            {
                foreach($datos as $dato)
                {?>
                    <tr data-id="<?php echo $dato['id'] ?>"
                        data-servicio_id="<?php echo $dato['servicio_id'] ?>" 
                        data-numero="<?php echo $dato['numero'] ?>"
                        data-modelo="<?php echo $dato['modelo'] ?>"
                        data-observacion="<?php echo $dato['observacion'] ?>"
                        data-activo="<?php echo $dato['activo'] ?>">
                        <td><?php echo $dato['id'] ?></td>
                        <td><?php echo $dato['descripcionservicio'] ?></td>
                        <td><?php echo $dato['numero'] ?></td>
                        <td><?php echo $dato['modelo'] ?></td>
                        <td style='overflow-wrap: break-word;'><?php echo $dato['observacion'] ?></td>
                        <td><?php echo ($dato['activo'] == 't' ? 'Sí' : 'No') ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn_editar waves-effect waves-light btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn_eliminar waves-effect waves-light btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
        <?php   }
            }
        ?>
    </tbody>
</table>