<?php
if($registros != null && count($registros) > 0){
?>
<!-- <div class="container"> -->
<table class="table table-success table-striped table align-middle table-nowrap mb-0 dt-responsive">
    <thead>
        <tr>
            <th class="align-middle">ID</th>
            <th class="align-middle">Descripción</th>
            <th class="align-middle">Descripción del Estado</th>
            <th class="align-middle all">Acción</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($registros as $row){
    ?>
        <tr>
            <td><?php echo '#' . $row['id'];?></td>
            <td><?php echo $row['descripcion'];?></td>
            <td><?php echo $row['descripcion_estado'];?></td>
            <td data-id="<?php echo $row['id'];?>" id="td_acciones_<?php echo $row['id'];?>">
                <button type="button" class="btn btn-primary btn_editar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Editar Estado #<?php echo $row['id'];?>" onclick="editarEstado(<?php echo $row['id'];?>);">
                    <i class="mdi mdi-pencil me-1"></i>
                </button>
                <button type="button" class="btn btn-danger btn_eliminar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Eliminar Estado #<?php echo $row['id'];?>" onclick="eliminarEstado(<?php echo $row['id'];?>);">
                    <i class="mdi mdi-delete me-1"></i>
                </button>
            </td>
        </tr>
    <?php
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
            <i class="mdi mdi-alert-outline me-2"></i> Actualmente no existen usuarios registrados
        </div>';
}
?>
