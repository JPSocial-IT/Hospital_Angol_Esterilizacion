
$(document).ready(function(){
    $('#btn_modalFormulario .btn_agregar').click(agregarRegistro);
    cargarTablaRegistros();
});

/* FUNCIONES... */
function cargarTablaRegistros(){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/equiposObtenerTablaRegistros',
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
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/equiposAgregarRegistro');
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}

function editarEquipo(id){
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/equiposEditarRegistro/' + id);
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}

function eliminarEquipo(id){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/equiposEliminarRegistroConfirmar/' + id,
        type: 'GET',
        data: {},
        success: function(data){
        var json = eval('(' + data + ')');
            if(json.status == 'SUCCESS'){
                var contenidoHtml = '<p>Usted está a punto de eliminar al siguiente Equipo :</p>';
                contenidoHtml += '<p><strong>' + json.equipo + '</strong></p>';
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
                            url: rutaProyecto + '/ES_mantenedoresController/equiposEliminarRegistro',
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
                                        'Se ha eliminado correctamente el Equipo<br><strong>' + json.equipo + '</strong>', 
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

$(document).on('click', '#FormEquipo #btn_guardar', function(){
    var formModal           = 'form#FormEquipo';    
    var accion              = $(formModal + ' #hf_accion');
    var descripcion         = $(formModal + ' #txt_descripcion');
    var descripcion_equipo  = $(formModal + ' #txt_descripcion_equipo');
    var area_id             = $(formModal + ' #val_area_id');
    var descripcion_area    = $(formModal + ' #txt_descripcion_area');
    var tipo_id             = $(formModal + ' #val_tipo_id');
    var tipo_descripcion    = $(formModal + ' #txt_tipo_descripcion');
    var centro_costo        = $(formModal + ' #val_centro_costo');
    var url_guardar;

    if(parseInt(accion.val()) == 1){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/equiposAgregarRegistroGuardar';
    }
    if(parseInt(accion.val()) == 2){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/equiposEditarRegistroGuardar';
    }

    if($.trim(descripcion.val()) == ''){
            alert('Por favor ingrese descripción del Equipo.');
            descripcion.focus();
            return false;
        }
    if($.trim(descripcion_equipo.val()) == ''){
        alert('Por favor ingrese un comentario relacionado con el Equipo.');
        comentario_equipo.focus();
        return false;
    }
    if($.trim(centro_costo.val()) == 0){
        alert('Por favor debe seleccionar un Centro de Costo Contable para el Equipo.');
        centro_costo.focus();
        return false;
    }
    if($.trim(area_id.val()) == 0){
        alert('Por favor debe seleccionar un Área del Servicio.');
        area_id.focus();
        return false;
    }
    if($.trim(tipo_id.val()) == 0){
        alert('Por favor debe seleccionar un Tipo de Equipo.');
        tipo_id.focus();
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
                    Swal_titulo = 'Nuevo Equipo del Servicio';
                    Swal_textoMensaje = 'Se ha agregado correctamente el siguiente Equipo :';
                }
                if(parseInt(accion.val()) == 2){
                    Swal_titulo = 'Actualización Equipo del Servicio';
                    Swal_textoMensaje = 'Se ha actualizado correctamente el Equipo :';
                }
                Swal_textoMensaje += '<br><strong>' + json.equipo + '</strong>';
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
