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
						<strong>Daftar User</strong>
						</h3>
					</div>
					<div class="add-cat-nav col-sm-2">
						<a class="btn btn-sm green-seagreen" data-toggle="modal" id="52B"><i class="fa fa-plus"></i> User Baru</a>
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
						<a href="<?php echo base_url('user/setting');?>">User Setting</a>
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
																if( !empty($user_aktif) ) {
																	foreach($user_aktif as $ua) {
																		echo"<strong>".$ua->aktif." Profil</strong>";
																	}
																}
															?>
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
															<?php
																if( !empty($user_non) ) {
																	foreach($user_non as $un) {
																		echo"<strong>".$un->non." Profil</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>User Non-Aktif</strong>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="btn-group" id="btn_act" style="display:none;">
													<a class="btn green-seagreen dropdown-toggle btn-rounded btn-sm btn-border btn-actcl" data-toggle="dropdown" href="#" id="52D">
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
													<a class="btn green-seagreen btn-sm btn-rounded-left btn-border" id="52E">
														Import
													</a>
													<div class="btn-group">
														<a class="btn green-seagreen dropdown-toggle btn-rounded-right btn-sm btn-border" data-toggle="dropdown" href="#" id="52F">
														Eksport
														</a>
														<ul class="dropdown-menu pull-right">
															<!-- <li>
																<a href="#">
																Export to Excel </a>
															</li> -->
															<li>
																<a href="#" id="btn-csv-user">
																Export to Excel </a>
															</li>
															<li>
																<a href="#" id="btn-pdf-user">
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
														<input type="text" class="form-control input-rounded-left" id="keyword-user-front" value="<?php echo $keyw;?>">
													</div>
													<div class="input-group-btn">
														<button type="button" id="search-btn-user" class="btn btn-default advance-toggle  btn-rounded-right"><i class="fa fa-angle-down" id="search-icon-user"></i></button>
														
														<div class="advance-search-toggle" id="search-toggle-user" style="min-width:250px;display: none;">
															<div class="row">
																<div class="col-sm-12" style="margin:12px 5px 15px;padding-right: 23px;">
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Kata Kunci</label>
																		<div class="col-md-12">
																			<input type="text" class="form-control input-sm dropdown-input" name="keyword-user" id="keyword-user" placeholder="" value="<?php echo $keyw;?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Akses User</label>
																		<div class="col-md-12">
																			<select class="form-control input-sm dropdown-input" name="kategori-filter" id="kategori-filter">
																				<option value="0">None</option>
																				<?php
																					if( !empty($akses_user) ) {
		    																			foreach($akses_user as $au) {
		    																	?>
																							<option value="<?php echo $au->group_user_id;?>" <?php if($grp_id == $au->group_user_id){echo "selected='selected'";}?>><?php echo $au->user_name;?></option>
																				<?php
																						}
																					}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-9 control-label" style="margin-top:10px;color:#777;">Tampilkan Arsip</label>
																		<div class="col-md-3" style="margin-top:10px;">
																			<input type="checkbox" class="form-control input-sm" name="chk-arsip-user" id="chk-arsip-user" <?php if($is_arc <>'' || $is_arc <> false){echo 'checked';}?>>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;padding: 3px 8px 0px 15px;text-align: right;">
																			<a class="btn-rf-user" id="btn-rf-user" style="color:#777;text-decoration:none;">Hapus Filter</a>
																		</div>
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;color: #777;padding: 0px 15px 0px 0px;">
																			<a class="btn green-seagreen btn-rounded" style="display:block;" name="btn-sf-user" id="btn-sf-user">
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
										
										<div class="tab-content" id="52A" style="display:none;">
											<div class="tab-pane fade active in" id="tab_2_1">
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<div class="table-actions-wrapper">
													</div>
													<table class="table table-hover" id="datatable_user">
														<thead class="thead-dark">
															<tr role="row" class="heading">
																<th width="1%" style="background-color: #1BA39C!important;">
																	<input type="checkbox" class="group-checkable checkall" onclick="calc();">
																</th>
																<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
																	 Username
																</th>
																<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
																	 Akses
																</th>
															
															</tr>
															
															<tr role="row" class="filter panel-collapse collapse" id="collapse_2">
																<td></td>
																<td>
																	<input type="text" class="form-control form-filter input-sm" name="username">
																</td>
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
            
            UserSetting.init();
            
        });

        var is_valid = 1;

        $('#pass_user, #passkon_user').on('keyup', function () {
		  if ($('#pass_user').val() == $('#passkon_user').val()) {
		    $('#message').html('Matching').css('color', 'green');
		  } else 
		    $('#message').html('Not Matching').css('color', 'red');
		});

        $(document).mouseup(function(e) 
		{
		    var container = $("#search-toggle-user");
		    var btn = $("#search-btn-user");
		    var icn = $("#search-icon-user");
		    var x = document.getElementById("search-toggle-user");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target) && !icn.is(e.target)) 
		    {
		       $("#search-toggle-user").hide();
		    }else if(btn.is(e.target) || icn.is(e.target)){
		    	
				if (x.style.display === "none") {
				  $("#search-toggle-user").show();
				} else {
				  $("#search-toggle-user").hide();
				}
		    }
		});

        var countCheckedUser = function($table, checkboxClass) {
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

        function checkUser() {
		  var result = countCheckedUser($('#datatable_user'), '.chk-set');
		  
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
		        $('.chk-set').prop('checked', this.checked);
		        var $checkboxes = $('.chk-set');
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
		function save_user() {
			var id_user = $('#id_user').val();
			var type = 1;

			if(id_user !=""){
				type = 2;
			}
			var name = $('#nama_user').val();
			var pass = $('#pass_user').val();
			var pass_kon = $('#passkon_user').val();
			
			var is_active = $('#is_act_user').prop('checked');
			var is_non = $('#is_non_user').prop('checked');
			if(is_active == true && is_non == false){
				var status = 0;
			}else{
				var status = 1;
			}

			var akses = $('#slc_akse_user').val();
			if(pass != pass_kon){
				alert('Password tidak sama!Harap isi dengan sesuai!');
			}

			if(name!="" && pass!="" &&  (is_active !="" || is_non !="") && akses != "" && pass_kon!=""){
				$("#btn-s-user").attr("disabled", "disabled");
				$("#btn-rs-user").attr("disabled", "disabled");
				$("#btn-r-user").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("user/action_user");?>",
					type: "POST",
					data: {
						type: type,
						id_user : id_user,
						name: name,
						pass: pass,
						status : status,
						akses: akses
					},
					cache: false,
					success: function(dataResult){
						
						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){
							$("#btn-s-user").removeAttr("disabled");
							$("#btn-rs-user").removeAttr("disabled");
							$("#btn-r-user").removeAttr("disabled");
							$('#frm-user').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });			
			                is_valid = 1;
						}else if(dataResult.statusCode==201){
							$("#btn-s-user").removeAttr("disabled");
							$("#btn-rs-user").removeAttr("disabled");
							$("#btn-r-user").removeAttr("disabled");
							$('#frm-user').find('input:text').val('');
							$('#frm-user').find('input:text').val('');
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	
			                is_valid = 1;

			                reload_page();
						}else if(dataResult.statusCode==405){
							$("#btn-s-user").removeAttr("disabled");
							$("#btn-rs-user").removeAttr("disabled");
							$("#btn-r-user").removeAttr("disabled");
							alert('Username sudah digunakan!Ganti username lain!');
						}
					},
					error: function() {
						$("#btn-s-user").removeAttr("disabled");
						$("#btn-rs-user").removeAttr("disabled");
						$("#btn-r-user").removeAttr("disabled");
						$('#frm-user').find('input:text').val('');
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });
		                reload_page();
					}
				});

			}else{
				$("#btn-s-user").removeAttr("disabled");
				$("#btn-rs-user").removeAttr("disabled");
				$("#btn-r-user").removeAttr("disabled");
				$("#validation-user").show();
				$('#validation-user').html('Harap isi semua data yang dibutuhkan!');
				$("#validation-user").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation-user").slideUp(500);
                });

                is_valid = 0;
			}
		}

		//action btn save
		$('#btn-s-user').on('click', function(e) {
			e.preventDefault();
			save_user();

			var name = $('#nama_user').val();
			var pass = $('#pass_user').val();
			var pass_kon = $('#passkon_user').val();
			
			var is_active = $('#is_act_user').prop('checked');
			var is_non = $('#is_non_user').prop('checked');
			if(is_active == true && is_non == false){
				var status = 0;
			}else{
				var status = 1;
			}

			var akses = $('#slc_akse_user').val();
			if(pass != pass_kon){
				alert('Password tidak sama!Harap isi dengan sesuai!');
			}

			if(name!="" && pass!="" &&  (is_active !="" || is_non !="") && akses != "" && pass_kon!=""){
				reload_page();		
				$('#add_user').modal('hide');	
			}
			
		});

		//action btn save and add new
		$('#btn-rs-user').on('click', function(e) {
			e.preventDefault();
			save_user();
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
				$("#validation-s-user").show();
				$('#validation-s-user').html('Data berhasil ditambahkan!');
				$("#validation-s-user").fadeTo(2000, 500).slideUp(500, function() {
	            	$("#validation-s-user").slideUp(500);
	            });
			}
		});

		//action btn reset
		$('#btn-r-user').on('click', function(e) {
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
		$('#52F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});

		//btn import
		$('#52E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});

		//btn aksi
		$('#52D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}		
		});
		

		// action edit clicked row
		function cae_user(id_user) {
			var x = document.getElementById("52C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
	            // Set data to Form Edit
	            $('#id_user').val(id_user);
	            $.ajax({
					url: "<?php echo base_url("user/get_edit_data_user");?>",
					type: "POST",
					data: {
						id_user: id_user
					},
					cache: false,
					success: function(dataResult){
						// console.log(dataResult);
						var json_data = JSON.parse(dataResult);
						
						$('#id_user').val(json_data.user_id);
						$('#nama_user').val(json_data.user_name);
						$('#pass_user').val(json_data.user_pass);

						var status = json_data.status;
						if(status == 0 ){
							$('#is_act_user').prop('checked', true);
							$('#is_non_user').prop('checked', false);
						}else{
							$('#is_act_user').prop('checked', false);
							$('#is_non_user').prop('checked', true);
						}
						$('#slc_akse_user').val(json_data.group_user_id);

						$.uniform.update();
					}
				});

				$('#add_user').modal('show');
			}
		}

		//btn add new
		$('#52B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$('#is_act_user').attr('checked', true);
				$('#is_act_user').closest('span').addClass('checked');
				$('#is_non_user').attr('checked', false);
				$('#is_non_user').closest('span').removeClass('checked');
				$('#add_user').modal('show');
				// $('#tree_1').jstree(true).deselect_all();
			}		
		});

		//btn delete item
		$('#btn-h-akses').on('click', function() {
			// Get userid from checked checkboxes
				var user_arr = [];
				$(".chk-set:checked").each(function(){
					var userid = $(this).val();

					user_arr.push(userid);
				});

				// Array length
				var length = user_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("user/action_user");?>",
						type: "POST",
						data: {
							type: 3,
							id_user : user_arr
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
		function search_user() {
			var keyword = $("#keyword-user").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip-user").prop("checked");
			var group_user_id = $('#kategori-filter').val();
			var urlist = "<?php echo base_url('user/setting');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/" + group_user_id + "/"
		    );
		    location.href = url.href;
		}

		//action btn arsip
		$('#btn-a-akses').on('click', function() {
			// Get userid from checked checkboxes
				var user_arr = [];
				$(".chk-set:checked").each(function(){
					var userid = $(this).val();

					user_arr.push(userid);
				});

				// Array length
				var length = user_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("user/action_user");?>",
						type: "POST",
						data: {
							type: 4,
							id_user : user_arr
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
		$('#btn-rf-user').on('click', function(e) {
			$('#chk-arsip-user').prop("checked", false);
			$('#keyword-user').val("");
			$('#keyword-user-front').val("");
			$('#kategori-filter').val("0");

			$.uniform.update();

			search_user();

		});

		//action btn cari
		$('#btn-sf-user').on('click', function(e) {
			search_user();
		});

		//action ketika enter search bar
		$("#keyword-user-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-user-front").val();
		    	$("#keyword-user").val(keyword);
		        search_user();
		    }
		});

		$(document).on('click', '#btn-pdf-user', function(e){
		 	e.preventDefault();

		 	var keyword = $("#keyword-user").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip-user").prop("checked");
			var group_user_id = $('#kategori-filter').val();
			var urlist = "<?php echo base_url('user/print_user_pdf');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/" + group_user_id + "/"
		    );
		    window.open(url);

		});

		$(document).on('click', '#btn-csv-user', function(e){
		 	e.preventDefault();
		 	var keyword = $("#keyword-user").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip-user").prop("checked");
			var group_user_id = $('#kategori-filter').val();
			var urlist = "<?php echo base_url('user/print_user_csv');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/" + group_user_id + "/"
		    );
		    window.open(url);
		});
</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>