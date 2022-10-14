$(document).ready(function(){
    addKeyUpInputContarCaractere("modal_gestionar_servicio_descripcion", "modal_gestionar_servicio_descripcion_contador");
    cargarTablaDatos();
    function cargarTablaDatos() {
        $.ajax({
            url: rutaProyecto + "/ES_mantenedoresController/servicioObtenerTablaServicio",
            type: "POST",
            data: {
            },
            beforeSend: function () {
                $("#contenedor_tabla").html("Obteniendo datos...");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                Swal.fire(
                    {
                        title: errorThrown,
                        text: "Error obtener tabla servicios",
                        icon: "warning",
                        confirmButtonColor: '#556ee6',
                        confirmButtonText: 'Cerrar alerta'
                    }
                );
                $("#contenedor_tabla").html("No se obtuvieron datos: " + errorThrown);
            },
            success: function (response) {
                $("#contenedor_tabla").html(response);
                cargarEventClickEditar();
                cargarEventClickEliminar();
                cargarFormatoDataTable("contenedor_tabla");
            },
            complete() {
            }
        });
    }

    $("#btn_nuevo").click(function () {
        $("#modal_gestionar_servicio_titulo").text("Nuevo Servicio");

        $("#modal_gestionar_servicio_id").val(0);
        $("#modal_gestionar_servicio_codigo").val("");
        $("#modal_gestionar_servicio_descripcion").val("");
        $("#modal_gestionar_servicio_activo").prop("checked", true);
        contarCaracter("", "modal_gestionar_servicio_descripcion_contador");

        $("#modal_gestionar_servicio").modal("show");
    });

    $("#modal_gestionar_servicio_btn_guardar").click(function() {
        let id          = $("#modal_gestionar_servicio_id").val();
        let cod_deis    = $("#modal_gestionar_servicio_codigo").val();
        let descripcion = $("#modal_gestionar_servicio_descripcion").val();
        let activo_es   = $("#modal_gestionar_servicio_activo").is(":checked") ? true : false;

        if(id == 0){
            insertarDatos(cod_deis, descripcion, activo_es);
        } else {
            actualizarDatosPorId(id, cod_deis, descripcion, activo_es);
        }
        
        $("#modal_gestionar_servicio").modal("hide");
    });

    function cargarEventClickEditar(){
        $(".btn_editar").off("click");
        $(".btn_editar").click(function(){
            $("#modal_gestionar_servicio_titulo").text("Actualizar Servicio");

            let id          = $(this).parent().parent().attr("data-id");
            let cod_deis    = $(this).parent().parent().attr("data-cod_deis");
            let descripcion = $(this).parent().parent().attr("data-descripcion");
            let activo_es   = $(this).parent().parent().attr("data-activo_es");

            $("#modal_gestionar_servicio_id").val(id);
            $("#modal_gestionar_servicio_codigo").val(cod_deis);
            $("#modal_gestionar_servicio_descripcion").val(descripcion);
            if(activo_es == 'f'){
                $("#modal_gestionar_servicio_activo").prop("checked", false);
            } else {
                $("#modal_gestionar_servicio_activo").prop("checked", true);
            }
            contarCaracter(descripcion, "modal_gestionar_servicio_descripcion_contador");

            $("#modal_gestionar_servicio").modal("show");
        });
    }

    function cargarEventClickEliminar(){
        $(".btn_eliminar").off("click");
        $(".btn_eliminar").click(function(){
            let id          = $(this).parent().parent().attr("data-id");
            let descripcion = $(this).parent().parent().attr("data-descripcion");

            Swal.fire({
                title               : '¿Eliminar este servicio?',
                text                : descripcion,
                icon                : 'question',
                showCancelButton    : true,
                cancelButtonText    : 'No, Cancelar',
                confirmButtonText   : 'Si, Eliminar',
              }).then((result) => {
                if (result.isConfirmed) {
                    eliminarDatosPorId(id);
                } 
              });
        });
    }

    function insertarDatos(cod_deis, descripcion, activo_es) {
        $.ajax({
            url: rutaProyecto + "/ES_mantenedoresController/servicioInsertarDatos",
            type: "POST",
            data: {
                cod_deis    : cod_deis,
                descripcion : descripcion,
                activo_es   : activo_es
            },
            beforeSend: function () {
                modal_mensaje_cargando("Mostrar", "Agregando nuevo servicio");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                Swal.fire(
                    {
                        title: errorThrown,
                        text: "Error al agregar servicio",
                        icon: "warning",
                        confirmButtonColor: '#556ee6',
                        confirmButtonText: 'Cerrar alerta'
                    }
                );
            },
            success: function () {
                cargarTablaDatos();
            },
            complete() {
                setTimeout(function(){
                    modal_mensaje_cargando("Ocultar", "");
                }, 500);
            }
        });
    }

    function actualizarDatosPorId(id, cod_deis, descripcion, activo_es) {
        $.ajax({
            url: rutaProyecto + "/ES_mantenedoresController/servicioActualizarDatosPorId",
            type: "POST",
            data: {
                id          : id,
                cod_deis    : cod_deis,
                descripcion : descripcion,
                activo_es   : activo_es
            },
            beforeSend: function () {
                modal_mensaje_cargando("Mostrar", "Actualizando servicio");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire(
                    {
                        title: errorThrown,
                        text: "Error al actualizar servicio",
                        icon: "warning",
                        confirmButtonColor: '#556ee6',
                        confirmButtonText: 'Cerrar alerta'
                    }
                );
                modal_mensaje_cargando("Ocultar", "");
            },
            success: function (response) {
                cargarTablaDatos();
            },
            complete() {
                setTimeout(function(){
                    modal_mensaje_cargando("Ocultar", "");
                }, 500);
            }
        });
    }

    function eliminarDatosPorId(id) {
        $.ajax({
            url: rutaProyecto + "/ES_mantenedoresController/servicioEliminarDatosPorId",
            type: "POST",
            data: {
                id: id
            },
            beforeSend: function () {
                modal_mensaje_cargando("Mostrar", "Eliminando servicio");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                Swal.fire(
                    {
                        title: errorThrown,
                        text: "Error al eliminar servicio",
                        icon: "warning",
                        confirmButtonColor: '#556ee6',
                        confirmButtonText: 'Cerrar alerta'
                    }
                );
            },
            success: function (response) {
                console.log(response);
                cargarTablaDatos();
            },
            complete() {
                setTimeout(function(){
                    modal_mensaje_cargando("Ocultar", "");
                }, 500);
            }
        });
    }

});