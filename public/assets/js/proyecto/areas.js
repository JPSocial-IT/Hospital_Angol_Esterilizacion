
$(document).ready(function(){
    $('#btn_modalFormulario .btn_agregar').click(agregarRegistro); // va al model
    cargarTablaRegistros();
});

/* FUNCIONES... */
function cargarTablaRegistros(){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/areasObtenerTablaRegistros',
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
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/areasAgregarRegistro');
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}


function editarArea(id){
    $('#modalFormulario .modal-content').load(rutaProyecto + '/ES_mantenedoresController/areasEditarRegistro/' + id);
    var modalForm = new bootstrap.Modal(document.getElementById('modalFormulario'));
    modalForm.show();
}


function eliminarArea(id){
    $.ajax({
        url: rutaProyecto + '/ES_mantenedoresController/areasEliminarRegistroConfirmar/' + id,
        type: 'GET',
        data: {},
        success: function(data){
        var json = eval('(' + data + ')');
            if(json.status == 'SUCCESS'){
                var contenidoHtml = '<p>Usted está a punto de eliminar la siguiente Área del Servicio :</p>';
                contenidoHtml += '<p><strong>' + json.area + '</strong></p>';
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
                            url: rutaProyecto + '/ES_mantenedoresController/areasEliminarRegistro',
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
                                        'Se ha eliminado correctamente el Área del Servicio<br><strong>' + json.area + '</strong>', 
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

$(document).on('click', '#FormAreas #btn_guardar', function(){
    var formModal           = 'form#FormAreas';    
    var accion              = $(formModal + ' #hf_accion');
    var nombre              = $(formModal + ' #txt_nombre');
    var descripcion         = $(formModal + ' #txt_descripcion');
    var id_encargado        = $(formModal + ' #val_id_encargado');
    var nombre_encargado    = $(formModal + ' #txt_nombre_encargado');
    var url_guardar;

    if(parseInt(accion.val()) == 1){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/areasAgregarRegistroGuardar';
    }
    if(parseInt(accion.val()) == 2){
        url_guardar = rutaProyecto + '/ES_mantenedoresController/areasEditarRegistroGuardar';
    }
    if($.trim(nombre.val()) == ''){
            alert('Por favor ingrese definición de Área del Servicio.');
            nombre.focus();
            return false;
        }
    if($.trim(descripcion.val()) == ''){
        alert('Por favor ingrese un comentario o descripción de Área del Servicio.');
        descripcion.focus();
        return false;
    }
    if($.trim(id_encargado.val()) == 0){
        alert('Por favor debe seleccionar un encargado de Área de Servicio.');
        id_encargado.focus();
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
                    Swal_titulo = 'Nueva Área del Servicio';
                    Swal_textoMensaje = 'Se ha agregado correctamente la siguiente Área del Servicio:';
                }
                if(parseInt(accion.val()) == 2){
                    Swal_titulo = 'Actualización Área del Servicio';
                    Swal_textoMensaje = 'Se ha actualizado correctamente el Área del Servicio seleccionado:';
                }
                Swal_textoMensaje += '<br><strong>' + json.area + '</strong>';
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
