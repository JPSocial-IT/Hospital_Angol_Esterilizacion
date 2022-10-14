<?php
    if($datoscarroparo != null && count($datoscarroparo) > 0)
    {?>
        <option value="0">Seleccione insumo</option>
<?php   foreach($datoscarroparo as $dato)
        {?>
            <option value="<?php echo $dato['id'] ?>"><?php echo $dato['numero'] ?></option>
<?php   }
    } 
    else 
    {?>
        <option value="0">Sin información</option>
<?php 
    }
?>