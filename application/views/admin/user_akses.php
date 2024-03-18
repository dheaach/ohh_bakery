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
						<strong>Daftar Akses</strong>
						</h3>
					</div>
					<div class="add-cat-nav col-sm-2">
						<a class="btn btn-sm green-seagreen" data-toggle="modal" id="53B"><i class="fa fa-plus"></i> Akses Baru</a>
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
						<a href="<?php echo base_url('user/akses');?>">User Akses</a>
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
						<!-- <div class="portlet-title"> -->
							<!-- <div class="caption font-green-seagreen">
								<strong>Daftar Barang</strong>
							</div> -->
							<!-- <div class="actions">
								<div class="btn-group dropdown dropdown-quick-sidebar-toggler">
									<a class="accordion-toggle btn btn-sm btn-success filter-submit tooltips" data-toggle="collapse" data-container="body" data-placement="top" data-original-title="Import Data" href="#collapse_2">
									<i class="fa fa-upload"></i>
									</a>
								</div>
								
								
								<a class="accordion-toggle btn btn-sm blue filter-submit tooltips" data-toggle="collapse" data-container="body" data-placement="top" data-original-title="Cari Produk" href="#collapse_2">
								<i class="fa fa-search"></i>
								</a>
								<button class="btn btn-sm blue-ebonyclay filter-submit tooltips" data-container="body" data-placement="top" data-original-title="Muat Ulang"><i class="fa fa-refresh"></i></button>
								<div class="btn-group">
									<a class="btn default yellow-stripe dropdown-toggle" href="#">
									<i class="fa fa-download"></i> <i class="fa fa-angle-down"></i>
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
											Export to XML </a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
											Print Invoices </a>
										</li>
									</ul>
								</div>
							</div> -->
						<!-- </div> -->
						<div class="portlet-body">
							<div class="tabbable-line">
								<!-- <ul class="nav nav-tabs ">
									<li class="active">
										<a href="#tab_15_1" data-toggle="tab">
										Barang</a>
									</li>
								</ul> -->
								<div class="tab-content">
									<div class="tab-pane active" id="tab_15_1">
										<!-- <div class="row">
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
															 <strong>0 Profil</strong>
														</div>
														<div class="desc db-desc">
															 <strong>User Aktif</strong>
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
															 <strong>0 Profil</strong>
														</div>
														<div class="desc db-desc">
															 <strong>User Non-Aktif</strong>
														</div>
													</div>
												</div>
											</div>
										</div> -->
										<div class="row">
											<div class="col-sm-6">
												<!-- <ul class="nav nav-pills">
													<li class="active">
														<a href="#tab_2_1" data-toggle="tab" class="btn green-seagreen btn-sm btn-rounded-left btn-border">
														Kategori </a>
													</li>
													<li>
														<a href="#tab_2_2" data-toggle="tab" class="btn green-seagreen btn-sm btn-rounded-right btn-border">
														Sub-Kategori </a>
													</li>
												</ul> -->
												<div class="btn-group" id="btn_act" style="display:none;">
													<a class="btn green-seagreen dropdown-toggle btn-rounded btn-sm btn-border btn-actcl" data-toggle="dropdown" href="#" id="53D">
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
												<!-- <div class="btn-group">
													<a class="btn green-seagreen btn-sm btn-rounded-left btn-border" id="53E">
														Import
													</a>
													<div class="btn-group">
														<a class="btn green-seagreen dropdown-toggle btn-rounded-right btn-sm btn-border" data-toggle="dropdown" href="#" id="53F">
														Eksport
														</a>
														<ul class="dropdown-menu pull-right">
															<li>
																<a href="#">
																Export to Excel </a>
															</li>
															<li>
																<a href="#">
																Export to Excel </a>
															</li>
															<li>
																<a href="#">
																Export to PDF </a>
															</li>
														</ul>
													</div>
												</div> -->
											</div>
											<div class="col-sm-3 pdg-search">
												<div class="input-group" id="akses-search">
													<div class="input-icon">
														<i class="fa fa-search"></i>
														<input type="text" class="form-control input-rounded-left" id="keyword-akses-front" value="<?php echo $keyw;?>">
													</div>
													<div class="input-group-btn">
														<button type="button" id="search-btn-setting" class="btn btn-default advance-toggle  btn-rounded-right"><i class="fa fa-angle-down" id="search-icon-setting"></i></button>
														
														<div class="advance-search-toggle" id="search-toggle-setting" style="min-width:250px;display: none;">
															<div class="row">
																<div class="col-sm-12" style="margin:12px 5px 15px;padding-right: 23px;">
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Kata Kunci</label>
																		<div class="col-md-12">
																			<input type="text" class="form-control input-sm dropdown-input" name="keyword-akses" id="keyword-akses" placeholder="" value="<?php echo $keyw;?>">
																		</div>
																	</div>
																	
																	<div class="form-group">
																		<label class="col-md-9 control-label" style="margin-top:10px;color:#777;">Tampilkan Arsip</label>
																		<div class="col-md-3" style="margin-top:10px;">
																			<input type="checkbox" class="form-control input-sm" name="chk-arsip-akses" id="chk-arsip-akses" <?php if($is_arc <>'' || $is_arc <> false){echo 'checked';}?>>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;padding: 3px 8px 0px 15px;text-align: right;">
																			<a class="btn-rf-akses" id="btn-rf-akses" style="color:#777;text-decoration:none;">Hapus Filter</a>
																		</div>
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;color: #777;padding: 0px 15px 0px 0px;">
																			<a class="btn green-seagreen btn-rounded" style="display:block;" name="btn-sf-akses" id="btn-sf-akses">
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
										
										<div class="tab-content" id="53A" style="display:none;">
											<div class="tab-pane fade active in" id="tab_2_1">
												<div class="row">
													<div class="col-sm-6">
														<div class="table-scrollable" style="border: 0px solid #dddddd;">
															<div class="table-actions-wrapper">
															</div>
															<table class="table table-hover" id="datatable_akses">
																<thead class="thead-dark">
																	<tr role="row" class="heading">
																		<th width="4%" style="background-color: #1BA39C!important;">
																			<input type="checkbox" class="group-checkable checkall" onclick="calc();">
																		</th>
																		<th width="96%" style="background-color: #1BA39C!important;color:white!important;">
																			 Nama Akses
																		</th>
																	
																	</tr>
																	<tr role="row" class="filter panel-collapse collapse" id="collapse_2">
																		<td></td>
																		<td>
																			<input type="text" class="form-control form-filter input-sm" name="akses">
																		</td>
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
															
														</div>
													</div>
													<div class="col-sm-6">
														<div class="portlet green-seagreen box">
															<div class="portlet-title tree">
																<div class="caption" style="font-size: 13px;font-weight: 500;">
																	Hak Akses
																</div>
															</div>
															<div class="portlet-body" id="body_tree_2">
																<div id="tree_2" class="tree-demo">
																</div>
															</div>
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
            
            UserAkses.init();//load datatable
            UITree.init();//load checkbox user akses
            
        });

        var is_valid = 1;

        //js for open detail seach toggle
		$(document).mouseup(function(e) 
		{
		    var container = $("#search-toggle-setting");
		    var btn = $("#search-btn-setting");
		    var icn = $("#search-icon-setting");
		    var x = document.getElementById("search-toggle-setting");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target) && !icn.is(e.target)) 
		    {
		       $("#search-toggle-setting").hide();
		    }else if(btn.is(e.target) || icn.is(e.target)){
		    	
				if (x.style.display === "none") {
				  $("#search-toggle-setting").show();
				} else {
				  $("#search-toggle-setting").hide();
				}
		    }
		});

        //get slected hak akses
        function getIDTree(id) {
        	var nodes = $(id).jstree('get_selected');
        	let str = nodes.toString();
			let hasil = str.replace(/,/g,' ');
        	return hasil;
        }

        var countCheckedAkses = function($table, checkboxClass) {
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
		//aksi untuk checkbox super user
		function super_user_check() {
		    if (document.getElementById('is_super_akses').checked){
			  $('#tree_1').jstree(true).select_all();
			} else {
			  $('#tree_1').jstree(true).deselect_all();
			}
		}
		
		//show button aksi and show table detail
        function checkAkses() {
		  var result = countCheckedAkses($('#datatable_akses'), '.chk-akses');
		  
		  $('#myText').html(result.checked);
		  var p = document.getElementById('myText');
		  var text = p.textContent;
		  var number = Number(text);

		  if (number > 0){
		    btn_act.style.display = "block";
		    var val_check = $('.chk-akses:checked').val();
		    $('#tree_2').jstree(true).deselect_all();
			  $.ajax({
						url: "<?php echo base_url("user/get_user_right");?>",
						type: "POST",
						data: {
							id_akses: val_check
						},
						cache: false,
						success: function(dataResult){
							// console.log(dataResult);
							var json_data = JSON.parse(dataResult);
							var user_right = json_data.user_right;
							// console.log(id_akses);
							// console.log(json_data.user_name);
							// console.log(is_super);
							// console.log(user_right);
							var cbd = user_right.split(" ");
							var arrayLength = cbd.length;
							// console.log(cbd);
							for (var i = 0; i < arrayLength; i++) {
							    $('#tree_2').jstree('select_node', cbd);
							}
							$.uniform.update();
						}
					});
		  } else {
		  	$('#tree_2').jstree(true).deselect_all();
		    btn_act.style.display = "none";
		  }
		}

		//count checked row in table
		function calc()
		{
			$('.checkall').click(function (event) {    
		        $('.chk-akses').prop('checked', this.checked);
		        var $checkboxes = $('.chk-akses');
		        var number = $checkboxes.filter(':checked').length;
		        
		        var p = document.getElementById('myText');
		  		
		        if (number > 0){
				    btn_act.style.display = "block";
				  } else {
				    btn_act.style.display = "none";
				  }
		    });
		}

		
		function reload_page() {
			setTimeout(function(){
			   window.location.reload();
			}, 1600);
		}
		//function for save and edit
		function save_akses() {
			var id_akses = $('#id_akses').val();
			var type = 1;
			if(id_akses !=""){
				type = 2;
			}else{
				id_akses = "";
			}
			var name = $('#nama_akses').val();
			var is_super = $('#is_super_akses').prop('checked');

			var user_right = getIDTree('#tree_1');
			if(name!=""){
				$("#btn-s-akses").attr("disabled", "disabled");
				$("#btn-rs-akses").attr("disabled", "disabled");
				$("#btn-r-akses").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("user/action_akses");?>",
					type: "POST",
					data: {
						type: type,
						id_akses : id_akses,
						name: name,
						is_super: is_super,
						user_right: user_right
					},
					cache: false,
					success: function(dataResult){

						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){
							$("#btn-s-akses").removeAttr("disabled");
							$("#btn-rs-akses").removeAttr("disabled");
							$("#btn-r-akses").removeAttr("disabled");
							$('#frm-user-akses').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });			
			                
			                is_valid = 1;		
						}else if(dataResult.statusCode==201){
							$("#btn-s-akses").removeAttr("disabled");
							$("#btn-rs-akses").removeAttr("disabled");
							$("#btn-r-akses").removeAttr("disabled");
							$('#frm-user-akses').find('input:text').val('');
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	
			                is_valid = 1;
			                reload_page();
						}else if(dataResult.statusCode==405){
							$("#btn-s-akses").removeAttr("disabled");
							$("#btn-rs-akses").removeAttr("disabled");
							$("#btn-r-akses").removeAttr("disabled");
							alert('Nama Akses sudah digunakan!');
							
						}
					},
					error: function() {
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });
		                reload_page();
					}
				});

			}else{
				$("#name_validation").show();
				$('#name_validation').html('Nama Akses tidak boleh kosong!');
				is_valid = 0;
			}
		}

		//action btn save
		$('#btn-s-akses').on('click', function(e) {
			e.preventDefault();
			save_akses();
			var name = $('#nama_akses').val();
			
			if(name!=""){
				reload_page();
				$('#add_akses').modal('hide');
			}
			
		});

		//action btn save and add new
		$('#btn-rs-akses').on('click', function(e) {
			e.preventDefault();
			save_akses();

			$('#tree_1').jstree(true).deselect_all();
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

			if(is_valid != 0){
				$("#validation-s-akses").show();
				$('#validation-s-akses').html('Data berhasil ditambahkan!');
				$("#validation-s-akses").fadeTo(2000, 500).slideUp(500, function() {
	            	$("#validation-s-akses").slideUp(500);
	            });
			}

		});

		//action btn reset
		$('#btn-r-akses').on('click', function(e) {
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


		//btn eksport
		$('#53F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});

		//btn import
		$('#53E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});

		//btn aksi
		$('#53D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}		
		});
		

		// action edit clicked row
		function cae_akses(id_akses) {
			var x = document.getElementById("53C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
	            // Set data to Form Edit
	 			$('#tree_1').jstree(true).deselect_all();
	            $('#id_akses').val(id_akses);
	            $.ajax({
					url: "<?php echo base_url("user/get_edit_data");?>",
					type: "POST",
					data: {
						id_akses: id_akses
					},
					cache: false,
					success: function(dataResult){
						// console.log(dataResult);
						var json_data = JSON.parse(dataResult);
						var is_super = json_data.is_Super;
						var user_right = json_data.user_right;

						$('#id_akses').val(json_data.group_user_id);
						$('#nama_akses').val(json_data.user_name);

						if(is_super!=='1'){is_super = false}else{ is_super=true;}
						$('#is_super_akses').prop("checked", is_super);

						// console.log(id_akses);
						// console.log(json_data.user_name);
						// console.log(is_super);
						// console.log(user_right);

						var cbd = user_right.split(" ");
						var arrayLength = cbd.length;
						// console.log(cbd);
						for (var i = 0; i < arrayLength; i++) {
						    $('#tree_1').jstree('select_node', cbd);
						}
						$.uniform.update();
					}
				});

				$('#add_akses').modal('show');
			}
		}

		//btn add new
		$('#53B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$('#add_akses').modal('show');
			}		
		});

		//btn delete item
		$('#btn-h-akses').on('click', function() {
			// Get userid from checked checkboxes
				var akses_arr = [];
				$(".chk-akses:checked").each(function(){
					var aksesid = $(this).val();

					akses_arr.push(aksesid);
				});

				// Array length
				var length = akses_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("user/action_akses");?>",
						type: "POST",
						data: {
							type: 3,
							id_akses : akses_arr
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
		function search_akses() {
			var keyword = $("#keyword-akses").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip-akses").prop("checked");
			var urlist = "<?php echo base_url('user/akses');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/"
		    );
		    location.href = url.href;
		}

		//action btn arsip
		$('#btn-a-akses').on('click', function() {
			// Get userid from checked checkboxes
				var akses_arr = [];
				$(".chk-akses:checked").each(function(){
					var aksesid = $(this).val();

					akses_arr.push(aksesid);
				});

				// Array length
				var length = akses_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("user/action_akses");?>",
						type: "POST",
						data: {
							type: 4,
							id_akses : akses_arr
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
		$('#btn-rf-akses').on('click', function(e) {
			$('#chk-arsip-akses').prop("checked", false);
			$('#keyword-akses').val("");
			$('#keyword-akses-front').val("");

			$.uniform.update();

			search_akses();

		});

		//action btn cari
		$('#btn-sf-akses').on('click', function(e) {
			search_akses();
		});

		//action ketika enter search bar
		$("#keyword-akses-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-akses-front").val();
		    	$("#keyword-akses").val(keyword);
		        search_akses();
		    }
		});

		

</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>