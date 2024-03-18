var Productlist = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }

    var handleProducts = function() {

        var selectedRows = [];

        var status_modal = $('#status_modal_sp').val();

        $(".chk-prodml:checked").each(function(){
            var brgid = $(this).val();
            if(selectedRows.indexOf(brgid) === -1){
              selectedRows.push(brgid);
            }
        });

        for (var i = 0; i < selectedRows.length; i++) {
            var val = selectedRows[i];
            $('.chk-prodml[value="'+val+'"]').prop("checked", true);
        }

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_productslist"),
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
                    "url": BASE_URL+"product/show_list", 
                    "data" : function(data) {
                        data.searchField = $('#productlistmp_search').val();
                        data.prodType = $('input[name="optTipeBrgMl"]:checked').val();
                    }// ajax source
                },
                "order": [
                    [2, "asc"]
                ] ,
                "columnDefs": [
                    {   "orderable": false, 
                        "targets": [0] 
                    },{
                        "searchable": false,
                        "targets": [0,1,2]
                    }
                ]
                // set first column as a default sort by asc
            }
        });

        grid.getDataTable().on('draw', function() {
            var status_modal = $('#status_modal_sp').val();

            console.log(status_modal);

            if(status_modal == 'clear'){
                selectedRows = [];
                grid.getTableWrapper().find('input[type="checkbox"]').prop('checked', false);
                grid.getTableWrapper().find('span.checked').removeClass('checked');
            }

            var checkboxes = grid.getTableWrapper().find('input[type="checkbox"]');
            checkboxes.each(function() {
                var val = $(this).val();

                var index = $.inArray(val, selectedRows);

                if(index !== -1){
                    $(this).attr("checked", true);
                    $(this).closest('span').addClass('checked');
                }else{
                    $(this).attr("checked", false);
                    $(this).closest('span').removeClass('checked'); 
                }
            });
        });

        grid.getTableWrapper().on('click', 'input[type="checkbox"]', function(e) {
            var chk_val = $(this).val();
            var val = $('.chk-prodml[value="'+chk_val+'"]').is(':checked');
            
            if(val == false){
                var index = selectedRows.indexOf(chk_val);

                if (index > -1) {
                    selectedRows.splice(index, 1);
                }

            }else{
                $(".chk-prodml:checked").each(function(){
                    var brgid = $(this).val();
                    if(selectedRows.indexOf(brgid) === -1){
                      selectedRows.push(brgid);
                    }
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
var ProductlistSingle = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }

    var handleProducts = function() {

        // var key = $('#singleprod_search').val();
        var grid = new Datatable();

        grid.init({
            src: $("#datatable_productslistsingle"),
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
                    "lengthMenu": "Records _MENU_ |"
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here 
                ],
                "processing": true,
                "serverSide": true,
                "serverMethod": "POST",
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL+"product/show_list_single", 
                    "data" : function(data) {
                        data.searchField = $('#singleprod_search').val();
                        data.prodType = $('input[name="optTipeBrg"]:checked').val();
                    }// ajax source
                },
                "order": [
                    [1, "asc"]
                ] ,
                "columnDefs": [
                    {   "orderable": false, 
                        "targets": [0]
                    },{
                        "searchable": false,
                        "targets": [3,4,5]
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

        // $('#singleprod_search').on("keyup", function(e) {
        //     e.preventDefault();
        //     var oTable = $('#datatable_productslistsingle').DataTable();
        //     oTable.draw();
        //     console.log(key);
        // });

        
    }

    return {

        //main function to initiate the module
        init: function () {

            handleProducts();
            initPickers();
            
        }

    };

}();

var ProductlistSingleBb = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }

    var handleProducts = function() {

        // var key = $('#singleprod_search').val();
        var grid = new Datatable();

        grid.init({
            src: $("#datatable_productslistsinglebb"),
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
                    "lengthMenu": "Records _MENU_ |"
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here 
                ],
                "processing": true,
                "serverSide": true,
                "serverMethod": "POST",
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL+"product/show_list_single_bb", 
                    "data" : function(data) {
                        data.searchField = $('#singleprodbb_search').val();
                    }// ajax source
                },
                "order": [
                    [1, "asc"]
                ] ,
                "columnDefs": [
                    {   "orderable": false, 
                        "targets": [0]
                    },{
                        "searchable": false,
                        "targets": [1,2,3,4]
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

        // $('#singleprod_search').on("keyup", function(e) {
        //     e.preventDefault();
        //     var oTable = $('#datatable_productslistsingle').DataTable();
        //     oTable.draw();
        //     console.log(key);
        // });

        
    }

    return {

        //main function to initiate the module
        init: function () {

            handleProducts();
            initPickers();
            
        }

    };

}();