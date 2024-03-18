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
						<strong>Daftar Kategori</strong>
						</h3>
					</div>
					<div class="add-cat-nav col-sm-2">
						<a class="btn btn-sm green-seagreen" data-toggle="modal" id="22B"><i class="fa fa-plus"></i> Kategori Baru</a>
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
						<a href="<?php echo base_url('category/page');?>">Master Kategori</a>
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
																if( !empty($cat_aktif) ) {
																	foreach($cat_aktif as $ua) {
																		echo"<strong>".$ua->aktif." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Kategori Aktif</strong>
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
																if( !empty($cat_non) ) {
																	foreach($cat_non as $ua) {
																		echo"<strong>".$ua->non." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Kategori Non-Aktif</strong>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												
												<div class="btn-group" id="btn_act" style="display:none;">
													<a class="btn green-seagreen dropdown-toggle btn-rounded btn-sm btn-border btn-actcl" data-toggle="dropdown" href="#" id="22D">
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
													<a class="btn green-seagreen btn-sm btn-rounded-left btn-border" id="22E">
														Import
													</a>
													<div class="btn-group">
														<a class="btn green-seagreen dropdown-toggle btn-rounded-right btn-sm btn-border" data-toggle="dropdown" href="#" id="22F">
														Eksport
														</a>
														<ul class="dropdown-menu pull-right">
															<!-- <li>
																<a href="#" id="btn-exc-kat">
																Export to Excel </a>
															</li> -->
															<li>
																<a href="#" id="btn-csv-kat">
																Export to Excel </a>
															</li>
															<li>
																<a href="#" id="btn-pdf-kat">
																Export to PDF </a>
															</li>
														</ul>
													</div>
												</div>
											</div>
											<div class="col-sm-3 pdg-search">
												<div class="input-group">
													<div class="input-icon">
														<i class="fa fa-search"></i>
														<input type="text" class="form-control input-rounded-left" id="keyword-front" value="<?php echo $keyw;?>">
													</div>
													<div class="input-group-btn">
														<button type="button" id="search-btn-kategori" class="btn btn-default advance-toggle  btn-rounded-right"><i class="fa fa-angle-down" id="search-icn-kategori"></i></button>
														<div class="advance-search-toggle" id="search-toggle-kategori" style="min-width:250px;display: none;">
															<div class="row">
																<div class="col-sm-12" style="margin:12px 5px 15px;padding-right: 23px;">
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Kata Kunci</label>
																		<div class="col-md-12">
																			<input type="text" class="form-control input-sm dropdown-input" name="keyword" id="keyword" placeholder="" value="<?php echo $keyw;?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-9 control-label" style="margin-top:10px;color:#777;">Tampilkan Arsip</label>
																		<div class="col-md-3" style="margin-top:10px;">
																			<input type="checkbox" class="form-control input-sm" name="chk-arsip" id="chk-arsip" <?php if($is_arc <>'' || $is_arc <> false){echo 'checked';}?>>
																		</div>
																		<div class="col-sm-12">
																			<!-- <div class="material-switch pull-right">
													                            <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"/>
													                            <label for="someSwitchOptionPrimary" class="label-primary"></label>
													                        </div> -->
													                        <!-- <div class="checkbox checbox-switch switch-primary">
											                                    <label>
											                                        <input type="checkbox" name="chk-switch" checked >
											                                        <span></span>
											                                    </label>
											                                </div> -->
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;padding: 3px 8px 0px 15px;text-align: right;">
																			<a class="" style="color:#777;text-decoration:none;" id="btn-rf-cat">Hapus Filter</a>
																		</div>
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;color: #777;padding: 0px 15px 0px 0px;">
																			<a class="btn green-seagreen btn-rounded" style="display:block;" id="btn-sf-cat">
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
										
										<div class="tab-content" id="22A" style="display:none;">
											<div class="tab-pane fade active in" id="tab_2_1">
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<div class="table-actions-wrapper">
													</div>
													<table class="table table-hover" id="datatable_category">
														<thead class="thead-dark">
															<tr role="row" class="heading">
																<th width="1%" style="background-color: #1BA39C!important;">
																	<input type="checkbox" class="group-checkable checkall" onclick="calc();">
																</th>
																<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
																	 Kode&nbsp;Kategori
																</th>
																<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
																	 Nama&nbsp;Kategori
																</th>
															
															</tr>
															<tr role="row" class="filter panel-collapse collapse" id="collapse_2">
																<td></td>
																<td>
																	<input type="text" class="form-control form-filter input-sm" name="category_kode">
																</td>
																<td>
																	<input type="text" class="form-control form-filter input-sm" name="category_name">
																</td>
																
																
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
            
            EcommerceCategories.init();

            $('#22').addClass('active');
            
        });

        var is_valid = 1;

        var countCheckedCat = function($table, checkboxClass) {
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

        function checkCategory() {
		  var result = countCheckedCat($('#datatable_category'), '.chk-cat');
		  
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
		        $('.chk-cat').prop('checked', this.checked);
		        var $checkboxes = $('.chk-cat');
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
		    var container = $("#search-toggle-kategori");
		    var btn = $("#search-btn-kategori");
		    var icn = $("#search-icn-kategori");
		    var x = document.getElementById("search-toggle-kategori");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target) && !icn.is(e.target)) 
		    {
		        $("#search-toggle-kategori").hide();
		    }else if(btn.is(e.target) || icn.is(e.target)){
		    	
				if (x.style.display === "none") {
				  $("#search-toggle-kategori").show();
				} else {
				  $("#search-toggle-kategori").hide();
				}
		    }
		});

		function reload_page() {
			setTimeout(function(){
			   window.location.reload();
			}, 1600);
		}
		//function for save and edit
		function save_kat() {
			var id_kat = $('#id_kat').val();
			var type = 1;

			if(id_kat !=""){
				type = 2;
			}
			var kode = $('#kode_kat').val();
			var nama = $('#nama_kat').val();
			
			var is_active = $('#is_act_kat').prop('checked');
			var is_non = $('#is_non_kat').prop('checked');
			if(is_active == true && is_non == false){
				var status = 0;
			}else{
				var status = 1;
			}

			if(kode!="" && nama!="" &&  (is_active !="" || is_non !="")){
				$("#btn-s-kat").attr("disabled", "disabled");
				$("#btn-rs-kat").attr("disabled", "disabled");
				$("#btn-r-kat").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("category/action_category");?>",
					type: "POST",
					data: {
						type: type,
						id_kat : id_kat,
						kode: kode,
						nama: nama,
						status : status
					},
					cache: false,
					success: function(dataResult){
						
						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){
							$("#btn-s-kat").removeAttr("disabled");
							$("#btn-rs-kat").removeAttr("disabled");
							$("#btn-r-kat").removeAttr("disabled");
							$('#frm-kat').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	

			                is_valid = 1;		
						}else if(dataResult.statusCode==201){
							$("#btn-s-kat").removeAttr("disabled");
							$("#btn-rs-kat").removeAttr("disabled");
							$("#btn-r-kat").removeAttr("disabled");
							$('#frm-kat').find('input:text').val('');
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	

			                $.uniform.update();

			                is_valid = 1;
						}else if(dataResult.statusCode==405){
							$("#btn-s-kat").removeAttr("disabled");
							$("#btn-rs-kat").removeAttr("disabled");
							$("#btn-r-kat").removeAttr("disabled");
							alert('Kode Kategori sudah digunakan!Ganti kode lain!');
						}
					},
					error: function() {
						$("#btn-s-kat").removeAttr("disabled");
						$("#btn-rs-kat").removeAttr("disabled");
						$("#btn-r-kat").removeAttr("disabled");
						$('#frm-kat').find('input:text').val('');
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });

		                $.uniform.update();
		                reload_page();
					}
				});

			}else{
				if(kode ==""){
					$("#btn-s-kat").removeAttr("disabled");
					$("#btn-rs-kat").removeAttr("disabled");
					$("#btn-r-kat").removeAttr("disabled");
					$("#validation-kat").show();
					$('#validation-kat').html('Kode kategori harus diisi!');
					$("#validation-kat").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-kat").slideUp(500);
	                });	
				}else if (nama =="") {
					$("#btn-s-kat").removeAttr("disabled");
					$("#btn-rs-kat").removeAttr("disabled");
					$("#btn-r-kat").removeAttr("disabled");
					$("#validation-kat").show();
					$('#validation-kat').html('Nama kategori harus diisi!');
					$("#validation-kat").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-kat").slideUp(500);
	                });	
				}else{
					$("#btn-s-kat").removeAttr("disabled");
					$("#btn-rs-kat").removeAttr("disabled");
					$("#btn-r-kat").removeAttr("disabled");
					$("#validation-kat").show();
					$('#validation-kat').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-kat").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-kat").slideUp(500);
	                });	
				}

                is_valid = 0;
			}
		}

		//action btn save
		$('#btn-s-kat').on('click', function(e) {
			e.preventDefault();
			save_kat();

			var kode = $('#kode_kat').val();
			var nama = $('#nama_kat').val();
			
			var is_active = $('#is_act_kat').prop('checked');
			var is_non = $('#is_non_kat').prop('checked');

			if(is_active == true && is_non == false){
				var status = 0;
			}else{
				var status = 1;
			}

			if(kode!="" && nama!="" &&  (is_active !="" || is_non !="")){
				$('#add_category').modal('hide');
				$.uniform.update();	
				var oTable = $('#datatable_category').DataTable();
				oTable.draw();
			}else{
				if(kode ==""){
					$("#btn-s-kat").removeAttr("disabled");
					$("#btn-rs-kat").removeAttr("disabled");
					$("#btn-r-kat").removeAttr("disabled");
					$("#validation-kat").show();
					$('#validation-kat').html('Kode kategori harus diisi!');
					$("#validation-kat").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-kat").slideUp(500);
	                });	
				}else if (nama =="") {
					$("#btn-s-kat").removeAttr("disabled");
					$("#btn-rs-kat").removeAttr("disabled");
					$("#btn-r-kat").removeAttr("disabled");
					$("#validation-kat").show();
					$('#validation-kat').html('Nama kategori harus diisi!');
					$("#validation-kat").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-kat").slideUp(500);
	                });	
				}else{
					$("#btn-s-kat").removeAttr("disabled");
					$("#btn-rs-kat").removeAttr("disabled");
					$("#btn-r-kat").removeAttr("disabled");
					$("#validation-kat").show();
					$('#validation-kat').html('Harap isi semua data yang dibutuhkan!');
					$("#validation-kat").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#validation-kat").slideUp(500);
	                });	
				}

                is_valid = 0;
			}
		});

		//action btn save and add new
		$('#btn-rs-kat').on('click', function(e) {
			e.preventDefault();
			save_kat();

			if(is_valid != 0 ){
				$("#validation-s-kat").show();
				$('#validation-s-kat').html('Data berhasil ditambahkan!');
				$("#validation-s-kat").fadeTo(2000, 500).slideUp(500, function() {
	            	$("#validation-s-kat").slideUp(500);
	            });
			}

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
		});

		//action btn reset
		$('#btn-r-kat').on('click', function(e) {
			e.preventDefault();
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

		$('#22F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#22E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#22D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});

		// action edit clicked row
		function cae_kategori(id_kat) {
			var x = document.getElementById("22C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
	            // Set data to Form Edit
	            $('#id_kat').val(id_kat);
	            $.ajax({
					url: "<?php echo base_url("category/get_edit_data");?>",
					type: "POST",
					data: {
						id_kat: id_kat
					},
					cache: false,
					success: function(dataResult){
						// console.log(dataResult);
						var json_data = JSON.parse(dataResult);
						
						$('#id_kat').val(json_data.kat_id);
						$('#kode_kat').val(json_data.kat_kode);
						$('#nama_kat').val(json_data.kat_nama);

						var status = json_data.status;

						// console.log(status);
						if(status == 0 ){
							$('#is_act_kat').prop('checked', true);
							$('#is_non_kat').prop('checked', false);
						}else{
							$('#is_act_kat').prop('checked', false);
							$('#is_non_kat').prop('checked', true);
						}

						$.uniform.update();
					}
				});

				$('#add_category').modal('show');
			}
		}

		//btn add new
		$('#22B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$('#is_act_kat').attr('checked', true);
				$('#is_act_kat').closest('span').addClass('checked');
				$('#is_non_kat').attr('checked', false);
				$('#is_non_kat').closest('span').removeClass('checked');
				$('#add_category').modal('show');
			}		
		});

		//btn delete item
		$('#btn-h-akses').on('click', function() {
			// Get userid from checked checkboxes
				var cat_arr = [];
				$(".chk-cat:checked").each(function(){
					var catid = $(this).val();

					cat_arr.push(catid);
				});

				// Array length
				var length = cat_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("category/action_category");?>",
						type: "POST",
						data: {
							type: 3,
							id_kat : cat_arr
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

		//function search akses
		function search_kat() {
			var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var urlist = "<?php echo base_url('category/page');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/"
		    );
		    location.href = url.href;
		}

		//action btn arsip
		$('#btn-a-akses').on('click', function() {
			// Get userid from checked checkboxes
				var cat_arr = [];
				$(".chk-cat:checked").each(function(){
					var catid = $(this).val();

					cat_arr.push(catid);
				});

				// Array length
				var length = cat_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("category/action_category");?>",
						type: "POST",
						data: {
							type: 4,
							id_kat : cat_arr
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

		//action btn reset filter
		$('#btn-rf-cat').on('click', function(e) {
			$('#chk-arsip').prop("checked", false);
			$('#keyword').val("");
			$('#keyword-front').val("");

			$.uniform.update();

			search_kat();

		});

		//action btn cari
		$('#btn-sf-cat').on('click', function(e) {
			search_kat();
		});

		//action ketika enter search bar
		$("#keyword-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-front").val();
		    	$("#keyword").val(keyword);
		        search_kat();
		    }
		});

		$(document).on('click', '#btn-pdf-kat', function(e){
		 	e.preventDefault();

		 	var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var urlist = "<?php echo base_url('category/print_pdf');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/"
		    ); 
		 	window.open(url);
		});

		$(document).on('click', '#btn-csv-kat', function(e){
		 	e.preventDefault();
		 	var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var urlist = "<?php echo base_url('category/print_csv');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/"
		    ); 
		 	window.open(url);
		});

		$(document).on('click', '#btn-exc-kat', function(e){
		 	e.preventDefault();
		 	var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var urlist = "<?php echo base_url('category/print_exc');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/"
		    ); 
		 	window.open(url);
		});

		$('#btn-b-kat').on('click', function(e) {
			e.preventDefault();
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
			$('#add_category').modal('hide');
			var oTable = $('#datatable_category').DataTable();
			oTable.draw();
		});
</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>