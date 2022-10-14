$(document).ready(function(){
    var txt_user_id = $("#txt_user_id").val();

    function ObtenerDatosUsuarioLogeado() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: rutaProyecto + "/IniPageController/ObtenerDatosUsuarioLogeado",
                type: "POST",
                data: {
                    txt_user_id : txt_user_id
                },
                beforeSend: function () {
                    $("#lbl_mensaje").text("Obteniendo informacion usuario...");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    reject(jqXHR + "..." + textStatus + "..." + errorThrown);
                },
                success: function (response) {
                    resolve(JSON.parse(response));
                },
                complete: function () {
                }
            });
        });
    }
    
    function ObtenerOpcionMenu() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: rutaProyecto + "/IniPageController/ObtenerOpcionMenu",
                type: "POST",
                data: {
                    txt_user_id : txt_user_id
                },
                beforeSend: function () {
                    $("#lbl_mensaje").text("Obteniendo opcion sistema...");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    reject(jqXHR + "..." + textStatus + "..." + errorThrown);
                },
                success: function (response) {
                    resolve(JSON.parse(response));
                },
                complete: function () {
                }
            });
        });
    }

    /*
    function ObtenerPermisoPorPerfil() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: rutaProyecto + "/IniPageController/ObtenerPermisoPorPerfil",
                type: "POST",
                data: {
                    txt_user_id : txt_user_id
                },
                beforeSend: function () {
                    $("#lbl_mensaje").text("Obteniendo permisos perfil...");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    reject(jqXHR + "..." + textStatus + "..." + errorThrown);
                },
                success: function (response) {
                    resolve(JSON.parse(response));
                },
                complete: function () {
                }
            });
        });
    }*/

    function initComponent(){
        if(txt_user_id == ""){
            $("#lbl_mensaje").text("CREDENCIALES NO INGRESADAS. REDIRECCIONANDO LOGIN...");
            // let url = $("#url_acceso_sistema").val();
            // $("#formulario_redireccionar_principal").attr("action", url);
            // $("#formulario_redireccionar_principal").submit();
            window.location.href = $("#url_acceso_sistema").val();
        } else {
            ObtenerDatosUsuarioLogeado()
                .then(data => {
                    console.log("------------------ ObtenerDatosUsuarioLogeado");
                    console.log(data);
                    if (data.estado) {
                        ObtenerOpcionMenu()
                            .then(data => {
                                console.log("------------------ ObtenerDatosUsuarioLogeado");
                                console.log(data);
                                if (data.estado) {
                                    $("#lbl_mensaje").text("REDIRECCIONANDO PANTALLA INICIAL...");
                                    window.location.href = $("#url_principal").val();
                                    // $("#formulario_redireccionar_principal").submit();
                                } else {
                                    Swal.fire(
                                        {
                                            title: data.validacion,
                                            text: data.mensaje,
                                            icon: data.icono,
                                            confirmButtonColor: '#556ee6',
                                            confirmButtonText: 'Cerrar alerta'
                                        }
                                    );
                                }
                            })
                            .catch(error => {
                                Swal.fire(
                                    {
                                        title: error,
                                        text: "",
                                        icon: 'warning',
                                        confirmButtonColor: '#556ee6',
                                        confirmButtonText: 'Cerrar alerta'
                                    }
                                );
                            });
                        //$("#formulario_enviar_datos").submit();
                    } else {
                        Swal.fire(
                            {
                                title: data.validacion,
                                text: data.mensaje,
                                icon: data.icono,
                                confirmButtonColor: '#556ee6',
                                confirmButtonText: 'Cerrar alerta'
                            }
                        );
                    }
                })
                .catch(error => {
                    Swal.fire(
                        {
                            title: error,
                            text: "",
                            icon: 'warning',
                            confirmButtonColor: '#556ee6',
                            confirmButtonText: 'Cerrar alerta'
                        }
                    );
                });
        }
    }

    
    initComponent();
});