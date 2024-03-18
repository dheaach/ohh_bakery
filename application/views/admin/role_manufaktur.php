<?php
	$this->load->view("_partials/header.php");
?> 
<!-- BEGIN HEADER -->
<?php
	$this->load->view("_partials/navbar.php");
?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<?php
		$this->load->view("_partials/sidebar.php");
	?>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<?php
				$this->load->view("_partials/modal.php");
			?>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<?php
				// $this->load->view("_partials/theme.php");
			?>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			
			<div class="page-bar">
				<div class="row">
					<div class="col-sm-9">
						<h3 class="page-title font-green-seagreen">
						<strong>Daftar Role Manufaktur</strong>
						</h3>
					</div>
					<div class="add-subcat-nav col-sm-3">
						<a class="btn btn-sm green-seagreen" data-toggle="modal" id="32B"><i class="fa fa-plus"></i> Rote Price Baru</a>
					</div>
				</div>
				<div class="page-toolbar"></div>
			</div>
			<!-- END PAGE HEADER-->
			<div class="page-bar pg-breadcrumb">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('login/dashboard');?>">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url('manufacture/role');?>">Role Manufaktur</a>
					</li>
				</ul>
			</div>

			<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
			</div>
			<div class="alert alert-danger alert-dismissible" id="failed" style="display:none;">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
			</div>

			<!-- BEGIN PAGE CONTENT -->
			<div class="row mycard">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet">
						<div class="portlet-body">
							<div class="tabbable-line">
								<div class="tab-content">
									<div class="tab-pane active" id="tab_15_1">
										<div class="row">
											<h5 class="page-title title-tab">
											<strong>Ringkasan</strong>
											</h5>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-20">
												<div class="dashboard-stat db-table">
													<div class="visual db-ic">
														<i class="fa fa-cube fa-icon-medium"></i>
													</div>
													<div class="details db-lbl ">
														<div class="number db-number">
															<?php
																if(is_array($akt)||is_object($akt)) {
																	foreach($akt as $ua) {
																		echo"<strong>".$ua->hasil." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Role Aktif</strong>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-20">
												<div class="dashboard-stat db-table">
													<div class="visual db-ic">
														<i class="fa fa-cube fa-icon-medium"></i>
													</div>
													<div class="details db-lbl ">
														<div class="number db-number">
															<?php
																if(is_array($non)||is_object($non)) {
																	foreach($non as $ua) {
																		echo"<strong>".$ua->hasil." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Role Non-Aktif</strong>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<!-- <ul class="nav nav-pills">
													<li class="active">
														<a href="#tab_2_1" data-toggle="tab" class="btn green-seagreen btn-sm btn-rounded-left btn-border">
														Daftar </a>
													</li>
													<li>
														<a href="#tab_2_2" data-toggle="tab" class="btn green-seagreen btn-sm btn-rounded-right btn-border">
														Baru </a>
													</li>
												</ul> -->
												<div class="btn-group" id="btn_act" style="display:none;">
													<a class="btn green-seagreen dropdown-toggle btn-rounded btn-sm btn-border btn-actcl" data-toggle="dropdown" href="#" id="32D">
													Aksi
													</a>
													<ul class="dropdown-menu pull-left dropdown-action">
														<li>
															<a class="user-target" data-toggle="modal" href="#ars_akses">
															Arsip </a>
														</li>
														<li>
															<a class="user-target" data-toggle="modal" href="#del_akses">
															Hapus </a>
														</li>
													</ul>
												</div>
											</div>
											<div class="col-sm-3 pdg-btn">
												<div class="btn-group">
													<!-- <a class="btn green-seagreen btn-sm btn-rounded-left btn-border" id="32E">
														Import
													</a>
													<div class="btn-group">
														<a class="btn green-seagreen dropdown-toggle btn-rounded-right btn-sm btn-border" data-toggle="dropdown" href="#" id="32F">
														Eksport
														</a>
														<ul class="dropdown-menu pull-right">
															<li>
																<a href="#">
																Export to Excel </a>
															</li>
															<li>
																<a href="#">
																Export to CSV </a>
															</li>
															<li>
																<a href="#">
																Export to PDF </a>
															</li>
														</ul>
													</div> -->
												</div>
											</div>
											<div class="col-sm-3 pdg-search">
												<div class="input-group">
													<div class="input-icon">
														<i class="fa fa-search"></i>
														<input type="text" class="form-control input-rounded-left" id="keyword-front" value="<?php echo $keyw;?>">
													</div>
													<div class="input-group-btn">
														<button type="button" id="search-btn-role" class="btn btn-default advance-toggle  btn-rounded-right"><i class="fa fa-angle-down" id="search-icn-role"></i></button>
														
														<div class="advance-search-toggle" id="search-toggle-role" style="min-width:250px;display: none;">
															<div class="row">
																<div class="col-sm-12" style="margin:12px 5px 15px;padding-right: 23px;">
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Kata Kunci</label>
																		<div class="col-md-12">
																			<input type="text" class="form-control input-sm dropdown-input" id="keyword" placeholder="" value="<?php echo $keyw;?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-md-2" style="margin-top:10px;">
																			<input type="checkbox" class="form-control input-sm" id="chk_tgl" <?php if($is_date==1){ echo " checked";}?>>
																		</div>
																		<label class="col-md-10 control-label" style="margin-top:10px;color:#777;">Tanggal</label>
																		<div class="col-md-9">
																			<input type="date" class="form-control input-sm dropdown-input" id="tgl_mulai" placeholder="" <?php echo 'value="'.$start_date.'"'; if($is_date<> 1){ echo "disabled" ;}?>>
																		</div>
																		<label class="col-md-3 control-label" style="margin-top:10px;color:#777;">s/d</label>
																		<div class="col-md-9" style="margin-top:8px">
																			<input type="date" class="form-control input-sm dropdown-input" id="tgl_selesai" placeholder="" <?php echo 'value="'.$end_date.'"'; if($is_date<> 1){ echo "disabled" ;}?>>
																		</div>
																		<div class="col-md-3"></div>
																	</div>
																	<div class="form-group" style="display: none;">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Status</label>
																		<div class="col-md-12">
																			<select class="form-control input-sm dropdown-input" id="status_trans">
																				<option value="0" <?php if($status == 0){ echo "selected='selected'";}?>>ALL</option>
																				<option value="1" <?php if($status == 1){ echo "selected='selected'";}?>>Proses</option>
																				<option value="2" <?php if($status == 2){ echo "selected='selected'";}?>>Selesai</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-9 control-label" style="margin-top:10px;color:#777;">Tampilkan Semua User</label>
																		<div class="col-md-3" style="margin-top:10px;">
																			<input type="checkbox" class="form-control input-sm" id="is_user" <?php if($is_user==1){ echo " checked";}?>>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;padding: 3px 8px 0px 15px;text-align: right;">
																			<a class="" id="btn-rf-role" style="color:#777;text-decoration:none;">Hapus Filter</a>
																		</div>
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;color: #777;padding: 0px 15px 0px 0px;">
																			<a class="btn green-seagreen btn-rounded" style="display:block;" id="btn-sf-role">
																				Cari
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="tab-content" id="32A" style="display:none;">
											<div class="tab-pane fade active in" id="tab_2_1">
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<div class="table-actions-wrapper">
													</div>
													<table class="table table-hover" id="datatable_rolemnf">
														<thead class="thead-dark">
															<tr role="row" class="heading">
																<th width="1%" style="background-color: #1BA39C!important;">
																	<input type="checkbox" class="group-checkable checkall" onclick="calc();">
																</th>
																<th width="10%" style="background-color: #1BA39C!important;color:white!important;">
																	 Tgl.&nbsp;Proses
																</th>
																<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
																	 No.&nbsp;Proses
																</th>
																<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
																	 Keterangan
																</th>
															</tr>
															
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
											<div class="tab-pane fade" id="tab_2_2">
												<p id="myText"></p>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
			</div>
			<!-- END PAGE CONTENT -->
			
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	<?php
	    $this->load->view("_partials/quick_sidebar.php");
	?>
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<?php
    $this->load->view("_partials/footer.php");
?>
<script>
        jQuery(document).ready(function() {    
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            QuickSidebar.init(); // init quick sidebar
            Demo.init(); // init demo features
            
            Productlist.init();
            ProductlistSingle.init();
            RoleManufaktur.init();
            // TableEditableRoleMnf.init();
            
        });

        var is_valid = 1;
        var selectedRows = [];

        var countCheckedRoleMnf = function($table, checkboxClass) {
		  if ($table) {
		    // Find all elements with given class
		    var chkAll = $table.find(checkboxClass);
		    // Count checked checkboxes
		    var checked = chkAll.filter(':checked').length;
		    // Count total
		    var total = chkAll.length;    
		    // Return an object with total and checked values
		    return {
		      total: total,
		      checked: checked
		    }
		  }
		}

        function checkRoleMnf() {
		  var result = countCheckedRoleMnf($('#datatable_rolemnf'), '.chk-role');
		  
		  $('#myText').html(result.checked);
		  var p = document.getElementById('myText');
		  var text = p.textContent;
		  var number = Number(text);

		  if (number > 0){
		    btn_act.style.display = "block";
		  } else {
		    btn_act.style.display = "none";
		  }
		}

		function calc()
		{
			$('.checkall').click(function (event) {    
		        $('.chk-role').prop('checked', this.checked);
		        var $checkboxes = $('.chk-role');
		        var number = $checkboxes.filter(':checked').length;
		        
		        var p = document.getElementById('myText');
		  		
		        if (number > 0){
				    btn_act.style.display = "block";
				  } else {
				    btn_act.style.display = "none";
				  }
		    });
		}

		$(document).mouseup(function(e) 
		{
		    var container = $("#search-toggle-role");
		    var btn = $("#search-btn-role");
		    var icn = $("#search-icn-role");
		    var x = document.getElementById("search-toggle-role");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target) && !icn.is(e.target)) 
		    {
		        x.style.display = "none";
		    }else if(btn.is(e.target)|| icn.is(e.target)){
		    	
				if (x.style.display === "none") {
				  x.style.display = "block";
				} else {
				  x.style.display = "none";
				}
		    }
		});

		$('#32F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#32E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#32D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		function cae_rolemnf(id_role) {
			var x = document.getElementById("32C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				// Set data to Form Edit
				$('#id_role').val(id_role);

				$.ajax({
					url: "<?php echo base_url("manufacture/get_edit_data_role");?>",
					type: "POST",
					data: {
						id_role: id_role
					},
					cache: false,
					success: function(dataResult){
						// console.log(dataResult);
						var json_data = JSON.parse(dataResult);
						
						var tgl = json_data.parent_prod.trans_date;

						var today = tgl.replace(" ","T");

						$('#tgl_role').val(today);
						$('#no_role').val(json_data.parent_prod.trans_no);
						$('#ket_role').val(json_data.parent_prod.keterangan);

						$.uniform.update();

						$('#table_rolemnf').DataTable().destroy();
						fetch_detail_role();
					}
				});
				
				$('#add_rolemnf').modal('show');
			}
		}

		$('#32B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$.ajax({
					url: "<?php echo base_url("manufacture/getProsesRole");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						
						var now = new Date();
						var day = ("0" + now.getDate()).slice(-2);
						var month = ("0" + (now.getMonth() + 1)).slice(-2);
						var year = now.getFullYear();
						var hour = ''+now.getHours();
                		var minute = ''+now.getMinutes();
                		var second = now.getSeconds();
                		var today = (year)+"-"+(month)+"-"+(day)+"T"+(hour.padStart(2,"0"))+":"+(minute.padStart(2,"0"));

						$('#tgl_role').val(today);

						var mydate = $('#tgl_role').val();
						var dt = mydate.split("T");
						var tgl_inpt = new Date(dt[0]);
					    var hr = tgl_inpt.getDate();
					    var bln = tgl_inpt.getMonth() + 1;
					    var thn = tgl_inpt.getFullYear();

						var nopro = "HR-"+thn+bln+hr+"-00000#";
						$('#no_role').val(nopro);

						$('#add_rolemnf').modal('show');
					},
					error:function(){
					}
				});

				
			}		
		});

		var countChecked = function($table, checkboxClass) {
		  if ($table) {
		    // Find all elements with given class
		    var chkAll = $table.find(checkboxClass);
		    // Count checked checkboxes
		    var checked = chkAll.filter(':checked').length;
		    // Count total
		    var total = chkAll.length;    
		    // Return an object with total and checked values
		    return {
		      total: total,
		      checked: checked
		    }
		  }
		}
		
		function check(chk_val) {

		    var result = countChecked($('#datatable_productslist'), '.chk-prodml');

		    $('#myTextBb').html(result.checked);
		    $('#myTextBb').val(result.checked);
		    var p = document.getElementById('myTextBb');
		    var text = p.textContent;
		    var number = Number(text);

		    var set = jQuery(this).attr("data-set");
		    // var checked = jQuery(this).is(":checked");
		    var checked = $('.chk-prodml[value="'+chk_val+'"]').is(":checked");

		    jQuery(set).each(function () {
		        if (checked) {
		            $(this).attr("checked", true);
		            $(this).parents('tr').addClass("active");
		        } else {
		            $(this).attr("checked", false);
		            $(this).parents('tr').removeClass("active");
		        }
		    });
		    jQuery.uniform.update(set);

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
		}

		function fetch_detail_role(){
        	
			var dataTable = $('#table_rolemnf').DataTable({
				"processing" : true,
				"serverSide" : true,
				"filter": false,
		        "paging": false,
		        "ordering": false,
		        "info": false,
		        "searching":false,
				"order" : [],
				"ajax" : {
					url:"<?= base_url('manufacture/fetch_detail_role') ?>",
					type:"POST"
				}
			});
		}

		$(document).on('click', '#btn-productlistmp_search', function(e){
            e.preventDefault();
            var oTable = $('#datatable_productslist').DataTable();
            oTable.draw();
        });

        $(document).on('keydown', '#productlistmp_search', function(e){
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                var oTable = $('#datatable_productslist').DataTable();
                oTable.draw();
            }
        });

        function check_detail_role() {
			var tableData = [];

			var hasil = 0;

			$('#tbl_rolemnf_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "harga_satuan": $(tr).find('td:eq(3) div').text(),
			    "keterangan": $(tr).find('td:eq(4) div').text(),
			    "id_det" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			var hasEmptyColumn = false;
			if(tableData.length > 0){
				for (var i = 0; i < tableData.length; i++) {
				  if (
				    tableData[i].prod_code === "" ||
				    tableData[i].prod_name === "" ||
				    tableData[i].satuan === "" ||
				    tableData[i].harga_satuan === ""
				  ) {
				    hasEmptyColumn = true;
				    break;
				  }
				}

				if (hasEmptyColumn) {
					hasil = 1;
				  	return hasil;
				}
			}else{
				hasil = 11;
				return hasil;
			}
		}

		function save_tbl_temp() {
			var tableData = [];

			$('#tbl_rolemnf_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "harga_satuan": $(tr).find('td:eq(3) div').text(),
			    "keterangan": $(tr).find('td:eq(4) div').text(),
			    "id_det" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			$.ajax({
			url:"<?= base_url('manufacture/add_detail_role') ?>",
				method:"POST",
				data:{tableData: tableData},
				success:function(data){
				}
			});
		}

		$('#pilih_prod_ml').on("click", function(e) {
        	e.preventDefault();
        	
        	var brg_arr = [];

			// $(".chk-prodml:checked").each(function(){
			// 	var brgid = $(this).val();
			// 	brg_arr.push(brgid);

			// });
			brg_arr = selectedRows;

			var length = brg_arr.length;

			var id_role = $('#id_role').val();

			if(length > 0){
				console.log(brg_arr);
				$.ajax({
					url: "<?php echo base_url("manufacture/insert_detailrole");?>",
					type: "POST",
					data: {
						id_brg : brg_arr,
						id_role : id_role
					},
					cache: false,
					success: function(){

						$('#table_rolemnf').DataTable().destroy();
						fetch_detail_role();
					},
					error: function() {
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });
					}
				});	
			}
			
			selectedRows = [];

            var $t = $(this),
			target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

			$(target)
				.find('input[type="checkbox"], input[type="radio"]')
					.prop("checked", false)
					.change();

			var oTable = $('#datatable_productslist').dataTable();
			$('input[type="checkbox"]', oTable.fnGetNodes()).removeAttr('checked');

			$('#opt_all_ml').attr("checked", true);
			$('#opt_all_ml').closest('span').addClass('checked');
			$('#opt_brg_ml').attr("checked", false);
			$('#opt_brg_ml').closest('span').removeClass('checked');
			$('#opt_mnf_ml').attr("checked", false);
			$('#opt_mnf_ml').closest('span').removeClass('checked');

			$.uniform.update();

            $('#productlistmp_search').val('');

            $('#status_modal_sp').val('clear');

            var oTable = $('#datatable_productslist').DataTable();
            oTable.ajax.reload();

			$('#show_product').modal('hide');
        });

        $('#btl_prod_ml').on('click', function(e) {
        	e.preventDefault();

        	$('#status_modal_sp').val('clear');

        	selectedRows = [];

            var $t = $(this),
			target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

			$(target)
				.find('input[type="checkbox"], input[type="radio"]')
					.prop("checked", false)
					.change();

			$.uniform.update();

			$('#opt_all_ml').attr("checked", true);
			$('#opt_all_ml').closest('span').addClass('checked');
			$('#opt_brg_ml').attr("checked", false);
			$('#opt_brg_ml').closest('span').removeClass('checked');
			$('#opt_mnf_ml').attr("checked", false);
			$('#opt_mnf_ml').closest('span').removeClass('checked');

			var oTable = $('#datatable_productslist').DataTable();
			oTable.draw();

            $('#show_product').modal('hide');
        });

        $('#btn_prod_role').on('click', function(e) {
        	e.preventDefault();

        	$('#status_modal_sp').val('');

        	$('#opt_all_ml').attr("checked", true);
			$('#opt_all_ml').closest('span').addClass('checked');
			$('#opt_brg_ml').attr("checked", false);
			$('#opt_brg_ml').closest('span').removeClass('checked');
			$('#opt_mnf_ml').attr("checked", false);
			$('#opt_mnf_ml').closest('span').removeClass('checked');

        	selectedRows = [];

        	var oTable = $('#datatable_productslist').DataTable();
   //      	oTable.one('draw', function () {
			//   oTable.rows().nodes().to$().find('.chk-prodml[type="checkbox"]').prop('checked', false).each(function() {
			//     $(this).closest('span').removeClass('checked');
			//   });
			// });

			// var table = $('#datatable_productslist').DataTable();
			// table
			// 	.$('input.chk-prodml:checked')
			// 	.each(function () {
			//   		$(this).prop('checked', false);
			// 	});
			// table.draw(false);
			oTable.draw();
			// oTable.ajax.reload();

			$('#show_product').modal('show');

			// $('#btn-productlistmp_search').click();
        });

        // $(document).on('focusout', '.update-satuan', function(e){
        $(document).on('keyup', '.update-satuan', function(e){
			e.preventDefault();
			save_tbl_temp();
			var id = $(this).data('id');
			var column = $(this).data('column');
			var value = $(this).text();

			if(column == 'satuan'){
				var uom = $(this).data('uom');
				var uom2 = $(this).data('uom2');
				var uom3 = $(this).data('uom3');
				var kon1 = $(this).data('kon1');
				var kon2 = $(this).data('kon2');
				var kon3 = $(this).data('kon3');

				if (value == 1) {
					if(uom != ''){
						value = uom;
						konversi = parseInt(kon1);
					}else{
						return false;
					}
					
				}else if(value == 2){
					if(uom2 != ''){
						value = uom2;
						konversi = parseInt(kon2);
					}else{
						value = uom;
						konversi = parseInt(kon1);
					}
				}else if(value == 3){
					if(uom3 != ''){
						value = uom3;
						konversi = parseInt(kon3);
					}else{
						value = uom;
						konversi = parseInt(kon1);
					}
				}else{
					value = uom;
					konversi = parseInt(kon1);
				}	

				$.ajax({
					url:"<?= base_url('manufacture/update_detail_role') ?>",
					method:"POST",
					data:{
						id:id,
						column:column,
						value:value
					},
					success:function(data){
						
						$.ajax({
							url:"<?= base_url('manufacture/update_detail_role') ?>",
							method:"POST",
							data:{
								id:id,
								column:'konversi',
								value:konversi
							},
							success:function(data){		
							}
						});

						var element = $('[data-id="' + id + '"][data-column="' + column + '"]');
					    element.focus();
					    element.html(value);
						// $('#table_rolemnf').DataTable().destroy();
						// fetch_detail_role();
					}
				});
			}

			// else{
			// 	$.ajax({
			// 		url:"<?= base_url('manufacture/update_detail_role') ?>",
			// 		method:"POST",
			// 		data:{
			// 			id:id,
			// 			column:column,
			// 			value:value
			// 		},
			// 		success:function(data){
						
			// 			$('#table_rolemnf').DataTable().destroy();
			// 			fetch_detail_role();
			// 		}
			// 	});
			// }
		});

		$('#tgl_role').on('change', function() {
			
			var mydate = $('#tgl_role').val();
			var dt = mydate.split("T");
			var tgl_inpt = new Date(dt[0]);
		    var hr = tgl_inpt.getDate();
		    var bln = tgl_inpt.getMonth() + 1;
		    var thn = tgl_inpt.getFullYear();

			var nopro = "HR-"+thn+bln+hr+"-00000#";
			$('#no_role').val(nopro);

		});

        function save_role() {
        	var id_role = $('#id_role').val();
			var type = 1;

			if(id_role !=""){
				type = 2;
			}

			var date = $('#tgl_role').val();
			var ket = $('#ket_role').val();

			save_tbl_temp();

			var checkTbl = check_detail_role();

			if(checkTbl == 1){
				$("#btn-s-role").removeAttr("disabled");
				$("#btn-rs-role").removeAttr("disabled");
				$("#btn-r-role").removeAttr("disabled");
				$("#validation-role").show();
				$('#validation-role').html('Harap isi semua data yang dibutuhkan!');
				$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-role").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-role").removeAttr("disabled");
				$("#btn-rs-role").removeAttr("disabled");
				$("#btn-r-role").removeAttr("disabled");
				$("#validation-role").show();
				$('#validation-role').html('Detail Role masih kosong!');
				$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-role").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			if(date!=""){
				$("#btn-s-role").attr("disabled", "disabled");
				$("#btn-rs-role").attr("disabled", "disabled");
				$("#btn-r-role").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("manufacture/action_rolemnf");?>",
					type: "POST",
					data: {
						type: type,
						id_role : id_role,
						date: date,
						ket: ket
					},
					cache: false,
					success: function(dataResult){
						
						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){

							$("#btn-s-role").removeAttr("disabled");
							$("#btn-rs-role").removeAttr("disabled");
							$("#btn-r-role").removeAttr("disabled");
							$('#frm-bb').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	

			                is_valid = 1;		
						}else if(dataResult.statusCode==201){

							$("#btn-s-role").removeAttr("disabled");
							$("#btn-rs-role").removeAttr("disabled");
							$("#btn-r-role").removeAttr("disabled");
							$('#frm-bb').find('input:text').val('');
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	

			                $.uniform.update();

			                is_valid = 1;
						}else if(dataResult.statusCode==405){
							$("#btn-s-role").removeAttr("disabled");
							$("#btn-rs-role").removeAttr("disabled");
							$("#btn-r-role").removeAttr("disabled");
							alert('Barang sudah digunakan! Silahkan pilih bahan yang lain/hapus bahan sebelumnya!');
						}
					},
					error: function() {
						$("#btn-s-role").removeAttr("disabled");
						$("#btn-rs-role").removeAttr("disabled");
						$("#btn-r-role").removeAttr("disabled");
						$('#frm-bb').find('input:text').val('');
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });

		                $.uniform.update();
		                
					}
				});

			}else{
				if(date==""){
					$("#btn-s-role").removeAttr("disabled");
					$("#btn-rs-role").removeAttr("disabled");
					$("#btn-r-role").removeAttr("disabled");
					$("#validation-role").show();
					$('#validation-role').html('Tanggal transaksi harus diisi!');
					$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-role").slideUp(500);
	                });
				}else{
					$("#btn-s-role").removeAttr("disabled");
					$("#btn-rs-role").removeAttr("disabled");
					$("#btn-r-role").removeAttr("disabled");
					$("#validation-role").show();
					$('#validation-role').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-role").slideUp(500);
	                });
				}

                is_valid = 0;
			}
        }

		$('#btn-s-role').on('click', function(e) {
			e.preventDefault();

			var date = $('#tgl_role').val();
			var ket = $('#ket_role').val();

			var checkTbl = check_detail_role();

			if(checkTbl == 1){
				$("#btn-s-role").removeAttr("disabled");
				$("#btn-rs-role").removeAttr("disabled");
				$("#btn-r-role").removeAttr("disabled");
				$("#validation-role").show();
				$('#validation-role').html('Harap isi semua data yang dibutuhkan!');
				$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-role").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-role").removeAttr("disabled");
				$("#btn-rs-role").removeAttr("disabled");
				$("#btn-r-role").removeAttr("disabled");
				$("#validation-role").show();
				$('#validation-role').html('Detail Role masih kosong!');
				$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-role").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			if(date!=""){
				save_role();

				$('#add_rolemnf').modal('hide');
				$.uniform.update();		
				
				setTimeout(function(){
				   window.location.reload();
				}, 2100);
			}else{
				if(date==""){
					$("#btn-s-role").removeAttr("disabled");
					$("#btn-rs-role").removeAttr("disabled");
					$("#btn-r-role").removeAttr("disabled");
					$("#validation-role").show();
					$('#validation-role').html('Tanggal transaksi harus diisi!');
					$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-role").slideUp(500);
	                });
				}else{
					$("#btn-s-role").removeAttr("disabled");
					$("#btn-rs-role").removeAttr("disabled");
					$("#btn-r-role").removeAttr("disabled");
					$("#validation-role").show();
					$('#validation-role').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-role").slideUp(500);
	                });
				}

                is_valid = 0;
			}
			
		});

		$('#btn-r-role').on('click', function(e) {
			e.preventDefault();
			
			var id_role = $('#id_role').val();

			if(id_role == ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_all_detail_role");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#table_rolemnf').DataTable().destroy();
						fetch_detail_role();

					},
					error:function(){
					}
				});
			}

			var $t = $(this),
			target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

			$(target)
				.find('input,textarea,select')
					.val('')
					.end()
				.find('input[type="checkbox"], input[type="radio"]')
					.prop("checked", false)
					.change();

			$.uniform.update();

			$.ajax({
				url: "<?php echo base_url("manufacture/getProsesRole");?>",
				type: "POST",
				data: {},
				cache: false,
				success: function(){
					
					var now = new Date();
					var day = ("0" + now.getDate()).slice(-2);
					var month = ("0" + (now.getMonth() + 1)).slice(-2);
					var year = now.getFullYear();
					var hour = ''+now.getHours();
            		var minute = ''+now.getMinutes();
            		var second = now.getSeconds();
            		var today = (year)+"-"+(month)+"-"+(day)+"T"+(hour.padStart(2,"0"))+":"+(minute.padStart(2,"0"));

					$('#tgl_role').val(today);
					console.log(today);

					var mydate = $('#tgl_role').val();
					var dt = mydate.split("T");
					var tgl_inpt = new Date(dt[0]);
				    var hr = tgl_inpt.getDate();
				    var bln = tgl_inpt.getMonth() + 1;
				    var thn = tgl_inpt.getFullYear();

					var nopro = "HR-"+thn+bln+hr+"-00000#";
					$('#no_role').val(nopro);

				},
				error:function(){
				}
			});
		});

		$('#btn-rs-role').on('click', function(e) {
			e.preventDefault();
			save_role();

			var id_role = $('#id_role').val();

			var checkTbl = check_detail_role();

			if(checkTbl == 1){
				$("#btn-s-role").removeAttr("disabled");
				$("#btn-rs-role").removeAttr("disabled");
				$("#btn-r-role").removeAttr("disabled");
				$("#validation-role").show();
				$('#validation-role').html('Harap isi semua data yang dibutuhkan!');
				$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-role").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-role").removeAttr("disabled");
				$("#btn-rs-role").removeAttr("disabled");
				$("#btn-r-role").removeAttr("disabled");
				$("#validation-role").show();
				$('#validation-role').html('Detail Role masih kosong!');
				$("#validation-role").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-role").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			if(id_role == ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_all_detail_role");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#table_rolemnf').DataTable().destroy();
						fetch_detail_role();
					},
					error:function(){
					}
				});
			}

			if(is_valid != 0){
				$("#validation-s-role").show();
				$('#validation-s-role').html('Data berhasil ditambahkan!');
				$("#validation-s-role").fadeTo(2000, 500).slideUp(500, function() {
	            	$("#validation-s-role").slideUp(500);
	            });

				$.ajax({
					url: "<?php echo base_url("manufacture/getProsesRole");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						var $t = $(this),
						target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

						$(target)
							.find("input,textarea,select")
								.val('')
								.end()
							.find("input[type=checkbox], input[type=radio]")
								.prop("checked", "")
								.end();
						$.uniform.update();

						var now = new Date();
						var day = ("0" + now.getDate()).slice(-2);
						var month = ("0" + (now.getMonth() + 1)).slice(-2);
						var year = now.getFullYear();
						var hour = ''+now.getHours();
                		var minute = ''+now.getMinutes();
                		var second = now.getSeconds();
                		var today = (year)+"-"+(month)+"-"+(day)+"T"+(hour.padStart(2,"0"))+":"+(minute.padStart(2,"0"));

						$('#tgl_role').val(today);
						console.log(today);

						var mydate = $('#tgl_role').val();
						var dt = mydate.split("T");
						var tgl_inpt = new Date(dt[0]);
					    var hr = tgl_inpt.getDate();
					    var bln = tgl_inpt.getMonth() + 1;
					    var thn = tgl_inpt.getFullYear();

						var nopro = "HR-"+thn+bln+hr+"-00000#";
						$('#no_role').val(nopro);

					},
					error:function(){
					}
				});
			}
		});

		$('#btn-b-role').on('click', function(e) {
			e.preventDefault();
			var id_role = $('#id_role').val();
			// if(id_brg == ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_all_detail_role");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#table_rolemnf').DataTable().destroy();
						fetch_detail_role();
					},
					error:function(){
					}
				});
			// }

			var $t = $(this),
			target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

			$(target)
				.find('input,textarea,select')
					.val('')
					.end()
				.find('input[type="checkbox"], input[type="radio"]')
					.prop("checked", false)
					.change();

			$.uniform.update();
			$('#add_rolemnf').modal('hide');
		});

		$(document).on('click', '.delete', function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			console.log(id);
			$.ajax({
				url:"<?= base_url('manufacture/delete_role_detail') ?>",
				method:"POST",
				data:{
					id_det:id
				},
				success:function(data){
					// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
					$('#table_rolemnf').DataTable().destroy();
					fetch_detail_role();
				}
			});
			// setInterval(function(){
			// 	$('#alert_message').html('');
			// }, 5000);
			// }
		});

		$('#chk_tgl').on('change', function(e) {
			e.preventDefault();
			document.getElementById('tgl_mulai').disabled = !this.checked;
			document.getElementById('tgl_selesai').disabled = !this.checked;
		});

		//function search akses
		function search_role() {
			var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}

			var is_date = $("#chk_tgl").prop("checked");
			var start_date = $("#tgl_mulai").val();
        	var end_date = $("#tgl_selesai").val();
        	var status = $("#status_trans").val();
        	var is_user = $("#is_user").prop("checked");

        	if(is_user == true){
        		is_user = 1;
        	}else{
        		is_user = 0;
        	}

			if(is_date == true){
        		is_date = 1;
        	}else{
        		is_date = 0;
        	}        	

			var urlist = "<?php echo base_url('manufacture/role');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_date + "/" + start_date + "/" + end_date + "/" + status + "/" + is_user + "/"
		    );
		    location.href = url.href;
		}

		$('#btn-rf-role').on('click', function(e) {
			var now = new Date();
			var day = ("0" + now.getDate()).slice(-2);
			var month = ("0" + (now.getMonth() + 1)).slice(-2);
			var year = now.getFullYear();
    		var today = (year)+"-"+(month)+"-"+(day);

			$('#chk_tgl').prop("checked", false);
			$('#keyword').val("");
			$('#keyword-front').val("");
			$("#tgl_mulai").val(today);
        	$("#tgl_selesai").val(today);
        	$("#status").val("");
        	$("#is_user").prop("checked", false);

			$.uniform.update();

			search_role();

		});

		//action btn cari
		$('#btn-sf-role').on('click', function(e) {
			search_role();
		});

		//action ketika enter search bar
		$("#keyword-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-front").val();
		    	$("#keyword").val(keyword);
		        search_role();
		    }
		});

		//action btn arsip
		$('#btn-a-akses').on('click', function() {
			// Get userid from checked checkboxes
				var id_arr = [];
				$(".chk-role:checked").each(function(){
					var roleid = $(this).val();

					id_arr.push(roleid);
				});

				// Array length
				var length = id_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("manufacture/action_rolemnf");?>",
						type: "POST",
						data: {
							type: 4,
							id_role : id_arr
						},
						cache: false,
						success: function(dataResult){

							var dataResult = JSON.parse(dataResult);
							if(dataResult.statusCode==202){
							    $("#success").show();
								$('#success').html('Data berhasil diarsipkan!');
								$("#success").fadeTo(1500, 500).slideUp(500, function() {
				                	$("#success").slideUp(500);
				                });
							}
						},
						error: function() {
							$("#failed").show();
							$('#failed').html('Gagal melakukan aksi!');
							$("#failed").fadeTo(2000, 500).slideUp(500, function() {
			                	$("#failed").slideUp(500);
			                });
						}
					});
					$('#del_akses').modal('hide');

					setTimeout(function(){
					   window.location.reload();
					}, 1600);
				}
		});

		//btn delete item
		$('#btn-h-akses').on('click', function() {
			// Get userid from checked checkboxes
				var id_arr = [];
				$(".chk-role:checked").each(function(){
					var roleid = $(this).val();

					id_arr.push(roleid);
				});

				// Array length
				var length = id_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("manufacture/action_rolemnf");?>",
						type: "POST",
						data: {
							type: 3,
							id_role : id_arr
						},
						cache: false,
						success: function(dataResult){

							var dataResult = JSON.parse(dataResult);
							if(dataResult.statusCode==202){
							    $("#success").show();
								$('#success').html('Data berhasil dihapus!');
								$("#success").fadeTo(1500, 500).slideUp(500, function() {
				                	$("#success").slideUp(500);
				                });
							}
						},
						error: function() {
							$("#failed").show();
							$('#failed').html('Gagal melakukan aksi!');
							$("#failed").fadeTo(2000, 500).slideUp(500, function() {
			                	$("#failed").slideUp(500);
			                });
						}
					});
					$('#del_akses').modal('hide');

					setTimeout(function(){
					   window.location.reload();
					}, 1600);
				}
		});

		$(document).on('click', '#btn-c-role', function(e){
		 	e.preventDefault();
		 	var id_role = $('#id_role').val();
			var urlist = "<?php echo base_url('manufacture/print_role_pdf');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + id_role + "/"
		    ); 
		 	window.open(url);
		});

</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>