
$(document).ready(function(){
    $('#btn_modalFormulario .btn_agregar').click(agregarRegistro);
    cargarTablaRegistros();
});


/* FUNCIONES... */
function cargarTablaRegistros(){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/estadosObtenerTablaRegistros',
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
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/estadosAgregarRegistro');
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}


function editarEstado(id){
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/estadosEditarRegistro/' + id);
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}


function eliminarEstado(id){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/estadosEliminarRegistroConfirmar/' + id,
        type: 'GET',
        data: {},
        success: function(data){
        var json = eval('(' + data + ')');
            if(json.status == 'SUCCESS'){
                var contenidoHtml = '<p>Usted está a punto de eliminar al siguiente Estado de Solicitud :</p>';
                contenidoHtml += '<p><strong>' + json.nombre_estado + '</strong></p>';
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
                            url: rutaProyecto + '/ES_mantenedoresController/estadosEliminarRegistro',
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
                                        'Se ha eliminado correctamente el Estado<br><strong>' + json.nombre_estado + '</strong>', 
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


$(document).on('click', '#FormEstados #btn_guardar', function(){
    var formModal           = 'form#FormEstados';    
    var accion              = $(formModal + ' #hf_accion');
    var descripcion         = $(formModal + ' #txt_descripcion');
    var descripcion_estado  = $(formModal + ' #txt_descripcion_estado');
    var url_guardar;

    if(parseInt(accion.val()) == 1){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/estadosAgregarRegistroGuardar';
    }
    if(parseInt(accion.val()) == 2){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/estadosEditarRegistroGuardar';
    }

   if($.trim(descripcion.val()) == ''){
        alert('Por favor ingrese el Estado de Solicitud');
        descripcion.focus();
        return false;
    }
    if($.trim(descripcion_estado.val()) == ''){
        alert('Por favor ingrese la descripción del Estado de Solicitud');
        descripcion_estado.focus();
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
                    Swal_titulo = 'Nuevo Estado de Solicitud';
                    Swal_textoMensaje = 'Se ha agregado correctamente el siguiente Estado:';
                }
                if(parseInt(accion.val()) == 2){
                    Swal_titulo = 'Actualización Estado de Solicitud';
                    Swal_textoMensaje = 'Se ha editado correctamente el Estado seleccionado:';
                }
                Swal_textoMensaje += '<br><strong>' + json.nombre_estado + '</strong>';
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
