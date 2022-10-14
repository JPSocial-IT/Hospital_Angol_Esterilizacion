
var rutaProyecto = $("#txtRutaProyecto").val();

var versionJsonEntrante = $("#txtVersionJsonEntrada").val();
var versionJsonSaliente = $("#txtVersionJsonSalida").val();

var form                        = $('#ajaxAntiForgeryForm');
var requestVerificationToken    = $('input[name="__RequestVerificationToken"]', form).val();

//$.ajaxPrefilter(function (options, originalOptions) {
//    if (options.type.toUpperCase() == "POST") {
//        options.data = $.param($.extend(originalOptions.data, { __RequestVerificationToken: requestVerificationToken }));
//    }
//});

function removerBackdrop() {
    if ($(".modal-backdrop").length > 0) {
        $(".modal-backdrop").remove();
    }
}

var alert_version_opcion = null;

var cant_mostrar_registro_tabla = 10;

obtenerCantRegistrosMostrar();
function obtenerCantRegistrosMostrar() {
    let cantidad = window.localStorage.getItem("cant_regis_mostrar");
    if (cantidad != null) {
        cant_mostrar_registro_tabla = parseInt(cantidad);
    }
}
cargarEventClickTabConDataTable();
function cargarEventClickTabConDataTable() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // var target = $(e.target).attr("href"); // activated tab
        // alert (target);
        $($.fn.dataTable.tables(true)).css('width', '100%');
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    });
}

function cargarFormatoDataTable(id) {
    let fileName = $("#txtFileNameExport").val();

    let dataColumns = [];
    let i = 0;
    $("#" + id + " table thead tr th").each(function () {
        let data_agregar;
        if ($(this).hasClass("quitar_formato_pesos")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        data.replace(/[$,.]/g, '') :
                        data;
                }
            };
        }
        else if ($(this).hasClass("buttons_aca")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        '':
                        data;
                }
            };
        } else {
            data_agregar = { data: i };
        }

        dataColumns[i] = data_agregar;
        i++;
    });

    let tabla_id = $("#" + id + " table").DataTable({
        responsive: true,
        bAutoWidth: true,
        info: true,
        bInfo: true,
        "autoWidth": false,
        select: false,
        autoFill: false,
        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todos"]],
        "paginate": true,
        "paging": true,
        "aaSorting": [],
        pageLength: cant_mostrar_registro_tabla,
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por Página",
            "zeroRecords": "Sin Datos",
            "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "",
            "search": "Buscar:",
            "infoFiltered": "( _TOTAL_ filtrado de un total de _MAX_ )",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "decimal": ",",
            "thousands": "."
        },
        columns: dataColumns,
        dom: "<'row mx-0 w-100' <'col-sm-12 mb-4 d-flex justify-content-end' B> > <'row mx-0 w-100' <'col-sm-6'l><'col-sm-6 d-flex justify-content-end'fr> > <'col-sm-12 w-100 my-5' t> <'row mx-0 w-100' <'col-sm-5'i><'col-sm-7'p> >",
        buttons: [
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Copiar tabla',
                "title": fileName
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a CSV',
                "title": fileName
            },
            {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel bigger-110 green'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a EXCEL',
                exportOptions: { orthogonal: 'export' },
                "title": fileName
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf bigger-110 red'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a PDF',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                "title": fileName,
                customize: function (doc) {
                    doc.content.table = {
                        "width": "100% !important"
                    }

                    doc.styles.tableBodyEven = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableBodyOdd = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableFooter = {
                        "white-space": "nowrap !important"
                    }
                }
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": "Imprimir tabla",
                autoPrint: false,
                message: "---",
                "title": fileName,
            }
        ]
    });

    cargarEventGuardar(id);

    return tabla_id;
}
function cargarFormatoDataTableId(id) {
    let fileName = $("#txtFileNameExport").val();

    let dataColumns = [];
    let i = 0;
    $("#" + id + " thead tr th").each(function () {
        let data_agregar;
        if ($(this).hasClass("quitar_formato_pesos")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        data.replace(/[$,.]/g, '') :
                        data;
                }
            };
        }
        else if ($(this).hasClass("buttons_aca")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        '' :
                        data;
                }
            };
        } else {
            data_agregar = { data: i };
        }

        dataColumns[i] = data_agregar;
        i++;
    });

    let tabla_id = $("#" + id).DataTable({
        responsive: true,
        bAutoWidth: true,
        info: true,
        bInfo: true,
        "autoWidth": false,
        select: false,
        autoFill: false,
        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todos"]],
        "paginate": true,
        "paging": true,
        "aaSorting": [],
        pageLength: cant_mostrar_registro_tabla,
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por Página",
            "zeroRecords": "Sin Datos",
            "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "",
            "search": "Buscar:",
            "infoFiltered": "( _TOTAL_ filtrado de un total de _MAX_ )",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "decimal": ",",
            "thousands": "."
        },
        columns: dataColumns,
        dom: "<'row mx-0 w-100' <'col-sm-12 mb-4 text-right' B> > <'row mx-0 w-100' <'col-sm-6'l><'col-sm-6 d-flex justify-content-end'fr> > <'col-sm-12 w-100 my-5' t> <'row mx-0 w-100' <'col-sm-5'i><'col-sm-7'p> >",
        buttons: [
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Copiar tabla',
                "title": fileName
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a CSV',
                "title": fileName
            },
            {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel bigger-110 green'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a EXCEL',
                exportOptions: { orthogonal: 'export' },
                "title": fileName
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf bigger-110 red'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a PDF',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                "title": fileName,
                customize: function (doc) {
                    doc.content.table = {
                        "width": "100% !important"
                    }

                    doc.styles.tableBodyEven = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableBodyOdd = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableFooter = {
                        "white-space": "nowrap !important"
                    }
                }
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": "Imprimir tabla",
                autoPrint: false,
                message: "---",
                "title": fileName,
            }
        ]
    });

    cargarEventGuardar(id);

    return tabla_id;
}

function cargarEventGuardar(id) {
    $("#" + id + " select").change(function () {
        let cant_regis_select = $(this).val();
        if (!isNaN(cant_regis_select)) {
            window.localStorage.removeItem("cant_regis_mostrar");
            window.localStorage.setItem("cant_regis_mostrar", cant_regis_select);
        }
    });
}

function cargarFormatoDataTable2(id) {
    $("#" + id + " table").DataTable({
        responsive: true,
        bAutoWidth: true,
        select: false,
        autoFill: false, 
        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todos"]],
        "paginate": false,
        "paging": false,
        "bFilter": false,
        "info": false,
        "aaSorting": [],
        pageLength: cant_mostrar_registro_tabla,
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por Página",
            "zeroRecords": "Sin Datos",
            "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "",
            "search": "Buscar:",
            "infoFiltered": "( _TOTAL_ filtrado de un total de _MAX_ )",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },
        dom: "<'row mx-0' <'col-sm-12 mb-4 text-right' B> > <'row mx-0' <'col-sm-6'l><'col-sm-6'fr> > <'col-sm-12 w-100 my-5' t> <'row mx-0' <'col-sm-5'i><'col-sm-7'p> >",
        buttons: [
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Copiar tabla'
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a CSV'
            },
            {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel bigger-110 green'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a EXCEL'
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf bigger-110 red'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a PDF'
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": "Imprimir tabla",
                autoPrint: false,
                message: "---"
            }
        ]
    });

    cargarEventGuardar();
}

function cargarFormatoDataTable3(id) {
    let fileName = $("#txtFileNameExport").val();

    let dataColumns = [];
    let i = 0;
    $("#" + id + " table thead tr th").each(function () {
        let data_agregar;
        if ($(this).hasClass("quitar_formato_pesos")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        data.replace(/[$,.]/g, '') :
                        data;
                }
            };
        }
        else if ($(this).hasClass("buttons_aca")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        '' :
                        data;
                }
            };
        }
        else {
            data_agregar = { data: i };
        }

        dataColumns[i] = data_agregar;
        i++;
    });

    $("#" + id + " table").DataTable({
        responsive: true,
        bAutoWidth: true,
        select: false,
        autoFill: false,
        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todos"]],
        "paginate": true,
        "bFilter": false,
        "paging": false,
        "aaSorting": [],
        pageLength: -1,
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por Página",
            "zeroRecords": "Sin Datos",
            "info": "Mostrando _TOTAL_ registros en total.",
            "infoEmpty": "",
            "search": "Buscar:",
            "infoFiltered": "( _TOTAL_ filtrado de un total de _MAX_ )",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "decimal": ",",
            "thousands": "."
        },
        columns: dataColumns,
        dom: "<'row mx-0' <'col-sm-12 mb-4 text-right' B> > <'row mx-0' <'col-sm-6'l><'col-sm-6'fr> > <'col-sm-12 w-100 my-5' t> <'row mx-0' <'col-sm-5'i><'col-sm-7'p> >",
        buttons: [
            {
                "extend"    : "copy",
                "text"      : "<i class='fa fa-copy bigger-110 pink'></i>",
                "className" : "btn btn-outline-secondary btn_export",
                "titleAttr" : 'Copiar tabla',
                "title"     : fileName,
                exportOptions: { orthogonal: 'export' }
            },
            {
                "extend"    : "csv",
                "text"      : "<i class='fa fa-database bigger-110 orange'></i>",
                "className" : "btn btn-outline-secondary btn_export",
                "titleAttr" : 'Exportar a CSV',
                "title"     : fileName,
                exportOptions: { orthogonal: 'export' }
            },
            {
                "extend"    : "excel",
                "text"      : "<i class='fa fa-file-excel bigger-110 green'></i>",
                "className" : "btn btn-outline-secondary btn_export",
                "titleAttr" : 'Exportar a EXCEL',
                "title"     : fileName,
                exportOptions: { orthogonal: 'export' }
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf bigger-110 red'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a PDF',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                "title": fileName,
                exportOptions: { orthogonal: 'export' },
                customize: function (doc) {
                    console.log(doc);

                    doc.content.table = {
                        "width": "100% !important"
                    }

                    doc.styles.tableBodyEven = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableBodyOdd = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableFooter = {
                        "white-space": "nowrap !important"
                    }
                }
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": "Imprimir tabla",
                autoPrint: false,
                message: "---",
                "title": fileName,
                exportOptions: { orthogonal: 'export' }
            }
        ]
    });
}

function cargarFormatoDataTable4(id) {
    let fileName = $("#txtFileNameExport").val();
    let dataColumns = [];
    let i = 0;
    $("#" + id + " table thead tr th").each(function () {
        let data_agregar;
        if ($(this).hasClass("quitar_formato_pesos")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        data.replace(/[$,.]/g, '') :
                        data;
                }
            };
        } else {
            data_agregar = { data: i };
        }

        dataColumns[i] = data_agregar;
        i++;
    });

    $("#" + id + " table").DataTable({
        responsive: true,
        bAutoWidth: true,
        select: false,
        autoFill: false,
        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todos"]],
        "paginate": true,
        "paging": false,
        "aaSorting": [],
        pageLength: -1,
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por Página",
            "zeroRecords": "Sin Datos",
            "info": "Mostrando _TOTAL_ registros en total.",
            "infoEmpty": "",
            "search": "Buscar:",
            "infoFiltered": "( _TOTAL_ filtrado de un total de _MAX_ )",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "decimal": ",",
            "thousands": "."
        },
        columns: dataColumns,
        dom: "<'row mx-0' <'col-sm-12 mb-4 text-right' B> > <'row mx-0' <'col-sm-6'l><'col-sm-6'fr> > <'col-sm-12 w-100 my-5' t> <'row mx-0' <'col-sm-5'i><'col-sm-7'p> >",
        buttons: [
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Copiar tabla',
                "title": fileName
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a CSV',
                "title": fileName
            },
            {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel bigger-110 green'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a EXCEL',
                exportOptions: { orthogonal: 'export' },
                "title": fileName
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf bigger-110 red'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a PDF',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                "title": fileName,
                customize: function (doc) {
                    console.log(doc);

                    doc.content.table = {
                        "width": "100% !important"
                    }

                    doc.styles.tableBodyEven = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableBodyOdd = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableFooter = {
                        "white-space": "nowrap !important"
                    }
                }
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": "Imprimir tabla",
                autoPrint: false,
                message: "---",
                "title": fileName
            }
        ]
    });
}

function cargarFormatoDataTable5(id) {
    let fileName = $("#txtFileNameExport").val();

    let dataColumns = [];
    let i = 0;
    $("#" + id + " table thead tr th").each(function () {
        let data_agregar;
        if ($(this).hasClass("quitar_formato_pesos")) {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        data.replace(/[$,.]/g, '') :
                        data;
                }
            };
        } else {
            data_agregar = {
                data: i,
                render: function (data, type, row, meta) {
                    return type === 'export' ?
                        "\u200C" + data :
                        data;
                }
            };
        }

        dataColumns[i] = data_agregar;
        i++;
    });

    $("#" + id + " table").DataTable({
        responsive: true,
        bAutoWidth: true,
        select: false,
        autoFill: false,
        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todos"]],
        "paginate": true,
        "paging": true,
        "aaSorting": [],
        pageLength: cant_mostrar_registro_tabla,
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por Página",
            "zeroRecords": "Sin Datos",
            "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "",
            "search": "Buscar:",
            "infoFiltered": "( _TOTAL_ filtrado de un total de _MAX_ )",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "decimal": ",",
            "thousands": "."
        },
        columns: dataColumns,
        dom: "<'row mx-0' <'col-sm-12 mb-4 text-right' B> > <'row mx-0' <'col-sm-6'l><'col-sm-6'fr> > <'col-sm-12 w-100 my-5' t> <'row mx-0' <'col-sm-5'i><'col-sm-7'p> >",
        buttons: [
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Copiar tabla',
                "title": fileName
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a CSV',
                "title": fileName
            },
            {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel bigger-110 green'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a EXCEL',
                exportOptions: { orthogonal: 'export' },
                "title": fileName
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf bigger-110 red'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": 'Exportar a PDF',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                "title": fileName,
                customize: function (doc) {
                    doc.content.table = {
                        "width": "100% !important"
                    }

                    doc.styles.tableBodyEven = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableBodyOdd = {
                        "white-space": "nowrap !important"
                    }

                    doc.styles.tableFooter = {
                        "white-space": "nowrap !important"
                    }
                }
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i>",
                "className": "btn btn-outline-secondary btn_export",
                "titleAttr": "Imprimir tabla",
                autoPrint: false,
                message: "---",
                "title": fileName,
            }
        ]
    });

    cargarEventGuardar();
}

function maxInteger32() {
    $(".max_integer_32").on({
        blur: function () {
            let valor = $(this).val();
            if (valor.trim() != "" && parseInt(valor) > 999999999) {
                $(this).val(0);
                swal("Valor ingresado no debe ser mayor a 999999999");
            }
            
        }
    });
}

function mascaraMonedaEntero(monto) {
    monto = parseInt(monto);
    monto = new Intl.NumberFormat("de-DE").format(monto);
    return monto;
}

function mascaraMonedaDecimal(monto, cant_decimal) {
    monto = parseFloat(monto).toFixed(cant_decimal).toString().replace(",", ".");
    monto = new Intl.NumberFormat("de-DE", { style: "currency", currency: "ZAR", minimumFractionDigits: cant_decimal }).format(monto);
    monto = monto.toString().replace("ZAR", "").trim();
    return monto;
}

function mascaraMonedaDecimaAutomatico(monto) {
    monto = parseFloat(monto).toString().replace(",", ".");
    monto = new Intl.NumberFormat("de-DE", { style: "currency", currency: "ZAR" }).format(monto);
    monto = monto.toString().replace("ZAR", "").trim();
    return monto;
}

function cargarFomartoRut() {
    $(".formato_rut").on({
        keyup: function () {
            let x = $(this);
            let cadena = x.val().replace("-", "");
            if (cadena.length > 10) {
                cadena = cadena.substring(0, 9);
            }

            if (cadena.length > 1) {
                let dv = cadena.substring(cadena.length - 1, cadena.length);
                let rut = cadena.substring(0, cadena.length - 1);
                if (isNaN(rut)) {
                    cadena = "";
                } else {
                    cadena = rut + "-" + dv;
                }
            }
            x.val(cadena);
        },
        keypress: function (event) {
            if (event.charCode == 75 || event.charCode == 107) { //LETRA K
            } else if (event.charCode < 48 || event.charCode > 57) {//DISTITO A NUMEROS 0-9
                return false;
            }
        },
        focus: function () {
            let x = $(this);
            let cadena = x.val();
            x.val(cadena.replace(/[.]/g, ""))
        },
        blur: function (event) {
            let x = $(this);
            let cadena = x.val().split("-");
            if (cadena.length == 2) {
                cadena = mascaraMonedaEntero(cadena[0]) + "-" + cadena[1];
            }

            x.val(cadena);
        }
    });

    $(".formato_rut_sin_puntos").on({
        keyup: function () {
            let x = $(this);
            let cadena = x.val().replace("-", "");
            if (cadena.length > 10) {
                cadena = cadena.substring(0, 9);
            }

            if (cadena.length > 1) {
                let dv = cadena.substring(cadena.length - 1, cadena.length);
                let rut = cadena.substring(0, cadena.length - 1);
                if (isNaN(rut)) {
                    cadena = "";
                } else {
                    cadena = rut + "-" + dv;
                }
            }
            x.val(cadena);
        },
        keypress: function (event) {
            if (event.charCode == 75 || event.charCode == 107) { //LETRA K
            } else if (event.charCode < 48 || event.charCode > 57) {//DISTITO A NUMEROS 0-9
                return false;
            }
        },
        focus: function () {
            let x = $(this);
            let cadena = x.val();
            x.val(cadena.replace(/[.]/g, ""))
        },
        blur: function (event) {
            let x = $(this);
            let cadena = x.val().split("-");
            if (cadena.length == 2) {
                cadena = cadena[0] + "-" + cadena[1];
            }

            x.val(cadena);
        }
    });
}

aplicarEfectoModalGlobal();

function aplicarEfectoModalGlobal() {
    if ($(".modal-dialog").length > 0) {
        $(".modal-dialog").addClass("animated");
        $(".modal-dialog").removeClass("bounceIn");
        $(".modal-dialog").addClass("fadeIn");
    }
}

function validarRut(numero, dv) {
    if (numero.length == 0 || numero.length > 9) {
        return false;
    } else {
        if (getDV(numero) == dv.toUpperCase()) return true;
    }
    return false;
}

function getDV(numero) {
    nuevo_numero = numero.toString().split("").reverse().join("");
    for (i = 0, j = 2, suma = 0; i < nuevo_numero.length; i++, ((j == 7) ? j = 2 : j++)) {
        suma += (parseInt(nuevo_numero.charAt(i)) * j);
    }
    n_dv = 11 - (suma % 11);
    var dv = ((n_dv == 11) ? 0 : ((n_dv == 10) ? "K" : n_dv));
    return dv;
}

inputSoloNumero();

function inputSoloNumero() {
    if ($(".input_solo_numeros").length > 0) {
        $(".input_solo_numeros").off("keypress");
        $(".input_solo_numeros").off("keypress");
        $(".input_solo_numeros").off("keyup");
        $(".input_solo_numeros").off("blur");

        $(".input_solo_numeros").on({
            keypress: function (event) {
                if (event.charCode < 48 || event.charCode > 57) {
                    return false;
                }
            },
            keyup: function () {
                let valor = $(this).val();
                let readonly = $(this).attr("readonly");
                if (typeof readonly == "undefined" && isNaN(valor)) {
                    $(this).val("");
                }
            },
            blur: function () {
                let valor = $(this).val();
                let readonly = $(this).attr("readonly");

                if (typeof readonly == "undefined" && isNaN(valor)) {
                    $(this).val("");
                }
            }
        });
    }
}

function inputMascaraMontoEnteros() {
    $(".input_mascara_monto_entero").off("focus");
    $(".input_mascara_monto_entero").off("keypress");
    $(".input_mascara_monto_entero").off("keyup");
    $(".input_mascara_monto_entero").off("blur");

    $(".input_mascara_monto_entero").on({
        focus: function () {
            let valor                   = $(this).val();
            let valor_save              = valor;
            let readonly                = $(this).attr("readonly");

            valor = valor.replaceAll(".", "");

            if (typeof readonly == "undefined" && isNaN(valor)) {
                valor = "";
            } else if (typeof readonly != "undefined") {
                valor = valor_save;
            }
            $(this).val(valor);
        },
        keypress: function (event) {
            if (event.charCode < 48 || event.charCode > 57) {
                return false;
            }
        },
        keyup: function () {
            let valor = $(this).val();
            let readonly = $(this).attr("readonly");
            if (typeof readonly == "undefined" && isNaN(valor)) {
                $(this).val("");
            }
        },
        blur: function () {
            let valor       = $(this).val();
            let readonly    = $(this).attr("readonly");

            if (typeof readonly == "undefined" && valor.trim() != "" && isNaN(valor)) {
                valor = "";
            } else if (typeof readonly == "undefined" && valor.trim() != "" && !isNaN(valor)) {
                valor = mascaraMonedaEntero(valor);
            }
            $(this).val(valor);
        }
    });
}

function base64ToArrayBuffer(base64) {
    var binaryString = window.atob(base64);
    var binaryLen = binaryString.length;
    var bytes = new Uint8Array(binaryLen);
    for (var i = 0; i < binaryLen; i++) {
        var ascii = binaryString.charCodeAt(i);
        bytes[i] = ascii;
    }
    return bytes;
}

function saveByteArray(nombre_archivo, byte, tipo_archivo) {
    var blob = new Blob([byte], { type: "application/" + tipo_archivo });
    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);

    var fileName = nombre_archivo;
    link.download = fileName;
    link.click();
};

function addItemLocalStorage(item, value) {
    window.localStorage.removeItem(item);
    window.localStorage.setItem(item, value);
    console.log("Item añadido: " + window.localStorage.getItem(item));
}

function updateItemLocalStorage(item, value) {
    window.localStorage.removeItem(item);
    window.localStorage.setItem(item, value);
    console.log("Item actualizado: " + window.localStorage.getItem(item));
}

function getItemLocalStorage(item) {
    let value = window.localStorage.getItem(item);
    console.log("Item obtenido: " + value);
    return value;
}

function deleteEventCloseAlert() {
    $("#modal_notify .modal-content").off("mouseover");
    $("#modal_notify .modal-content").off("mouseout");
    $("#btn_cerrar_notify").off("click");
}
var time_change_icon;
function cargarEventCloseAlert() {
    $("#btn_cerrar_notify").click(function () {
        $("#modal_notify").modal("hide");
    });
    $("#modal_notify .modal-content").mouseover(function () {
        clearTimeout(time_change_icon);
        $("#modal_notify span").removeClass("fa-bell");
        $("#modal_notify span").addClass("fa-times");
        $("#modal_notify span").addClass("animated bounceIn");
    });

    $("#modal_notify .modal-content").mouseout(function () {
        time_change_icon = setTimeout(function () {
            $("#modal_notify span").removeClass("fa-times");
            $("#modal_notify span").removeClass("animated bounceIn");
            $("#modal_notify span").addClass("fa-bell");
        }, 500);
    });
}

function cargarTooltip() {
    if ($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="tooltip"]').on("mouseleave", function () {
            let atributo = $(this).attr("aria-describedby")
            $("#" + atributo).remove();
        })
    }
}
validarScrollBodyModalHidden();
function validarScrollBodyModalHidden() {
    $('.modal').on('hide.bs.modal', function (event) {
        // do something...
        $("#contenedor_body").removeClass("modal-open");
        $("#contenedor_body").removeAttr("style");
    })
}


/* 
 * FUNCION CONTAR CARACTERES, OCUPADO EN LOS COMPONENTE CON CARACTERES LIMITADOS
 * */
function contarCaracter(texto, id_lbl_contador) {
    let totCaracteres = 0;
    if ($("#" + id_lbl_contador).length != 0) {
        totCaracteres = $("#" + id_lbl_contador).attr("maxlength");
    }
    $("#" + id_lbl_contador).text("Max. (" + texto.length + " de " + totCaracteres + ")");
}


/**
* ESTA FUNCIÓN PERMITE AÑADIR A LOS INPUT LA ACTUALIZACIÓN DEL CONTEO DE LOS CARACTERES INGRESADOS
*/
function addKeyUpInputContarCaractere(id_input_texto, id_lbl_contador) {
    $("#" + id_input_texto).keyup(function () {
        var texto = $(this).val();
        contarCaracter(texto, id_lbl_contador);
    });
}

function formatDateJsonAnioMesDia(jsonDateString, separador) {

    let d = new Date(parseInt(jsonDateString.replace('/Date(', '')));

    let month   = '' + (d.getMonth() + 1);
    let day     = '' + d.getDate();
    let year    = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join(separador);
}

function formatDateJsonHoraMinutoEtapaHoraria(jsonDateString) {

    let d = new Date(parseInt(jsonDateString.replace('/Date(', '')));

    let hora    = d.getHours();
    let minuto  = d.getMinutes();
    let ampm    = "am";

    if (hora > 12) {
        ampm = 'pm';
    }

    if (hora < 10) {
        hora = "0" + hora;
    }
    if (minuto < 10) {
        minuto = "0" + minuto;
    }

    return hora + ":" + minuto + " " + ampm;
}

function modal_mensaje_cargando(estado, mensaje) {
    if (estado == "Mostrar") {
        $("#modal_cargando").addClass("modal_cargando_show");

        if (mensaje == null || mensaje.trim == "") {
            mensaje = "Cargando..."
        }

        $(".modal_cargando_contenido__mensaje").text(mensaje);
    }
    else if (estado == "Mensaje") {
        if (mensaje == null || mensaje.trim == "") {
            mensaje = "Cargando..."
        }

        $(".modal_cargando_contenido__mensaje").text(mensaje);
    } else if (estado == "Ocultar") {
        $("#modal_cargando").removeClass("modal_cargando_show");
    }
}
//var cadena_byte = base64toarraybuffer("");
//savebytearray("archivo generado string byte a file.json", cadena_byte);

//$("").click(function () {
//    var that = this;
//    var page_url = 'download.php';

//    var req = new XMLHttpRequest();
//    req.open("POST", page_url, true);
//    req.addEventListener("progress", function (evt) {
//        if (evt.lengthComputable) {
//            var percentComplete = evt.loaded / evt.total;
//            console.log(percentComplete);
//        }
//    }, false);

//    req.responseType = "blob";
//    req.onreadystatechange = function () {
//        if (req.readyState === 4 && req.status === 200) {
//            var filename = $(that).data('filename');
//            if (typeof window.chrome !== 'undefined') {
//                // Chrome version
//                var link = document.createElement('a');
//                link.href = window.URL.createObjectURL(req.response);
//                link.download = filename;
//                link.click();
//            } else if (typeof window.navigator.msSaveBlob !== 'undefined') {
//                // IE version
//                var blob = new Blob([req.response], { type: 'application/force-download' });
//                window.navigator.msSaveBlob(blob, filename);
//            } else {
//                // Firefox version
//                var file = new File([req.response], filename, { type: 'application/force-download' });
//                window.open(URL.createObjectURL(file));
//            }
//        }
//    };
//    req.send();
//});
    function prevent_previous_page_return() {
        window.history.forward();
    }