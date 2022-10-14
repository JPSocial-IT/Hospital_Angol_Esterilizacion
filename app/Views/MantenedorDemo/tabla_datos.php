<?php
if($registros != null && count($registros) > 0){
?>
<table class="table align-middle table-nowrap mb-0 table-striped dt-responsive">
    <thead class="table-light">
        <tr>
            <th class="align-middle">ID</th>
            <th class="align-middle">RUT</th>
            <th class="align-middle">Ap. Paterno</th>
            <th class="align-middle">Ap. Materno</th>
            <th class="align-middle">Nombre</th>
            <th class="align-middle">Correo electrónico</th>
            <th class="align-middle">Fecha Registro</th>
            <th class="align-middle all">Acción</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($registros as $row){
    ?>
        <tr>
            <td><?php echo '#' . $row['IdUsuario'];?></td>
            <td><?php echo $row['Rut'];?></td>
            <td><?php echo $row['ApellidoPaterno'];?></td>
            <td><?php echo $row['ApellidoMaterno'];?></td>
            <td><?php echo $row['Nombre'];?></td>
            <td><?php echo $row['Email'];?></td>
            <td><?php echo $row['FechaRegistro'];?></td>
            <td data-id="<?php echo $row['IdUsuario'];?>" id="td_acciones_<?php echo $row['IdUsuario'];?>">
                <button type="button" class="btn btn-primary btn_editar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Editar registro #<?php echo $row['IdUsuario'];?>" onclick="editarUsuario(<?php echo $row['IdUsuario'];?>);">
                    <i class="mdi mdi-pencil me-1"></i>
                </button>
                <button type="button" class="btn btn-danger btn_eliminar btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Eliminar registro #<?php echo $row['IdUsuario'];?>" onclick="eliminarUsuario(<?php echo $row['IdUsuario'];?>);">
                    <i class="mdi mdi-delete me-1"></i>
                </button>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
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
