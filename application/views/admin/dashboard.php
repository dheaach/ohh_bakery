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
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('login/dashboard');?>">Dashboard</a>
					</li>
				</ul>
				<div class="page-toolbar">
					
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 margin-bottom-10">
					<div class="dashboard-stat green-seagreen">
						<div class="visual">
							<i class="fa fa-cube fa-icon-medium"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php
									if (is_array($barang)) {
										foreach ($barang as $key) {
											echo $key->total;
										}
									}
								?>
							</div>
							<div class="desc">
								 Barang
							</div>
						</div>
						<a class="more" href="<?php echo base_url("product/page");?>">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-seagreen">
						<div class="visual">
							<i class="fa fa-chain"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php
									if (is_array($bb)) {
										foreach ($bb as $key) {
											echo $key->total;
										}
									}
								?>
							</div>
							<div class="desc">
								 Bahan Baku
							</div>
						</div>
						<a class="more" href="<?php echo base_url("manufacture/bahan");?>">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-seagreen">
						<div class="visual">
							<i class="fa fa-random fa-icon-medium"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php
									if (is_array($mnf)) {
										foreach ($mnf as $key) {
											echo $key->total;
										}
									}
								?>
							</div>
							<div class="desc">
								 Proses Manufaktur
							</div>
						</div>
						<a class="more" href="<?php echo base_url("manufacture/proses");?>">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-seagreen">
						<div class="visual">
							<i class="fa fa-history fa-icon-medium"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php
									if (is_array($trial)) {
										foreach ($trial as $key) {
											echo $key->total;
										}
									}
								?>
							</div>
							<div class="desc">
								 Proses Trial
							</div>
						</div>
						<a class="more" href="<?php echo base_url("manufacture/proses_trial");?>">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- <div class="col-md-12">
					<div class="portlet box green-seagreen">
						<div class="portlet-title">
							<div class="caption">
							</div>
							<div class="tools">
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body" style="padding-bottom: 50px;">
							<h3 style="margin-bottom: 50px;" class="text-center"><b>Diagram Top 10 Fast Moving Bahan Baku</b></h3>
							<div id="pie_chart" class="chart">
							</div>
						</div>
					</div>
				</div> -->
				<div class="col-md-6">
					<!-- Begin: life time stats -->
					<div class="portlet light bordered border-green-seagreen">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject bold uppercase font-green-seagreen"> Bahan Baku Hampir Habis</span>
								<span class="caption-helper">Bahan kurang dari 10</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
									<?php
										if(is_array($bbs)){
											foreach ($bbs as $key) {
												$clickqty = "qty_product2('".$key->prod_no."')";
									?>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-warning">
														<i class="fa fa-bell-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														<?php echo "Stok <b>".$key->nama."</b> sisa <b>".$key->stok."</b>.";?>
													</div>
												</div>
											</div>
										</div>
										<div class="col2" style="margin-top: 3px;">
											<div class="desc">
												<button class="btn btn-xs bg-green-seagreen" onClick="<?php echo $clickqty;?>">
													Tambah <i class="fa fa-plus"></i>
												</button>
											</div>
										</div>
									</li>
									<?php
											}
										}else{
											echo "<div class='text-center'>Tidak ada data yang ditampilkan.</div>";
										}
									?>
								</ul>
							</div>
							<div class="scroller-footer">
								<!-- <div class="btn-arrow-link pull-right">
									<a href="#">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div> -->
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
				<div class="col-md-6">
					<!-- Begin: life time stats -->
					<div class="portlet light bordered border-green-seagreen">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject bold uppercase font-green-seagreen"> Barang Produksi Hampir Habis</span>
								<span class="caption-helper">Barang kurang dari 10</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
									<?php
										if(is_array($mnfs)){
											foreach ($mnfs as $key) {
												$clickqty = "qty_product2('".$key->prod_no."')";
									?>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-warning">
														<i class="fa fa-bell-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														<?php echo "Stok <b>".$key->nama."</b> sisa <b>".$key->stok."</b>.";?>
													</div>
												</div>
											</div>
										</div>
									</li>
									<?php
											}
										}else{
											echo "<div class='text-center'>Tidak ada data yang ditampilkan.</div>";
										}
									?>
								</ul>
							</div>
							<div class="scroller-footer">
								<!-- <div class="btn-arrow-link pull-right">
									<a href="#">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div> -->
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="portlet light bordered border-green-seagreen">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-bar-chart font-green-seagreen"></i>
								<span class="caption-subject bold uppercase font-green-seagreen"> Grafik Pemakaian Bahan Baku</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="input-group input-small	">
								<input type="date" class="form-control" id="bb_start" <?php if($bb_start <> ''){echo "value='".$bb_start."'";}?>>
								<span class="input-group-addon">s/d</span>
								<input type="date" class="form-control" id="bb_end" <?php if($bb_end <> ''){echo "value='".$bb_end."'";}?>>
							</div>
							<?php
								if(is_array($sbb)){
							?>
							<div id="chart_bb_usage" class="chart" style="height:310px;"></div>
							<?php
								}else{
									echo "<div class='text-center' style='margin-top:20px;'>Tidak ada data yang ditampilkan.</div>";
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="portlet light bordered border-green-seagreen">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-bar-chart font-green-seagreen"></i>
								<span class="caption-subject bold uppercase font-green-seagreen"> Grafik Barang Produksi</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="input-group input-small	">
								<input type="date" class="form-control" id="mnf_start" <?php if($mnf_start <> ''){echo "value='".$mnf_start."'";}?>>
								<span class="input-group-addon">s/d</span>
								<input type="date" class="form-control" id="mnf_end" <?php if($mnf_end <> ''){echo "value='".$mnf_end."'";}?>>
							</div>
							<?php
								if(is_array($smnf)){
							?>
							<div id="chart_mnf_usage" class="chart" style="height:310px;"></div>
							<?php
								}else{
									echo "<div class='text-center' style='margin-top:20px;'>Tidak ada data yang ditampilkan.</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->
			
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
   			
			ChartsAmcharts.init(); // init demo charts
		});

		function qty_product2(id_prod) {
			let qty = 0;
			$.ajax({
				url: "<?php echo base_url("product/get_qty_stok");?>",
				type: "POST",
				data: {
					id_prod : id_prod
				},
				cache: false,
				success: function(dataResult){
					var json_data = JSON.parse(dataResult);
					qty = json_data.stok;
					$('#quantity').val(qty);
					$('#id_prod_qty').val(id_prod);
				},
				error:function(){
				}
			});

			$.ajax({
		        url: "<?php echo base_url("product/get_qty_uom");?>",
		        type: "POST",
		        data: {
		            id_prod : id_prod
		        },
		        cache: false,
		        success: function(dataResult){
		            var select_data = JSON.parse(dataResult);

		            // Populate the select element
		            var $select = $('#uom_qty');
		            $select.find('option').remove();

		            $.each(select_data, function(index, value) {
		                $('<option>').val(value.value).text(value.text).appendTo($select);
		            });
		        },
		        error:function(){
		        }
		    });
			
			$('#modal_add_qty').modal('show');
		}
		function incrementValue(e) {
	        e.preventDefault();
	        var fieldName = $(e.target).data('field');
	        var parent = $(e.target).closest('.input-group');
	        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

	        if (!isNaN(currentVal)) {
	            parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
	        } else {
	            parent.find('input[name=' + fieldName + ']').val(0);
	        }

	        // console.log('fieldName', fieldName);
	        // console.log('parent', parent);
	        // console.log('currentVal', currentVal);
	    }

	    function decrementValue(e) {
	        e.preventDefault();
	        var fieldName = $(e.target).data('field');
	        var parent = $(e.target).closest('.input-group');
	        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

	        if (!isNaN(currentVal) && currentVal > 0) {
	            parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
	        } else {
	            parent.find('input[name=' + fieldName + ']').val(0);
	        }

	        // console.log('fieldName', fieldName);
	        // console.log('parent', parent);
	        // console.log('currentVal', currentVal);
	        
	    }

	    $(document).on('click', '#btn-plus', function(e){
		    incrementValue(e);
	    });

	    $(document).on('click', '#btn-minus', function(e){
		    decrementValue(e);
	    });

	    $(document).on('click', '#btn-b-qty,#btn-btl-qty', function(e){
		    $('#quantity').val('');
		    $('#modal_add_qty').modal('hide');
	    });

	    $(document).on('click', '#btn-s-qty', function(e){
	    	var id_prod = $('#id_prod_qty').val();
	    	let qty = $('#quantity').val();
	    	let kon = $('#uom_qty').val();
	    	let hasil = qty * kon;

	    	$.ajax({
				url: "<?php echo base_url("product/insert_stok_barang");?>",
				type: "POST",
				data: {
					id_prod : id_prod,
					qty : hasil
				},
				cache: false,
				success: function(dataResult){
					$('#quantity').val(0);
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==202){
					    $("#success").show();
						$('#success').html('Berhasil menabahkan stok!');
						$("#success").fadeTo(1500, 500).slideUp(500, function() {
		                	$("#success").slideUp(500);
		                });
					}
				},
				error:function(){
					$("#failed").show();
					$('#failed').html('Gagal melakukan aksi!');
					$("#failed").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#failed").slideUp(500);
	                });
				}
			});

		    $('#modal_add_qty').modal('hide');

		    setTimeout(function(){
			   window.location.reload();
			}, 2100);
	    });

	    set_date();

	    function set_date() {
	    	var now = new Date();
			var firstDayOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);
			var day_f = ("0" + firstDayOfMonth.getDate()).slice(-2);
			var month_f = ("0" + (firstDayOfMonth.getMonth() + 1)).slice(-2);
			var year_f = firstDayOfMonth.getFullYear();

			var lastDayOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0);
			var day_l = ("0" + lastDayOfMonth.getDate()).slice(-2);
			var month_l = ("0" + (lastDayOfMonth.getMonth() + 1)).slice(-2);
			var year_l = lastDayOfMonth.getFullYear();

			var fist_date = (year_f)+"-"+(month_f)+"-"+(day_f);
			var last_date = (year_l)+"-"+(month_l)+"-"+(day_l);

			if($('#bb_start').val() == ''){
				$('#bb_start').val(fist_date);
			}

			if($('#bb_end').val() == ''){
				$('#bb_end').val(last_date);
			}

			if($('#mnf_start').val() == ''){
				$('#mnf_start').val(fist_date);
			}

			if($('#mnf_end').val() == ''){
				$('#mnf_end').val(last_date);
			}

	    }

	    $('#bb_start').on('change', function() {
			
			var bb_start = $('#bb_start').val();
			var bb_end = $('#bb_end').val();

			var mnf_start = $('#mnf_start').val();
			var mnf_end = $('#mnf_end').val();

			var urlist = "<?php echo base_url('login/dashboard');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + bb_start + "/" + bb_end + "/" + mnf_start + "/" + mnf_end + "/"
		    );
		    location.href = url.href;

		});

		$('#bb_end').on('change', function() {
			
			var bb_start = $('#bb_start').val();
			var bb_end = $('#bb_end').val();

			var mnf_start = $('#mnf_start').val();
			var mnf_end = $('#mnf_end').val();

			var urlist = "<?php echo base_url('login/dashboard');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + bb_start + "/" + bb_end + "/" + mnf_start + "/" + mnf_end + "/"
		    );
		    location.href = url.href;

		});

		$('#mnf_start').on('change', function() {

			var bb_start = $('#bb_start').val();
			var bb_end = $('#bb_end').val();
			
			var mnf_start = $('#mnf_start').val();
			var mnf_end = $('#mnf_end').val();

			var urlist = "<?php echo base_url('login/dashboard');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + bb_start + "/" + bb_end + "/" + mnf_start + "/" + mnf_end + "/"
		    );
		    location.href = url.href;

		});

		$('#mnf_end').on('change', function() {
			var bb_start = $('#bb_start').val();
			var bb_end = $('#bb_end').val();
			
			var mnf_start = $('#mnf_start').val();
			var mnf_end = $('#mnf_end').val();

			var urlist = "<?php echo base_url('login/dashboard');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + bb_start + "/" + bb_end + "/" + mnf_start + "/" + mnf_end + "/"
		    );
		    location.href = url.href;

		});

</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>