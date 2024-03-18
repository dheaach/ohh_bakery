var Ingridients = function () {

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
        var is_date = $("#chk_tgl").prop("checked");
        if(is_date == true){
            is_date = 1;
        }else{
            is_date = 0;
        }
        var start_date = $("#tgl_mulai").val();
        var end_date = $("#tgl_selesai").val();
        var status_trans = $("#status_trans").val();
        var is_user = $("#is_user").prop("checked");
        if(is_user == true){
            is_user = 1;
        }else{
            is_user = 0;
        }

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_bahanbaku"),
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
                    "url": BASE_URL+"manufacture/list_bahan/"+keyw+"/"+is_date+"/"+start_date+"/"+end_date+"/"+status_trans+"/"+is_user+"/", // ajax source
                },
                "order": [
                    [2, "asc"]
                ] ,
                "columnDefs": [
                    { "orderable": false, "targets": [0] },
                    {
                        "searchable": false,
                        "targets": [0]
                    }
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
var RoleManufaktur = function () {

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

        var is_date = $("#chk_tgl").prop("checked");
        if(is_date == true){
            is_date = '1';
        }else{
            is_date = '0';
        }
        var start_date = $("#tgl_mulai").val();
        var end_date = $("#tgl_selesai").val();
        var status_trans = $("#status_trans").val();
        var is_user = $("#is_user").prop("checked");
        if(is_user == true){
            is_user = '1';
        }else{
            is_user = '0';
        }

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_rolemnf"),
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
                    "url": BASE_URL+"manufacture/list_role/"+keyw+"/"+is_date+"/"+start_date+"/"+end_date+"/"+status_trans+"/"+is_user+"/", // ajax source
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

var ProsesManufaktur = function () {

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
        
        var is_date = $("#chk_tgl").prop("checked");
        if(is_date == true){
            is_date = '1';
        }else{
            is_date = '0';
        }
        var start_date = $("#tgl_mulai").val();
        var end_date = $("#tgl_selesai").val();
        var status_trans = $("#status_trans").val();
        var is_user = $("#is_user").prop("checked");
        if(is_user == true){
            is_user = '1';
        }else{
            is_user = '0';
        }
        
        var grid = new Datatable();

        grid.init({
            src: $("#datatable_prosesmnf"),
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
                    "url": BASE_URL+"manufacture/list_proses/"+keyw+"/"+is_date+"/"+start_date+"/"+end_date+"/"+status_trans+"/"+is_user+"/", // ajax source
                },
                "order": [
                    [0, "asc"]
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

var ProsesTrial = function () {

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
        var is_date = $("#chk_tgl").prop("checked");
        if(is_date == true){
            is_date = '1';
        }else{
            is_date = '0';
        }
        var start_date = $("#kategori-filter").val();
        var end_date = $("#subkategori_filter").val();
        var status_trans = $("#status_trans").val();
        var is_user = $("#is_user").prop("checked");
        if(is_user == true){
            is_user = '1';
        }else{
            is_user = '0';
        }
        
        var grid = new Datatable();

        grid.init({
            src: $("#datatable_prosesmnf_trial"),
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
                    "url": BASE_URL+"manufacture/list_proses_trial/"+keyw+"/"+is_date+"/"+start_date+"/"+end_date+"/"+status_trans+"/"+is_user+"/", // ajax source
                },
                "order": [
                    [0, "asc"]
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