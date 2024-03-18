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
						<strong>Daftar Bahan Baku</strong>
						</h3>
					</div>
					<!-- <a class="btn btn-sm green-seagreen" data-toggle="modal" href="#" id="qty-modal">Qty Modal </a> -->
					<div class="add-subcat-nav col-sm-3">
						<a class="btn btn-sm green-seagreen" data-toggle="modal" id="31B"><i class="fa fa-plus"></i> Bahan Baku Baru</a>
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
						<a href="<?php echo base_url('product');?>">Bahan Baku</a>
					</li>
				</ul>
			</div>
			
			<!-- <input type="text" id="test_uom"> -->

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
																if(is_array($prs)||is_object($prs)) {
																	foreach($prs as $ua) {
																		echo"<strong>".$ua->proses." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Bahan Baku Dalam Proses</strong>
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
																if(is_array($sls)||is_object($sls)) {
																	foreach($sls as $ua) {
																		echo"<strong>".$ua->komplit." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Bahan Baku Selesai</strong>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-7">
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
													<a class="btn green-seagreen dropdown-toggle btn-rounded btn-sm btn-border btn-actcl" data-toggle="dropdown" href="#" id="31D">
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
											<div class="col-sm-2 pdg-btn">
												<div class="btn-group">
													<!-- <a class="btn green-seagreen btn-sm btn-rounded-left btn-border" id="31E">
														Import
													</a>
													<div class="btn-group">
														<a class="btn green-seagreen dropdown-toggle btn-rounded-right btn-sm btn-border" data-toggle="dropdown" href="#" id="31F">
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
														<button type="button" id="search-btn-bahan" class="btn btn-default advance-toggle  btn-rounded-right"><i class="fa fa-angle-down" id="search-icn-bahan"></i></button>
														
														<div class="advance-search-toggle" id="search-toggle-bahan" style="min-width:250px;display: none;">
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
																			<input type="date" class="form-control input-sm dropdown-input" id="tgl_mulai" placeholder="" <?php echo 'value="'.$start_date.'"';if($is_date <> 1){ echo "disabled"; }?>>
																		</div>
																		<label class="col-md-3 control-label" style="margin-top:10px;color:#777;">s/d</label>
																		<div class="col-md-9" style="margin-top:8px">
																			<input type="date" class="form-control input-sm dropdown-input" id="tgl_selesai" placeholder="" <?php echo 'value="'.$end_date.'"'; if($is_date <> 1){  echo "disabled"; }?>>
																		</div>
																		<div class="col-md-3"></div>
																	</div>
																	<div class="form-group">
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
																			<a class="" id="btn-rf-bb" style="color:#777;text-decoration:none;">Hapus Filter</a>
																		</div>
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;color: #777;padding: 0px 15px 0px 0px;">
																			<a class="btn green-seagreen btn-rounded" style="display:block;" id="btn-sf-bb">
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
										
										
										<div class="tab-content" id="31A" style="display:none;">
											<div class="tab-pane fade active in" id="tab_2_1">
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<div class="table-actions-wrapper">
													</div>
													<table class="table table-hover" id="datatable_bahanbaku">
														<thead class="thead-dark">
															<tr role="row" class="heading">
																<th width="1%" style="background-color: #1BA39C!important;">
																	<input type="checkbox" class="group-checkable checkall" onclick="calc();">
																</th>
																<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
																	 Tgl.&nbsp;Proses
																</th>
																<th width="10%" style="background-color: #1BA39C!important;color:white!important;">
																	 No.&nbsp;Proses
																</th>
																<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
																	 Nama&nbsp;Hasil&nbsp;Proses
																</th>
																<th width="15%" style="background-color: #1BA39C!important;color:white!important;">
																	 Keterangan
																</th>
															</tr>
															<tr role="row" class="filter panel-collapse collapse" id="collapse_2">
																<td></td>
																<td>
																	<input type="text" class="form-control form-filter input-sm" name="process_date">
																</td>
																<td>
																	<input type="text" class="form-control form-filter input-sm" name="process_number">
																</td>
																<td>
																	<input type="text" class="form-control form-filter input-sm" name="product_kode">
																</td>
																<td>
																	<input type="text" class="form-control form-filter input-sm" name="product_name">
																</td>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										
									</div>
									<div class="tab-pane fade" id="tab_2_2">
										<p id="myText"></p>
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
            Ingridients.init();
            // TableEditableBahanBaku.init();
            
        });

        var is_valid = 1;
        var selectedRows = [];

        function footer_sum3() {
        	let sumColumn = 0;
   
			$('#tbl_bahanbakudetail').find('td#col-qty-satuan').each(function(){
			    
			    $('#tbl_bahanbakudetail tbody tr').each(function(){
			        $('td', this).eq(3).each(function(){
			            if($('div', this).length==1)
			            	sumColumn += Number( ($('div', this).data('value')!="" ? $('div', this).data('value'): 0 ) );
			        });
			    });

			    $(this).text(parseFloat(sumColumn.toFixed(5)));
			    sumColumn = 0;
			});
        }

        function footer_sum4() {
        	let sumColumn = 0;
   
			$('#tbl_bahanbakudetail').find('td#col-qty-pakai').each(function(){
			    
			    $('#tbl_bahanbakudetail tbody tr').each(function(){
			        $('td', this).eq(4).each(function(){
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

        function footer_sum5() {
        	let sumColumn = 0;

			$('#tbl_bahanbakudetail').find('td#col-qty-butuh').each(function(){
			    
			    $('#tbl_bahanbakudetail tbody tr').each(function(){
			        $('td', this).eq(5).each(function(){
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

        var countCheckedIng = function($table, checkboxClass) {
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

        function checkIng() {
		  var result = countCheckedIng($('#datatable_bahanbaku'), '.chk-ing');
		  
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
		        $('.chk-ing').prop('checked', this.checked);
		        var $checkboxes = $('.chk-ing');
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
		    var container = $("#search-toggle-bahan");
		    var btn = $("#search-btn-bahan");
		    var icn = $("#search-icn-bahan");
		    var x = document.getElementById("search-toggle-bahan");

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

		$('#31F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#31E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#31D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		function cae_bahanbaku(id_bb) {
			var x = document.getElementById("21C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				let sat = 0;
				let pak = 0;
				let but = 0;
				// Set data to Form Edit
				$('#id_bb').val(id_bb);

				$.ajax({
					url: "<?php echo base_url("manufacture/get_edit_data_bb");?>",
					type: "POST",
					data: {
						id_bb: id_bb
					},
					cache: false,
					success: function(dataResult){
						// console.log(dataResult);
						var json_data = JSON.parse(dataResult);
						
						var tgl = json_data.parent_prod.trans_date;

						// var day = ("0" + tgl.getDate()).slice(-2);
						// var month = ("0" + (tgl.getMonth() + 1)).slice(-2);
						var today = tgl.replace(" ","T");

						console.log(today);

						$('#bb_tgl').val(today);
						$('#bb_noproses').val(json_data.parent_prod.trans_no);
						$('#bb_kodeprod').val(json_data.parent_prod.prod_code0);
						$('#bb_idprod').val(json_data.parent_prod.prod_no);
						$('#bb_prodname').val(json_data.parent_prod.prod_name0);
						$('#bb_ket').val(json_data.parent_prod.keterangan);

						sat = new Number(json_data.detail_sum.qty_satuan);
						pak = new Number(json_data.detail_sum.qty_pakai);
						but = new Number(json_data.detail_sum.qty_butuh);
						
						$('#col-qty-satuan').text(parseFloat(sat.toFixed(5)));
						$('#col-qty-pakai').text(parseFloat(pak.toFixed(5)));
						$('#col-qty-butuh').text(parseFloat(but.toFixed(5)));

						$.uniform.update();

						$('#tbl_bahanbakudetail').DataTable().destroy();
						fetch_detail_bb();
					}
				});
				
				$('#add_bahanbaku').modal('show');
			}
		}

		$('#bb_tgl').on('change', function() {
			
			var mydate = $('#bb_tgl').val();
			var dt = mydate.split("T");
			var tgl_inpt = new Date(dt[0]);
		    var hr = tgl_inpt.getDate();
		    var bln = tgl_inpt.getMonth() + 1;
		    var thn = tgl_inpt.getFullYear();

			var nopro = "BB-"+thn+bln+hr+"-00000#";
			$('#bb_noproses').val(nopro);

		});

		$('#31B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$.ajax({
					url: "<?php echo base_url("manufacture/getProsesBb");?>",
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

						$('#bb_tgl').val(today);
						console.log(today);

						var mydate = $('#bb_tgl').val();
						var dt = mydate.split("T");
						var tgl_inpt = new Date(dt[0]);
					    var hr = tgl_inpt.getDate();
					    var bln = tgl_inpt.getMonth() + 1;
					    var thn = tgl_inpt.getFullYear();

						var nopro = "BB-"+thn+bln+hr+"-00000#";
						$('#bb_noproses').val(nopro);

						$('#add_bahanbaku').modal('show');

						$('#col-qty-satuan').text(0);
						$('#col-qty-pakai').text(0);
						$('#col-qty-butuh').text(0);
					},
					error:function(){
					}
				});

				
			}		
		});

		$('#bb_show_product_single').on('click', function(e) {
			e.preventDefault();

			$('#opt_all_sg').attr("checked", true);
			$('#opt_all_sg').closest('span').addClass('checked');
			$('#opt_brg_sg').attr("checked", false);
			$('#opt_brg_sg').closest('span').removeClass('checked');
			$('#opt_mnf_sg').attr("checked", false);
			$('#opt_mnf_sg').closest('span').removeClass('checked');

			var oTable = $('#datatable_productslistsingle').DataTable();
            oTable.draw();
			
			$('#show_product_single').modal('show');		
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
            $('#opt_all_sg').attr("checked", true);
			$('#opt_all_sg').closest('span').addClass('checked');
			$('#opt_brg_sg').attr("checked", false);
			$('#opt_brg_sg').closest('span').removeClass('checked');
			$('#opt_mnf_sg').attr("checked", false);
			$('#opt_mnf_sg').closest('span').removeClass('checked');
            var oTable = $('#datatable_productslistsingle').DataTable();
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

        $('#btn_plh_prod').on('click', function(e) {
        	e.preventDefault();

        	save_tbl_temp();

        	$('#status_modal_sp').val('');

        	selectedRows = [];
			
			$('#opt_all_ml').attr("checked", true);
			$('#opt_all_ml').closest('span').addClass('checked');
			$('#opt_brg_ml').attr("checked", false);
			$('#opt_brg_ml').closest('span').removeClass('checked');
			$('#opt_mnf_ml').attr("checked", false);
			$('#opt_mnf_ml').closest('span').removeClass('checked');

			$.uniform.update();

			var oTable = $('#datatable_productslist').DataTable();
			oTable.ajax.reload();

			$('#show_product').modal('show');

        });
        
        $('#btl_prod_ml').on('click', function(e) {
        	e.preventDefault();

        	save_tbl_temp();

        	$('#status_modal_sp').val('clear');

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

            footer_sum3();
            footer_sum4();
            footer_sum5();

			var oTable = $('#datatable_productslist').DataTable();
			oTable.ajax.reload();

            $('#show_product').modal('hide');
        });

    	function getProdNo(id_prod) {

    		// e.preventDefault();
    		if ($('#bb_kodeprod').val() != '') {
				var id_bb = $('#id_bb').val();
				// if(id_brg == ""){
					$.ajax({
						url: "<?php echo base_url("manufacture/delete_all_detail_bb");?>",
						type: "POST",
						data: {},
						cache: false,
						success: function(){
							$('#tbl_bahanbakudetail').DataTable().destroy();
							fetch_detail_bb();
						},
						error:function(){
						}
					});
				// }

				var $t = $(this),
				target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

				$(target)
					.find('input')
						.val('')
						.end()
					.find('input[type="checkbox"], input[type="radio"]')
						.prop("checked", false)
						.change();

				$.uniform.update();
    		}

    		$.ajax({
				url: "<?php echo base_url("product/getProduct");?>",
				type: "POST",
				data: {
					id_prod : id_prod
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					$('#bb_kodeprod').val(dataResult.prod_code);
					$('#bb_prodname').val(dataResult.prod_name);
					$('#bb_ket').val(dataResult.prod_code+" "+dataResult.prod_name);
				},
				error:function(){
				}
			});

        	$('#bb_idprod').val(id_prod);
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
			$('#show_product_single').modal('hide');

			// console.log(id_prod);

			return false;
    	}

    	$('#add_new_prod_bahan_detail').on("click", function(e) {
    		e.preventDefault();
    		$('#tbl_bahanbakudetail').DataTable().destroy();
    		fetch_detail_bb();
    	});
        
        function fetch_detail_bb(){
        	
			var dataTable = $('#tbl_bahanbakudetail').DataTable({
				"processing" : true,
				"serverSide" : true,
				"filter": false,
		        "paging": false,
		        "ordering": false,
		        "info": false,
		        "searching":false,
				"order" : [],
				"ajax" : {
					url:"<?= base_url('manufacture/fetch_detail_bb') ?>",
					type:"POST"
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
		   
	        // console.log(selectedRows);
		}

        $('#pilih_prod_ml').on("click", function(e) {
        	e.preventDefault();

        	save_tbl_temp();
        	
        	var brg_arr = [];

			brg_arr = selectedRows;

			var length = brg_arr.length;

			var id_bb = $('#id_bb').val();

			if(length > 0){
				// console.log(brg_arr);
				$.ajax({
					url: "<?php echo base_url("manufacture/insert_detailbb");?>",
					type: "POST",
					data: {
						id_brg : brg_arr,
						id_bb : id_bb
					},
					cache: false,
					success: function(){
						$('#tbl_bahanbakudetail').DataTable().destroy();
						fetch_detail_bb();
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
            oTable.ajax.reload();

			$('#show_product').modal('hide');

			footer_sum3();
			footer_sum4();
			footer_sum5();
        });

        $(document).on('click', '.delete', function(e){
			e.preventDefault();

			var id = $(this).attr("id");
			// console.log(id);
			$.ajax({
				url:"<?= base_url('manufacture/delete_bb_detail') ?>",
				method:"POST",
				data:{
					id_det:id
				},
				success:function(dataResult){
					// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');

					$('#tbl_bahanbakudetail').DataTable().destroy();
					fetch_detail_bb();

					var dataResult = JSON.parse(dataResult);
					let sat = dataResult.qty_satuan;
					let pak = dataResult.qty_pakai;
					let but = dataResult.qty_butuh;
					
					$('#col-qty-satuan').text(parseFloat(sat.toFixed(5)));
					$('#col-qty-pakai').text(parseFloat(pak.toFixed(5)));
					$('#col-qty-butuh').text(parseFloat(but.toFixed(5)));
				}
			});

			footer_sum3();
			footer_sum4();
			footer_sum5();

		});

		function count_detail_bb() {
			var tableData = [];

			$('#tbl_bahanbakudetail_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "qty_satuan": $(tr).find('td:eq(3) div').text(),
			    "qty_pemakaian": $(tr).find('td:eq(4) div').text(),
			    "qty_dibutuhkan": $(tr).find('td:eq(5) div').text(),
			    "keterangan": $(tr).find('td:eq(6) div').text(),
			    "qty_kemasan": $(tr).find('td:eq(7) div').text(),
			    "id_det" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			var totalQtySatuan = 0;
			var totalQtyPakai = 0;
			var totalQtyButuh = 0;

			for (var i = 0; i < tableData.length; i++) {
				totalQtySatuan += parseFloat(tableData[i].qty_satuan);
				totalQtyPakai += parseFloat(tableData[i].qty_pemakaian);
				totalQtyButuh += parseFloat(tableData[i].qty_dibutuhkan);
			}

			// console.log(totalQtySatuan);
		}

		function check_detail_bb() {
			var tableData = [];

			var hasil = 0;

			$('#tbl_bahanbakudetail_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "qty_satuan": $(tr).find('td:eq(3) div').text(),
			    "qty_pemakaian": $(tr).find('td:eq(4) div').text(),
			    "qty_dibutuhkan": $(tr).find('td:eq(5) div').text(),
			    "keterangan": $(tr).find('td:eq(6) div').text(),
			    "qty_kemasan": $(tr).find('td:eq(7) div').text(),
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

        function save_bb() {
        	var id_bb = $('#id_bb').val();
			var type = 1;

			if(id_bb !=""){
				type = 2;
			}
			var kode_brg = $('#bb_idprod').val();
			var date = $('#bb_tgl').val();
			var ket = $('#bb_ket').val();

			save_tbl_temp();

			var checkTbl = check_detail_bb();

			if(checkTbl == 1){
				$("#btn-s-bb").removeAttr("disabled");
				$("#btn-rs-bb").removeAttr("disabled");
				$("#btn-r-bb").removeAttr("disabled");
				$("#validation-bb").show();
				$('#validation-bb').html('Harap isi semua data yang dibutuhkan!');
				$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-bb").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-bb").removeAttr("disabled");
				$("#btn-rs-bb").removeAttr("disabled");
				$("#btn-r-bb").removeAttr("disabled");
				$("#validation-bb").show();
				$('#validation-bb').html('Detail Bahan Baku masih kosong!');
				$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-bb").slideUp(500);
                });

                is_valid = 0;

                return;
			}
			
			if(kode_brg!="" && date!=""){
				$("#btn-s-bb").attr("disabled", "disabled");
				$("#btn-rs-bb").attr("disabled", "disabled");
				$("#btn-r-bb").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("manufacture/action_bahanbaku");?>",
					type: "POST",
					data: {
						type: type,
						id_bb : id_bb,
						kode_brg: kode_brg,
						date: date,
						ket: ket
					},
					cache: false,
					success: function(dataResult){
						
						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){

							$("#btn-s-bb").removeAttr("disabled");
							$("#btn-rs-bb").removeAttr("disabled");
							$("#btn-r-bb").removeAttr("disabled");
							$('#frm-bb').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });

			                is_valid = 1;

			                			
						}else if(dataResult.statusCode==201){

							$("#btn-s-bb").removeAttr("disabled");
							$("#btn-rs-bb").removeAttr("disabled");
							$("#btn-r-bb").removeAttr("disabled");
							$('#frm-bb').find('input:text').val('');
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	

			                $.uniform.update();

			                is_valid = 1;
						}else if(dataResult.statusCode==405){
							$("#btn-s-bb").removeAttr("disabled");
							$("#btn-rs-bb").removeAttr("disabled");
							$("#btn-r-bb").removeAttr("disabled");
							alert('Barang sudah digunakan! Silahkan pilih bahan yang lain/hapus bahan sebelumnya!');
						}
					},
					error: function() {
						$("#btn-s-bb").removeAttr("disabled");
						$("#btn-rs-bb").removeAttr("disabled");
						$("#btn-r-bb").removeAttr("disabled");
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
				if (kode_brg == "") {
					$("#btn-s-bb").removeAttr("disabled");
					$("#btn-rs-bb").removeAttr("disabled");
					$("#btn-r-bb").removeAttr("disabled");
					$("#validation-bb").show();
					$('#validation-bb').html('No. transaksi harus diisi!');
					$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-bb").slideUp(500);
	                });
				}else if (date=="") {
					$("#btn-s-bb").removeAttr("disabled");
					$("#btn-rs-bb").removeAttr("disabled");
					$("#btn-r-bb").removeAttr("disabled");
					$("#validation-bb").show();
					$('#validation-bb').html('Tanggal wajib diisi!');
					$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-bb").slideUp(500);
	                });
				}else{
					$("#btn-s-bb").removeAttr("disabled");
					$("#btn-rs-bb").removeAttr("disabled");
					$("#btn-r-bb").removeAttr("disabled");
					$("#validation-bb").show();
					$('#validation-bb').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-bb").slideUp(500);
	                });
				}
				
                is_valid = 0;
			}
        }

        $('#btn-s-bb').on('click', function(e) {
        	e.preventDefault();
			save_bb();

			var kode_brg = $('#bb_idprod').val();
			var date = $('#bb_tgl').val();

			var checkTbl = check_detail_bb();

			if(checkTbl == 1){
				$("#btn-s-bb").removeAttr("disabled");
				$("#btn-rs-bb").removeAttr("disabled");
				$("#btn-r-bb").removeAttr("disabled");
				$("#validation-bb").show();
				$('#validation-bb').html('Harap isi semua data yang dibutuhkan!');
				$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-bb").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-bb").removeAttr("disabled");
				$("#btn-rs-bb").removeAttr("disabled");
				$("#btn-r-bb").removeAttr("disabled");
				$("#validation-bb").show();
				$('#validation-bb').html('Detail Bahan Baku masih kosong!');
				$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-bb").slideUp(500);
                });

                is_valid = 0;

                return;
			}
			
			if(kode_brg!="" && date!="" ){
				$('#add_bahanbaku').modal('hide');
			
				$.uniform.update();		
				
				$("#col-qty-satuan").val(0);
				$("#col-qty-pakai").val(0);
				$("#col-qty-butuh").val(0);

				setTimeout(function(){
				   window.location.reload();
				}, 2100);
			}else{
				if (kode_brg == "") {
					$("#btn-s-bb").removeAttr("disabled");
					$("#btn-rs-bb").removeAttr("disabled");
					$("#btn-r-bb").removeAttr("disabled");
					$("#validation-bb").show();
					$('#validation-bb').html('No. Transaksi harus diisi!');
					$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-bb").slideUp(500);
	                });
				}else if (date=="") {
					$("#btn-s-bb").removeAttr("disabled");
					$("#btn-rs-bb").removeAttr("disabled");
					$("#btn-r-bb").removeAttr("disabled");
					$("#validation-bb").show();
					$('#validation-bb').html('Tanggal transaksi harus diisi!');
					$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-bb").slideUp(500);
	                });
				}else{
					$("#btn-s-bb").removeAttr("disabled");
					$("#btn-rs-bb").removeAttr("disabled");
					$("#btn-r-bb").removeAttr("disabled");
					$("#validation-bb").show();
					$('#validation-bb').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-bb").slideUp(500);
	                });
				}
				
                is_valid = 0;
			}
		});

		//action btn save and add new
		$('#btn-rs-bb').on('click', function(e) {
			e.preventDefault();
			save_bb();

			var checkTbl = check_detail_bb();

			if(checkTbl == 1){
				$("#btn-s-bb").removeAttr("disabled");
				$("#btn-rs-bb").removeAttr("disabled");
				$("#btn-r-bb").removeAttr("disabled");
				$("#validation-bb").show();
				$('#validation-bb').html('Harap isi semua data yang dibutuhkan!');
				$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-bb").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$("#btn-s-bb").removeAttr("disabled");
				$("#btn-rs-bb").removeAttr("disabled");
				$("#btn-r-bb").removeAttr("disabled");
				$("#validation-bb").show();
				$('#validation-bb').html('Detail Bahan Baku masih kosong!');
				$("#validation-bb").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-bb").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			var id_bb = $('#id_bb').val();

			if(id_bb == ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_all_detail_bb");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bahanbakudetail').DataTable().destroy();
						fetch_detail_bb();
					},
					error:function(){
					}
				});
			}

			if(is_valid != 0){
				$("#validation-s-bb").show();
				$('#validation-s-bb').html('Data berhasil ditambahkan!');
				$("#validation-s-bb").fadeTo(2000, 500).slideUp(500, function() {
	            	$("#validation-s-bb").slideUp(500);
	            });

	            $.ajax({
					url: "<?php echo base_url("manufacture/getProsesBb");?>",
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

						$('#bb_tgl').val(today);
						console.log(today);

						var mydate = $('#bb_tgl').val();
						var dt = mydate.split("T");
						var tgl_inpt = new Date(dt[0]);
					    var hr = tgl_inpt.getDate();
					    var bln = tgl_inpt.getMonth() + 1;
					    var thn = tgl_inpt.getFullYear();

						var nopro = "BB-"+thn+bln+hr+"-00000#";
						$('#bb_noproses').val(nopro);
						$("#col-qty-satuan").val(0);
						$("#col-qty-pakai").val(0);
						$("#col-qty-butuh").val(0);

						// $('#add_bahanbaku').modal('show');
					},
					error:function(){
					}
				});

				footer_sum3();
				footer_sum4();
				footer_sum5();
			}
		});

		//action btn reset
		$('#btn-r-bb').on('click', function(e) {
			e.preventDefault();
			
			var id_bb = $('#id_bb').val();

			if(id_bb == ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_all_detail_bb");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bahanbakudetail').DataTable().destroy();
						fetch_detail_bb();
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
					url: "<?php echo base_url("manufacture/getProsesBb");?>",
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

						$('#bb_tgl').val(today);
						console.log(today);

						var mydate = $('#bb_tgl').val();
						var dt = mydate.split("T");
						var tgl_inpt = new Date(dt[0]);
					    var hr = tgl_inpt.getDate();
					    var bln = tgl_inpt.getMonth() + 1;
					    var thn = tgl_inpt.getFullYear();

						var nopro = "BB-"+thn+bln+hr+"-00000#";
						$('#bb_noproses').val(nopro);

						$('#add_bahanbaku').modal('show');
					},
					error:function(){
					}
				});


			$("#col-qty-satuan").val(0);
			$("#col-qty-pakai").val(0);
			$("#col-qty-butuh").val(0);
		});

		$('#chk_tgl').on('change', function(e) {
			e.preventDefault();
			document.getElementById('tgl_mulai').disabled = !this.checked;
			document.getElementById('tgl_selesai').disabled = !this.checked;
		});

		//function search akses
		function search_bb() {
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

			var urlist = "<?php echo base_url('manufacture/bahan');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_date + "/" + start_date + "/" + end_date + "/" + status + "/" + is_user + "/"
		    );
		    location.href = url.href;
		}

		$('#btn-rf-bb').on('click', function(e) {
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

			search_bb();

		});

		//action btn cari
		$('#btn-sf-bb').on('click', function(e) {
			search_bb();
		});

		//action ketika enter search bar
		$("#keyword-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-front").val();
		    	$("#keyword").val(keyword);
		        search_bb();
		    }
		});

		//action btn arsip
		$('#btn-a-akses').on('click', function() {
			// Get userid from checked checkboxes
				var id_arr = [];
				$(".chk-ing:checked").each(function(){
					var bbid = $(this).val();

					id_arr.push(bbid);
				});

				// Array length
				var length = id_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("manufacture/action_bahanbaku");?>",
						type: "POST",
						data: {
							type: 4,
							id_bb : id_arr
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
				$(".chk-ing:checked").each(function(){
					var bbid = $(this).val();

					id_arr.push(bbid);
				});

				// Array length
				var length = id_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("manufacture/action_bahanbaku");?>",
						type: "POST",
						data: {
							type: 3,
							id_bb : id_arr
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
					url:"<?= base_url('manufacture/update_detail_bahan') ?>",
					method:"POST",
					data:{
						id:id,
						column:column,
						value:value
					},
					success:function(data){
						$.ajax({
							url:"<?= base_url('manufacture/update_detail_bahan') ?>",
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
						// $('#tbl_bahanbakudetail').DataTable().destroy();
						// fetch_detail_bb();
					}
				});
			}
			// else{
			// 	$.ajax({
			// 		url:"<?= base_url('manufacture/update_detail_bahan') ?>",
			// 		method:"POST",
			// 		data:{
			// 			id:id,
			// 			column:column,
			// 			value:value
			// 		},
			// 		success:function(data){	
			// 			$('#tbl_bahanbakudetail').DataTable().destroy();
			// 			fetch_detail_bb();
			// 		}
			// 	});
			// }
		});

		function save_tbl_temp() {
			var tableData = [];

			$('#tbl_bahanbakudetail_body tr').each(function(row, tr){
			  tableData[row] = {
			    "prod_code": $(tr).find('td:eq(0) div').text(),
			    "prod_name": $(tr).find('td:eq(1) div').text(),
			    "satuan": $(tr).find('td:eq(2) div').text(),
			    "qty_satuan": $(tr).find('td:eq(3) div').text(),
			    "qty_pemakaian": $(tr).find('td:eq(4) div').text(),
			    "qty_dibutuhkan": $(tr).find('td:eq(5) div').text(),
			    "keterangan": $(tr).find('td:eq(6) div').text(),
			    "qty_kemasan": $(tr).find('td:eq(7) div').text(),
			    "id_det" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			$.ajax({
			url:"<?= base_url('manufacture/add_detail_bb') ?>",
				method:"POST",
				data:{tableData: tableData},
				success:function(data){
				}
			});
		}

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
				QtyHsl = (QtyPemakaian) * (QtyHit)
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

		$('#qty-modal').on('click', function() {
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

			document.getElementById('qty_paksat').selectedIndex = 6;
			document.getElementById('qty_kemsat').selectedIndex = 3;

			$('#modal_qty').modal('show');
		});

		$('#btn-close-qty, #btn-keluar-qty').on('click', function(e) {
			e.preventDefault();

			const id = $('#id_detail_bb').val();

			save_tbl_temp();

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

			var element = $('[data-id="' + id + '"][data-column="qty_satuan"]');
		    element.focus();

			footer_sum3();
			footer_sum4();
			footer_sum5();
		});
		
		$(document).on('keypress', '.update-qty', function(e){
		// $(document).on('click', '.update-qty', function(e){
			var keyCode = e.which;
			var letter = String.fromCharCode(keyCode).toLowerCase();
			var isAlpha = /^[a-z0-9]+$/i.test(letter);

			if (isAlpha || keyCode == 13) {

				e.preventDefault();

				if(keyCode == 13){
					save_tbl_temp();

					// count_footer();

					var id = $(this).data('id');
					var column = $(this).data('column');

					document.getElementById('qty_paksat').selectedIndex = 6;
					document.getElementById('qty_kemsat').selectedIndex = 3;

					$.ajax({
						url:"<?= base_url('manufacture/get_qty_prod') ?>",
						method:"POST",
						data:{
							id:id,
							column:column
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
						}
					});

					$('#modal_qty').modal('show');
				}
			}
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

		$(document).on('click', '#btn-pilih-qty', function(e){

			e.preventDefault();

			var id = $('#id_detail_bb').val();
			var qty_paksat = $("#qty_paksat option:selected").text();
			var qty_kemsat = $("#qty_kemsat option:selected").text();
			var qty_paksat_input = $("#qty_paksat_input").val();
			var qty_kemsat_input = $("#qty_kemsat_input").val();
			var qty_pakai = $('#qty_pakai').val();
			var qty_butuh = $('#qty_butuh').val();
			var qty_hasil = $('#qty_hasil_pakai').val();
			var prod_kemasan = $('#prod_kemasan').val();

			save_tbl_temp();

			$.ajax({
				url:"<?= base_url('manufacture/update_qty_detail_bb') ?>",
				method:"POST",
				data:{
					id:id,
					qty_paksat:qty_paksat,
					qty_kemsat:qty_kemsat,
					qty_paksat_input:qty_paksat_input,
					qty_kemsat_input:qty_kemsat_input,
					qty_pakai:qty_pakai,
					qty_butuh:qty_butuh,
					qty_hasil:qty_hasil,
					prod_kemasan : prod_kemasan
				},
				success:function(dataResult){
					// $('#tbl_bahanbakudetail').DataTable().destroy();
					// fetch_detail_bb();

					var el_sat = $('[data-id="' + id + '"][data-column="qty_satuan"]');
					var el_pakai = $('[data-id="' + id + '"][data-column="qty_pemakaian"]');
					var el_butuh = $('[data-id="' + id + '"][data-column="qty_dibutuhkan"]');
				    el_sat.html(qty_hasil);
				    el_pakai.html(qty_paksat_input);
				    el_butuh.html(qty_butuh);
				    el_sat.focus();

				    count_detail_bb();

					var dataResult = JSON.parse(dataResult);
					let sat = dataResult.qty_satuan;
					let pak = dataResult.qty_pakai;
					let but = dataResult.qty_butuh;

					$('#col-qty-satuan').text(parseFloat(sat.toFixed(5)));
					$('#col-qty-pakai').text(parseFloat(pak.toFixed(5)));
					$('#col-qty-butuh').text(parseFloat(but.toFixed(5)));
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
			// count_footer();
		});

		$("#qty_paksat_input").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
            	$('#qty_butuh').focus();
            }
        });

		$("#qty_butuh").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
            	$('#btn-pilih-qty').focus();
            }
        });

        $("#btn-pilih-qty").on('keydown', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
            	e.preventDefault();

				var id = $('#id_detail_bb').val();
				var qty_paksat = $("#qty_paksat option:selected").text();
				var qty_kemsat = $("#qty_kemsat option:selected").text();
				var qty_paksat_input = $("#qty_paksat_input").val();
				var qty_kemsat_input = $("#qty_kemsat_input").val();
				var qty_pakai = $('#qty_pakai').val();
				var qty_butuh = $('#qty_butuh').val();
				var qty_hasil = $('#qty_hasil_pakai').val();
				var prod_kemasan = $('#prod_kemasan').val();

				save_tbl_temp();

				$.ajax({
					url:"<?= base_url('manufacture/update_qty_detail_bb') ?>",
					method:"POST",
					data:{
						id:id,
						qty_paksat:qty_paksat,
						qty_kemsat:qty_kemsat,
						qty_paksat_input:qty_paksat_input,
						qty_kemsat_input:qty_kemsat_input,
						qty_pakai:qty_pakai,
						qty_butuh:qty_butuh,
						qty_hasil:qty_hasil,
						prod_kemasan : prod_kemasan
					},
					success:function(dataResult){
						// $('#tbl_bahanbakudetail').DataTable().destroy();
						// fetch_detail_bb();

						var el_sat = $('[data-id="' + id + '"][data-column="qty_satuan"]');
						var el_pakai = $('[data-id="' + id + '"][data-column="qty_pemakaian"]');
						var el_butuh = $('[data-id="' + id + '"][data-column="qty_dibutuhkan"]');
					    el_sat.html(qty_hasil);
					    el_pakai.html(qty_paksat_input);
					    el_butuh.html(qty_butuh);
					    el_sat.focus();

					    count_detail_bb();

						var dataResult = JSON.parse(dataResult);
						let sat = dataResult.qty_satuan;
						let pak = dataResult.qty_pakai;
						let but = dataResult.qty_butuh;

						$('#col-qty-satuan').text(parseFloat(sat.toFixed(5)));
						$('#col-qty-pakai').text(parseFloat(pak.toFixed(5)));
						$('#col-qty-butuh').text(parseFloat(but.toFixed(5)));
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

		$('#btn-b-bb').on('click', function(e) {
			e.preventDefault();
			var id_bb = $('#id_bb').val();
			// if(id_brg == ""){
				$.ajax({
					url: "<?php echo base_url("manufacture/delete_all_detail_bb");?>",
					type: "POST",
					data: {},
					cache: false,
					success: function(){
						$('#tbl_bahanbakudetail').DataTable().destroy();
						fetch_detail_bb();
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
			$('#add_bahanbaku').modal('hide');

			$("#col-qty-satuan").val(0);
			$("#col-qty-pakai").val(0);
			$("#col-qty-butuh").val(0);
		});

		//action ketika enter search bar
		$("#keyword-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-front").val();
		    	$("#keyword").val(keyword);
		        search_brg();
		    }
		});

		
		$(function() {
		    $( "#test_uom" ).on( "keyup", function( e ) {
		      var txt = String.fromCharCode(e.which);
		      if (txt.match(/1/)) {
		        $(this).val().replace( /\1/, "" );
		        $('#test_uom').val('pcs');
		      }else if(txt.match(/2/)){
		        $(this).val().replace( /\2/, "" );
		        $('#test_uom').val('lsn');
		      }else if(txt.match(/3/)){
		        $(this).val().replace( /\3/, "" );
		        $('#test_uom').val('dus');
		      }else{
		        return false;
		      }
		    } )
		} );

		$(document).on('click', '#btn-c-bb', function(e){
		 	e.preventDefault();
		 	var id_bb = $('#id_bb').val();
			var urlist = "<?php echo base_url('manufacture/print_bb_pdf');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + id_bb + "/"
		    ); 
		 	window.open(url);
		});

</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>