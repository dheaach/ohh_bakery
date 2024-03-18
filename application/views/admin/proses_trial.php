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
					<div class="col-sm-10">
						<h3 class="page-title font-green-seagreen">
						<strong>Daftar Proses Trial</strong>
						</h3>
					</div>
					<div class="add-product-nav col-sm-2">
						<a class="btn btn-sm green-seagreen" data-toggle="modal" id="41B"><i class="fa fa-plus"></i> Trial Baru</a>
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
						<a href="<?php echo base_url('manufacture/proses');?>">Proses Trial</a>
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
																		echo"<strong>".$ua->hasil." Proses</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Trial Aktif</strong>
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
																		echo"<strong>".$ua->hasil." Proses</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Trial Batal</strong>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="btn-group" id="btn_act" style="display:none;">
													<a class="btn green-seagreen dropdown-toggle btn-rounded btn-sm btn-border btn-actcl" data-toggle="dropdown" href="#" id="41D">
													Aksi
													</a>
													<ul class="dropdown-menu pull-left dropdown-action">
														<!-- <li>
															<a class="user-target" data-toggle="modal" href="#ars_akses">
															Arsip </a>
														</li> -->
														<li>
															<a class="user-target" data-toggle="modal" href="#del_akses">
															Hapus </a>
														</li>
													</ul>
												</div>
											</div>
											<div class="col-sm-3 pdg-btn">
												<div class="btn-group">
													<!-- <a class="btn green-seagreen btn-sm btn-rounded-left btn-border" id="41E">
														Import
													</a>
													<div class="btn-group">
														<a class="btn green-seagreen dropdown-toggle btn-rounded-right btn-sm btn-border" data-toggle="dropdown" href="#" id="41F">
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
														<button type="button" id="search-btn-trial" class="btn btn-default advance-toggle  btn-rounded-right"><i class="fa fa-angle-down" id="search-icn-trial"></i></button>
														
														<div class="advance-search-toggle" id="search-toggle-trial" style="min-width:250px;display: none;">
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
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Status</label>
																		<div class="col-md-12">
																			<select class="form-control input-sm dropdown-input" id="status_trans">
																				<option value="0" <?php if($status == 0){ echo "selected='selected'";}?>>ALL</option>
																				<option value="1" <?php if($status == 1){ echo "selected='selected'";}?>>Aktif</option>
																				<option value="2" <?php if($status == 2){ echo "selected='selected'";}?>>Batal</option>
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
																			<a class="" id="btn-rf-trial" style="color:#777;text-decoration:none;">Hapus Filter</a>
																		</div>
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;color: #777;padding: 0px 15px 0px 0px;">
																			<a class="btn green-seagreen btn-rounded" style="display:block;" id="btn-sf-trial">
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
										
										<div class="tab-content" id="41A" style="display:none;">
											<div class="tab-pane fade active in" id="tab_2_1">
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<div class="table-actions-wrapper">
													</div>
													<table class="table table-hover" id="datatable_prosesmnf_trial">
														<thead class="thead-dark">
															<tr role="row" class="heading">
																<th width="1%" style="background-color: #1BA39C!important;">
																	<input type="checkbox" class="group-checkable checkall" onclick="calc();">
																</th>
																<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
																	 Tgl.&nbsp;Proses
																</th>
																<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
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
            ProductlistSingleBb.init();
            ProsesTrial.init()
            
        });

        var is_valid = 1;
        var selectedRows = [];

        var result_tf_reff = '';

        let prevent = function (e) {
	        e.preventDefault();
	        e.stopPropagation();
	    };

        var countCheckedProsesTrial = function($table, checkboxClass) {
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

        function checkProsesTrial() {
		  var result = countCheckedProsesTrial($('#datatable_prosesmnf_trial'), '.chk-trial');
		  
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
		        $('.chk-trial').prop('checked', this.checked);
		        var $checkboxes = $('.chk-trial');
		        var number = $checkboxes.filter(':checked').length;
		        
		        var p = document.getElementById('myText');
		  		
		        if (number > 0){
				    btn_act.style.display = "block";
				  } else {
				    btn_act.style.display = "none";
				  }
		    });
		}

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

		$(document).mouseup(function(e) 
		{
		    var container = $("#search-toggle-trial");
		    var btn = $("#search-btn-trial");
		    var icn = $("#search-icn-trial");
		    var x = document.getElementById("search-toggle-trial");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target) && !icn.is(e.target)) 
		    {
		        x.style.display = "none";
		    }else if(btn.is(e.target) || icn.is(e.target)){
		    	
				if (x.style.display === "none") {
				  x.style.display = "block";
				} else {
				  x.style.display = "none";
				}
		    }
		});

		$('#41F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#41E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#41D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		function cae_prosestrial(id_trial) {
			var x = document.getElementById("41C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				let sat = 0;
				let pak = 0;
				let but = 0;
				let hj = 0;
				let st = 0;

				$('#id_trial').val();

				$.ajax({
					url: "<?php echo base_url("manufacture/get_edit_data_trial");?>",
					type: "POST",
					data: {
						id_trial: id_trial
					},
					cache: false,
					success: function(dataResult){
						var json_data = JSON.parse(dataResult);
						var tgl = json_data.parent_prod.trans_date;
						var today = tgl.replace(" ","T");

						$('#tgl_trial').val(today);
						$('#no_trial').val(json_data.parent_prod.trans_no);
						$('#id_trial').val(json_data.parent_prod.trans_no);
						$('#no_bb_trial').val(json_data.parent_prod.no_bb);
						if(json_data.parent_prod.is_adj == 0 ){
							$('#chk_adjust_qty_trial').prop('checked', false);
						}else{
							$('#chk_adjust_qty_trial').prop('checked', true);
						}
						$('#ket_trial').val(json_data.parent_prod.ket_mnf);
						$('#ket_bb_trial').val(json_data.parent_prod.ket_mnf);
						$('#gud_trial').val(json_data.parent_prod.gud_no);

						$.uniform.update();

						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb();
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();

						sat = json_data.child_prod.qty_satuan;
						pak = json_data.child_prod.qty_pakai;
						but = json_data.child_prod.qty_butuh;
						hj = json_data.child_prod.harga_jual;
						st = json_data.child_prod.sub_total;

						$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
						$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
						$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
						$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
						$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
					}
				});

				if(id_trial != ''){
					var x = document.getElementById("btn-pm-tr");
					x.style.display = "unset";
				}

				$('#add_prosestrial').modal('show');
			}
		}

		$('#tgl_trial').on('change', function() {

			var mydate = $('#tgl_trial').val();
			var dt = mydate.split("T");
			var tgl_inpt = new Date(dt[0]);
		    var hr = tgl_inpt.getDate();
		    var bln = tgl_inpt.getMonth() + 1;
		    var thn = tgl_inpt.getFullYear();

			var nopro = "PRD"+thn+bln+hr+"-00000#";
			$('#no_trial').val(nopro);

		});

		$('#41B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$.ajax({
					url: "<?php echo base_url("manufacture/getProsesTrial");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$.ajax({
							url: "<?php echo base_url("manufacture/getGud");?>",
							type: "POST",
							data: {},
							cache: false,
							success: function(dataResult){
								var json_data = JSON.parse(dataResult);
								var gud_no = json_data.gud_no;

								$('#gud_trial').val(gud_no);

							}
						});
						
						var now = new Date();
						var day = ("0" + now.getDate()).slice(-2);
						var month = ("0" + (now.getMonth() + 1)).slice(-2);
						var year = now.getFullYear();
						var hour = ''+now.getHours();
                		var minute = ''+now.getMinutes();
                		var second = now.getSeconds();
                		var today = (year)+"-"+(month)+"-"+(day)+"T"+(hour.padStart(2,"0"))+":"+(minute.padStart(2,"0"));

						$('#tgl_trial').val(today);
						// console.log(today);

						var mydate = $('#tgl_trial').val();
						var dt = mydate.split("T");
						var tgl_inpt = new Date(dt[0]);
					    var hr = tgl_inpt.getDate();
					    var bln = tgl_inpt.getMonth() + 1;
					    var thn = tgl_inpt.getFullYear();

						var nopro = "PRD"+thn+bln+hr+"-00000#";
						$('#no_trial').val(nopro);

						$('#add_prosestrial').modal('show');
					},
					error:function(){
					}
				});
			}		
		});

		function check_detail_bb() {
			var tableData = [];

			var hasil = 0;

			$('#tbl_bb_trial_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "qty_satuan": $(tr).find('td:eq(3) div').text(),
			    "harga_last": $(tr).find('td:eq(4) div').text(),
			    "det_total1": $(tr).find('td:eq(5) div').text(),
			    "qty_kemasan": $(tr).find('td:eq(7) div').text(),
			    "qty_pemakaian": $(tr).find('td:eq(8) div').text(),
			    "qty_dibutuhkan": $(tr).find('td:eq(9) div').text(),
			    "harga_jual": $(tr).find('td:eq(10) div').text(),
			    "det_total2": $(tr).find('td:eq(11) div').text(),
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
				    tableData[i].qty_satuan === "" ||
				    tableData[i].qty_pemakaian === "" ||
				    tableData[i].qty_dibutuhkan === "" ||
				    tableData[i].qty_kemasan === ""
				  ) {
				    hasEmptyColumn = true;
					console.log(`Empty column found at index ${i}:`);
					Object.entries(tableData[i]).forEach(([key, value]) => {
					  if (value === "") {
					    console.log(`${key}: ${value}`);
					  }
					});
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

		function check_detail_mnf() {
			var tableData = [];

			var hasil = 0;

			$('#tbl_prosestrial_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "qty_satuan": $(tr).find('td:eq(3) div').text(),
			    "jenis_brg": $(tr).find('td:eq(4) div').text(),
			    "qty_kemasan": $(tr).find('td:eq(6) div').text(),
			    "harga_jual": $(tr).find('td:eq(7) div').text(),
			    "det_total2": $(tr).find('td:eq(8) div').text(),
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
				    tableData[i].qty_satuan === "" ||
				    tableData[i].jenis_brg === "" ||
				    tableData[i].qty_kemasan === "" 
				  ) {
				    hasEmptyColumn = true;
					console.log(`Empty column found at index ${i}:`);
					Object.entries(tableData[i]).forEach(([key, value]) => {
					  if (value === "") {
					    console.log(`${key}: ${value}`);
					  }
					});
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

		function save_tbl_temp_bb() {
			var tableData = [];

			$('#tbl_bb_trial_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "qty_satuan": $(tr).find('td:eq(3) div').text(),
			    "harga_last": $(tr).find('td:eq(4) div').text(),
			    "det_total1": $(tr).find('td:eq(5) div').text(),
			    "qty_kemasan": $(tr).find('td:eq(7) div').text(),
			    "qty_pemakaian": $(tr).find('td:eq(8) div').text(),
			    "qty_dibutuhkan": $(tr).find('td:eq(9) div').text(),
			    "harga_jual": $(tr).find('td:eq(10) div').text(),
			    "det_total2": $(tr).find('td:eq(11) div').text(),
			    "id_det" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			$.ajax({
			url:"<?= base_url('manufacture/add_detail_mnf_bb') ?>",
				method:"POST",
				data:{
					tableData: tableData,
					type : 4
				},
				success:function(data){
				}
			});
		}

		function save_tbl_temp_mnf() {
			var tableData = [];

			$('#tbl_prosestrial_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "qty_satuan": $(tr).find('td:eq(3) div').text(),
			    "jenis_brg": $(tr).find('td:eq(4) div').text(),
			    "qty_kemasan": $(tr).find('td:eq(6) div').text(),
			    "harga_jual": $(tr).find('td:eq(7) div').text(),
			    "det_total2": $(tr).find('td:eq(8) div').text(),
			    "id_det" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			$.ajax({
			url:"<?= base_url('manufacture/add_detail_mnf') ?>",
				method:"POST",
				data:{
					tableData: tableData,
					type : 4
				},
				success:function(data){
				}
			});
		}

		function fetch_detail_bb(tipe='', tbl = '', id = '') {
			var id_reff = $('#id_reff').val();
			var type = 0;
			
			if(id_reff != ""){
				type = 1;
			}

			var dataTable = $('#tbl_bb_trial').DataTable({
				"processing" : true,
				"serverSide" : true,
				"filter": false,
		        "paging": false,
		        "ordering": false,
		        "info": false,
		        "searching":false,
				"order" : [],
				"ajax" : {
					url:"<?= base_url('manufacture/fetch_bb_trial') ?>",
					type:"POST",
					data :{
						type : type
					}
				},
				"drawCallback": function () {
					if(tipe == "qty" && tbl == "bb"){
						set_focus_qty(tbl,id);
					}
				}
			});
		}

		function fetch_detail_mnf(tipe='', tbl = '', id = '') {
			var id_reff = $('#id_reff').val();
			var type = 0;

			if(id_reff != ""){
				type = 1;
			}

			var dataTable = $('#tbl_prosestrial').DataTable({
				"processing" : true,
				"serverSide" : true,
				"filter": false,
		        "paging": false,
		        "ordering": false,
		        "info": false,
		        "searching":false,
				"order" : [],
				"ajax" : {
					url:"<?= base_url('manufacture/fetch_proses_trial') ?>",
					type:"POST",
					data :{
						type : type
					}
				},
				"drawCallback": function () {
					if(tipe == "qty" && tbl == "bb"){
						set_focus_qty(tbl,id);
					}
				}
			});
		}

		function set_focus_qty(tbl,id) {
			if(tbl == "mnf"){
				var element = $('.update-qty-mnf[data-id="' + id + '"][data-column="qty_satuan"]');
				element.focus();
			}else if(tbl == "bb"){
				var element = $('.update-qty-bb[data-id="' + id + '"][data-column="qty_satuan"]');
				element.focus();
			}
		}

		function get_bahan_baku(id_bb) {
			var tgl = $('#tgl_trial').val();

			$.ajax({
					url: "<?php echo base_url("manufacture/get_bb_trial");?>",
					type: "POST",
					data: {
						id_bb: id_bb,
						tgl : tgl
					},
					cache: false,
					success: function(dataResult){
						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb();

						$.ajax({
							url: "<?php echo base_url("manufacture/get_qty_cal");?>",
							type: "POST",
							data: {
								kode : 4
							},
							cache: false,
							success: function(dataResult){
								var dataResult = JSON.parse(dataResult);
								sat = dataResult.qty_satuan;
								pak = dataResult.qty_pakai;
								but = dataResult.qty_butuh;
								hj = dataResult.harga_jual;
								st = dataResult.sub_total;

								$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
								$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
								$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
								$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
								$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
							},
							error:function(){
							}
						});
					}
				});
			
			var oTable = $('#datatable_productslistsinglebb').DataTable();
			oTable.ajax.reload();
			
		}

		function getBbNo(id_bb,e) {

    		e.preventDefault();
    		let sat = 0;
    		let pak = 0;
    		let but = 0;
    		let hj = 0;
    		let st = 0;

    		$.ajax({
				url: "<?php echo base_url("product/getBb");?>",
				type: "POST",
				data: {
					id_bb : id_bb
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					$('#no_bb_trial').val(dataResult.no_bb);
					$('#ket_bb_trial').val(dataResult.keterangan);
					$('#ket_trial').val(dataResult.keterangan);

					get_bahan_baku(id_bb);
				},
				error:function(){
				}
			});

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
			$('#show_product_single_bb').modal('hide');

			// return false;

			
    	}

    	$(document).on('click', '.delete-bb', function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			var tbl = "bb";
			// console.log(id);
			$.ajax({
				url:"<?= base_url('manufacture/delete_bb_trial') ?>",
				method:"POST",
				data:{
					id_det:id,
					tbl : tbl
				},
				success:function(dataResult){
					// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
					$('#tbl_bb_trial').DataTable().destroy();
					fetch_detail_bb();

					var dataResult = JSON.parse(dataResult);
					let sat = dataResult.qty_satuan;
					let pak = dataResult.qty_pakai;
					let but = dataResult.qty_butuh;
					let hj = dataResult.harga_jual;
					let st = dataResult.sub_total;

					$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
					$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
					$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
					$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
					$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
				}
			});
		});

		$(document).on('keypress', '.update-bb-harga', function(e){
			var keyCode = e.which;
			if(keyCode == 13){
				e.preventDefault();

				save_tbl_temp_bb();

				var id = $(this).data('id');
				var column = $(this).data('column');
				var value = $(this).text();
				var tbl = "bb";
				var bb_no = $('#no_bb_trial').val();

				$.ajax({
					url:"<?= base_url('manufacture/update_bb_trial') ?>",
					method:"POST",
					data:{
						id:id,
						column:column,
						value:value,
						tbl : tbl,
						bb_no : bb_no
					},
					success:function(data){
						var element = $('[data-id="' + id + '"][data-column="' + column + '"]');
						var qty = $('[data-id="' + id + '"][data-column="qty_satuan"]').text();
						var el_sub = $('[data-id="' + id + '"][data-column="det_total1"]');
						var hasil = parseFloat(qty) * parseFloat(value);

					    element.html(value);
					    el_sub.html(hasil);
					    element.focus();
					}
				});
			}
			
		});

		// $(document).on('focusout', '.update-bb', function(e){
		$(document).on('keyup', '.update-bb-satuan', function(e){
			e.preventDefault();

			save_tbl_temp_bb();

			var id = $(this).data('id');
			var column = $(this).data('column');
			var value = $(this).text();
			var tbl = "bb";
			var bb_no = $('#no_bb_trial').val();

			// console.log(id);
			// console.log(column);
			// console.log(value);

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
					url:"<?= base_url('manufacture/update_bb_trial') ?>",
					method:"POST",
					data:{
						id:id,
						column:column,
						value:value,
						tbl : tbl,
						bb_no : bb_no
					},
					success:function(data){
						// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$.ajax({
							url:"<?= base_url('manufacture/update_bb_trial') ?>",
							method:"POST",
							data:{
								id:id,
								column:'konversi',
								value:konversi,
								tbl: tbl,
								bb_no : bb_no
							},
							success:function(data){		
							}
						});

						var element = $('[data-id="' + id + '"][data-column="' + column + '"]');
					    element.focus();
					    element.html(value);

						// $('#tbl_bb_trial').DataTable().destroy();
						// fetch_detail_bb();
					}
				});
			}
			// else{
			// 	$.ajax({
			// 		url:"<?= base_url('manufacture/update_bb_trial') ?>",
			// 		method:"POST",
			// 		data:{
			// 			id:id,
			// 			column:column,
			// 			value:value,
			// 			tbl : tbl,
			// 			bb_no : bb_no
			// 		},
			// 		success:function(data){
			// 			// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
			// 			$('#tbl_bb_trial').DataTable().destroy();
			// 			fetch_detail_bb();
			// 		}
			// 	});
			// }
		});

		$(document).on('click', '.delete-mnf', function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			var tbl = "mnf";
			// console.log(id);
			$.ajax({
				url:"<?= base_url('manufacture/delete_bb_trial') ?>",
				method:"POST",
				data:{
					id_det:id,
					tbl : tbl
				},
				success:function(data){
					// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
					$('#tbl_prosestrial').DataTable().destroy();
					fetch_detail_mnf();
				}
			});
		});

		// $(document).on('focusout', '.update-mnf', function(e){
		$(document).on('keyup', '.update-mnf-satuan', function(e){
			e.preventDefault();

			save_tbl_temp_mnf();

			var id = $(this).data('id');
			var column = $(this).data('column');
			var value = $(this).text();
			var tbl = "mnf";
			var bb_no = $('#no_bb_trial').val();

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
					url:"<?= base_url('manufacture/update_bb_trial') ?>",
					method:"POST",
					data:{
						id:id,
						column:column,
						value:value,
						tbl : tbl,
						bb_no : bb_no
					},
					success:function(data){
						// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$.ajax({
							url:"<?= base_url('manufacture/update_bb_trial') ?>",
							method:"POST",
							data:{
								id:id,
								column:'konversi',
								value:konversi,
								tbl : tbl,
								bb_no : bb_no
							},
							success:function(data){		
							}
						});

						var element = $('[data-id="' + id + '"][data-column="' + column + '"]');
					    element.focus();
					    element.html(value);

						// $('#tbl_prosestrial').DataTable().destroy();
						// fetch_detail_mnf();
					}
				});
			}else if(column == 'jenis_brg'){

				if (value == "1") {
					value = "Rote";
				}else if(value == "2") {
					value = "Produksi";
				}else{
					value = "Rote"
				}

				$.ajax({
					url:"<?= base_url('manufacture/update_bb_trial') ?>",
					method:"POST",
					data:{
						id:id,
						column:column,
						value:value,
						tbl : tbl,
						bb_no : bb_no
					},
					success:function(data){
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();
					}
				});
			}else{
				$.ajax({
					url:"<?= base_url('manufacture/update_bb_trial') ?>",
					method:"POST",
					data:{
						id:id,
						column:column,
						value:value,
						tbl : tbl,
						bb_no : bb_no
					},
					success:function(data){
						// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();

						if(column = 'qty_satuan'){
							$('#tbl_bb_trial').DataTable().destroy();
							fetch_detail_bb();
						}
					}
				});
			}
		});

		function save_pm() {
        	var id_trial = $('#id_trial').val();
        	var no_reff = $('#id_reff').val();

			var type = 1;

			if(id_trial !=""){
				type = 2;
			}

			if(no_reff != ""){
				type = 12;
			}

			var date = $('#tgl_trial').val();
			var no_bb = $('#no_bb_trial').val();
			var is_adj = $('#chk_adjust_qty_trial').prop('checked');
			var ket = $('#ket_trial').val();
			var ket_bb = $('#ket_bb_trial').val();
			var gud_trial = $('#gud_trial').val();
			var gud_trial_name = $("#gud_trial option:selected").text();
			var kat = $('#kat_brg').val();

			console.log("tipe transaksi", type);
			console.log("id_reff", no_reff);

			save_tbl_temp_mnf();
			save_tbl_temp_bb();

			var checkTbl = check_detail_bb();

			if(checkTbl == 1){
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Harap isi semua data yang dibutuhkan pada detail Bahan Baku!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Detail Bahan Baku masih kosong!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			var checkTbl2 = check_detail_mnf();

			if(checkTbl2 == 1){
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Harap isi semua data yang dibutuhkan pada detail Manufaktur!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl2 == 11) {
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Detail Manufaktur masih kosong!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			if(date !="" && no_bb!=""){
				$("#btn-s-tr").attr("disabled", "disabled");
				$("#btn-rs-tr").attr("disabled", "disabled");
				$("#btn-r-tr").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("manufacture/action_prosestrial");?>",
					type: "POST",
					data: {
						type: type,
						id_trial : id_trial,
						date: date,
						no_bb: no_bb,
						is_adj: is_adj,
						ket_bb: ket_bb,
						ket: ket,
						gud_trial : gud_trial,
						gud_trial_name : gud_trial_name,
						kat_id : kat,
						no_reff : no_reff
					},
					cache: false,
					success: function(dataResult){
						
						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){

							$("#btn-s-tr").removeAttr("disabled");
							$("#btn-rs-tr").removeAttr("disabled");
							$("#btn-r-tr").removeAttr("disabled");
							$('#frm-tr').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	
							is_valid = 1;
			                			
						}else if(dataResult.statusCode==201){

							$("#btn-s-tr").removeAttr("disabled");
							$("#btn-rs-tr").removeAttr("disabled");
							$("#btn-r-tr").removeAttr("disabled");
							$('#frm-tr').find('input:text').val('');
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	

			                $.uniform.update();
			                is_valid = 1;
						}else if(dataResult.statusCode==405){
							$("#btn-s-tr").removeAttr("disabled");
							$("#btn-rs-tr").removeAttr("disabled");
							$("#btn-r-tr").removeAttr("disabled");
							alert('Barang sudah digunakan! Silahkan pilih bahan yang lain/hapus bahan sebelumnya!');
						}else if(dataResult.statusCode==101){
							alert('Item Produksi tidak ditemukan dalam list!');
						}else if(dataResult.statusCode==102){
							alert('Item Bahan Baku tidak ditemukan dalam list!');
						}else if(dataResult.statusCode==103){
							alert('Quantity Item Produksi tidak ditemukan dalam list!');
						}else if(dataResult.statusCode==104){
							alert('Quantity Item Bahan Baku tidak ditemukan dalam list!');
						}else if(dataResult.statusCode==105){
							alert('Stok persediaan kurang pada Bahan Baku item '+ dataResult.dataItem);
						}else if(dataResult.statusCode==106){
							alert('Cabang warehouse '+dataResult.warehouse+' tidak ditemukan pada master.');
						}else if(dataResult.statusCode==301){
							console.log(dataResult.message);
						}
					},
					error: function() {
						$("#btn-s-tr").removeAttr("disabled");
						$("#btn-rs-tr").removeAttr("disabled");
						$("#btn-r-tr").removeAttr("disabled");
						$('#frm-tr').find('input:text').val('');
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });

		                $.uniform.update();
		                
					}
				});

			}else{
				if (date =="") {
					$("#btn-s-tr").removeAttr("disabled");
					$("#btn-rs-tr").removeAttr("disabled");
					$("#btn-r-tr").removeAttr("disabled");
					$("#validation-trial").show();
					$('#validation-trial').html('Tanggal transaksi harus diisi!');
					$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation").slideUp(500);
	                });
				}else if (no_bb=="") {
					$("#btn-s-tr").removeAttr("disabled");
					$("#btn-rs-tr").removeAttr("disabled");
					$("#btn-r-tr").removeAttr("disabled");
					$("#validation-trial").show();
					$('#validation-trial').html('No. Transaksi harus diisi!');
					$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation").slideUp(500);
	                });
				}else{
					$("#btn-s-tr").removeAttr("disabled");
					$("#btn-rs-tr").removeAttr("disabled");
					$("#btn-r-tr").removeAttr("disabled");
					$("#validation-trial").show();
					$('#validation-trial').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation").slideUp(500);
	                });
				}
				
                is_valid = 0;
			}
        }

		$('#btn-s-tr').on('click', function(e) {
			e.preventDefault();
			
			const date = $('#tgl_trial').val();
			const no_bb = $('#no_bb_trial').val();

			save_pm();

			var checkTbl = check_detail_bb();

			if(checkTbl == 1){
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Harap isi semua data yang dibutuhkan pada detail Bahan Baku!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Detail Bahan Baku masih kosong!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			var checkTbl2 = check_detail_mnf();

			if(checkTbl2 == 1){
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Harap isi semua data yang dibutuhkan pada detail Manufaktur!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl2 == 11) {
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Detail Manufaktur masih kosong!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}
			

			if(date!="" && no_bb!=""){
				$('#add_prosestrial').modal('hide');
				$.uniform.update();		
				
				setTimeout(function(){
				   window.location.reload();
				}, 2100);
			}else{
				if (date=="") {
					$("#btn-s-tr").removeAttr("disabled");
					$("#btn-rs-tr").removeAttr("disabled");
					$("#btn-r-tr").removeAttr("disabled");
					$("#validation-trial").show();
					$('#validation-trial').html('Tanggal transaksi harus diisi!');
					$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation").slideUp(500);
	                });
				}else if (no_bb=="") {
					$("#btn-s-tr").removeAttr("disabled");
					$("#btn-rs-tr").removeAttr("disabled");
					$("#btn-r-tr").removeAttr("disabled");
					$("#validation-trial").show();
					$('#validation-trial').html('No. Transaksi harus diisi!');
					$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation").slideUp(500);
	                });
				}else{
					$("#btn-s-tr").removeAttr("disabled");
					$("#btn-rs-tr").removeAttr("disabled");
					$("#btn-r-tr").removeAttr("disabled");
					$("#validation-trial").show();
					$('#validation-trial').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation").slideUp(500);
	                });
				}
				
                is_valid = 0;
			}
		});

		$('#btn-r-tr').on('click', function(e) {
			e.preventDefault();
			
			var id_trial = $('#id_trial').val();
			const id_reff = $('#id_reff').val();
			if(id_reff == ''){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_detail_trial_reset");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb();
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();
					},
					error:function(){
					}
				});
			}else{
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_detail_mnf_reset");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb();
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();
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
		});

		$('#btn-rs-tr').on('click', function(e) {
			e.preventDefault();
			save_pm();

			var checkTbl = check_detail_bb();

			if(checkTbl == 1){
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Harap isi semua data yang dibutuhkan pada detail Bahan Baku!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Detail Bahan Baku masih kosong!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			var checkTbl2 = check_detail_mnf();

			if(checkTbl2 == 1){
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Harap isi semua data yang dibutuhkan pada detail Manufaktur!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl2 == 11) {
				$("#btn-s-tr").removeAttr("disabled");
				$("#btn-rs-tr").removeAttr("disabled");
				$("#btn-r-tr").removeAttr("disabled");
				$("#validation-trial").show();
				$('#validation-trial').html('Detail Manufaktur masih kosong!');
				$("#validation-trial").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-trial").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			var id_trial = $('#id_trial').val();
			const id_reff = $('#id_reff').val();

			if(id_trial == ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_detail_trial_reset");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb();
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();
					},
					error:function(){
					}
				});
			}

			if(id_reff != ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_detail_mnf_reset");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb();
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();
					},
					error:function(){
					}
				});

				$.ajax({
					url: "<?php echo base_url("manufacture/getProsesMnf");?>",
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

						$('#tgl_trial').val(today);
						// console.log(today);

						var mydate = $('#tgl_trial').val();
						var dt = mydate.split("T");
						var tgl_inpt = new Date(dt[0]);
					    var hr = tgl_inpt.getDate();
					    var bln = tgl_inpt.getMonth() + 1;
					    var thn = tgl_inpt.getFullYear();

						var nopro = "PRD"+thn+bln+hr+"-00000#";
						$('#no_trial').val(nopro);

					},
					error:function(){
					}
				});
			}else{
				if(is_valid != 0){
					$("#validation-s-trial").show();
					$('#validation-s-trial').html('Data berhasil ditambahkan!');
					$("#validation-s-trial").fadeTo(2000, 500).slideUp(500, function() {
		            	$("#validation-s-trial").slideUp(500);
		            });

					$.ajax({
						url: "<?php echo base_url("manufacture/getProsesTrial");?>",
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

							$('#tgl_trial').val(today);
							// console.log(today);

							var mydate = $('#tgl_trial').val();
							var dt = mydate.split("T");
							var tgl_inpt = new Date(dt[0]);
						    var hr = tgl_inpt.getDate();
						    var bln = tgl_inpt.getMonth() + 1;
						    var thn = tgl_inpt.getFullYear();

							var nopro = "PRD"+thn+bln+hr+"-00000#";
							$('#no_trial').val(nopro);

						},
						error:function(){
						}
					});
				}
			}
		});

		$('#btn-b-tr').on('click', function(e) {
			// e.preventDefault();
			prevent(e);
			
			let sat = 0;
			let pak = 0;
			let but = 0;
			let hj = 0 ;
			let st = 0 ;

			const hasil = use_store_id_tf_result();
			
			const id_reff = hasil[0];
    		const type = hasil[1];

			const id_trial = $('#id_trial').val();

			var x = document.getElementById("btn-pm-tr");
			x.style.display = "none";

			$.ajax({
				url: "<?php echo base_url("manufacture/delete_detail_trial");?>",
				type: "POST",
				data: {},
				cache: false,
				success: function(){
					$('#tbl_bb_trial').DataTable().destroy();
					fetch_detail_bb();
					$('#tbl_prosestrial').DataTable().destroy();
					fetch_detail_mnf();

					$.ajax({
						url: "<?php echo base_url("manufacture/get_qty_cal");?>",
						type: "POST",
						data: {
							kode: 4
						},
						cache: false,
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);
							sat = dataResult.qty_satuan;
							pak = dataResult.qty_pakai;
							but = dataResult.qty_butuh;
							hj = dataResult.harga_jual;
							st = dataResult.sub_total;

							$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
							$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
							$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
							$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
							$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
						},
						error:function(){
						}
					});
				},
				error:function(){
				}
			});

			if(type == 1){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_detail_mnf");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb();
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf();

						$.ajax({
							url: "<?php echo base_url("manufacture/get_qty_cal");?>",
							type: "POST",
							data: {
								kode: 3
							},
							cache: false,
							success: function(dataResult){
								var dataResult = JSON.parse(dataResult);
								sat = dataResult.qty_satuan;
								pak = dataResult.qty_pakai;
								but = dataResult.qty_butuh;
								hj = dataResult.harga_jual;
								st = dataResult.sub_total;

								$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
								$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
								$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
								$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
								$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
							},
							error:function(){
							}
						});
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

			$('#add_prosestrial').modal('hide');
		});

		$('#btn_pilih_bb_trial').on('click', function(e) {

			save_tbl_temp_bb();

			selectedRows = [];

			$.uniform.update();

			$('#type_det_trial').val('bb');

			$('#type_det').val('bb');
			$('#opt_all_ml').attr("checked", true);
			$('#opt_all_ml').closest('span').addClass('checked');
			$('#opt_brg_ml').attr("checked", false);
			$('#opt_brg_ml').closest('span').removeClass('checked');
			$('#opt_mnf_ml').attr("checked", false);
			$('#opt_mnf_ml').closest('span').removeClass('checked');
			$('#show_product').modal('show');

			$('#show_product').modal('show');

			$('#status_modal_sp').val('');

			var oTable = $('#datatable_productslist').DataTable();
			oTable.ajax.reload();
		});

		$('#btn_pilih_mnf_trial').on('click', function(e) {
			
			save_tbl_temp_mnf();

			selectedRows = [];

			$.uniform.update();

			$('#type_det_trial').val('mnf');
			$('#type_det').val('mnf');
			$('#opt_all_ml').attr("checked", true);
			$('#opt_all_ml').closest('span').addClass('checked');
			$('#opt_brg_ml').attr("checked", false);
			$('#opt_brg_ml').closest('span').removeClass('checked');
			$('#opt_mnf_ml').attr("checked", false);
			$('#opt_mnf_ml').closest('span').removeClass('checked');
			$('#show_product').modal('show');
			$('#show_product').modal('show');

			$('#status_modal_sp').val('');

			var oTable = $('#datatable_productslist').DataTable();
			oTable.ajax.reload();
		});

		$('#pilih_prod_ml').on("click", function(e) {
        	e.preventDefault();

        	save_tbl_temp_bb();
        	save_tbl_temp_mnf();

        	// const hasil = use_store_id_tf_result();

        	// const id_reff = ($('#id_reff').val() != '') ? $('#id_reff').val() : hasil[0];
        	const id_reff = $('#id_reff').val();

        	// console.log(id_reff);

        	var kode = 4;

        	if(id_reff != ''){
        		kode = 3;
        	}
        	
        	var detype = $('#type_det_trial').val();
        	var id_trial = $('#id_trial').val();
        	var tgl = $('#tgl_trial').val();

        	var brg_arr = [];

			// $(".chk-prodml:checked").each(function(){
			// 	var brgid = $(this).val();
			// 	brg_arr.push(brgid);

			// });
			brg_arr = selectedRows;

			var length = brg_arr.length;

			if(length > 0){
				// console.log(brg_arr);
				var curl = "";

				if(id_reff != ''){
					curl = "<?php echo base_url("manufacture/insert_detail_mnf");?>";
				}else{
					curl = "<?php echo base_url("manufacture/insert_detail_trial");?>";
				}

				$.ajax({
					url: curl,
					type: "POST",
					data: {
						id_brg : brg_arr,
						id_trial : id_trial,
						tgl : tgl,
						type : detype
					},
					cache: false,
					success: function(){
						if(detype == 'bb'){
							$('#tbl_bb_trial').DataTable().destroy();	
							fetch_detail_bb();
							$.ajax({
								url: "<?php echo base_url("manufacture/get_qty_cal");?>",
								type: "POST",
								data: {
									kode : kode
								},
								cache: false,
								success: function(dataResult){
									console.log("get_qty");
									var dataResult = JSON.parse(dataResult);
									sat = dataResult.qty_satuan;
									pak = dataResult.qty_pakai;
									but = dataResult.qty_butuh;
									hj = dataResult.harga_jual;
									st = dataResult.sub_total;

									$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
									$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
									$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
									$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
									$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
								},
								error:function(){
									console.log("error on get_qty_cal")
								}
							});
						}else if(detype == 'mnf'){
							$('#tbl_prosestrial').DataTable().destroy();	
							fetch_detail_mnf();
						}
					},
					error: function() {
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });
		                console.log("error on insert_detail")
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

			$.uniform.update();

            $('#productlistmp_search').val('');

            $('#opt_all_ml').attr("checked", true);
			$('#opt_all_ml').closest('span').addClass('checked');
			$('#opt_brg_ml').attr("checked", false);
			$('#opt_brg_ml').closest('span').removeClass('checked');
			$('#opt_mnf_ml').attr("checked", false);
			$('#opt_mnf_ml').closest('span').removeClass('checked');

            $('#status_modal_sp').val('clear');

            var oTable = $('#datatable_productslist').DataTable();
            oTable.draw();

			$('#show_product').modal('hide');
        });

        $(document).on('click', '#productlist_searchbtn', function(e){
            e.preventDefault();
            var oTable = $('#datatable_productslistsingle').DataTable();
            oTable.draw();
            // console.log(key);
        });

        $(document).on('keydown', '#singleprod_search', function(e){
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                var oTable = $('#datatable_productslistsingle').DataTable();
                oTable.draw();
            }
        });

        $('#sps_btl').on('click', function() {
            $('#singleprod_search').val('');
            var oTable = $('#datatable_productslistsingle').DataTable();
            oTable.draw();
        });

        $(document).on('click', '#productlistbb_searchbtn', function(e){
            e.preventDefault();
            var oTable = $('#datatable_productslistsinglebb').DataTable();
            oTable.draw();
            // console.log(key);
        });

        $(document).on('keydown', '#singleprodbb_search', function(e){
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                var oTable = $('#datatable_productslistsinglebb').DataTable();
                oTable.draw();
            }
        });

        $('#spsbb_btl').on('click', function() {
            $('#singleprodbb_search').val('');
            var oTable = $('#datatable_productslistsinglebb').DataTable();
            oTable.draw();
        });

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

        $('#btl_prod_ml').on('click', function(e) {

        	e.preventDefault();

        	save_tbl_temp_bb();
        	save_tbl_temp_mnf();

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

			$('#productlistmp_search').val('');

			$('#status_modal_sp').val('clear');

            // var oTable = $('#datatable_productslist').DataTable();
            // oTable.ajax.reload();

            $('#show_product').modal('hide');
        });

        function set_option(data, ele) {
			const selopt = document.getElementById(ele);

			for (let key in data) {
				let option = document.createElement("option");
			    let optionText = document.createTextNode(key);

			    option.setAttribute('value', data[key]);
			    option.appendChild(optionText);
			    selopt.appendChild(option);
			}
		}

        // $(document).on('click', '.update-qty-bb', function(e){
        $(document).on('keypress', '.update-qty-bb', function(e){
			var keyCode = e.which;
			var letter = String.fromCharCode(keyCode).toLowerCase();
			var isAlpha = /^[a-z0-9]+$/i.test(letter);

			if (isAlpha || keyCode == 13) {
				e.preventDefault();

				if(keyCode == 13){
					save_tbl_temp_bb();

					$('#jenis_tbl').val("");
					$('#qty_butuh').prop('readonly', true);

					var id = $(this).data('id');
					var column = $(this).data('column');
					var type= 4;
					const id_reff = $('#id_reff').val();

					if(id_reff != ""){
						type=3;
					}

					document.getElementById('qty_paksat').selectedIndex = 6;
					document.getElementById('qty_kemsat').selectedIndex = 3;

					$.ajax({
						url:"<?= base_url('manufacture/get_qty_prod_trial') ?>",
						method:"POST",
						data:{
							id:id,
							column:column,
							tbl:"bb",
							type : type
						},
						success:function(dataResult){
							var dataResult = JSON.parse(dataResult);
							$('#id_detail_bb').val(dataResult.id_detail);
							$('#qty_kemsat_input').val(dataResult.qty_kemasan);

							var satuan = dataResult.prod_kemasan;

							if (satuan == 'l' || satuan == 'L') {
								const data = {
								  	"KL": "1",
									"HL" : "10",
									"DAL" : "100",
									"L" : "1000",
									"DL" : "10000",
									"CL" : "100000",
									"ML" : "1000000"
								}

								set_option(data, "qty_paksat");
								set_option(data, "qty_kemsat");
								set_option(data, "sat_hit");

								$('#prod_kemasan').val('L');
							}else if (satuan == 'g' || satuan == 'G') {
								const data = {
									"KG" : "1",
									"HG" : "10",
									"DAG" : "100",
									"G" : "1000",
									"DG" : "10000",
									"CG" : "100000",
									"MG" : "1000000"	
								}

								set_option(data, "qty_paksat");
								set_option(data, "qty_kemsat");
								set_option(data, "sat_hit");

								$('#prod_kemasan').val('G');
							}else{
								const data = {
									"KG" : "1",
									"HG" : "10",
									"DAG" : "100",
									"G" : "1000",
									"DG" : "10000",
									"CG" : "100000",
									"MG" : "1000000"	
								}

								set_option(data, "qty_paksat");
								set_option(data, "qty_kemsat");
								set_option(data, "sat_hit");

								$('#prod_kemasan').val('G');
							}

							document.getElementById('qty_paksat').selectedIndex = 6;
							document.getElementById('qty_kemsat').selectedIndex = 3;
							$('#qty_butuh').val(1);
							$('#jenis_tbl').val("bb");
						}
					});

					$('#modal_qty').modal('show');
				}
			}			
		});

		// $(document).on('click', '.update-qty-mnf', function(e){
		$(document).on('keypress', '.update-qty-mnf', function(e){
			var keyCode = e.which;
			var letter = String.fromCharCode(keyCode).toLowerCase();
			var isAlpha = /^[a-z0-9]+$/i.test(letter);

			if (isAlpha || keyCode == 13) {

				e.preventDefault();

				if(keyCode == 13){
					save_tbl_temp_mnf();

					$('#jenis_tbl').val("");
					$('#qty_butuh').prop('readonly', false);

					var id = $(this).data('id');
					var column = $(this).data('column');
					var type= 4;
					const id_reff = $('#id_reff').val();

					if(id_reff != ""){
						type=3;
					}

					document.getElementById('qty_paksat').selectedIndex = 6;
					document.getElementById('qty_kemsat').selectedIndex = 3;

					$.ajax({
						url:"<?= base_url('manufacture/get_qty_prod_trial') ?>",
						method:"POST",
						data:{
							id:id,
							column:column,
							tbl:"mnf",
							type : type
						},
						success:function(dataResult){
							var dataResult = JSON.parse(dataResult);
							$('#id_detail_bb').val(dataResult.id_detail);
							$('#qty_kemsat_input').val(dataResult.qty_kemasan);

							var satuan = dataResult.prod_kemasan;

							if (satuan == 'l' || satuan == 'L') {
								const data = {
								  	"KL": "1",
									"HL" : "10",
									"DAL" : "100",
									"L" : "1000",
									"DL" : "10000",
									"CL" : "100000",
									"ML" : "1000000"
								}

								set_option(data, "qty_paksat");
								set_option(data, "qty_kemsat");
								set_option(data, "sat_hit");

								$('#prod_kemasan').val('L');
							}else if (satuan == 'g' || satuan == 'G') {
								const data = {
									"KG" : "1",
									"HG" : "10",
									"DAG" : "100",
									"G" : "1000",
									"DG" : "10000",
									"CG" : "100000",
									"MG" : "1000000"	
								}

								set_option(data, "qty_paksat");
								set_option(data, "qty_kemsat");
								set_option(data, "sat_hit");

								$('#prod_kemasan').val('G');
							}else{
								const data = {
									"KG" : "1",
									"HG" : "10",
									"DAG" : "100",
									"G" : "1000",
									"DG" : "10000",
									"CG" : "100000",
									"MG" : "1000000"	
								}

								set_option(data, "qty_paksat");
								set_option(data, "qty_kemsat");
								set_option(data, "sat_hit");

								$('#prod_kemasan').val('G');
							}

							document.getElementById('qty_paksat').selectedIndex = 6;
							document.getElementById('qty_kemsat').selectedIndex = 3;
							$('#qty_butuh').val(1);
							$('#jenis_tbl').val("mnf");
						}
					});

					$('#modal_qty').modal('show');
				}
			}			
		});

		function qty_calculation() {
			let QtyPemakaian = $('#qty_paksat_input').val();
			let QtyKemasan = $('#qty_kemsat_input').val();
			let SatPakai = document.getElementById('qty_paksat').selectedIndex;
			let SatKemas = document.getElementById('qty_kemsat').selectedIndex;
			let QtyPakai = $('#qty_pakai').val();
			let QtyButuh = $('#qty_butuh').val();

			let QtyBagi = 0;
			let QtyHsl = 0;
			let QtyHit = 0;
			let QtyHp = 0;

			const hasil = new Array(SatPakai,SatKemas,QtyPemakaian);

			// console.log(hasil);


			if((SatPakai) > (SatKemas)){
				QtyBagi = ((SatPakai) - (SatKemas));
				document.getElementById('sat_hit').selectedIndex = QtyBagi;
				QtyHit = $('#sat_hit').val();
				QtyHsl = (QtyPemakaian) / (QtyHit);
			}else if ((SatPakai) < (SatKemas)) {
				QtyBagi = ((SatKemas) - (SatPakai));
				document.getElementById('sat_hit').selectedIndex = QtyBagi;
				QtyHit = $('#sat_hit').val();
				QtyHsl = (QtyPemakaian) * (QtyHit);
			}else{
				QtyBagi = ((SatPakai) - (SatKemas));
				document.getElementById('sat_hit').selectedIndex = QtyBagi;
				QtyHit = $('#sat_hit').val();
				QtyHsl = (QtyPemakaian) / (QtyHit);
			}

			// console.log(QtyBagi, QtyHit, QtyHsl);

			if ((QtyKemasan) != 0) {
				QtyHsl = QtyHsl / (QtyKemasan);
			}else{
				QtyHsl = 0;
			}

			QtyHp = (QtyPakai) * (QtyButuh);

			$('#qty_pakai').val(parseFloat(QtyHsl.toFixed(5)));
			$('#qty_hasil_pakai').val(parseFloat(QtyHp.toFixed(5)));

		}

		$(document).on('input', '#qty_paksat_input,#qty_butuh,#qty_kemsat_input', function(e){
			qty_calculation();
		});

		$(document).on('focusout', '#qty_paksat_input,#qty_butuh,#qty_kemsat_input,#qty_paksat,#qty_kemsat', function(e){
			qty_calculation();
		});

		$(document).on('change', '#qty_paksat,#qty_kemsat', function(e){
			qty_calculation();
		});

		function footer_sum3() {
        	let sumColumn = 0;
   
			$('#tbl_bb_trial').find('td#col-qty-satuan-trial').each(function(){
			    
			    $('#tbl_bb_trial tbody tr').each(function(){
			        $('td', this).eq(3).each(function(){
			            if($('div', this).length==1)
			            	sumColumn += Number( ($('div', this).data('value')!="" ? $('div', this).data('value'): 0 ) );
			        });
			    });

			    $(this).text(parseFloat(sumColumn.toFixed(5)));
			    sumColumn = 0;
			});
        }

        function footer_sum8() {
        	let sumColumn = 0;
   
			$('#tbl_bb_trial').find('td#col-qty-pakai-trial').each(function(){
			    
			    $('#tbl_bb_trial tbody tr').each(function(){
			        $('td', this).eq(8).each(function(){
			            if($('div', this).length==1){
			                let num = Number( ($('div', this).data('value')!="" ? $('div', this).data('value'): 0 ) );
			             	sumColumn += num;
			            }
			        });
			    });
			    $(this).text(parseFloat(sumColumn.toFixed(5)));
			    sumColumn = 0;
			});
        }

        function footer_sum9() {
        	let sumColumn = 0;

			$('#tbl_bb_trial').find('td#col-qty-butuh-trial').each(function(){
			    
			    $('#tbl_bb_trial tbody tr').each(function(){
			        $('td', this).eq(9).each(function(){
			            if($('div', this).length==1){
			                let num = Number( ($('div', this).data('value')!="" ? $('div', this).data('value'): 0 ) );
			             	sumColumn += num;
			            }
			        });
			    });
			    $(this).text(parseFloat(sumColumn.toFixed(5)));
			    sumColumn = 0;
			});
        }

        function footer_sum10() {
        	let sumColumn = 0;

			$('#tbl_bb_trial').find('td#col-qty-hj-trial').each(function(){
			    
			    $('#tbl_bb_trial tbody tr').each(function(){
			        $('td', this).eq(10).each(function(){
			            if($('div', this).length==1){
			                let num = Number( ($('div', this).data('value')!="" ? $('div', this).data('value'): 0 ) );
			             	sumColumn += num;
			            }
			        });
			    });
			    $(this).text(parseFloat(sumColumn.toFixed(5)));
			    sumColumn = 0;
			});
        }

        function footer_sum11() {
        	let sumColumn = 0;

			$('#tbl_bb_trial').find('td#col-qty-st2-trial').each(function(){
			    
			    $('#tbl_bb_trial tbody tr').each(function(){
			        $('td', this).eq(11).each(function(){
			            if($('div', this).length==1){
			                let num = Number( ($('div', this).data('value')!="" ? $('div', this).data('value'): 0 ) );
			             	sumColumn += num;
			            }
			        });
			    });
			    $(this).text(parseFloat(sumColumn.toFixed(5)));
			    sumColumn = 0;
			});
        }

		$('#btn-close-qty, #btn-keluar-qty').on('click', function(e) {
			e.preventDefault();

			const id = $('#id_detail_bb').val();
			const tbl = $('#jenis_tbl').val();

			save_tbl_temp_bb();
			save_tbl_temp_mnf();

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

			$('#qty_paksat option').remove();
			$('#qty_kemsat option').remove();
			$('#sat_hit option').remove();

			$('#modal_qty').modal('hide');

			if(tbl == "mnf"){
				var element = $('.update-qty-mnf[data-id="' + id + '"][data-column="qty_satuan"]');
			}else if(tbl == "bb"){
				var element = $('.update-qty-bb[data-id="' + id + '"][data-column="qty_satuan"]');
			}

			element.focus();

			footer_sum3();
			footer_sum8();
			footer_sum9();
			footer_sum10();
			footer_sum11();
		});

		$(document).on('click', '#btn-pilih-qty', function(e){

			e.preventDefault();

			const id = $('#id_detail_bb').val();
			var qty_paksat = $("#qty_paksat option:selected").text();
			var qty_kemsat = $("#qty_kemsat option:selected").text();
			var qty_paksat_input = $("#qty_paksat_input").val();
			var qty_kemsat_input = $("#qty_kemsat_input").val();
			var qty_pakai = $('#qty_pakai').val();
			var qty_butuh = $('#qty_butuh').val();
			var qty_hasil = $('#qty_hasil_pakai').val();
			var prod_kemasan = $('#prod_kemasan').val();
			const tbl = $('#jenis_tbl').val();
			var adj = $('#chk_adjust_qty_trial').prop('checked');
			const id_reff = $('#id_reff').val();
			var type = 4;
			const tipe="qty";

			if(id_reff != ""){
				var type = 3;
			}

        	if (adj == "false" || adj == 0 || adj == "0") {
        		adj = 0;
        	}else{
        		adj = 1;
        	}

        	save_tbl_temp_bb();
			save_tbl_temp_mnf();

			let sat = 0;
			let pak = 0;
			let but = 0;
			let hj = 0;
			let st = 0;

			console.log(id);
			console.log('table', tbl);
			console.log('is_adj', adj);
			console.log('qty_kemsat', qty_kemsat_input);
			console.log('qty_hasil', qty_hasil);

			$.ajax({
				url:"<?= base_url('manufacture/update_qty_detail_trial') ?>",
				method:"POST",
				data:{
					id:id,
					is_adj : adj,
					qty_paksat:qty_paksat,
					qty_kemsat:qty_kemsat,
					qty_paksat_input:qty_paksat_input,
					qty_kemsat_input:qty_kemsat_input,
					qty_pakai:qty_pakai,
					qty_butuh:qty_butuh,
					qty_hasil:qty_hasil,
					prod_kemasan : prod_kemasan,
					tbl : tbl,
					type : type
				},
				success:function(dataResult){
					$('#tbl_bb_trial').DataTable().destroy();
					fetch_detail_bb(tipe, tbl, id);
					$('#tbl_prosestrial').DataTable().destroy();
					fetch_detail_mnf(tipe, tbl, id);

					var dataResult = JSON.parse(dataResult);
					sat = dataResult.qty_satuan;
					pak = dataResult.qty_pakai;
					but = dataResult.qty_butuh;
					hj = dataResult.harga_jual;
					st = dataResult.sub_total;

					$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
					$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
					$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
					$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
					$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
				}
			});

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

			$('#qty_paksat option').remove();
			$('#qty_kemsat option').remove();
			$('#sat_hit option').remove();

			$('#modal_qty').modal('hide');
		});

		$("#qty_paksat_input").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
            	e.preventDefault();

            	var tbl = $('#jenis_tbl').val();

            	$(this).blur();
            	
            	if(tbl == "bb"){
            		$('#btn-pilih-qty').focus();
            	}else{
            		$('#qty_butuh').focus();	
            	}

            	$('#qty_butuh').focus();
            }
        });

		$("#qty_butuh").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
            	e.preventDefault();
            	
            	$(this).blur();
            	
            	$('#btn-pilih-qty').focus();
            }
        });

        $("#btn-pilih-qty").on('keydown', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
            	e.preventDefault();

				const id = $('#id_detail_bb').val();
				var qty_paksat = $("#qty_paksat option:selected").text();
				var qty_kemsat = $("#qty_kemsat option:selected").text();
				var qty_paksat_input = $("#qty_paksat_input").val();
				var qty_kemsat_input = $("#qty_kemsat_input").val();
				var qty_pakai = $('#qty_pakai').val();
				var qty_butuh = $('#qty_butuh').val();
				var qty_hasil = $('#qty_hasil_pakai').val();
				var prod_kemasan = $('#prod_kemasan').val();
				const tbl = $('#jenis_tbl').val();
				var adj = $('#chk_adjust_qty_trial').prop('checked');
				const id_reff = $('#id_reff').val();
				var type = 4;
				const tipe="qty";

				if(id_reff != ""){
					var type = 3;
				}

	        	if (adj == "false" || adj == 0 || adj == "0") {
	        		adj = 0;
	        	}else{
	        		adj = 1;
	        	}

	        	save_tbl_temp_bb();
				save_tbl_temp_mnf();

				let sat = 0;
				let pak = 0;
				let but = 0;
				let hj = 0;
				let st = 0;

				console.log('id', id);
				console.log('is_adj',tbl);
				console.log('qty_kemsat', qty_kemsat_input);
				console.log('qty_hasil', qty_hasil);

				$.ajax({
					url:"<?= base_url('manufacture/update_qty_detail_trial') ?>",
					method:"POST",
					data:{
						id:id,
						is_adj : adj,
						qty_paksat:qty_paksat,
						qty_kemsat:qty_kemsat,
						qty_paksat_input:qty_paksat_input,
						qty_kemsat_input:qty_kemsat_input,
						qty_pakai:qty_pakai,
						qty_butuh:qty_butuh,
						qty_hasil:qty_hasil,
						prod_kemasan : prod_kemasan,
						tbl : tbl,
						type : type
					},
					success:function(dataResult){
						$('#tbl_bb_trial').DataTable().destroy();
						fetch_detail_bb(tipe, tbl, id);
						$('#tbl_prosestrial').DataTable().destroy();
						fetch_detail_mnf(tipe, tbl, id);

						var dataResult = JSON.parse(dataResult);
						sat = dataResult.qty_satuan;
						pak = dataResult.qty_pakai;
						but = dataResult.qty_butuh;
						hj = dataResult.harga_jual;
						st = dataResult.sub_total;

						$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
						$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
						$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
						$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
						$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
					}
				});

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

				$('#qty_paksat option').remove();
				$('#qty_kemsat option').remove();
				$('#sat_hit option').remove();

				$('#modal_qty').modal('hide');
            }
        });

        $(document).on('focusout', '.update-kemasan-mnf', function(e){
        	e.preventDefault();

        	let sat = 0;
	    	let pak = 0;
	    	let but = 0;
	    	let hj = 0;
	    	let st = 0;

			var id = $(this).data('id');
			var value = $(this).text();
			const id_reff = $('#id_reff').val();
			var type = 4;
			if (id_reff != '') {
				type = 3;
			}

        	var is_adj = $('#chk_adjust_qty_trial').prop('checked');

			if(is_adj == true){
				var adj = 1;
			}else{
				var adj = 0;
			}

			$.ajax({
				url:"<?= base_url('manufacture/hitung_all_trial/') ?>",
				method:"POST",
				data:{
					type: type,
					is_adj : adj,
					id : id,
					value :value,
				},
				success:function(dataResult){
					$('#tbl_bb_trial').DataTable().destroy();
					fetch_detail_bb();
					$('#tbl_prosestrial').DataTable().destroy();
					fetch_detail_mnf();

					var dataResult = JSON.parse(dataResult);
					sat = dataResult.qty_satuan;
					pak = dataResult.qty_pakai;
					but = dataResult.qty_butuh;
					hj = dataResult.harga_jual;
					st = dataResult.sub_total;

					$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
					$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
					$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
					$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
					$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
				}
			});
        });

	    $('#chk_adjust_qty_trial').change(function(){
	    	let sat = 0;
	    	let pak = 0;
	    	let but = 0;
	    	let hj = 0;
	    	let st = 0;

			var is_adj = $('#chk_adjust_qty_trial').prop('checked');

			if(is_adj == true){
				var adj = 1;
			}else{
				var adj = 0;
			}

			const id_reff = $('#id_reff').val();
			var type = 4;
			if (id_reff != '') {
				type = 3;
			}

			$.ajax({
				url:"<?= base_url('manufacture/hitung_all_trial/') ?>",
				method:"POST",
				data:{
					type : type,
					is_adj : adj,
					id : 0,
					value : 0
				},
				success:function(dataResult){
					$('#tbl_bb_trial').DataTable().destroy();
					fetch_detail_bb();
					$('#tbl_prosestrial').DataTable().destroy();
					fetch_detail_mnf();

					var dataResult = JSON.parse(dataResult);
					sat = dataResult.qty_satuan;
					pak = dataResult.qty_pakai;
					but = dataResult.qty_butuh;
					hj = dataResult.harga_jual;
					st = dataResult.sub_total;

					$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
					$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
					$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
					$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
					$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
				}
			});
		});

		$('#btn-h-akses').on('click', function() {
			// Get userid from checked checkboxes
				var id_arr = [];
				$(".chk-trial:checked").each(function(){
					var bbid = $(this).val();

					id_arr.push(bbid);
				});

				const id_reff = $('#id_reff').val();
				var type = 3;
				if (id_reff != '') {
					type = 31;
				}

				// Array length
				var length = id_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("manufacture/action_prosestrial");?>",
						type: "POST",
						data: {
							type: type,
							id_trial : id_arr,
							id_reff : id_reff
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
							}else if(dataResult.statusCode==301){
								$("#failed").show();
								$('#failed').html(dataResult.message);
								$("#failed").fadeTo(2000, 500).slideUp(500, function() {
				                	$("#failed").slideUp(500);
				                });
							}else if(dataResult.statusCode==201) {
								$("#failed").show();
								$('#failed').html("Gagal menambahkan data!");
								$("#failed").fadeTo(2000, 500).slideUp(500, function() {
				                	$("#failed").slideUp(500);
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
					}, 2100);
				}
		});

		$('#chk_tgl').on('change', function(e) {
			e.preventDefault();
			document.getElementById('tgl_mulai').disabled = !this.checked;
			document.getElementById('tgl_selesai').disabled = !this.checked;
		});

		//function search akses
		function search_trial() {
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

			var urlist = "<?php echo base_url('manufacture/proses_trial');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_date + "/" + start_date + "/" + end_date + "/" + status + "/" + is_user + "/"
		    );
		    location.href = url.href;
		}

		$('#btn-rf-trial').on('click', function(e) {
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

			search_trial();

		});

		//action btn cari
		$('#btn-sf-trial').on('click', function(e) {
			search_trial();
		});

		//action ketika enter search bar
		$("#keyword-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-front").val();
		    	$("#keyword").val(keyword);
		        search_trial();
		    }
		});

		$('#btn-pm-tr').on('click', function(e) {
			e.preventDefault();
			$("#btn-pm-tr").attr("disabled", "disabled");

			let sat = 0;
			let pak = 0;
			let but = 0;
			let hj = 0;
			let st = 0;

			const id_reff = $('#id_trial').val();

			$.ajax({
				url: "<?php echo base_url("manufacture/delete_detail_trial");?>",
				type: "POST",
				data: {},
				cache: false,
				success: function(){
				},
				error:function(){
				}
			});

			$('#id_reff').val(id_reff);

			$.ajax({
				url: "<?php echo base_url("manufacture/tf_data_trial");?>",
				type: "POST",
				data: {
					id_trial: id_reff
				},
				cache: false,
				success: function(dataResult){

					var now = new Date();
					var day = ("0" + now.getDate()).slice(-2);
					var month = ("0" + (now.getMonth() + 1)).slice(-2);
					var year = now.getFullYear();
					var hour = ''+now.getHours();
            		var minute = ''+now.getMinutes();
            		var second = now.getSeconds();
            		var today = (year)+"-"+(month)+"-"+(day)+"T"+(hour.padStart(2,"0"))+":"+(minute.padStart(2,"0"));

					$('#tgl_trial').val(today);
					// console.log(today);

					var mydate = $('#tgl_trial').val();
					var dt = mydate.split("T");
					var tgl_inpt = new Date(dt[0]);
				    var hr = tgl_inpt.getDate();
				    var bln = tgl_inpt.getMonth() + 1;
				    var thn = tgl_inpt.getFullYear();

					var nopro = "PRD"+thn+bln+hr+"-00000#";
					$('#no_trial').val(nopro);

					var json_data = JSON.parse(dataResult);
					$('#no_bb_trial').val(json_data.parent_prod.no_bb);
					if(json_data.parent_prod.is_adj == 0 ){
						$('#chk_adjust_qty_trial').prop('checked', false);
					}else{
						$('#chk_adjust_qty_trial').prop('checked', true);
					}
					$('#ket_trial').val(json_data.parent_prod.ket_mnf);
					$('#ket_bb_trial').val(json_data.parent_prod.ket_mnf);
					$('#gud_trial').val(json_data.parent_prod.gud_no);

					$.uniform.update();

					$('#tbl_bb_trial').DataTable().destroy();
					fetch_detail_bb();
					$('#tbl_prosestrial').DataTable().destroy();
					fetch_detail_mnf();

					sat = json_data.child_prod.qty_satuan;
					pak = json_data.child_prod.qty_pakai;
					but = json_data.child_prod.qty_butuh;
					hj = json_data.child_prod.harga_jual;
					st = json_data.child_prod.sub_total;

					$('#col-qty-satuan-trial').text(parseFloat(sat.toFixed(5)));
					$('#col-qty-pakai-trial').text(parseFloat(pak.toFixed(5)));
					$('#col-qty-butuh-trial').text(parseFloat(but.toFixed(5)));
					$('#col-qty-hj-trial').text(parseFloat(hj.toFixed(5)));
					$('#col-qty-st2-trial').text(parseFloat(st.toFixed(5)));
				},
				error: function() {
					console.log("error");
				}
			});
			result_tf_reff = store_id_tf(id_reff, 1);
			use_store_id_tf_result();
		});

		function store_id_tf(id_trial, tipe) {
			var type = 0;
			if(tipe != 0 ){
				type = 1;
			}
			const id_reff = id_trial;

			return [id_reff, type];
		}

		function use_store_id_tf_result() {
		    const id_reff = result_tf_reff[0];
		    const type = result_tf_reff[1];
		    return [id_reff, type];
		}

		$(document).on('click', '#btn-c-tr', function(e){
		 	e.preventDefault();
		 	
		 	var id_trial = $('#id_trial').val();
        	var no_reff = $('#id_reff').val();

			var urlist = "<?php echo base_url('manufacture/print_trial_pdf');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + id_trial + "/"
		    ); 
		 	window.open(url);
		});

</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>