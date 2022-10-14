<?php
    if($datos != null && count($datos) > 0)
    {?>
        <option value="0">Seleccione servicio</option>
<?php   foreach($datos as $dato)
        {?>
            <option value="<?php echo $dato['id'] ?>"><?php echo $dato['descripcion'] ?></option>
<?php   }
    } 
    else 
    {?>
        <option value="0">Sin información</option>
<?php 
    }
?>