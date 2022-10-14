<?php
    if($datosinstrumental != null && count($datosinstrumental) > 0)
    {?>
        <option value="0">Seleccione servicio</option>
<?php   foreach($datosinstrumental as $dato)
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