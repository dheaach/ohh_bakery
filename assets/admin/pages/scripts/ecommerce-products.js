var EcommerceProducts = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }

    var handleProducts = function() {
        
        var keyw = $("#keyword").val();
        if(keyw ==''){
            keyw = 'none';
        }else{
            keyw  = keyw.replace(/ /g,"_");
        }
        var is_archive = $("#chk-arsip").prop("checked");
        var kat = $("#kategori-filter").val();
        var grp = $("#subkategori_filter").val();
        var sts = $("#statbar_filter").val();

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_products"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "dom": '<"top">rt<"bottom"lpi>',
                "language" : {
                    "lengthMenu": "Records _MENU_ |",
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here 
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL+"product/list/"+keyw+"/"+is_archive+"/"+grp+"/"+kat+"/"+sts+"/", // ajax source
                },
                "order": [
                    [2, "asc"]
                ] ,
                "columnDefs": [
                    { "orderable": false, "targets": [0] }
                ]
                // set first column as a default sort by asc
            }
        });

         // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // handling hide button

        // if(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */

        if(check_user_right('21G') == 0){
            var iCol = 5;
            var column = grid.getDataTable().column(iCol);
            var bVis = column.visible();
            column.visible(!bVis);
        }
        if(check_user_right('21H') == 0){
            var iCol = 6;
            var column = grid.getDataTable().column(iCol);
            var bVis = column.visible();
            column.visible(!bVis);
        }
        
        // }
    }

    return {

        //main function to initiate the module
        init: function () {

            handleProducts();
            initPickers();
            
        }

    };

}();

var ProductsMargin = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }

    var handleProducts = function() {

        var keyw = $("#keyword").val();
        if(keyw ==''){
            keyw = 'none';
        }else{
            keyw  = keyw.replace(/ /g,"_");
        }
        var is_archive = $("#chk-arsip").prop("checked");
        var kat = $("#kategori-filter").val();
        var grp = $("#subkategori_filter").val();
        var sts = $("#statbar_filter").val();

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_products_margin"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "dom": '<"top">rt<"bottom"lpi>',
                "language" : {
                    "lengthMenu": "Records _MENU_ |",
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here 
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL+"product/list_margin/"+keyw+"/"+is_archive+"/"+grp+"/"+kat+"/"+sts+"/", // ajax source
                },
                "order": [
                    [2, "asc"]
                ] ,
                "columnDefs": [
                    { "orderable": false, "targets": [0] }
                ]
                // set first column as a default sort by asc
            }
        });

         // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            handleProducts();
            initPickers();
            
        }

    };

}();