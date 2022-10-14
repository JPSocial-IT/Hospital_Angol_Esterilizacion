<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Carro Paro</th>
            <th class="align-middle">Insumo</th>
            <th class="align-middle">Cantidad Inicio</th>
            <th class="align-middle">Cantidad Fin</th>
            <th class="align-middle">Nota</th>
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
                        data-carro_paro="<?php echo $dato['carro_paro_id'] ?>" 
                        data-insumo_id="<?php echo $dato['insumo_id'] ?>"
                        data-numero_carro_paro="<?php echo $dato['numero_carro_paro'] ?>"
                        data-descripcion_insumo="<?php echo $dato['descripcion_insumo'] ?>"
                        data-cantidad_inicio="<?php echo $dato['cantidad_inicial'] ?>"
                        data-cantidad_fin="<?php echo $dato['cantidad_final'] ?>"
                        data-nota="<?php echo $dato['nota'] ?>">
                        <td><?php echo $dato['id'] ?></td>
                        <td><?php echo $dato['numero_carro_paro'] ?></td>
                        <td><?php echo $dato['descripcion_insumo'] ?></td>
                        <td><?php echo $dato['cantidad_inicial'] ?></td>
                        <td><?php echo $dato['cantidad_final'] ?></td>
                        <td><?php echo $dato['nota'] ?></td>
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