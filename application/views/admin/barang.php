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
						<strong>Daftar Barang</strong>
						</h3>
					</div>
					<div class="add-product-nav col-sm-2">
						<a class="btn btn-sm green-seagreen filter-submit" data-toggle="modal" id="21B"><i class="fa fa-plus"></i> Barang Baru</a>
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
						<a href="<?php echo base_url('product/page');?>">Master Barang</a>
					</li>
					<!-- <li>
						<a href="#" id="f5test"> RIPRES</a>
					</li>	 -->	
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
												<!-- <span name="coba" id="test"></span> -->
											<strong>Ringkasan</strong>
											</h5>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-20">
												<div class="dashboard-stat db-table">
													<div class="visual db-ic">
														<i class="fa fa-cube fa-icon-medium"></i>
													</div>
													<div class="details db-lbl ">
														<div class="number db-number">
															 <?php
																if( !empty($prt) ) {
																	foreach($prt as $ua) {
																		echo"<strong>".$ua->tersedia." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Stok tersedia</strong>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-20">
												<div class="dashboard-stat db-table">
													<div class="visual db-ic">
														<i class="fa fa-cube fa-icon-medium"></i>
													</div>
													<div class="details db-lbl ">
														<div class="number db-number">
															 <?php
																if( !empty($prs) ) {
																	foreach($prs as $ua) {
																		echo"<strong>".$ua->segera." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Stok segera habis</strong>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-20">
												<div class="dashboard-stat db-table">
													<div class="visual db-ic">
														<i class="fa fa-cube fa-icon-medium"></i>
													</div>
													<div class="details db-lbl ">
														<div class="number db-number">
															<?php
																if( !empty($prh) ) {
																	foreach($prh as $ua) {
																		echo"<strong>".$ua->habis." Jenis</strong>";
																	}
																}
															?>
														</div>
														<div class="desc db-desc">
															 <strong>Stok habis</strong>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												
												<div class="btn-group" id="btn_act" style="display:none;">
													<a class="btn green-seagreen dropdown-toggle btn-rounded btn-sm btn-border btn-actcl" data-toggle="dropdown" href="#" id="21D">
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
												<ul class="nav nav-pills">
													<li id="li_tab_2_1">
														<a href="#tab_2_1" data-toggle="tab" class="btn green-seagreen btn-sm btn-rounded-left btn-border">
														Barang </a>
													</li>
													<li id="li_tab_2_2">
														<a href="#tab_2_2" data-toggle="tab" class="btn green-seagreen btn-sm btn-rounded-right btn-border">
														Penyesuaian Harga </a>
													</li>
												</ul>
											</div>
											<div class="col-sm-3 pdg-btn">
												<div class="btn-group">
													<a class="btn green-seagreen btn-sm btn-rounded-left btn-border" id="21E">
														Import
													</a>
													<div class="btn-group">
														<a class="btn green-seagreen dropdown-toggle btn-rounded-right btn-sm btn-border" data-toggle="dropdown" href="#" id="21F">
														Eksport
														</a>
														<ul class="dropdown-menu pull-right">
															<!-- <li>
																<a href="#" id="btn-exc-brg">
																Export to Excel </a>
															</li> -->
															<li>
																<a href="#" id="btn-csv-brg">
																Export to Excel </a>
															</li>
															<li>
																<a href="#" id="btn-pdf-brg">
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
														<button type="button" id="search-btn" class="btn btn-default advance-toggle  btn-rounded-right"><i class="fa fa-angle-down" id="icon-btn"></i></button>
														
														<div class="advance-search-toggle" id="search-toggle-barang" style="min-width:250px;display: none;">
															<div class="row">
																<div class="col-sm-12" style="margin:12px 5px 15px;padding-right: 23px;">
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Kata Kunci</label>
																		<div class="col-md-12">
																			<input type="text" class="form-control input-sm dropdown-input" name="keyword" id="keyword" placeholder="" value="<?php echo $keyw;?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Kategori Produk</label>
																		<div class="col-md-12">
																			<select class="table-group-action-input form-control input-sm dropdown-input select2" name="category" id="kategori-filter">
																				<option value="0">None</option>
																				<?php
																					if( !empty($kat) ) {
		    																			foreach($kat as $au) {
		    																	?>
																							<option value="<?php echo $au->cat_id;?>" <?php if($kat_id == $au->cat_id){echo "selected='selected'";}?>><?php echo $au->nama;?></option>
																				<?php
																						}
																					}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Sub-Kategori Produk</label>
																		<div class="col-md-12">
																			<select class="table-group-action-input form-control input-sm dropdown-input select2" name="subcategory" id="subkategori_filter">
																				<option value="0">None</option>
																				<?php
																					if( !empty($sub_kat) ) {
		    																			foreach($sub_kat as $au) {
		    																	?>
																							<option value="<?php echo $au->group_id;?>" <?php if($group_id == $au->group_id){echo "selected='selected'";}?>><?php echo $au->nama;?></option>
																				<?php
																						}
																					}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-12 control-label" style="margin-top:10px;color:#777;">Status Barang</label>
																		<div class="col-md-12">
																			<select class="table-group-action-input form-control input-sm dropdown-input" name="status_brg" id="statbar_filter">
																				<option value="0" <?php if($sts == 0){echo "selected='selected'";}?>>All</option>
																				<option value="1" <?php if($sts == 1){echo "selected='selected'";}?>>Barang</option>
																				<option value="2" <?php if($sts == 2){echo "selected='selected'";}?>>Manufaktur</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-md-9 control-label" style="margin-top:10px;color:#777;">Tampilkan Arsip</label>
																		<div class="col-md-3" style="margin-top:10px;">
																			<input type="checkbox" class="form-control input-sm" name="chk-arsip" id="chk-arsip" <?php if($is_arc <>'' || $is_arc <> false){echo 'checked';}?>>
																		</div>
																		<div class="col-sm-12">
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;padding: 3px 8px 0px 15px;text-align: right;">
																			<a class="btn-rf-brg" id="btn-rf-brg" style="color:#777;text-decoration:none;">Hapus Filter</a>
																		</div>
																		<div class="col-sm-6" style="margin: 30px 0px 0px 0px;color: #777;padding: 0px 15px 0px 0px;">
																			<a class="btn green-seagreen btn-rounded" style="display:block;" name="btn-sf-brg" id="btn-sf-brg">
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
										
										<div class="tab-content" id="21A" style="display:none;">
											<div class="tab-panel tab-pane fade" id="tab_2_1">
												<div class="table-scrollable" style="border: 0px solid #dddddd;" >
													
													<div class="table-actions-wrapper">
													</div>
													
													<table class="table table-hover" id="datatable_products">
														<thead class="thead-dark">
															<tr role="row" class="heading">
																<th width="1%" style="background-color: #1BA39C!important;">
																	<input type="checkbox" class="group-checkable checkall" id="head-check-prod" onclick="calc();">
																</th>
																<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
																	 Kode&nbsp;Barang
																</th>
																<th width="19%" style="background-color: #1BA39C!important;color:white!important;">
																	 Nama&nbsp;Barang
																</th>
																<th width="12%" style="background-color: #1BA39C!important;color:white!important;">
																	 Kategori
																</th>
																<th width="6%" style="background-color: #1BA39C!important;color:white!important;">
																	 Qty
																</th>
																<th width="6%" class="kol-hb" style="background-color: #1BA39C!important;color:white!important;">
																	 Harga Beli
																</th>
																<th width="6%" class="kol-hj" style="background-color: #1BA39C!important;color:white!important;">
																	 Harga Jual
																</th>
																<th width="6%" style="background-color: #1BA39C!important;color:white!important;">
																	 Status
																</th>
																<th width="4%" style="background-color: #1BA39C!important;color:white!important;"></th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
											<div class="tab-panel tab-pane fade" id="tab_2_2">
												<div class="row" style="margin-top:10px;">
													<div class="col-sm-7">
														<div class="form-group">
															<label class="col-md-2 control-label" style="margin:5px 0px 5px 0px;padding:0px;text-align: center;">Harga Up<span class="required">
																* </span></label>
															<div class="col-md-2" style="margin:0px 0px 5px 0px;padding:0px;">
																<div class="input-group">
																	<input type="text" class="form-control input-sm input-rounded-left" id="marginper" placeholder="">
																	<span class="input-group-addon input-rounded-right">%</span>
																</div>
															</div>
															<label class="col-md-1 control-label" style="margin:5px 0px 5px 0px;padding:0px;text-align: center;">atau</label>
															<div class="col-md-3" style="margin:0px 0px 5px 0px;padding:0px;">
																<div class="input-group">
																	<span class="input-group-addon input-rounded-left">Rp</span>
																	<input type="text" class="form-control input-sm input-rounded-right" id="marginrep" placeholder="">
																</div>
															</div>
															<div class="col-md-3" style="margin:0px 0px 5px 5px;padding:0px;">
																<!-- <div class="btn-group">
																	<button class="btn green-seagreen btn-sm btn-rounded"><i class="fa fa-check"></i></button>
																</div> -->
																<div class="btn-group">
																	<button class="btn yellow-casablanca btn-sm btn-rounded" id="update-margin" disabled>Update</button>
																</div>
															</div>
														</div>
													</div>
													<div class="col-sm-6"></div>
													<div class="col-sm-12">
														<cite class="font-red font-">* pilih barang dengan checkbox dan isi salah satu antara persen atau rupiah</cite>
													</div>
												</div>
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<div class="table-actions-wrapper">
													</div>
													<table class="table table-hover" id="datatable_products_margin">
														<thead class="thead-dark">
															<tr role="row" class="heading">
																<th width="1%" style="background-color: #1BA39C!important;">
																	<input type="checkbox" class="group-checkable checkall-margin" id="head-check-margin" onclick="calcmargin();">
																</th>
																<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
																	 Kode&nbsp;Barang
																</th>
																<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
																	 Nama&nbsp;Barang
																</th>
																<th width="15%" style="background-color: #1BA39C!important;color:white!important;">
																	 Kategori
																</th>
																<th width="8%" style="background-color: #1BA39C!important;color:white!important;">
																	 Qty
																</th>
																<th width="8%" style="background-color: #1BA39C!important;color:white!important;">
																	 Hrg Jual Lama
																</th>
																<th width="8%" style="background-color: #1BA39C!important;color:white!important;">
																	 Hrg Jual Baru
																</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
											<div class="tab-pane fade" id="tab_2_3">
												<p id="myText"></p>
												<p id="myTextMargin"></p>
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
            
            EcommerceProducts.init();
            ProductsMargin.init();
            // FormFileUpload.init();
        });

        var is_valid = 1;

        (function ($) {

		    $.fn.imageUploader = function (options) {

		        // Default settings
		        let defaults = {
		            preloaded: [],
		            imagesInputName: 'images',
		            preloadedInputName: 'preloaded',
		            label: 'Drag & Drop files here or click to browse'
		        };

		        // Get instance
		        let plugin = this;

		        // Set empty settings
		        plugin.settings = {};

		        // Plugin constructor
		        plugin.init = function () {

		            // Define settings
		            plugin.settings = $.extend(plugin.settings, defaults, options);

		            // Run through the elements
		            plugin.each(function (i, wrapper) {

		                // Create the container
		                let $container = createContainer();

		                // Append the container to the wrapper
		                $(wrapper).append($container);

		                // Set some bindings
		                $container.on("dragover", fileDragHover.bind($container));
		                $container.on("dragleave", fileDragHover.bind($container));
		                $container.on("drop", fileSelectHandler.bind($container));

		                // If there are preloaded images
		                if (plugin.settings.preloaded.length) {

		                    // Change style
		                    $container.addClass('has-files');

		                    // Get the upload images container
		                    let $uploadedContainer = $container.find('.uploaded');

		                    // Set preloaded images preview
		                    for (let i = 0; i < plugin.settings.preloaded.length; i++) {
		                        $uploadedContainer.append(createImg(plugin.settings.preloaded[i].src, plugin.settings.preloaded[i].id, true));
		                    }

		                }

		            });

		        };


		        let dataTransfer = new DataTransfer();

		        let createContainer = function () {

		            // Create the image uploader container
		            let $container = $('<div>', {class: 'image-uploader'}),

		                // Create the input type file and append it to the container
		                $input = $('<input>', {
		                    type: 'file',
		                    id: plugin.settings.imagesInputName + '-' + random(),
		                    name: plugin.settings.imagesInputName + '[]',
		                    multiple: ''
		                }).appendTo($container),

		                // Create the uploaded images container and append it to the container
		                $uploadedContainer = $('<div>', {class: 'uploaded'}).appendTo($container),

		                // Create the text container and append it to the container
		                $textContainer = $('<div>', {
		                    class: 'upload-text'
		                }).appendTo($container),

		                // Create the icon and append it to the text container
		                $i = $('<i>', {class: 'material-icons', text: 'cloud_upload'}).appendTo($textContainer),

		                // Create the text and append it to the text container
		                $span = $('<span>', {text: plugin.settings.label}).appendTo($textContainer);


		            // Listen to container click and trigger input file click
		            $container.on('click', function (e) {
		                // Prevent browser default event and stop propagation
		                prevent(e);

		                // Trigger input click
		                $input.trigger('click');
		            });

		            // Stop propagation on input click
		            $input.on("click", function (e) {
		                e.stopPropagation();
		            });

		            // Listen to input files changed
		            $input.on('change', fileSelectHandler.bind($container));

		            return $container;
		        };


		        let prevent = function (e) {
		            // Prevent browser default event and stop propagation
		            e.preventDefault();
		            e.stopPropagation();
		        };

		        let createImg = function (src, id) {

		            // Create the upladed image container
		            let $container = $('<div>', {class: 'uploaded-image'}),

		            	//Create a tag
		            	$a = $('<a>', {target: '_blank',href : '#', onClick : 'test(this)'}).appendTo($container),
		                // Create the img tag
		                $img = $('<img>', {src: src}).appendTo($a),

		                // Create the delete button
		                $button = $('<button>', {class: 'delete-image'}).appendTo($container),

		                // Create the delete icon
		                $i = $('<i>', {class: 'material-icons', text: 'clear'}).appendTo($button);

		            // If the images are preloaded
		            if (plugin.settings.preloaded.length) {

		                // Set a identifier
		                $container.attr('data-preloaded', true);

		                // Create the preloaded input and append it to the container
		                let $preloaded = $('<input>', {
		                    type: 'hidden',
		                    name: plugin.settings.preloadedInputName + '[]',
		                    value: id
		                }).appendTo($container)

		            } else {

		                // Set the identifier
		                $container.attr('data-index', id);

		            }

		            // Stop propagation on click
		            $container.on("click", function (e) {
		                // Prevent browser default event and stop propagation
		                prevent(e);
		            });

		             $('#rmv-img').on("click", function (e) {

		             	prevent(e);

		             	for (let i = 0; i < $container.find('.uploaded-image').length; i++) {
		                    dataTransfer.items.remove(i);
		                }

		                // Remove this image from the container
		                $container.remove();

		                // If there is no more uploaded files
		                if (!$container.find('.uploaded-image').length) {

		                    // Remove the 'has-files' class
		                    $container.removeClass('has-files');

		                }
		             });
		            // Set delete action
		            $button.on("click", function (e) {
		                // Prevent browser default event and stop propagation
		                prevent(e);

		                // If is not a preloaded image
		                if ($container.data('index')) {

		                    // Get the image index
		                    let index = parseInt($container.data('index'));

		                    // Update other indexes
		                    $container.find('.uploaded-image[data-index]').each(function (i, cont) {
		                        if (i > index) {
		                            $(cont).attr('data-index', i - 1);
		                        }
		                    });

		                    // Remove the file from input
		                    dataTransfer.items.remove(index);
		                }

		                // Remove this image from the container
		                $container.remove();

		                // If there is no more uploaded files
		                if (!$container.find('.uploaded-image').length) {

		                    // Remove the 'has-files' class
		                    $container.removeClass('has-files');

		                }

		            });

		            return $container;
		        };

		        let fileDragHover = function (e) {

		            // Prevent browser default event and stop propagation
		            prevent(e);

		            // Change the container style
		            if (e.type === "dragover") {
		                $(this).addClass('drag-over');
		            } else {
		                $(this).removeClass('drag-over');
		            }
		        };

		        let fileSelectHandler = function (e) {

		            // Prevent browser default event and stop propagation
		            prevent(e);

		            // Get the jQuery element instance
		            let $container = $(this);

		            // Change the container style
		            $container.removeClass('drag-over');

		            // Get the files
		            let files = e.target.files || e.originalEvent.dataTransfer.files;

		            // Makes the upload
		            setPreview($container, files);
		        };

		        let setPreview = function ($container, files) {

		            // Add the 'has-files' class
		            $container.addClass('has-files');

		            // Get the upload images container
		            let $uploadedContainer = $container.find('.uploaded'),

		                // Get the files input
		                $input = $container.find('input[type="file"]');

		            // Run through the files
		            $(files).each(function (i, file) {

		                // Add it to data transfer
		                dataTransfer.items.add(file);

		                // Set preview
		                $uploadedContainer.append(createImg(URL.createObjectURL(file), dataTransfer.items.length - 1));

		            });

		            // Update input files
		            $input.prop('files', dataTransfer.files);

		        };

		        // Generate a random id
		        let random = function () {
		            return Date.now() + Math.floor((Math.random() * 100) + 1);
		        };

		        this.init();

		        // Return the instance
		        return this;
		    };

		}(jQuery));
		

		function load_img_up(prl ='') {
			if (prl != ''){
				$('.input-images-2').imageUploader({
		            preloaded: prl,
		            imagesInputName: 'photos',
		            preloadedInputName: 'old'
		        });
			}else{
				$('.input-images-2').imageUploader();
			}
		}
		
		//initialize the firebase app
		const config = {
		  apiKey: "AIzaSyA7N2Ft2I87jxx764oQYTqqOMSLvMj_1uk",
		  authDomain: "ohh-bakery.firebaseapp.com",
		  databaseURL: "https://ohh-bakery-default-rtdb.asia-southeast1.firebasedatabase.app",
		  projectId: "ohh-bakery",
		  storageBucket: "ohh-bakery.appspot.com",
		  messagingSenderId: "739469483228",
		  appId: "1:739469483228:web:9172a6c0bd9be4ac4e2819",
		  measurementId: "G-D5T21BPSMG"
		};
		// Initialize Firebase
		firebase.initializeApp(config);
		// console.log(firebase);
		//create firebase references
		function sendImg(flnm,udw,sz,prod_no) {
      
		  if(sz <= 1097152){
		    $.ajax({
		      url:'<?php echo base_url();?>product/uploadImage/',
		      method: 'POST',
		      data: {
		              prod_no : prod_no,
		              filename: flnm,
		              url : udw,
		              size : sz
		            },
		      success: function(msg){
		        console.log('sukses upload gambar');
		      },
		      error: function(xhr, status, error){
		        console.log('error upload gambar');
		      }
		    }); 
		  }else{
		    $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload! Ukuran terlalu besar!</span></div>');
		    $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
		          $("#failed-alert").slideUp(500);
		        });
		  }

		}

		function upload_images(id_brg) {
		  let $form = $('#add_product');
		  // Get the input file
		  let $inputImages = $form.find('input[name^="images"]');

		  if (!$inputImages.length) {
		      $inputImages = $form.find('input[name^="photos"]')
		  }

		  console.log($inputImages);

		  // Get the new files names
		  var no = 0;
		  for (let file of $inputImages.prop('files')) {
		      var str_rep1 = id_brg.replace("/","@");
		      var str_rep2 = str_rep1.replace(".","&");
		      no = no+1;
		      const filename = 'IMG_'+str_rep2+'_'+no;
		      const ref = firebase.storage().ref();
		      const fnm = file.name;
		      const sz = file.size;
		      const ft = fnm.split('.').pop();
		      const name = filename+'.'+ft;
		      const metadata = {
		        contentType: file.type
		      };

		      if(sz <= 1097152){ 
		        const task = ref.child('product/' +name).put(file, metadata);
		        task
		          .then(snapshot => snapshot.ref.getDownloadURL())
		          .then(url => {
		            console.log(url);
		            sendImg(name, url, sz, id_brg);
		          })
		          .catch(console.error);
		      }else{
		        $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload! Ukuran terlalu besar!</span></div>');
		         $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
		          $("#failed-alert").slideUp(500);
		        });
		      }  
		  }
		}

		function update_image(id_brg) {
			$.ajax({
				url: "<?php echo base_url("product/get_img_edit");?>",
				type: "POST",
				data: {
					id_brg: id_brg
				},
				cache: false,
				success: function(dataResult){
					// console.log(dataResult);
					// let jdat = JSON.parse(dataResult);
					var jsonData = JSON.parse(dataResult);
				  	for (var i = 0, len = jsonData.length; i < len; ++i) {
					    var json_data = jsonData[i];
				    	const np = id_brg;
				        const ref = firebase.storage();
				        const fileRef = ref.refFromURL(json_data.src);
				        
				        // Delete the file using the delete() method
				        fileRef.delete().then(function () {}).catch(function (error) {
				          document.write();
				        });
					}
					
					$.ajax({
						url: "<?php echo base_url("product/delete_img");?>",
						type: "POST",
						data: {
							id_brg: id_brg
						},
						cache: false,
						success: function(dataResult){
							upload_images(id_brg);
						}
					});
				}
			});
		}

        var is_click_ins_stn;

        function test(element) {
	        var newTab = window.open();
	        setTimeout(function() {
	            newTab.document.body.innerHTML = element.innerHTML;
	        }, 100);
	        return false;
	    }

        $("li[id='li_tab_2_1'] a").on("click", function(){
			sessionStorage.setItem("tabActive", "li_tab_2_1");
			$("#li_tab_2_1" ).addClass( "active" );
			$("#tab_2_1" ).addClass( "active in" );
			$("#li_tab_2_2" ).removeClass( "active" );
			$("#tab_2_2" ).removeClass( "active in" );
			var oTable = $('#datatable_products').DataTable();
			oTable.draw();
		});

		$("li[id='li_tab_2_2'] a").on("click", function(){
			sessionStorage.setItem("tabActive", "li_tab_2_2");
			$("#li_tab_2_2" ).addClass( "active" );
			$("#tab_2_2" ).addClass( "active in" );
			$("#li_tab_2_1" ).removeClass( "active" );
			$("#tab_2_1" ).removeClass( "active in" );
			var oTable = $('#datatable_products_margin').DataTable();
			oTable.draw();

		});

		let sessionState = sessionStorage.getItem("tabActive");

		if( sessionState !== null ) {
			if( sessionState == "li_tab_2_1" ) {
				sessionStorage.setItem("tabActive", "li_tab_2_1");
				$("#li_tab_2_1" ).addClass( "active" );
				$("#tab_2_1" ).addClass( "active in" );
				$("#li_tab_2_2" ).removeClass( "active" );
				$("#tab_2_2" ).removeClass( "active in" );
			} else if(sessionState == "li_tab_2_2"){
			   	sessionStorage.setItem("tabActive", "li_tab_2_2");
				$("#li_tab_2_2" ).addClass( "active" );
				$("#tab_2_2" ).addClass( "active in" );
				$("#li_tab_2_1" ).removeClass( "active" );
				$("#tab_2_1" ).removeClass( "active in" );
			}
		} else {
			sessionStorage.setItem("tabActive", "li_tab_2_1");
			$("#li_tab_2_1" ).addClass( "active" );
			$("#tab_2_1" ).addClass( "active in" );
			$("#li_tab_2_2" ).removeClass( "active" );
			$("#tab_2_2" ).removeClass( "active in" );
		}

		if(check_user_right('21H') == 0){
			$('#li_tab_2_2 a').removeAttr('href').addClass('disabled');
		}

		function fetch_data(){
			var dataTable = $('#table_satuan_brg').DataTable({
				"processing" : true,
				"serverSide" : true,
				"filter": false,
		        "paging": false,
		        "ordering": false,
		        "info": false,
		        "searching":false,
				"order" : [],
				"ajax" : {
					url:"<?= base_url('product/fetch_data_satuan') ?>",
					type:"POST"
				}
			});
		}

		function getProsesID() {
			$.ajax({
				url: "<?php echo base_url("product/ProcessId");?>",
				type: "POST",
				data: {},
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					$('#proses_id_brg').val(dataResult.proses_id);

					add_table_satuan();
				}
			});
		}

		function update_data_satuan(id, column_name, value){

			$.ajax({
				url:"<?= base_url('product/update_satuan_barang') ?>",
				method:"POST",
				data:{
					id:id, 
					column_name:column_name, 
					value:value},
				success:function(data){
					$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
					$('#table_satuan_brg').DataTable().destroy();
					fetch_data();

				}
			});
			setInterval(function(){
				$('#alert_message').html('');
			}, 5000);
		}

		
		$('#add_new_satuan').click(function(e){
			e.preventDefault();

			is_click_ins_stn = true ;
			var nm_satuan = "";
			var konversi = "";
			var hj_dua = 0;
			var hj_tiga = 0;
			var hj = 0;
			
			$.ajax({
			url:"<?= base_url('product/add_satuan') ?>",
				method:"POST",
				data:{
					nm_satuan:nm_satuan, 
					konversi:konversi,
					hj_dua:hj_dua,
					hj_tiga:hj_tiga,
					hj:hj
					},
				success:function(data){
					$('#table_satuan_brg').DataTable().destroy();
					fetch_data();
				}
			});
			is_click_ins_stn = false ;
		});
		
		$(document).on('click', '#insert', function(e){
			e.preventDefault();
			is_click_ins_stn = true ;
			var nm_satuan = $('#data1').text();
			var konversi = $('#data2').text();
			var hj_dua = $('#data3').text();
			var hj_tiga = $('#data4').text();
			var hj = $('#data5').text();
			var proses_id = $('#proses_id_brg').val();
			
			if(nm_satuan != '' && konversi != ''){
				$.ajax({
				url:"<?= base_url('product/add_satuan') ?>",
					method:"POST",
					data:{
						nm_satuan:nm_satuan, 
						konversi:konversi,
						hj_dua:hj_dua,
						hj_tiga:hj_tiga,
						hj:hj,
						proses_id:proses_id,
						},
					success:function(data){
						// $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#table_satuan_brg').DataTable().destroy();
						fetch_data();
					}
				});
				// setInterval(function(){
				// 	$('#alert_message').html('');
				// }, 5000);
				is_click_ins_stn = false ;
			}else{
				alert("Harap mengisi kolom satuan dan konversi!");
			}
		});	

		$(document).on('click', '.delete', function(e){
			e.preventDefault();
			var id = $(this).attr("id");

			is_click_ins_stn = true ;

			var tableData = [];

			$('#tbl_satuan_body tr').each(function(row, tr){
			  tableData[row] = {
			    "nm_satuan": $(tr).find('td:eq(0) div').text(),
			    "konversi": $(tr).find('td:eq(1) div').text(),
			    "hj_satu": $(tr).find('td:eq(2) div').text(),
			    "hj_dua": $(tr).find('td:eq(3) div').text(),
			    "hj_tiga": $(tr).find('td:eq(4) div').text(),
			    "id" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			$.ajax({
			url:"<?= base_url('product/add_satuan_ml') ?>",
				method:"POST",
				data:{tableData: tableData},
				success:function(data){
				}
			});
			is_click_ins_stn = false;
			
			$.ajax({
				url:"<?= base_url('product/delete_satuan_barang') ?>",
				method:"POST",
				data:{
					id:id
				},
				success:function(data){

					is_click_ins_stn = true ;
					var nm_satuan = "";
					var konversi = "";
					var hj_dua = 0;
					var hj_tiga = 0;
					var hj = 0;
					
					$.ajax({
					url:"<?= base_url('product/add_satuan_single') ?>",
						method:"POST",
						data:{
							nm_satuan:nm_satuan, 
							konversi:konversi,
							hj_dua:hj_dua,
							hj_tiga:hj_tiga,
							hj:hj
						},
						success:function(data){
							$('#table_satuan_brg').DataTable().destroy();
							fetch_data();
						}
					});
					is_click_ins_stn = false ;
				}
			});

		});

		// $(document).on('focusout', '.update', function(e) {
		//     e.preventDefault();

		//     var id = $(this).data('id');
		//     var column = $(this).data('column');
		//     var value = $(this).text();
		//     $.ajax({
		//         url: "<?= base_url('product/update_satuan_brg') ?>",
		//         method: "POST",
		//         data: {
		//             id: id,
		//             column: column,
		//             value: value
		//         },
		//         success: function(data) {
		//             $('#table_satuan_brg').DataTable().destroy();
		//             fetch_data();
		//         }
		//     });
		// });


		$(document).on('keyup', '#data5', function(e){
			e.preventDefault();
			is_click_ins_stn = false;
		    if (e.key === 'Enter' || e.keyCode === 13) {
		    	document.querySelector("#data5").removeAttribute('contenteditable');
		    	var myIns = document.getElementById("insert");
			    if(myIns){
			    	$("#insert").click();
			    }
		    }
		});

		$(document).on('click', '#data5', function(e){
			document.querySelector("#data5").setAttribute('contenteditable', true);
			document.querySelector("#data5").focus();
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

        function checkProduct() {
		  var result = countChecked($('#datatable_products'), '.chk-barang');
		  
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
		        $('.chk-barang').prop('checked', this.checked);
		        var $checkboxes = $('.chk-barang');
		        var number = $checkboxes.filter(':checked').length;
		        
		        var p = document.getElementById('myText');
		  		
		        if (number > 0){
				    btn_act.style.display = "block";
				  } else {
				    btn_act.style.display = "none";
				  }
		    });
		}

		var countCheckedMargin = function($table, checkboxClass) {
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

        function checkMargin() {
		  var result = countCheckedMargin($('#datatable_products_margin'), '.chk-barang-margin');
		  
		  $('#myTextMargin').html(result.checked);
		  var p = document.getElementById('myTextMargin');
		  var text = p.textContent;
		  var number = Number(text);

		  if (number > 0){
		  	$("#update-margin").removeAttr("disabled");    
		  } else {
		    $("#update-margin").attr("disabled", "disabled");
		  }
		}

		function calcmargin()
		{
			$('.checkall-margin').click(function (event) {    
		        $('.chk-barang-margin').prop('checked', this.checked);
		        var $checkboxes = $('.chk-barang-margin');
		        var number = $checkboxes.filter(':checked').length;
		        
		        var p = document.getElementById('myTextMargin');
		  		
		        if (number > 0){
					$("#update-margin").removeAttr("disabled");    
				} else {
					$("#update-margin").attr("disabled", "disabled");	    
				}
		    });
		}

		$(document).mouseup(function(e) 
		{
		    var container = $("#search-toggle-barang");
		    var btn = $("#search-btn");
		    var icn = $("#icon-btn");
		    var x = document.getElementById("search-toggle-barang");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target) && !icn.is(e.target)) 
		    {
		        $("#search-toggle-barang").hide();
		    }else if(btn.is(e.target) || icn.is(e.target)){
		    	
				if (x.style.display === "none") {
					$("#search-toggle-barang").show();
				} else {
					$("#search-toggle-barang").hide();
				}
		    }
		});

		function reload_page() {
			// setTimeout(function(){
			//    window.location.reload();
			// }, 1600);
		}
		//function for save and edit
		$('#is_stn').val(1);

		function check_detail_brg() {
			var tableData = [];

			var hasil = 0;

			$('#tbl_satuan_body tr').each(function(row, tr){
			  tableData[row] = {
			    "nm_satuan": $(tr).find('td:eq(0) div').text(),
			    "konversi": $(tr).find('td:eq(1) div').text(),
			    "hj_satu": $(tr).find('td:eq(2) div').text(),
			    "hj_dua": $(tr).find('td:eq(3) div').text(),
			    "hj_tiga": $(tr).find('td:eq(4) div').text(),
			    "id" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			var hasEmptyColumn = false;
			if(tableData.length > 0){
				for (var i = 0; i < 1; i++) {
				  if (
				    tableData[i].nm_satuan === "" ||
				    tableData[i].konversi === ""
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

		function save_brg() {

			var id_brg = $('#id_brg').val();
			var type = 1;

			if(id_brg !=""){
				type = 2;
			}
			var kode0 = $('#kode_brg').val();
			var nama0 = $('#nama_brg').val();
			var kode1 = $('#kode_alias').val();
			var nama1 = $('#nama_alias').val();
			
			var is_active = $('#is_act_brg').prop('checked');
			var is_non = $('#is_non_brg').prop('checked');
			if(is_active == true && is_non == false){
				var status = 0;
			}else{
				var status = 1;
			}

			var tipe_brg = $('input[name="opt_tipe"]:checked').val();
			
			if ($('#chk_pjk_inc').is(':checked')) {
				var is_ptkp = 1;
			}else{
				var is_ptkp = 0;
			}

			if ($('#chk_pjk_ptkp').is(':checked')) {
				var is_inc = 1;
			}else{
				var is_inc = 0;
			}

			var kat = $('#kat_brg').val();
			var sub_kat = $('#grp_brg').val();
			var desk = $('#prod_desk').val();
			var prod_buy = $('#harga_beli').val();
			var prod_ppn = $('#harga_belippn').val();
			var kemasan = $('#kemasan').val();
			var qty_kemasan = $('#qty_kemasan').val();

			var tableData = [];

			$('#tbl_satuan_body tr').each(function(row, tr){
			  tableData[row] = {
			    "nm_satuan": $(tr).find('td:eq(0) div').text(),
			    "konversi": $(tr).find('td:eq(1) div').text(),
			    "hj_satu": $(tr).find('td:eq(2) div').text(),
			    "hj_dua": $(tr).find('td:eq(3) div').text(),
			    "hj_tiga": $(tr).find('td:eq(4) div').text(),
			    "id" : $(tr).find('td:eq(0) div').data('id')
			  }
			});

			var checkTbl = check_detail_brg();

			if(checkTbl == 1){
				$('#is_stn').val(0);
				$("#btn-s-brg").removeAttr("disabled");
				$("#btn-rs-brg").removeAttr("disabled");
				$("#btn-r-brg").removeAttr("disabled");
				$("#empsat").show();
				$('#empsat').html('Harap lengkapi kolom Satuan dan Konversi pada Tab Satuan!');
				$("#empsat").fadeTo(1500, 500).slideUp(500, function() {
                	$("#empsat").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$('#is_stn').val(0);
				$("#btn-s-brg").removeAttr("disabled");
				$("#btn-rs-brg").removeAttr("disabled");
				$("#btn-r-brg").removeAttr("disabled");
				$("#empsat").show();
				$('#empsat').html('Detail satuan barang masih kosong!');
				$("#empsat").fadeTo(1500, 500).slideUp(500, function() {
                	$("#empsat").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			if(kode0!="" && nama0!="" &&  (is_active !="" || is_non !="") && kemasan != "" && qty_kemasan != ""){
				

				$("#btn-s-brg").attr("disabled", "disabled");
				$("#btn-rs-brg").attr("disabled", "disabled");
				$("#btn-r-brg").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("product/action_product");?>",
					type: "POST",
					data: {
						type: type,
						id_brg : id_brg,
						kode0: kode0,
						nama0: nama0,
						kode1: kode1,
						nama1: nama1,
						status : status,
						kat : kat,
						sub_kat : sub_kat,
						desk : desk,
						prod_buy : prod_buy,
						prod_ppn : prod_ppn,
						kemasan : kemasan,
						qty_kemasan : qty_kemasan,
						tipe_brg : tipe_brg,
						is_ptkp : is_ptkp,
						is_inc : is_inc,
						tableData: tableData
					},
					cache: false,
					success: function(dataResult){
						
						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){

							upload_images(dataResult.prod_no);

							$("#btn-s-brg").removeAttr("disabled");
							$("#btn-rs-brg").removeAttr("disabled");
							$("#btn-r-brg").removeAttr("disabled");
							$('#frm-brg').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	
							is_valid = 1;
			                			
						}else if(dataResult.statusCode==201){

							update_image(dataResult.prod_no);

							$("#btn-s-brg").removeAttr("disabled");
							$("#btn-rs-brg").removeAttr("disabled");
							$("#btn-r-brg").removeAttr("disabled");
							$('#frm-brg').find('input:text').val('');
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	

			                $.uniform.update();

			                is_valid = 1;
			                
						}else if(dataResult.statusCode==405){
							$('#is_stn').val(0);
							$("#btn-s-brg").removeAttr("disabled");
							$("#btn-rs-brg").removeAttr("disabled");
							$("#btn-r-brg").removeAttr("disabled");
							$("#empsat").show();
							$('#empsat').html('Kode/Nama barang sudah digunakan!');
							$("#empsat").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#empsat").slideUp(500);
			                });

			                is_valid = 0;

						}else if(dataResult.statusCode==5001){
							$('#is_stn').val(0);
							$("#btn-s-brg").removeAttr("disabled");
							$("#btn-rs-brg").removeAttr("disabled");
							$("#btn-r-brg").removeAttr("disabled");
							$("#empsat").show();
							$('#empsat').html('Harap isi kolom Satuan dan Konversi pada Tab Satuan!');
							$("#empsat").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#empsat").slideUp(500);
			                });

			                console.log(dataResult.satuan);
			                is_valid = 0;
						}
					},
					error: function() {
						$("#btn-s-brg").removeAttr("disabled");
						$("#btn-rs-brg").removeAttr("disabled");
						$("#btn-r-brg").removeAttr("disabled");
						$('#frm-brg').find('input:text').val('');
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });
		                is_valid = 0;	

		                $.uniform.update();
		                reload_page();
					}
				});

			}else{
				$("#btn-s-brg").removeAttr("disabled");
				$("#btn-rs-brg").removeAttr("disabled");
				$("#btn-r-brg").removeAttr("disabled");
				$("#validation").show();
				if(kode0==""){
					$('#validation').html('Kode barang harus diisi!');	
				}else if (nama0=="") {
					$('#validation').html('Nama barang harus diisi!');	
				}
				// else if (status == "") {
					// $('#validation').html('Status barang harus diisi!');	
				// }
				else if (kemasan == "") {
					$('#validation').html('Kemasan barang harus diisi!');	
				}else if(qty_kemasan == ""){
					$('#validation').html('Qty kemasan barang harus diisi!');	
				}else{
					$('#validation').html('Harap isi semua informasi yang dibutuhkan!');	
				}
				$("#validation").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation").slideUp(500);
                });

                is_valid = 0;
			}
		}

		//action btn save
		$('#btn-s-brg').on('click', function(e) {
			e.preventDefault();

			save_brg();
			var kode0 = $('#kode_brg').val();
			var nama0 = $('#nama_brg').val();
			
			var is_active = $('#is_act_brg').prop('checked');
			var is_non = $('#is_non_brg').prop('checked');
			if(is_active == true && is_non == false){
				var status = 0;
			}else{
				var status = 1;
			}
			var kat = $('#kat_brg').val();
			var sub_kat = $('#grp_brg').val();
			var desk = $('#prod_desk').val();
			var prod_buy = $('#harga_beli').val();
			var prod_ppn = $('#harga_belippn').val();
			var kemasan = $('#kemasan').val();
			var qty_kemasan = $('#qty_kemasan').val();

			var checkTbl = check_detail_brg();

			if(checkTbl == 1){
				$('#is_stn').val(0);
				$("#btn-s-brg").removeAttr("disabled");
				$("#btn-rs-brg").removeAttr("disabled");
				$("#btn-r-brg").removeAttr("disabled");
				$("#empsat").show();
				$('#empsat').html('Harap lengkapi kolom Satuan dan Konversi pada Tab Satuan!');
				$("#empsat").fadeTo(1500, 500).slideUp(500, function() {
                	$("#empsat").slideUp(500);
                });

                is_valid = 0;

                return;
			}else if (checkTbl == 11) {
				$('#is_stn').val(0);
				$("#btn-s-brg").removeAttr("disabled");
				$("#btn-rs-brg").removeAttr("disabled");
				$("#btn-r-brg").removeAttr("disabled");
				$("#empsat").show();
				$('#empsat').html('Detail satuan barang masih kosong!');
				$("#empsat").fadeTo(1500, 500).slideUp(500, function() {
                	$("#empsat").slideUp(500);
                });

                is_valid = 0;

                return;
			}

			if(kode0!="" && nama0!="" &&  (is_active !="" || is_non !="") && kemasan != "" && qty_kemasan != ""){

				var tableData = [];

				$('#tbl_satuan_body tr').each(function(row, tr){
				  tableData[row] = {
				    "nm_satuan": $(tr).find('td:eq(0) div').text(),
				    "konversi": $(tr).find('td:eq(1) div').text(),
				    "hj_satu": $(tr).find('td:eq(2) div').text(),
				    "hj_dua": $(tr).find('td:eq(3) div').text(),
				    "hj_tiga": $(tr).find('td:eq(4) div').text(),
				    "id" : $(tr).find('td:eq(0) div').data('id')
				  }
				});

				$.ajax({
					url: "<?php echo base_url("product/cek_unit_satuan_json");?>",
					type: "POST",
					data: {tableData : tableData},
					cache: false,
					success: function(dataResult){
						var jsonData = JSON.parse(dataResult);
						let hsl = jsonData.hasil;
						if(hsl < 1){
							// console.log(hsl);
							$('#add_product').modal('hide');
							$.uniform.update();
							var oTable = $('#datatable_products').DataTable();
            				oTable.draw();
            				var oTable2 = $('#datatable_products_margin').DataTable();
            				oTable2.draw();
						}
					},
					error: function() {
					}
				});
			}else{
				$("#btn-s-brg").removeAttr("disabled");
				$("#btn-rs-brg").removeAttr("disabled");
				$("#btn-r-brg").removeAttr("disabled");
				$("#validation").show();
				if(kode0==""){
					$('#validation').html('Kode barang harus diisi!');	
				}else if (nama0=="") {
					$('#validation').html('Nama barang harus diisi!');	
				}
				// else if (status == "") {
					// $('#validation').html('Status barang harus diisi!');	
				// }
				else if (kemasan == "") {
					$('#validation').html('Kemasan barang harus diisi!');	
				}else if(qty_kemasan == ""){
					$('#validation').html('Qty kemasan barang harus diisi!');	
				}else{
					$('#validation').html('Harap isi semua informasi yang dibutuhkan!');	
				}
				$("#validation").fadeTo(2000, 500).slideUp(500, function() {
                	$("#validation").slideUp(500);
                });

                is_valid = 0;
			}

		});

		//action add_qty 

		function qty_product(id_prod) {
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
		
		//action btn save and add new
		$('#btn-rs-brg').on('click', function(e) {
			e.preventDefault();
			save_brg();

			var proses_id = $('#proses_id_brg').val();
			var id_brg = $('#id_brg').val();
			if(id_brg == ""){
				$.ajax({
					url: "<?php echo base_url("product/delete_all_satuan");?>",
					type: "POST",
					data: {
						proses_id : proses_id
					},
					cache: false,
					success: function(){
						$('#table_satuan_brg').DataTable().destroy();
						fetch_data();
						if(is_valid != 0){
							$("#validation-s").show();
							$('#validation-s').html('Data berhasil ditambahkan!');
							$("#validation-s").fadeTo(2000, 500).slideUp(500, function() {
				            	$("#validation-s").slideUp(500);
				            });
						}
						
					},
					error:function(){
					}
				});
			}

			$("#rmv-img").click(e);

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
		$('#btn-r-brg').on('click', function(e) {
			e.preventDefault();
			
			var proses_id = $('#proses_id_brg').val();
			var id_brg = $('#id_brg').val();
			if(id_brg == ""){
				$.ajax({
					url: "<?php echo base_url("product/delete_all_satuan");?>",
					type: "POST",
					data: {
						proses_id : proses_id
					},
					cache: false,
					success: function(){
						$('#table_satuan_brg').DataTable().destroy();
						fetch_data();
					},
					error:function(){
					}
				});
			}

			$("#rmv-img").click(e);
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

		$('#21F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#21E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#21D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		
		function cae_product(id_brg) {
			var x = document.getElementById("21C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				// Set data to Form Edit
				$('#id_brg').val(id_brg);
				$.ajax({
					url: "<?php echo base_url("product/get_edit_data");?>",
					type: "POST",
					data: {
						id_brg: id_brg
					},
					cache: false,
					success: function(dataResult){
						// console.log(dataResult);
						var json_data = JSON.parse(dataResult);
						
						$('#id_brg').val(json_data.parent_prod.prod_no);
						$('#nama_brg').val(json_data.parent_prod.prod_name0);
						$('#kode_brg').val(json_data.parent_prod.prod_code0);
						$('#nama_alias').val(json_data.parent_prod.prod_name1);
						$('#kode_alias').val(json_data.parent_prod.prod_code1);
						$('#proses_id_brg').val(json_data.parent_prod.proses_id);
						var status = json_data.parent_prod.status;

						// console.log(status);
						if(status == 0 ){
							$('#is_act_brg').prop('checked', true);
							$('#is_non_brg').prop('checked', false);
						}else{
							$('#is_act_brg').prop('checked', false);
							$('#is_non_brg').prop('checked', true);
						}

						if(json_data.parent_prod.tipe_brg == 0){
							$('#opt_tipe_brg').prop('checked', true);
							$('#opt_tipe_mnf').prop('checked', false);
						}else{
							$('#opt_tipe_brg').prop('checked', false);
							$('#opt_tipe_mnf').prop('checked', true);
						}

						if(json_data.parent_prod.is_ptkp == 1){
							$('#chk_pjk_ptkp').prop('checked', true);
						}
						
						if(json_data.parent_prod.is_inc == 1){
							$('#chk_pjk_inc').prop('checked', true);
						}						

						$('#kat_brg').val(json_data.parent_prod.cat_id).trigger('change');
						$('#grp_brg').val(json_data.parent_prod.group_id).trigger('change');
						$('#prod_desk').val(json_data.parent_prod.desc);
						$('#harga_beli').val(json_data.parent_prod.prod_buy_price);
						$('#harga_belippn').val(json_data.parent_prod.prod_last_ppn);
						$('#kemasan').val(json_data.parent_prod.kemasan);
						$('#qty_kemasan').val(json_data.parent_prod.qty_kemasan);

						$.uniform.update();

						$('#table_satuan_brg').DataTable().destroy();
						fetch_data();

						$.ajax({
							url: "<?php echo base_url("product/get_img_edit");?>",
							type: "POST",
							data: {
								id_brg: id_brg
							},
							cache: false,
							success: function(dataResult){
								// console.log(dataResult);
								$('.input-images-2').empty();
								let json_data = JSON.parse(dataResult);
								if(json_data.length != 0){
									load_img_up(json_data);
								}else{
									load_img_up();
								}
							}
						});	
					}
				});
				
				$('#add_product').modal('show');
			}
		}

		$('#21B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$('#proses_id_brg').val('');
				$('#quantity-stok').val(0);
				$('#is_act_brg').attr("checked", true);
                $('#is_act_brg').closest('span').addClass('checked');
				$('#is_non_brg').attr("checked", false);
				$('#is_non_brg').closest('span').removeClass('checked');
				$('#opt_tipe_brg').attr("checked", true);
                $('#opt_tipe_brg').closest('span').addClass('checked');
				$('#opt_tipe_mnf').attr("checked", false);
				$('#opt_tipe_mnf').closest('span').removeClass('checked');
				$('.input-images-2').empty();
				$.uniform.update();
				load_img_up();
				getProsesID();
				$('#add_product').modal('show');
			}		
		});

		function add_table_satuan() {
			is_click_ins_stn = true ;
			var nm_satuan = "";
			var konversi = "";
			var hj_dua = 0;
			var hj_tiga = 0;
			var hj = 0;
			
			$.ajax({
			url:"<?= base_url('product/add_satuan') ?>",
				method:"POST",
				data:{
					nm_satuan:nm_satuan, 
					konversi:konversi,
					hj_dua:hj_dua,
					hj_tiga:hj_tiga,
					hj:hj
				},
				success:function(data){
					$('#table_satuan_brg').DataTable().destroy();
					fetch_data();
				}
			});
			is_click_ins_stn = false ;
		}

		//btn delete item
		$('#btn-h-akses').on('click', function() {
			// Get userid from checked checkboxes
				var brg_arr = [];
				$(".chk-barang:checked").each(function(){
					var brgid = $(this).val();

					brg_arr.push(brgid);
				});

				// Array length
				var length = brg_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("product/action_product");?>",
						type: "POST",
						data: {
							type: 3,
							id_brg : brg_arr
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
		function search_brg() {
			var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var kat = $("#kategori-filter").val();
        	var grp = $("#subkategori_filter").val();
        	var sts = $("#statbar_filter").val();

			var urlist = "<?php echo base_url('product/page');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/" + grp + "/" + kat + "/" + sts + "/"
		    );
		    location.href = url.href;
		}

		//action btn arsip
		$('#btn-a-akses').on('click', function() {
			// Get userid from checked checkboxes
				var brg_arr = [];
				$(".chk-barang:checked").each(function(){
					var brgid = $(this).val();

					brg_arr.push(brgid);
				});

				// Array length
				var length = brg_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("product/action_product");?>",
						type: "POST",
						data: {
							type: 4,
							id_brg : brg_arr
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
		$('#btn-rf-brg').on('click', function(e) {
			$('#chk-arsip').prop("checked", false);
			$('#keyword').val("");
			$('#keyword-front').val("");
			$("#kategori-filter").val("");
        	$("#subkategori_filter").val("");
        	$("#statbar_filter").val(1);

			$.uniform.update();

			search_brg();

		});

		//action btn cari
		$('#btn-sf-brg').on('click', function(e) {
			search_brg();
		});
		$('#test-upload').on('click', function(e) {
			e.preventDefault();
			upload_images("ID-12312132");
		});
		$('#btn-b-brg').on('click', function(e) {
			e.preventDefault();

			var proses_id = $('#proses_id_brg').val();
			var id_brg = $('#id_brg').val();
			// if(id_brg == ""){
				$.ajax({
					url: "<?php echo base_url("product/delete_all_satuan");?>",
					type: "POST",
					data: {
						proses_id : proses_id
					},
					cache: false,
					success: function(){
						$('#table_satuan_brg').DataTable().destroy();
						fetch_data();
					},
					error:function(){
					}
				});
			// }

			$("#rmv-img").click(e);

			var $t = $(this),
			target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

			$(target)
				.find('input,textarea,select')
					.val('')
					.end()
				.find('input[type="checkbox"], input[type="radio"]')
					.prop("checked", false)
					.change();
			
			$("#kat_brg").select2("val"," ")
			$("#grp_brg").select2("val"," ")
			$.uniform.update();
			$('#add_product').modal('hide');
			var oTable = $('#datatable_products').DataTable();
			oTable.draw();
			var oTable2 = $('#datatable_products_margin').DataTable();
			oTable2.draw();
		});

		//action ketika enter search bar
		$("#keyword-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-front").val();
		    	$("#keyword").val(keyword);
		        search_brg();
		    }
		});

		//action update list margin
		$('#update-margin').on('click', function() {
			// Get userid from checked checkboxes
				var brg_arr = [];
				$(".chk-barang-margin:checked").each(function(){
					var brgid = $(this).val();

					brg_arr.push(brgid);
				});

				var margin_rep = $('#marginrep').val();
				var margin_per = $('#marginper').val();

				if(margin_rep != '' && margin_per != ''){
					$("#failed").show();
					$('#failed').html('Hanya isi salah satu antara persen dan rupiah!');
					$("#failed").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#failed").slideUp(500);
	                });
				}else if (margin_rep == '' && margin_per == '') {
					$("#failed").show();
					$('#failed').html('Harap isi salah satu antara persen dan rupiah!');
					$("#failed").fadeTo(2000, 500).slideUp(500, function() {
	                	$("#failed").slideUp(500);
	                });
				}else{
					// Array length
					var length = brg_arr.length;

					if(length > 0){

					// AJAX request
						$.ajax({
							url: "<?php echo base_url("product/update_margin");?>",
							type: "POST",
							data: {
								id_brg : brg_arr,
								margin_rep : margin_rep,
								margin_per : margin_per
							},
							cache: false,
							success: function(dataResult){

								var dataResult = JSON.parse(dataResult);
								if(dataResult.statusCode==202){
								    $("#success").show();
									$('#success').html('Harga Jual Berhasil di Update!');
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
					}

					var oTable = $('#datatable_products_margin').DataTable();
            		oTable.draw();
				}
		});

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

	    $(document).on('click', '#btn-pdf-brg', function(e){
		 	e.preventDefault();

		 	var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var kat = $("#kategori-filter").val();
        	var grp = $("#subkategori_filter").val();
        	var sts = $("#statbar_filter").val();
        	
        	var tabAktif = sessionState;
        	var urlist = '';
        	if(sessionState == "li_tab_2_1"){
        		urlist = "<?php echo base_url('product/print_pdf');?>";
        	}else{
        		urlist = "<?php echo base_url('product/print_pdf_margin');?>";
        	}
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/" + grp + "/" + kat + "/" + sts + "/"
		    );
		 	window.open(url);
		});

	    $(document).on('click', '#btn-csv-brg', function(e){
		 	e.preventDefault();
		 	var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var kat = $("#kategori-filter").val();
        	var grp = $("#subkategori_filter").val();
        	var sts = $("#statbar_filter").val();

			var tabAktif = sessionState;
			console.log(sessionState);
        	var urlist = '';
        	if(sessionState == "li_tab_2_1"){
        		urlist = "<?php echo base_url('product/print_csv');?>";
        	}else{
        		urlist = "<?php echo base_url('product/print_csv_margin');?>";
        	}
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/" + grp + "/" + kat + "/" + sts + "/"
		    );
		 	window.open(url);
		});

		$(document).on('click', '#btn-exc-brg', function(e){
		 	e.preventDefault();
		 	var keyword = $("#keyword").val();
			if(keyword==''){
				keyword = 'none';
			}else{
				keyword  = keyword.replace(/ /g,"_");
			}
			var is_ar = $("#chk-arsip").prop("checked");
			var kat = $("#kategori-filter").val();
        	var grp = $("#subkategori_filter").val();
        	var sts = $("#statbar_filter").val();

			var tabAktif = sessionState;
			// console.log(sessionState);
        	var urlist = '';
        	if(sessionState == "li_tab_2_1"){
        		urlist = "<?php echo base_url('product/print_exc');?>";
        	}else{
        		urlist = "<?php echo base_url('product/print_exc_margin');?>";
        	}
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/" + grp + "/" + kat + "/" + sts + "/"
		    ); 
		 	window.open(url);
		});

		$(document).on('click', '#f5test', function(e){
			e.preventDefault();
			var oTable = $('#datatable_products').DataTable();
            oTable.draw();
		});
</script>
<!-- END JAVASCRIPTS -->
<?php
    $this->load->view("_partials/end_body.php");
?>
