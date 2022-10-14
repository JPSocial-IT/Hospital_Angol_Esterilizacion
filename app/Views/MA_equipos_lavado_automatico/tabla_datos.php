<?php
if($registros != null && count($registros) > 0){
?>
<!-- <div class="container"> -->
<table class="table table-success table-striped table align-middle table-nowrap mb-0 dt-responsive">
    <!-- <thead> -->
    <thead class="thead-dark">
        <tr>
            <th class="align-middle">ID</th>
            <th class="align-middle">ID Area Esterilizado</th>
            <th class="align-middle">Equipo</th>
            <th class="align-middle">Descripción</th>
            <th class="align-middle">C.C.Contable</th>
            <th class="align-middle all">Acción</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($registros as $row){
    ?>
        <tr>
            <td><?php echo '#' . $row['id'];?></td>
            <td><?php echo $row['area_id'];?></td>
            <td><?php echo $row['descripcion'];?></td>
            <td><?php echo $row['descripcion_equipo'];?></td>
            <td><?php echo $row['centro_costo'];?></td>
            <td data-id="<?php echo $row['id'];?>" id="td_acciones_<?php echo $row['id'];?>">
                <button type="button" class="btn btn-primary btn_editar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Editar registro #<?php echo $row['id'];?>" onclick="editarEquipo(<?php echo $row['id'];?>);">
                    <i class="mdi mdi-pencil me-1"></i>
                </button>
                <button type="button" class="btn btn-danger btn_eliminar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Eliminar registro #<?php echo $row['id'];?>" onclick="eliminarEquipo(<?php echo $row['id'];?>);">
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
            <i class="mdi mdi-alert-outline me-2"></i> Actualmente no existen Servicios registrados
        </div>';
}
?>
