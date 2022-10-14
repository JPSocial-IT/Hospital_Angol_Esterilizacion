
$(document).ready(function(){
    $('#btn_modalFormulario .btn_agregar').click(agregarRegistro);
    cargarTablaRegistros();
});


/* FUNCIONES... */
function cargarTablaRegistros(){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/bodegasObtenerTablaRegistros',
        type: 'POST',
        data: {},
        beforeSend: function () {
            $('#btn_modalFormulario .btn_agregar').css('display', 'none');
            preloader = '<div class="alert alert-info" role="alert">';
            preloader += '<i class="mdi mdi-magnify me-2"></i>Obteniendo datos...</div>';
            $('#contenedor_tabla').html(preloader);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        },
        success: function (response) {
            $('#btn_modalFormulario .btn_agregar').css('display', 'block');
            $('#contenedor_tabla').html(response);
            cargarFormatoDataTable('contenedor_tabla');
        },
        complete(){
        }
    });
}


function agregarRegistro(){
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/bodegasAgregarRegistro');
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}


function editarBodega(id){
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/bodegasEditarRegistro/' + id);
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}


function eliminarBodega(id){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/bodegasEliminarRegistroConfirmar/' + id,
        type: 'GET',
        data: {},
        success: function(data){
        var json = eval('(' + data + ')');
            if(json.status == 'SUCCESS'){
                var contenidoHtml = '<p>Usted está a punto de eliminar al siguiente Estado de Solicitud :</p>';
                contenidoHtml += '<p><strong>' + json.bodega + '</strong></p>';
                contenidoHtml += '<p>Esta acción no puede deshacerse<br>¿Desea continuar...?</p>';
                Swal.fire({
                    title : '',
                    icon : 'warning',
                    html : contenidoHtml,
                    showCloseButton : false,
                    showCancelButton : true,
                    confirmButtonColor : '#f46a6a',
                    cancelButtonColor : '#636678',
                    confirmButtonText : '<i class="mdi mdi-content-save me-1"></i> Eliminar',
                    cancelButtonText : '<i class="mdi mdi-close-thick me-1"></i> Cancelar',
                    reverseButtons : true
                }).then((result) => {
                    if(result.isConfirmed){
                        var parametros = new FormData();
                        parametros.append('id', id);
                        $.ajax({
                            url: rutaProyecto + '/ES_mantenedoresController/bodegasEliminarRegistro',
                            type: 'POST',
                            data: parametros,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function (){},
                            error: function (jqXHR, textStatus, errorThrown){
                                console.log(jqXHR);
                            },
                            success: function (data){
                                var json = eval('(' + data + ')');
                                if(json.status == 'SUCCESS'){
                                    Swal_Alert(
                                        'Eliminado!',
                                        'Se ha eliminado correctamente la Bodega<br><strong>' + json.bodega + '</strong>', 
                                        'success',
                                        'Finalizar'
                                    );
                                    cargarTablaRegistros();
                                }
                                if(json.status == 'ERROR'){
                                    Swal_Alert('ERROR!', json.error, 'error');
                                }
                            },
                            complete(){
                            }
                        });
                    }
                });
            }
        }
    });
}


function Swal_Alert(titulo, textoHtml, icono, textoBtn = 'Aceptar'){
    Swal.fire({title: titulo, html: textoHtml, icon: icono, confirmButtonText: textoBtn});
}


function reinicializarTooltips(){
    $('[data-bs-toggle="tooltip"]').tooltip();
}


$(document).on('click', '#FormBodegas #btn_guardar', function(){
    var formModal       = 'form#FormBodegas';    
    var accion          = $(formModal + ' #hf_accion');
    var descripcion     = $(formModal + ' #txt_descripcion');
    var comentario      = $(formModal + ' #txt_comentario');
    var encargado_id    = $(formModal + ' #val_encargado_id');
    var encargado_nombre= $(formModal + ' #txt_encargado_nombre');
    var activo          = $(formModal + ' #bol_activo');
    var url_guardar;

    if(parseInt(accion.val()) == 1){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/bodegasAgregarRegistroGuardar';
    }
    if(parseInt(accion.val()) == 2){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/bodegasEditarRegistroGuardar';
    }

    if($.trim(descripcion.val()) == ''){
            alert('Por favor ingrese descripción de la Bodega.');
            descripcion.focus();
            return false;
        }
    if($.trim(comentario.val()) == ''){
        alert('Por favor ingrese un comentario relacionado con la Bodega.');
        comentario.focus();
        return false;
    }
    if($.trim(encargado_id.val()) == 0){
        alert('Por favor debe seleccionar un encargado de la Bodega.');
        encargado_id.focus();
        return false;
    }

    var parametros = new FormData($(formModal)[0]);

    $.ajax({
        url: url_guardar,
        type: 'POST',
        data: parametros,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $(formModal + ' #btn_guardar').attr('disabled', 'disabled');
            $(formModal + ' #btn_guardar').css({'cursor': 'default', 'background-color': '#2ca67a', 'border-color': '#2a9c72'});
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
        },
        success: function (data){
            var json = eval('(' + data + ')');
            if(json.status == 'SUCCESS'){
                var Swal_titulo, Swal_textoMensaje;
                if(parseInt(accion.val()) == 1){
                    Swal_titulo = 'Nueva Bodega Esterilización';
                    Swal_textoMensaje = 'Se ha agregado correctamente la siguiente Bodega:';
                }
                if(parseInt(accion.val()) == 2){
                    Swal_titulo = 'Actualización Bodega Esterilización';
                    Swal_textoMensaje = 'Se ha actualizado correctamente la Bodega seleccionada:';
                }
                Swal_textoMensaje += '<br><strong>' + json.bodega + '</strong>';
                Swal_Alert(Swal_titulo, Swal_textoMensaje, 'success', 'Finalizar');
                $('#modalFormulario').modal('toggle');
            }
            if(json.status == 'ERROR'){
                Swal_Alert('ERROR!', json.error, 'error');
            }
            cargarTablaRegistros();
        },
        complete(){
        }
    });

});
