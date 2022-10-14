
$(document).ready(function(){
    $('#btn_modalFormulario .btn_agregar').click(agregarRegistro);
    cargarTablaRegistros();
});

/* FUNCIONES... */
function cargarTablaRegistros(){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/serviciosObtenerTablaRegistros',
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
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/serviciosAgregarRegistro');
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}

function editarServicio(id){
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/serviciosEditarRegistro/' + id);
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}

function eliminarServicio(id){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/serviciosEliminarRegistroConfirmar/' + id,
        type: 'GET',
        data: {},
        success: function(data){
        var json = eval('(' + data + ')');
            if(json.status == 'SUCCESS'){
                var contenidoHtml = '<p>Usted está a punto de eliminar al siguiente Servicio :</p>';
                contenidoHtml += '<p><strong>' + json.servicio + '</strong></p>';
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
                            url: rutaProyecto + '/ES_mantenedoresController/serviciosEliminarRegistro',
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
                                        'Se ha eliminado correctamente el Servicio<br><strong>' + json.servicio + '</strong>', 
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

$(document).on('click', '#FormServicio #btn_guardar', function(){
    var formModal   = 'form#FormServicio';    
    var accion      = $(formModal + ' #hf_accion');
    var cod_deis    = $(formModal + ' #val_cod_dais');
    var descripcion = $(formModal + ' #txt_descripcion');
    var activo_es   = $(formModal + ' #chk_activo_es');
    var url_guardar;

    if(parseInt(accion.val()) == 1){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/serviciosAgregarRegistroGuardar';
    }
    if(parseInt(accion.val()) == 2){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/serviciosEditarRegistroGuardar';
    }

    if($.trim(descripcion.val()) == ''){
            alert('Por favor ingrese definición del Servicio.');
            descripcion.focus();
            return false;
    }
    /*if($.trim(cod_deis.val()) == 0){
        alert('Por favor ingrese un código DEIS del Servicio.');
        cod_deis.focus();
        return false;
    }
     if($.trim(encargado_servicio_id.val()) == 0){
        alert('Por favor debe seleccionar un encargado del Servicio.');
        encargado_servicio_id.focus();
        return false;
    } */

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
                    Swal_titulo = 'Nuevo Servicio';
                    Swal_textoMensaje = 'Se ha agregado correctamente el siguiente Servicio:';
                }
                if(parseInt(accion.val()) == 2){
                    Swal_titulo = 'Actualización del Servicio';
                    Swal_textoMensaje = 'Se ha actualizado correctamente el Servicio seleccionado:';
                }
                Swal_textoMensaje += '<br><strong>' + json.servicio + '</strong>';
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
