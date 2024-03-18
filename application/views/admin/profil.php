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
						<strong>Profil Outlet</strong>
						</h3>
					</div>
					<div class="add-product-nav col-sm-2">
						<!-- <a class="btn btn-sm green-seagreen filter-submit" data-toggle="modal" href="#add_product"><i class="fa fa-plus"></i> Barang Baru</a> -->
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
						<a href="<?php echo base_url('profil');?>">Profil</a>
					</li>
				</ul>
			</div>
			<!-- BEGIN PAGE CONTENT -->
			<div class="row" id="51A" style="display:none;">
				<div class="col-md-12">				
					<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
					</div>
					<div class="alert alert-danger alert-dismissible" id="failed" style="display:none;">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
					</div>
				</div>
				<div class="col-md-12">
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row">
							<div class="col-md-3">
								<div class="portlet light profile-sidebar-portlet own">
									<!-- SIDEBAR USERPIC -->
									<div class="profile-userpic own">
										<img class="images own" id="user-image" src="<?php echo base_url();?>assets/admin/layout/img/logo_ohh_dark.png" class="img-responsive" alt="">
										<!-- <img id="user-image" src="<?php echo base_url();?>assets/images/logo/no-image.jpg" class="img-responsive" alt=""> -->
									</div>
									<!-- END SIDEBAR USERPIC -->
									<!-- SIDEBAR USER TITLE -->
									<!-- END SIDEBAR USER TITLE -->
									<!-- SIDEBAR BUTTONS -->
									<!-- <div class="profile-userbuttons">
										<button id="btn-pilih-logo" type="button" class="btn btn-circle green-seagreen btn-sm">Pilih Logo</button>
										<button id="btn-hps-logo" type="button" class="btn btn-circle btn-danger btn-sm">Hapus Logo</button>
									</div> -->
									<!-- END SIDEBAR BUTTONS -->
									<!-- SIDEBAR MENU -->
									<!-- <div class="profile-usermenu">
									</div> -->
									<!-- END MENU -->
								</div>
							</div>
							<div class="col-md-9">
								<!-- BEGIN PORTLET -->
								<div class="portlet light" style="min-height: 241px;">
									<div class="portlet-title tabbable-line">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab">
												Data Outlet </a>
											</li>
											<!-- <li>
												<a href="#tab_1_2" data-toggle="tab">
												Header & Footer </a>
											</li> -->
										</ul>
									</div>
									<?php
										$nama = '';
										$alamat = '';
										$telp = '';
										$email = '';
										$npwp = '';

										if(is_array($get_prof)||is_object($get_prof)){
											foreach ($get_prof as $profile) {
												$nama = $profile->faktur_pajak_nama;
												$alamat1 = $profile->faktur_pajak_alamat;
												$alamat2 = $profile->faktur_pajak_alamat2;
												$telp = $profile->telp;
												$email = $profile->mail;
												$npwp = $profile->faktur_pajak_npwp;												
											}
										}
									?>
									<div class="portlet-body">
										<!--BEGIN TABS-->
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1_1">
												<div class="form-body">
													<div class="row">	
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Nama Outlet
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="nama" placeholder="" value="<?php echo $nama;?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Alamat
																</label>
																<div class="col-md-8"  style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="alamat1" placeholder="" value="<?php echo $alamat1;?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label" style="color:white;">abc
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control input-sm" id="alamat2" placeholder="" value="<?php echo $alamat2;?>">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Telp
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="telp" placeholder="" value="<?php echo $telp;?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Email
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="email" placeholder="" value="<?php echo $email;?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">NPWP
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="npwp" placeholder="" value="<?php echo $npwp;?>">
																</div>
															</div>
														</div>
														<div class="col-md-10">
														</div>
														<div class="col-md-2 text-center">
															<button type="button" id="btn-update-profile" class="btn btn-circle yellow-gold btn-sm">Update</button>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_1_2">
												<div class="form-body">
													<div class="row">	
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Header 1
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="header1" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Header 2
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="header2" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Header 3
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="header3" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Header 4
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control input-sm" id="header4" placeholder="">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Footer 1
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="footer1" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Footer 2
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="footer2" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Footer 3
																</label>
																<div class="col-md-8" style="margin-bottom:10px;">
																	<input type="text" class="form-control input-sm" id="footer3" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label text-align-reverse">Footer 4
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control input-sm" id="footer4" placeholder="">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--END TABS-->
									</div>
								</div>
								<!-- END PORTLET -->
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT -->
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
            
            Profile.init();
        });
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'keenthemes.com');
  ga('send', 'pageview');


  function reload_page() {
  	setTimeout(function(){
	   window.location.reload();
	}, 2000);
  }

  $('#btn-update-profile').on('click', function(e) {

  	e.preventDefault();

  	var nama = $('#nama').val();
	var alamat1 = $('#alamat1').val();
	var alamat2 = $('#alamat2').val();
	var telp = $('#telp').val();
	var email = $('#email').val();
	var npwp = $('#npwp').val();

	if(nama!="" ){
		$.ajax({
			url: "<?php echo base_url("profile/action_profile");?>",
			type: "POST",
			data: {
				nama : nama,
				alamat1 : alamat1,
				alamat2 : alamat2,
				telp : telp,
				email : email,
				npwp : npwp
			},
			cache: false,
			success: function(dataResult){
				$("#success").show();
				$('#success').html('Data berhasil diubah!');
				$("#success").fadeTo(1500, 500).slideUp(500, function() {
                	$("#success").slideUp(500);
                });	
			},
			error: function() {
				$("#failed").show();
				$('#failed').html('Gagal melakukan aksi!');
				$("#failed").fadeTo(1500, 500).slideUp(500, function() {
                	$("#failed").slideUp(500);
                });
			}
		});

		reload_page();
	}
  });
</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>