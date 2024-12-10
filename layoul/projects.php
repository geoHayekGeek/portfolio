<?php
include_once "./layout/header.php";
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.css">

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table-locale-all.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<h1 class="mb-4">All Project</h1>

<div id="toolbar">
    <button id="remove" class="btn btn-danger" disabled>
        <i class="fa fa-trash"></i> Delete
    </button>
</div>
<table id="table" data-toolbar="#toolbar" data-search="true" data-show-refresh="true" data-show-toggle="true"
    data-show-fullscreen="true" data-show-columns="true" data-show-columns-toggle-all="true" data-detail-view="true"
    data-show-export="true" data-click-to-select="true" data-detail-formatter="detailFormatter"
    data-minimum-count-columns="2" data-show-pagination-switch="true" data-pagination="true" data-id-field="id"
    data-page-list="[10, 25, 50, 100, all]" data-side-pagination="server"
    data-url="https://examples.wenzhixin.net.cn/examples/bootstrap_table/data" data-response-handler="responseHandler">
</table>

<script>
    var $table = $('#table')
    var $remove = $('#remove')
    var selections = []

    function getIdSelections() {
        return $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id
        })
    }

    function responseHandler(res) {
        $.each(res.rows, function (i, row) {
            row.state = $.inArray(row.id, selections) !== -1
        })
        return res
    }

    function detailFormatter(index, row) {
        var html = []
        $.each(row, function (key, value) {
            html.push('<p><b>' + key + ':</b> ' + value + '</p>')
        })
        return html.join('')
    }

    function operateFormatter(value, row, index) {
        return [
            '<a class="edit me-4" href="javascript:void(0)" title="Edit">',
            '<i class="fa fa-pen"></i>',
            '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('')
    }

    window.operateEvents = {
        'click .like': function (e, value, row, index) {
            alert('You click like action, row: ' + JSON.stringify(row))
        },
        'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                field: 'id',
                values: [row.id]
            })
        }
    }

    function totalTextFormatter(data) {
        return 'Total'
    }

    function totalNameFormatter(data) {
        return data.length
    }

    function totalPriceFormatter(data) {
        var field = this.field
        return '$' + data.map(function (row) {
            return +row[field].substring(1)
        }).reduce(function (sum, i) {
            return sum + i
        }, 0)
    }

    function initTable() {
        $table.bootstrapTable('destroy').bootstrapTable({
            height: 550,
            locale: 'en-US',
            columns: [
                [
                    {
                        field: 'state',
                        checkbox: true,
                        rowspan: 2,
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: 'Item ID',
                        field: 'id',
                        rowspan: 2,
                        align: 'center',
                        valign: 'middle',
                        sortable: true,
                    },
                    {
                        title: 'Item Detail',
                        colspan: 3,
                        align: 'center'
                    }
                ],
                [
                    {
                        field: 'name',
                        title: 'Item Name',
                        sortable: true,
                        align: 'center'
                    },
                    {
                        field: 'price',
                        title: 'Item Price',
                        sortable: true,
                        align: 'center',
                    },
                    {
                        field: 'operate',
                        title: 'Item Operate',
                        align: 'center',
                        clickToSelect: false,
                        events: window.operateEvents,
                        formatter: operateFormatter
                    }
                ]
            ]
        })
        $table.on('check.bs.table uncheck.bs.table ' +
            'check-all.bs.table uncheck-all.bs.table',
            function () {
                $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

                // save your data, here just save the current page
                selections = getIdSelections()
                // push or splice the selections if you want to save all data selections
            })
        $table.on('all.bs.table', function (e, name, args) {
            console.log(name, args)
        })
        $remove.click(function () {
            var ids = getIdSelections()
            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids
            })
            $remove.prop('disabled', true)
        })
    }

    $(function () {
        initTable()

        $('#locale').change(initTable)
    })
</script>

<?php
include_once "./layout/footer.php";
?>