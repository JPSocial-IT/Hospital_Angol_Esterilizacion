
<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Fecha Registro</th>
            <th class="align-middle">Comentario</th>
            <th class="align-middle all">Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($datos != null && count($datos) > 0)
            {
                foreach($datos as $dato)
                {?>
                    <tr>
                        <td><?php echo $dato['id'] ?></td>
                        <td><?php echo $dato['fecha_registro'] ?></td>
                        <td><?php echo $dato['comentario'] ?></td>
                        <td data-id="<?php echo $dato['id'] ?>">
                            <button type="button" class="btn btn-primary btn_agregar waves-effect waves-light btn-sm">
                                agregar
                            </button>
                            <button type="button" class="btn btn-primary btn_editar waves-effect waves-light btn-sm">
                                editar
                            </button>
                            <button type="button" class="btn btn-primary btn_eliminar waves-effect waves-light btn-sm">
                                eliminar
                            </button>
                        </td>
                    </tr>
        <?php   }
            }
        ?>
    </tbody>
</table>