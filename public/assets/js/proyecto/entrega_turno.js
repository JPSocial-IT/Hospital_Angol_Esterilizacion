$(document).ready(function(){
    cargarTablaDatos();
    function cargarTablaDatos() {
        $.ajax({
            url: rutaProyecto + "/EntregaTurno/obtenerTablaDatos",
            type: "POST",
            data: {
            },
            beforeSend: function () {
                $("#contenedor_tabla").html("Obteniendo datos...");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
            },
            success: function (response) {
                $("#contenedor_tabla").html(response);
                initFunctiones();
                cargarFormatoDataTable("contenedor_tabla");
            },
            complete() {
            }
        });
    }

    function insertarDatos() {
        $(".btn_agregar").off("click");
        $(".btn_agregar").click(function(){
            $.ajax({
                url: rutaProyecto + "/EntregaTurno/insertarDatos",
                type: "POST",
                data: {
                    comentario: 'hola hola..'
                },
                beforeSend: function () {
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                },
                success: function (response) {
                   console.log(response);
                   cargarTablaDatos();
                },
                complete() {
                }
            });

        });
    }
    
    function actualizarDatosPorId() {
        $(".btn_editar").off("click");
        $(".btn_editar").click(function(){
            let id = $(this).parent().attr("data-id");

            $.ajax({
                url: rutaProyecto + "/EntregaTurno/actualizarDatosPorId",
                type: "POST",
                data: {
                    id: id,
                    comentario: 'Editado 1313...'
                },
                beforeSend: function () {
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                },
                success: function (response) {
                   console.log(response);
                   cargarTablaDatos();
                },
                complete() {
                }
            });

        });
    }

    function eliminarDatosPorId() {
        $(".btn_eliminar").off("click");
        $(".btn_eliminar").click(function(){
            let id = $(this).parent().attr("data-id");
            
            $.ajax({
                url: rutaProyecto + "/EntregaTurno/eliminarDatosPorId",
                type: "POST",
                data: {
                    id: id
                },
                beforeSend: function () {
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                },
                success: function (response) {
                   console.log(response);
                   cargarTablaDatos();
                },
                complete() {
                }
            });

        });
    }
    function initFunctiones(){
        insertarDatos();
        actualizarDatosPorId();
        eliminarDatosPorId();
    }
});