<?php
    if($datosinsumos != null && count($datosinsumos) > 0)
    {?>
        <option value="0">Seleccione insumo</option>
<?php   foreach($datosinsumos as $dato)
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