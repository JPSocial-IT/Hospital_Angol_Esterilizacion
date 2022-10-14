<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Esterilización</li>
                <?php 
                    if($menu_usuario_logeado != null && count($menu_usuario_logeado) > 0)
                    {
                        foreach($menu_usuario_logeado as $opcion)
                        {                          
                            if($opcion->menu_id == 0){
                                
                                $href   = $opcion->controlador.$opcion->accion;
                                $class  = "";

                                //VALIDANDO SI ESA OPCION TIENE SUB OPCIONES
                                $found_key = array_search('0', array_column($menu_usuario_logeado, 'menu_id'));    
                                if($found_key != -1){
                                    $href = 'javascript: void(0);';
                                    $class  = "has-arrow";
                                }?>
                                <li>
                                    <a href="<?php echo $href ?>" class="<?php echo $class?> waves-effect" aria-expanded="false">
                                        <i class="<?php echo $opcion->icono ?>"></i>
                                        <span><?php echo $opcion->nombre_opcion ?></span>
                                    </a>
                        <?php   if($found_key != -1){?>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <?php foreach($menu_usuario_logeado as $opcion_sub_menu)
                                        {
                                            if($opcion_sub_menu->menu_id == $opcion->id){?>
                                                <li>
                                                    <a href="<?php echo $opcion_sub_menu->controlador.$opcion_sub_menu->accion ?>">
                                                        <?php echo $opcion_sub_menu->nombre_opcion ?>
                                                    </a>
                                                </li>
                                    <?php   } 
                                        }?>
                                    </ul>
                        <?php   } ?>
                                </li>
                    <?php   }
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->