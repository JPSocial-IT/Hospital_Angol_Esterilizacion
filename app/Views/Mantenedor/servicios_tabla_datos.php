<?php
if($registros != null && count($registros) > 0){
?>
<!-- <div class="container"> -->
<table class="table table-success table-striped table align-middle table-nowrap mb-0 dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Código DEIS</th>
            <th class="align-middle">Descripción</th>
            <th class="align-middle">Activo</th>
            <th class="align-middle all" style="max-width: 4em !important;">Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($registros != null && count($registros) > 0)
            {
                foreach($registros as $dato)
                {?>
                    <tr data-id="<?php echo $dato['id'] ?>"
                        data-cod_deis="<?php echo $dato['cod_deis'] ?>"
                        data-descripcion="<?php echo $dato['descripcion'] ?>"
                        data-activo_es="<?php echo $dato['activo_es'] ?>">
                        <td><?php echo $dato['id'] ?></td>
                        <td><?php echo $dato['cod_deis'] ?></td>
                        <td><?php echo $dato['descripcion'] ?></td>
                        <td><?php echo ($dato['activo_es'] == 't' ? 'Sí' : 'No') ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn_editar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Editar Servicio #<?php echo $dato['id'];?>" onclick="editarServicio(<?php echo $dato['id'];?>);">
                                <i class="mdi mdi-pencil me-1"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn_eliminar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Eliminar Servicio #<?php echo $dato['id'];?>" onclick="eliminarServicio(<?php echo $dato['id'];?>);">
                                <i class="mdi mdi-delete me-1"></i>
                            </button>
                        </td>
                    </tr>
        <?php   }
            }
        ?>
    </tbody>
</table>
<!-- </container> -->
<script type="text/javascript">
    reinicializarTooltips();
</script>
<?php
}

else{
    echo '<div class="alert alert-warning" role="alert">
            <i class="mdi mdi-alert-outline me-2"></i> Actualmente no existen Servicios registrados
        </div>';
}
?>