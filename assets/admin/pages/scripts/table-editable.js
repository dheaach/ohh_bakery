var TableEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var counter = 1;
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            // jqTds[0].innerHTML = '<input type="text" class="form-control input-small input-xs" value="' + counter + '" readonly>';
            // jqTds[0].innerHTML = '<input type="text" class="form-control input-small unit_id" id="unit_id" id="unit_id" value="' + aData[0] + '">';
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small unit_nama" name="unit_nama" id="unit_nama" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small unit_kon" name="unit_kon" id="unit_kon" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small unit_hb" name="unit_hb" id="unit_hb" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small unit_hbp" name="unit_hbp" id="unit_hbp" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small unit_hj" name="unit_hj" id="unit_hj" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-check"></i></a><a class="cancel" href=""><i class="fa fa-times"></i></a>';

            counter++;
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            // oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            // oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate('<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a><a class="delete" href=""><i class="fa fa-minus"></i></a>', nRow, 5, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value , nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            // oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            // oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate('<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a>', nRow, 5, false);
            oTable.fnDraw();
        }

        var table = $('#sample_editable_1');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            "searching": false, 
            "paging": false, 
            "info": false,
            "ordering": false,
            "targets" : [
                0,1,2,3,4,5
            ],
            // set the initial value
            "pageLength": 4,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_1_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Unit sebelumnya belum tersimpan. Simpan data sebelumnya?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Anda yakin menghapus unit ini?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            alert("Unit berhasil dihapus!");
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];
            var y = $("i").hasClass("fa-check");

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow) {
                /* Editing this row and want to save it */
                if (y) {
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    alert("Aksi berhasil dilakukan!");
                }
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

var TableEditableBahanBaku = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var counter = 1;
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="number" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-check"></i></a><a class="cancel" href=""><i class="fa fa-times"></i></a>';

            counter++;
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate('<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a><a class="delete" href=""><i class="fa fa-minus"></i></a>', nRow, 5, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate('<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a>', nRow, 5, false);
            oTable.fnDraw();
        }

        var table = $('#editabledb_bahanbaku');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            "searching": false, 
            "paging": false, 
            "info": false,
            "ordering": false,
            "targets" : [
                0,1,2,3,4
            ],
            // set the initial value
            "pageLength": 4,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }] // set first column as a default sort by asc
        });

        var tableWrapper = $("#editabledb_bahanbaku_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#editabledb_bahanbaku_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previous row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            alert("Deleted! Do not forget to do some ajax to sync with backend :)");
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];
            var y = $("i").hasClass("fa-check");

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow) {
                /* Editing this row and want to save it */
                if (y) {
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
                }
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

var TableEditableRoleMnf = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var counter = 1;
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="number" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-check"></i></a><a class="cancel" href=""><i class="fa fa-times"></i></a>';

            counter++;
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a><a class="delete" href=""><i class="fa fa-minus"></i></a>', nRow, 4, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a>', nRow, 4, false);
            oTable.fnDraw();
        }

        var table = $('#editabledb_rolemnf');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            "searching": false, 
            "paging": false, 
            "info": false,
            "ordering": false,
            "targets" : [
                0,1,2,3,4
            ],
            // set the initial value
            "pageLength": 4,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }] // set first column as a default sort by asc
        });

        var tableWrapper = $("#editabledb_rolemnf_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#editabledb_rolemnf_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previous row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            alert("Deleted! Do not forget to do some ajax to sync with backend :)");
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];
            var y = $("i").hasClass("fa-check");

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow) {
                /* Editing this row and want to save it */
                if (y) {
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
                }
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

var TableEditableProsesMnf = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var counter = 1;
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            
            
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small nama-proses" value="' + aData[0] + '" readonly>';
            jqTds[0].innerHTML = '<select class="form-control select-proses select2" id="kt_select2_6" name="param">'+
                                                      '<option value="AK">Alaska</option>'+
                                                      '<option value="HI">Hawaii</option>'+
                                                      '<option value="CA">California</option>'+
                                                      '<option value="NV">Nevada</option>'+
                                                      '<option value="OR">Oregon</option>'+
                                                      '<option value="WA">Washington</option>'+
                                                      '<option value="AZ">Arizona</option>'+
                                                      '<option value="CO">Colorado</option>'+
                                                      '<option value="ID">Idaho</option>'+
                                                      '<option value="MT">Montana</option>'+
                                                      '<option value="NE">Nebraska</option>'+
                                                      '<option value="NM">New Mexico</option>'+
                                                      '<option value="ND">North Dakota</option>'+
                                                      '<option value="UT">Utah</option>'+
                                                      '<option value="WY">Wyoming</option>'+
                                                      '<option value="AL">Alabama</option>'+
                                                      '<option value="AR">Arkansas</option>'+
                                                      '<option value="IL">Illinois</option>'+
                                                      '<option value="IA">Iowa</option>'+
                                                      '<option value="KS">Kansas</option>'+
                                                      '<option value="KY">Kentucky</option>'+
                                                      '<option value="LA">Louisiana</option>'+
                                                      '<option value="MN">Minnesota</option>'+
                                                      '<option value="MS">Mississippi</option>'+
                                                      '<option value="MO">Missouri</option>'+
                                                      '<option value="OK">Oklahoma</option>'+
                                                      '<option value="SD">South Dakota</option>'+
                                                      '<option value="TX">Texas</option>'+
                                                      '<option value="TN">Tennessee</option>'+
                                                      '<option value="WI">Wisconsin</option>'+
                                                      '<option value="CT">Connecticut</option>'+
                                                      '<option value="DE">Delaware</option>'+
                                                      '<option value="FL">Florida</option>'+
                                                      '<option value="GA">Georgia</option>'+
                                                      '<option value="IN">Indiana</option>'+
                                                      '<option value="ME">Maine</option>'+
                                                      '<option value="MD">Maryland</option>'+
                                                      '<option value="MA">Massachusetts</option>'+
                                                      '<option value="MI">Michigan</option>'+
                                                      '<option value="NH">New Hampshire</option>'+
                                                      '<option value="NJ">New Jersey</option>'+
                                                      '<option value="NY">New York</option>'+
                                                      '<option value="NC">North Carolina</option>'+
                                                      '<option value="OH">Ohio</option>'+
                                                      '<option value="PA">Pennsylvania</option>'+
                                                      '<option value="RI">Rhode Island</option>'+
                                                      '<option value="SC">South Carolina</option>'+
                                                      '<option value="VT">Vermont</option>'+
                                                      '<option value="VA">Virginia</option>'+
                                                      '<option value="WV">West Virginia</option>'+
                                                     '</select>';
            // jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '" readonly="true">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small unit-proses" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="number" class="form-control input-small qty-proses" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small proses_ket" id="proses-ket" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<a class="edit aksi-proses" href="" style="margin-right:15px;"><i class="fa fa-check"></i></a><a class="cancel" href=""><i class="fa fa-times"></i></a>';

            counter++;
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate('<a class="edit aksi-proses" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a><a class="delete" href=""><i class="fa fa-minus"></i></a>', nRow, 5, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate('<a class="edit aksi-proses" href="" style="margin-right:15px;"><i class="fa fa-pencil"></i></a>', nRow, 5, false);
            oTable.fnDraw();
        }

        var table = $('#editabledb_prosesmnf');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            "searching": false, 
            "paging": false, 
            "info": false,
            "ordering": false,
            "targets" : [
                0,1,2,3,4
            ],
            // set the initial value
            "pageLength": 4,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }] // set first column as a default sort by asc
        });

        var tableWrapper = $("#editabledb_prosesmnf_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#editabledb_prosesmnf_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previous row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
            
            var newSelect = $("#editabledb_prosesmnf").find(".select2").last();
            var ketpros = $("#editabledb_prosesmnf").find(".proses_ket").last();
            newRowProses(ketpros);
            initializeSelect2(newSelect);
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            alert("Deleted! Do not forget to do some ajax to sync with backend :)");
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];
            var y = $("i").hasClass("fa-check");

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow) {
                /* Editing this row and want to save it */
                if (y) {
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
                }
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
            
        }

    };

}();
