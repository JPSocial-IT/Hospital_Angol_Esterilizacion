<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Rut</th>
            <th class="align-middle">Nombres</th>
            <th class="align-middle">Cargo</th>
            <th class="align-middle">Servicio</th>
            <th class="align-middle">Perfil</th>
            <th class="align-middle">Email</th>
           



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
                        data-rut="<?php echo $dato['rut'] ?>"
                        data-dv="<?php echo $dato['dv'] ?>"
                        data-nombres="<?php echo $dato['nombres'] ?>"
                        data-apellido_uno="<?php echo $dato['apellido_uno'] ?>"
                        data-apellido_dos="<?php echo $dato['apellido_dos'] ?>"
                        data-email="<?php echo $dato['email'] ?>"
                        data-cargo_id="<?php echo $dato['cargo_id'] ?>"
                        data-servicio_id="<?php echo $dato['servicio_id'] ?>"
                        data-perfil_id="<?php echo $dato['perfil_id'] ?>"
                        data-activo="<?php echo $dato['activo'] ?>">
                        <td><?php echo $dato['id'] ?></td>
                        <td><?php echo $dato['rut'] . '-' . $dato['dv']?></td>
                        <td><?php echo $dato['nombres'] . ' ' . $dato['apellido_uno'] . ' ' . $dato['apellido_dos']?></td>
                        <td><?php echo $dato['descripcion_cargo'] ?></td>
                        <td><?php echo $dato['descripcion_servicio'] ?></td>
                        <td><?php echo $dato['descripcion_perfil'] ?></td>
                        <td><?php echo $dato['email'] ?></td>
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