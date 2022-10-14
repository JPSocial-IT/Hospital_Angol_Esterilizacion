<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Descripción</th>
            <th class="align-middle">Hora Inicio</th>
            <th class="align-middle">Hora Fin</th>
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
                        data-descripcion="<?php echo $dato['descripcion'] ?>"
                        data-hora_inicio="<?php echo $dato['hora_inicio'] ?>"
                        data-hora_fin="<?php echo $dato['hora_fin'] ?>"
                        data-activo="<?php echo $dato['activo'] ?>">
                        <td><?php echo $dato['id'] ?></td>
                        <td><?php echo $dato['descripcion'] ?></td>
                        <td><?php echo $dato['hora_inicio'] ?></td>
                        <td><?php echo $dato['hora_fin'] ?></td>
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