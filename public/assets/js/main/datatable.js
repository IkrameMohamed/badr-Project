let load_dtb = (id, url_dtb, data_dtb, columns) => {

    let buttonConfig = [];
    buttonConfig.push({
        extend: 'print',
        text: '<i class="fa fa-print"></i>',
        titleAttr: 'Print',
        className: 'btn btn-outline-warning ',
        exportOptions: {
            columns: "thead th:not(.noExport)"
        }
    });
    buttonConfig.push({
        extend: 'copy',
        text: '<i class="fa fa-copy"></i>',
        titleAttr: 'Copy',
        className: 'btn btn-outline-warning ',
        exportOptions: {
            columns: "thead th:not(.noExport)"
        }
    });
    buttonConfig.push({
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i>',
        titleAttr: 'Excel',
        className: 'btn btn-outline-warning ',
        exportOptions: {
            columns: "thead th:not(.noExport)",
            format: {
                body: function (data, column, row, node) {
                    var val = $(node).html();
                    if ($(node).hasClass('isNumber'))
                        return parseFloat(val.replace(/\s/g, '').replace("&amp;", "&").replace(",", "."));
                    return val
                        ? $(node).html().replace("&amp;", "&").replace(",", ".")
                        : '';
                },
            },
        },
    });
    buttonConfig.push({
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i>',
        titleAttr: 'pdf',
        className: 'btn btn-outline-warning ',
        orientation : 'landscape',
        exportOptions: {
            columns: "thead th:not(.noExport)"
        },
        customize: function (doc) {
            doc.content[1].table.widths =
                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            doc.defaultStyle.alignment = 'center';
        },
    });
    buttonConfig.push({
        extend: 'colvis',
        text: '<i class="fa fa-eye"></i>',
        titleAttr: 'PDF',
        className: 'btn btn-outline-warning ',
        collectionLayout: 'fixed',
        exportOptions: {
            columns: "thead th:not(.noExport)"
        }
    });
    let table = $('#' + id).DataTable({
        language: {
            "url": asset + "/plugins/datatables/lang/" + theLanguage + ".json"
        },
        dom: "<'row'<'col-sm-12 col-md-3'l>''<'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        "serverSide": true,
        "processing": true,
        "responsive": true,
        "ajax": {
            "url": url + url_dtb,
            "dataType": "json",
            "type": "POST",
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            },
            "data": data_dtb,
        },
        "columns": columns,
        buttons: {
            buttons: buttonConfig,
            dom: {
                button: {
                    className: ''
                }
            }
        },

    });
    return table
};

let dynamic_dtb = (table, message = null, totalColumns = null, footer = false) => {

    let buttonConfig = [];
    buttonConfig.push({
        extend: 'print',
        text: '<i class="fa fa-print"></i>',
        titleAttr: 'Print',
        className: 'btn btn-outline-warning ',
        exportOptions: {
            columns: "thead th:not(.noExport)"
        },
        customize: function (win) {
            $(win.document.body).find('h1').css('text-align', 'center');

        },
        messageTop: function () {
            return '<div class="font-weight-bold"> ' + message + '</div>';
        },
        footer: footer
    });
    buttonConfig.push({
        extend: 'copy',
        text: '<i class="fa fa-copy"></i>',
        titleAttr: 'Copy',
        className: 'btn btn-outline-warning ',
        exportOptions: {
            columns: "thead th:not(.noExport)"
        },
        footer: footer
    });
    buttonConfig.push({
        extend: 'excel',
        text: '<i class="fa fa-file-excel-o"></i>',
        titleAttr: 'Excel',
        className: 'btn btn-outline-warning ',
        exportOptions: {
            columns: "thead th:not(.noExport)",
            format: {
                body: function (data, column, row, node) {
                    var val = $(node).html();
                    if ($(node).hasClass('isNumber'))
                        return parseFloat(val.replace(/\s/g, '').replace("&amp;", "&").replace(",", "."));
                    return val
                        ? $(node).html().replace("&amp;", "&").replace(",", ".")
                        : '';
                },
            },
        },
        messageTop: function () {
            return message;
        },
        footer: footer
    });
    buttonConfig.push({
        extend: 'pdf',
        text: '<i class="fa fa-file-pdf-o"></i>',
        titleAttr: 'pdf',
        className: 'btn btn-outline-warning ',
        exportOptions: {
            columns: "thead th:not(.noExport)"
        },
        messageTop: function () {
            return message;
        },
        footer: footer
    });
    buttonConfig.push({
        extend: 'colvis',
        text: '<i class="fa fa-eye"></i>',
        titleAttr: 'colvis',
        className: 'btn btn-outline-warning ',
        collectionLayout: 'fixed',
    });
    let dtb = table.DataTable({
        language: {
            "url": asset + "plugins/datatables/lang/" + theLanguage + ".json"
        },
        dom: "<'row'<'col-sm-12 col-md-3'l>''<'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        buttons: {
            buttons: buttonConfig,
            dom: {
                button: {
                    className: ''
                }
            }
        }, "footerCallback": function (row, data, start, end, display) {
            var api = this.api(), total = [];

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(' ', '').replace(',','.') :
                    typeof i === 'number' ?
                        i : 0;
            };
            if (totalColumns) {
                $(api.column(0).footer()).html(translate.total);

                // computing column Total of the complete result
                $.each(totalColumns, function (i, ele) {

                    total[ele] = api
                        .column(ele)
                        .data()
                        .reduce(function (a, b) {
                            a = (a) ? a : 0;
                            b = (b) ? b : 0;
                            return parseFloat(intVal(a)) + parseFloat(intVal(b));
                        }, 0);

                    $(api.column(ele).footer()).html(number_format(total[ele].toFixed(2)));

                });
            }
        }

    });


    return dtb

};
