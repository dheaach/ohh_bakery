<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				 Widget settings form goes here
			</div>
			<div class="modal-footer">
				<button type="button" class="btn blue">Save changes</button>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!--MODAL ADD PRODUCT-->
<div class="modal fade bs-modal-xl right" id="add_product" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<!-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Produk</h4>
			</div> -->
			<div class="modal-body">
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#" id="frm-brg">
							<div class="portlet">
								<div class="portlet-title">
									
									<div class="actions btn-set">
										<!-- <button type="button" name="back" class="btn default"><i class="fa fa-close"></i> Cancel</button> -->
										<!-- <button id="test-upload">
											TEST UPLOAD GAMBAR
										</button> -->
										<button id="rmv-img" style="display:none;"></button>
										<button class="btn default" id="btn-r-brg"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-brg"><i class="fa fa-check"></i> Simpan</button>
										<button class="btn green-seagreen" id="btn-rs-brg"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn default" id="btn-b-brg"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>

								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
											<li>
												<a href="#tab_satuan" data-toggle="tab">
												Satuan </a>
											</li>
											<li>
												<a href="#tab_images" data-toggle="tab">
												Gambar </a>
											</li>
										</ul>
										<div class="tab-content no-space">
											<div class="alert alert-danger alert-dismissible" id="validation" style="display:none;">
											  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
											</div>
											<div class="alert alert-danger alert-dismissible" id="empsat" style="display:none;">
											  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
											</div>
											<div class="alert alert-success alert-dismissible" id="validation-s" style="display:none;">
											  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
											</div>
											<div class="tab-pane active" id="tab_general">
												<div class="form-body">
													<div class="row" style="margin-top:20px;">	
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label">Kode Barang<span class="required">
																* </span>
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control" id="kode_brg" >
																	<input type="hidden" class="form-control" id="id_brg" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label">Nama Barang<span class="required">
																* </span>
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control" id="nama_brg" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label">Kemasan<span class="required">
																* </span>
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control" id="kemasan" >
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label">Kode Alias
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control" id="kode_alias" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label">Nama Alias
																</label>
																<div class="col-md-8">
																	<input type="text" class="form-control" id="nama_alias" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label">Qty Kemasan<span class="required">
																* </span>
																</label>
																<div class="col-md-8">
																	<input type="number" class="form-control" id="qty_kemasan" >
																	<input type="hidden" class="form-control" id="quantity-stok" >
																</div>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label class="col-md-2 control-label">Status Barang<span class="required">
																* </span>
																</label>
																<div class="col-md-4">
																	<div class="radio-list">
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_act_brg" value="1" checked> Active</label>
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_non_brg" value="0" checked> Non-Active </label>
																	</div>
																</div>
																<label class="col-md-6 control-label"></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-3 control-label" style="text-align:left;color: #10625e;">Tipe Barang
																</label>
																<div class="col-md-9"  style="text-align:left;">
																	<hr class="hr-gs" />
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-3 control-label" style="text-align:left;color: #10625e;">Spesifikasi
																</label>
																<div class="col-md-9"  style="text-align:left;">
																	<hr class="hr-gs" />
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-1 control-label"></label>
																<div class="col-md-3">
																	<div class="radio-list">
																		<label>
																		<input type="radio" name="opt_tipe" id="opt_tipe_brg" value="0" checked> Barang </label>
																		<label>
																		<input type="radio" name="opt_tipe" id="opt_tipe_mnf" value="1" checked> Manufaktur </label>
																		<!-- <label>
																		<input type="radio" name="opt_tipe" id="opt_tipe_paket" value="3"> Paket </label>
																		<label>
																		<input type="radio" name="opt_tipe" id="opt_tipe_jasa" value="4"> Jasa </label> -->

																	</div>
																</div>
																<div class="col-md-3">
																	<div class="checkbox-list" style="display:none;">
																		<label>
																		<input type="checkbox" name="chk_tipe" id="chk_pjk_inc"> Pjk Inc </label>
																		<label>
																		<input type="checkbox" name="chk_tipe" id="chk_pjk_ptkp"> Pjk PTKP </label>
																		<!-- <label>
																		<input type="radio" name="opt_tipe" id="opt_tipe_paket" value="3"> Paket </label>
																		<label>
																		<input type="radio" name="opt_tipe" id="opt_tipe_jasa" value="4"> Jasa </label> -->

																	</div>
																</div>
																<label class="col-md-5 control-label"></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label">Kategori<span class="required">
																* </span>
																</label>
																<div class="col-md-8">
																	<select class="table-group-action-input form-control select2" id="kat_brg">
																		<?php
																			if( !empty($kat) ) {
    																			foreach($kat as $au) {
																					echo"<option value=".$au->cat_id.">".$au->nama."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-4 control-label">Sub-Kategori
																</label>
																<div class="col-md-8">
																	<select class="table-group-action-input form-control select2" id="grp_brg">
																		<option value="0">None</option>
																		<?php
																			if( !empty($sub_kat) ) {
    																			foreach($sub_kat as $au) {
																					echo"<option value=".$au->group_id.">".$au->nama."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-12">
															<div class="form-group">
																<label class="col-md-12" style="color: #10625e;">Deskripsi
																</label>
																<div class="col-md-12">
																	<textarea class="form-control txt-prd" id="prod_desk"></textarea>
																</div>
															</div>
														</div>
														<div style="display: none;">
																<div class="form-group">
																	<label class="col-md-12 control-label left">Warehouse
																	</label>
																	<div class="col-md-12">
																		<select class="form-control select2" id="gud_prod">
																			<?php
																				if( is_array($gud) || is_object($gud)) {
	    																			foreach($gud as $au) {
																						echo"<option value=".$au->gud_no.">".$au->gud_name."</option>";
																					}
																				}
																			?>
																		</select>
																	</div>
																</div>
															</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_satuan">
												<div id="alert_message"></div>
												<input type="hidden" class="form-control" id="proses_id_brg" >
												<div class="form-body">
													<table class="table table-striped table-bordered" id="table_satuan_brg">
														<thead>
															<tr>
																<th>
																	 Satuan
																</th>
																<th>
																	 Konversi
																</th>
																<!-- <th>
																	 Harga Beli
																</th>
																<th>
																	 Hrg Beli + PPN
																</th> -->
																<th>
																	 Harga Jual 1
																</th>
																<th>
																	 Harga Jual 2
																</th>
																<th>
																	 Harga Jual 3
																</th>
																<th>
																	
																</th>
															</tr>
														</thead>
														<tbody id="tbl_satuan_body">
															<!-- <td>
																<div contenteditable class="update" data-id="1" data-column="nm_satuan"></div>
															</td>
															<td>
																<div contenteditable class="update" data-id="1" data-column="konversi"></div>
															</td>
															<td>
																<div contenteditable class="update" data-id="1" data-column="hj_satu"></div>
															</td>
															<td>
																<div contenteditable class="update" data-id="1" data-column="hj_dua"></div>
															</td>
															<td>
																<div contenteditable class="update" data-id="1" data-column="hj_tiga"></div>
															</td> -->
														</tbody>
														<!-- <tfoot>
															<tr>
																<th colspan="6">
																	<a id="add_new_satuan">
																		<i class="fa fa-plus"> Tambahkan</i>
																	</a>
																</th>
															</tr>
														</tfoot> -->
													</table>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-md-6 control-label">Harga Beli
															</label>
															<div class="col-md-6">
																<input type="text" class="form-control underline-form text-right" id="harga_beli" >
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-6 control-label">Harga Beli + PPN
															</label>
															<div class="col-md-6">
																<input type="text" class="form-control underline-form text-right" id="harga_belippn" >
															</div>
														</div>
													</div>
													<div class="col-sm-8"></div>
												</div>
											</div>
											<div class="tab-pane" id="tab_images">
												<!-- <form id="fileupload" action="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data"> -->
													<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
													<div class="row fileupload-buttonbar">
														<div class="col-lg-12">
															<div id="d-alert"></div>
															<!-- The fileinput-button span is used to style the file input field as button -->
															<!-- <span class="btn green-seagreen fileinput-button">
																<i class="fa fa-plus"></i>
																<span>Add files </span>
																<input type="file" name="files[]" multiple="" id="upload-img" accept="image/* ,application/pdf" onchange="readURL(this)">
															</span> -->
															<div class="input-fieldku">
														        <label class="active">Photos</label>
														        <div class="input-images-2" style="padding-top: .5rem;"></div>
														    </div>
														    <!-- <a href="#" type="button" name="upload_img" class="btn btn-warning mx-auto btn-block" onclick="upload_images('ID-123131231-343433');">Upload Test</a> -->
															<!-- <button type="button" class="btn red-sunglo delete">
																<i class="fa fa-trash"></i>
																<span>Delete </span>
															</button> -->
															<!-- <input type="checkbox" class="toggle"> -->
															<!-- The global file processing state -->
															<span class="fileupload-process">
															</span>
														</div>
														<!-- The global progress information -->
													</div>
													<!-- The table listing the files available for upload/download -->
													<table role="presentation" class="table table-striped clearfix">
													<tbody class="files">
													</tbody>
													</table>
												<!-- </form> -->
												<div class="panel panel-seagreen">
													<div class="panel-heading">
														<h3 class="panel-title">Catatan</h3>
													</div>
													<div class="panel-body">
														<ul>
															<li>
																 Ukuran maksimal gambar <strong>1 MB</strong>.
															</li>
															<li>
																 Gambar yang diupload maksimal <strong>3</strong>.
															</li>
															<li>
																 Hanya gambar dengan tipe (<strong>JPG, GIF, PNG</strong>) yang diperbolehkan.
															</li>
														</ul>
													</div>
												</div>
												<div class="row">
													<div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12">
													</div>
												</div>
												<!-- <table class="table table-bordered table-hover">
													<thead>
													<tr role="row" class="heading">
														<th width="8%">
															 Image
														</th>
														<th width="25%">
															 Label
														</th>
														<th width="8%">
															 Sort Order
														</th>
														<th width="10%">
															 Base Image
														</th>
														<th width="10%">
															 Small Image
														</th>
														<th width="10%">
															 Thumbnail
														</th>
														<th width="10%">
														</th>
													</tr>
													</thead>
													<tbody>
													<tr>
														<td>
															<a href="<?php echo base_url();?>assets/admin/pages/media/works/img1.jpg" class="fancybox-button" data-rel="fancybox-button">
															<img class="img-responsive" src="<?php echo base_url();?>assets/admin/pages/media/works/img1.jpg" alt="">
															</a>
														</td>
														<td>
															<input type="text" class="form-control" name="product[images][1][label]" value="Thumbnail image">
														</td>
														<td>
															<input type="text" class="form-control" name="product[images][1][sort_order]" value="1">
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][1][image_type]" value="1">
															</label>
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][1][image_type]" value="2">
															</label>
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][1][image_type]" value="3" checked>
															</label>
														</td>
														<td>
															<a href="javascript:;" class="btn default btn-sm">
															<i class="fa fa-times"></i> Remove </a>
														</td>
													</tr>
													<tr>
														<td>
															<a href="<?php echo base_url();?>assets/admin/pages/media/works/img2.jpg" class="fancybox-button" data-rel="fancybox-button">
															<img class="img-responsive" src="<?php echo base_url();?>assets/admin/pages/media/works/img2.jpg" alt="">
															</a>
														</td>
														<td>
															<input type="text" class="form-control" name="product[images][2][label]" value="Product image #1">
														</td>
														<td>
															<input type="text" class="form-control" name="product[images][2][sort_order]" value="1">
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][2][image_type]" value="1">
															</label>
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][2][image_type]" value="2" checked>
															</label>
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][2][image_type]" value="3">
															</label>
														</td>
														<td>
															<a href="javascript:;" class="btn default btn-sm">
															<i class="fa fa-times"></i> Remove </a>
														</td>
													</tr>
													<tr>
														<td>
															<a href="<?php echo base_url();?>assets/admin/pages/media/works/img3.jpg" class="fancybox-button" data-rel="fancybox-button">
															<img class="img-responsive" src="<?php echo base_url();?>assets/admin/pages/media/works/img3.jpg" alt="">
															</a>
														</td>
														<td>
															<input type="text" class="form-control" name="product[images][3][label]" value="Product image #2">
														</td>
														<td>
															<input type="text" class="form-control" name="product[images][3][sort_order]" value="1">
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][3][image_type]" value="1" checked>
															</label>
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][3][image_type]" value="2">
															</label>
														</td>
														<td>
															<label>
															<input type="radio" name="product[images][3][image_type]" value="3">
															</label>
														</td>
														<td>
															<a href="javascript:;" class="btn default btn-sm">
															<i class="fa fa-times"></i> Remove </a>
														</td>
													</tr>
													</tbody>
												</table> -->
											</div>
											<div class="tab-pane" id="tab_reviews">
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<table class="table table-striped table-bordered table-hover" id="datatable_reviews">
													<thead>
													<tr role="row" class="heading">
														<th width="5%">
															 Review&nbsp;#
														</th>
														<th width="10%">
															 Review&nbsp;Date
														</th>
														<th width="10%">
															 Customer
														</th>
														<th width="20%">
															 Review&nbsp;Content
														</th>
														<th width="10%">
															 Status
														</th>
														<th width="10%">
															 Actions
														</th>
													</tr>
													<tr role="row" class="filter">
														<td>
															<input type="text" class="form-control form-filter input-sm" name="product_review_no">
														</td>
														<td>
															<div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
																<input type="text" class="form-control form-filter input-sm" readonly name="product_review_date_from" placeholder="From">
																<span class="input-group-btn">
																<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
																<input type="text" class="form-control form-filter input-sm" readonly name="product_review_date_to" placeholder="To">
																<span class="input-group-btn">
																<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
														</td>
														<td>
															<input type="text" class="form-control form-filter input-sm" name="product_review_customer">
														</td>
														<td>
															<input type="text" class="form-control form-filter input-sm" name="product_review_content">
														</td>
														<td>
															<select name="product_review_status" class="form-control form-filter input-sm">
																<option value="">Select...</option>
																<option value="pending">Pending</option>
																<option value="approved">Approved</option>
																<option value="rejected">Rejected</option>
															</select>
														</td>
														<td>
															<div class="margin-bottom-5">
																<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
															</div>
															<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
														</td>
													</tr>
													</thead>
													<tbody>
													</tbody>
													</table>
												</div>
											</div>
											<div class="tab-pane" id="tab_history">
												<div class="table-scrollable" style="border: 0px solid #dddddd;">
													<table class="table table-striped table-bordered table-hover" id="datatable_history">
													<thead>
													<tr role="row" class="heading">
														<th width="25%">
															 Datetime
														</th>
														<th width="55%">
															 Description
														</th>
														<th width="10%">
															 Notification
														</th>
														<th width="10%">
															 Actions
														</th>
													</tr>
													<tr role="row" class="filter">
														<td>
															<div class="input-group date datetime-picker margin-bottom-5" data-date-format="dd/mm/yyyy hh:ii">
																<input type="text" class="form-control form-filter input-sm" readonly name="product_history_date_from" placeholder="From">
																<span class="input-group-btn">
																<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<div class="input-group date datetime-picker" data-date-format="dd/mm/yyyy hh:ii">
																<input type="text" class="form-control form-filter input-sm" readonly name="product_history_date_to" placeholder="To">
																<span class="input-group-btn">
																<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
														</td>
														<td>
															<input type="text" class="form-control form-filter input-sm" name="product_history_desc" placeholder="To"/>
														</td>
														<td>
															<select name="product_history_notification" class="form-control form-filter input-sm">
																<option value="">Select...</option>
																<option value="pending">Pending</option>
																<option value="notified">Notified</option>
																<option value="failed">Failed</option>
															</select>
														</td>
														<td>
															<div class="margin-bottom-5">
																<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
															</div>
															<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
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
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL ADD PRODUCT-->

<!--MODAL ADD CATEGORY-->
<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" id="frm-kat">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-kat"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-kat"><i class="fa fa-check"></i> Simpan</button>
										<button class="btn green-seagreen" id="btn-rs-kat"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn default" id="btn-b-kat"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-kat" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-kat" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:20px;">	
														<div class="col-md-12" style="padding-right: 30px;">
															<div class="form-group">
																<label class="col-md-3 control-label">Kode <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="kode_kat" id="kode_kat">
																	<input type="hidden" class="form-control" name="id_kat" id="id_kat">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Nama <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="nama_kat" id="nama_kat" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Status <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<div class="radio-list">
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_act_kat" value="1" checked> Active</label>
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_non_kat" value="0" checked> Non-Active </label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_satuan">
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL ADD Sub-CATEGORY-->
<div class="modal fade" id="add_subcategory" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#" id="frm-sub">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-group"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-group"><i class="fa fa-check"></i> Simpan</button>
										<button class="btn green-seagreen" id="btn-rs-group"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn default" id="btn-b-group"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-sub" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-sub" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:20px;">	
														<div class="col-md-12" style="padding-right: 30px;">
															<div class="form-group">
																<label class="col-md-3 control-label">Kode <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="kode_group" id="kode_group">
																	<input type="hidden" class="form-control" name="id_group" id="id_group">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Nama <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="nama_group" id="nama_group" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Status <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<div class="radio-list">
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_act_group" value="1" checked> Active</label>
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_non_group" value="0" checked> Non-Active </label>
																	</div>
																</div>
															</div>
														</div>
														<!-- <div class="col-md-6" style="margin-bottom: 20px;">
															
														</div> -->
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_satuan">
												<div class="form-body">
													<div class="row" style="margin-top:20px;">	
														<div class="col-md-12" style="padding-right: 30px;">
															<div class="form-group">
																<label class="col-md-3 control-label">Kode <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="subcategory[kode]" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Nama <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="subcategory[name]" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Status <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<div class="radio-list">
																		<label class="radio-inline">
																		<input type="radio" name="optionsRadios" id="optionsRadios20" value="option1" checked> Active</label>
																		<label class="radio-inline">
																		<input type="radio" name="optionsRadios" id="optionsRadios21" value="option2" checked> Non-Active </label>
																	</div>
																</div>
															</div>
														</div>
														<!-- <div class="col-md-6" style="margin-bottom: 20px;">
															
														</div> -->
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL ADD BAHAN BAKU-->

<div class="modal fade bs-modal-xl right" id="add_bahanbaku" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#" id="frm-bb">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-bb"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-bb"><i class="fa fa-check"></i> Simpan</button>
										<button class="btn green-seagreen" id="btn-rs-bb"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn green-seagreen" id="btn-c-bb"><i class="fa fa-print"></i> Cetak</button>
										<button class="btn default" id="btn-b-bb"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-bb" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-bb" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:10px;padding: 10px;">	
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">Tanggal 
																</label>
																<div class="col-md-12">
																	<input type="datetime-local" class="form-control" id="bb_tgl">
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">No. Proses 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="bb_noproses" readonly="true">
																	<input type="hidden" id="id_bb">
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																
																<label class="col-md-12 control-label left">Kode Barang 
																</label>
																<div class="col-md-12">
																	<div class="input-group">
																	<div class="input-icon">
																		<input type="text" class="form-control" id="bb_kodeprod" readonly="">
																		<input type="hidden" class="form-control" id="bb_idprod">
																	</div>
																	<div class="input-group-btn">
																		<a class="btn btn-default" id="bb_show_product_single"><i class="fa fa-ellipsis-h"></i></a>
																	</div>
																</div>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left" style="color:white;">s
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="bb_prodname" readonly="" >
																</div>
															</div>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<label class="col-md-12 control-label left">Keterangan 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="bb_ket" >
																</div>
															</div>
														</div>
														<div class="col-md-4" style="display: none;">
															<div class="form-group">
																<label class="col-md-12 control-label left">Kategori
																</label>
																<div class="col-md-12">
																	<select class="form-control select2" id="kat_brg_bb">
																		<option value="0">None</option>
																		<?php
																			if( !empty($kat) ) {
    																			foreach($kat as $ab) {
																					echo"<option value=".$ab->cat_id.">".$ab->nama."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<label class="col-md-12 control-label" style="color:white;">s
															</label>
															<div class="col-md-12">
																<a class="btn green-seagreen" id="btn_plh_prod"><i class="fa fa-plus"></i> Pilih Barang</a>
															</div>
														</div>
													</div>
													<div class="table-scrollable">
														
														<table class="table table-striped table-bordered" id="tbl_bahanbakudetail">
															<thead>
																<tr>
																	<th>
																		 Kode Barang
																	</th>
																	<th>
																		 Nama Barang
																	</th>
																	<th>
																		 Unit
																	</th>
																	<th>
																		 Qty
																	</th>
																	<th>
																		 Qty Pemakaian
																	</th>
																	<th>
																		 Qty Dibutuhkan
																	</th>
																	<th>
																		 Keterangan
																	</th>
																	<th>
																		 Qty Kemasan
																	</th>
																	<th>
																		 
																	</th>
																</tr>
															</thead>
															<tbody id="tbl_bahanbakudetail_body">
															</tbody>
															<tfoot>
																<tr style="background-color: rgba(148, 148, 148, .2)">
																	<td></td>
																	<td></td>
																	<td></td>
																	<td id="col-qty-satuan">0</td>
																	<td id="col-qty-pakai">0</td>
																	<td id="col-qty-butuh">0</td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
															</tfoot>
															<!-- <tfoot>
																<tr>
																	<th colspan="6">
																		<a id="add_new_prod_bahan_detail">
																			<i class="fa fa-plus"> Tambahkan</i>
																		</a>
																	</th>
																</tr>
															</tfoot> -->
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL ADD Role Manufaktur-->

<div class="modal fade bs-modal-xl right" id="add_rolemnf" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-role"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-role"><i class="fa fa-check"></i> Simpan</button>
										<button class="btn green-seagreen" id="btn-rs-role"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn green-seagreen" id="btn-c-role"><i class="fa fa-print"></i> Cetak</button>
										<button class="btn default" id="btn-b-role"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-role" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-role" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:10px;padding: 10px;">	
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">Tanggal 
																</label>
																<div class="col-md-12">
																	<input type="datetime-local" class="form-control" id="tgl_role" >
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">No. Proses 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="no_role"  readonly="true">
																	<input type="hidden" id="id_role">
																</div>
															</div>
														</div>
														<!-- <div class="col-md-3">
															<div class="form-group">
																
																<label class="col-md-12 control-label left">Kode Barang 
																</label>
																<div class="col-md-12">
																	<div class="input-group">
																	<div class="input-icon">
																		<input type="text" class="form-control">
																	</div>
																	<div class="input-group-btn">
																		<a class="btn btn-default" data-toggle="modal" href="#show_product_single"><i class="fa fa-ellipsis-h"></i></a>
																	</div>
																</div>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left" style="color:white;">s
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" name="process[name_item]" >
																</div>
															</div>
														</div> -->
														<div class="col-md-6">
															<label class="col-md-12 control-label" style="color:white;">s
															</label>
															<div class="col-md-12">
																<a class="btn green-seagreen" id="btn_prod_role"><i class="fa fa-plus"></i> Pilih Barang</a>
															</div>
															
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label class="col-md-12 control-label left">Keterangan 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="ket_role" >
																</div>
															</div>
														</div>
														
														<!-- <div class="col-md-6" style="margin-bottom: 20px;">
															
														</div> -->
													</div>
													<div class="table-scrollable">
														
														<table class="table table-striped table-bordered" id="table_rolemnf">
															<thead>
																<tr>
																	<th>
																		 Kode Barang
																	</th>
																	<th>
																		 Nama Barang
																	</th>
																	<th>
																		 Unit
																	</th>
																	<th>
																		 Harga
																	</th>
																	<th>
																		 Keterangan
																	</th>
																	<th>
																		 
																	</th>
																</tr>
															</thead>
															<tbody id="tbl_rolemnf_body">
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL ADD Proses TRIAL-->

<div class="modal fade bs-modal-xl right" id="add_prosestrial" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="" id="frm-tr">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-tr"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-tr"><i class="fa fa-check"></i> Simpan</button>
										<!-- <button class="btn green-seagreen" id="btn-t-pm"><i class="fa fa-check"></i> Test Simpan</button> -->
										<button class="btn green-seagreen" id="btn-rs-tr"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn yellow-gold" id="btn-pm-tr" style="display: none;"><i class="fa fa-plus"></i> Proses Manufacture</button>
										<button class="btn green-seagreen" id="btn-c-tr"><i class="fa fa-print"></i> Cetak</button>
										<button class="btn default" data-dismiss="modal" id="btn-b-tr"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
											<!-- <li>
												<a href="#tab_account" data-toggle="tab">
												Account </a>
											</li> -->
										</ul>

										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-trial" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-trial" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:10px;padding: 10px;">	
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">Tanggal 
																</label>
																<div class="col-md-12">
																	<input type="datetime-local" class="form-control" id="tgl_trial" >
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">No. Faktur 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="no_trial"  readonly="true">
																	<input type="hidden" class="form-control" id="id_trial">
																	<input type="hidden" class="form-control" id="id_reff">
																</div>
															</div>
														</div>
														<div style="display: none;">
															<div class="form-group">
																<label class="col-md-12 control-label left">Warehouse
																</label>
																<div class="col-md-12">
																	<select class="form-control select2" id="gud_trial">
																		<?php
																			if( is_array($gud) || is_object($gud)) {
    																			foreach($gud as $au) {
																					echo"<option value=".$au->gud_no.">".$au->gud_name."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>													
														<div class="col-md-3">
															<div class="form-group">
																
																<label class="col-md-12 control-label left">No Bahan Baku 
																</label>
																<div class="col-md-12">
																	<div class="input-group">
																	<div class="input-icon">
																		<input type="text" class="form-control" id="no_bb_trial">
																	</div>
																	<div class="input-group-btn">
																		<a class="btn btn-default" data-toggle="modal" href="#show_product_single_bb"><i class="fa fa-ellipsis-h"></i></a>
																	</div>
																</div>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group" style="margin-top:25px;">
																<div class="col-md-2" style="margin-top: 10px;padding-left: 25px;">
																	<input type="checkbox" class="form-control" id="chk_adjust_qty_trial" >
																</div>
																<label class="col-md-10 control-label left"> Adjust Qty Pemakaian
																</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-12 control-label left">Keterangan 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="ket_trial"  >
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-12 control-label left">Keterangan Bahan Baku
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="ket_bb_trial"  >
																</div>
															</div>
														</div>
														<div class="col-md-4" style="display: none;">
															<div class="form-group">
																<label class="col-md-12 control-label left">Kategori
																</label>
																<div class="col-md-12">
																	<select class="form-control select2" id="kat_brg_trial">
																		<option value="0">None</option>
																		<?php
																			if( !empty($kat) ) {
    																			foreach($kat as $ab) {
																					echo"<option value=".$ab->cat_id.">".$ab->nama."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<!-- <div class="col-md-6" style="margin-bottom: 20px;">
															
														</div> -->
													</div>
													<input type="hidden" id="type_det_trial">

													<div class="row">
														<div class="col-md-12" style="text-align: right;">
															<!-- <a class="btn green-seagreen" data-toggle="modal" href="#show_product"><i class="fa fa-plus"></i> Pilih Barang</a> -->
															<a class="btn green-seagreen" id="btn_pilih_bb_trial"><i class="fa fa-plus"></i> Pilih Barang</a>
														</div>
													</div>

													<div class="table-scrollable">
														<table class="table table-striped table-hover table-bordered" id="tbl_bb_trial">
															<thead>
																<tr align="center">
																	<th class="th-judul" colspan="12" style="text-align:center">PEMAKAIAN BAHAN BAKU</th>
																</tr>
																<tr>
																	<th class="th-kode" width="9%">
																		 Kode Barang
																	</th>
																	<th class="th-nama" width="12%">
																		 Nama Barang
																	</th>
																	<th class="th-unit" width="9%">
																		 Unit
																	</th>
																	<th class="th-qty" width="8%">
																		 Qty
																	</th>
																	<th class="th-harga" width="9%">
																		 Harga
																	</th>
																	<th class="th-subtot" width="9%">
																		 Sub Total
																	</th>
																	<th width="2%"></th>
																	<th class="th-qty-kemas" width="8%">
																		 Qty Kemasan
																	</th>
																	<th class="th-qty-pakai" width="8%">
																		 Qty Pemakaian
																	</th>
																	<th class="th-qty-butuh" width="8%">
																		 Qty Dibutuhkan
																	</th>
																	<th class="th-hj" width="9%">
																		 Harga Jual
																	</th>
																	<th class="th-subtot2" width="9%">
																		 Sub Total
																	</th>
																</tr>
															</thead>
															<tbody id="tbl_bb_trial_body">
															</tbody>
															<tfoot>
																<tr style="background-color: rgba(148, 148, 148, .2)">
																	<td></td>
																	<td></td>
																	<td></td>
																	<td id="col-qty-satuan-trial">0</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td id="col-qty-pakai-trial">0</td>
																	<td id="col-qty-butuh-trial">0</td>
																	<td id="col-qty-hj-trial">0</td>
																	<td id="col-qty-st2-trial">0</td>
																</tr>
															</tfoot>
														</table>
													</div>

													<div class="row">
														<div class="col-md-12" style="text-align: right;">
															<!-- <a class="btn green-seagreen" data-toggle="modal" href="#show_product"><i class="fa fa-plus"></i> Pilih Barang</a> -->
															<a class="btn green-seagreen" id="btn_pilih_mnf_trial" ><i class="fa fa-plus"></i> Pilih Barang</a>
														</div>
													</div>

													<div class="table-scrollable">
														<table class="table table-striped table-hover table-bordered" id="tbl_prosestrial">
															<thead>
																<tr align="center">
																	<th class="th-judul" colspan="10" style="text-align:center">BARANG PRODUKSI</th>
																</tr>
																<tr>
																	<th class="th-kode" width="12%">
																		 Kode Barang
																	</th>
																	<th class="th-nama" width="18%">
																		 Nama Barang
																	</th>
																	<th class="th-unit" width="8%">
																		 Unit
																	</th>
																	<th class="th-qty" width="10%">
																		 Qty
																	</th>
																	<th class="th-jenis" width="12%">
																		 Jenis
																	</th>
																	<th width="2%"></th>
																	<th class="th-qty-kemas" width="12%">
																		Qty Kemasan
																	</th>
																	<th class="th-hj" width="13%">
																		 Harga Jual
																	</th>
																	<th class="th-subtot" width="13%">
																		 Sub Total
																	</th>
																</tr>
															</thead>
															<tbody id="tbl_prosestrial_body">
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->


<!--MODAL ADD Proses Manufaktur-->

<div class="modal fade bs-modal-xl right" id="add_prosesmnf" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="" id="frm-pm">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-pm"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-pm"><i class="fa fa-check"></i> Simpan</button>
										<!-- <button class="btn green-seagreen" id="btn-t-pm"><i class="fa fa-check"></i> Test Simpan</button> -->
										<button class="btn green-seagreen" id="btn-rs-pm"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn green-seagreen" id="btn-c-pm"><i class="fa fa-print"></i> Cetak</button>
										<button class="btn default" data-dismiss="modal" id="btn-b-pm"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
											<!-- <li>
												<a href="#tab_account" data-toggle="tab">
												Account </a>
											</li> -->
										</ul>

										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-mnf" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-mnf" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:10px;padding: 10px;">	
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">Tanggal 
																</label>
																<div class="col-md-12">
																	<input type="datetime-local" class="form-control" id="tgl_manuf" >
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="col-md-12 control-label left">No. Faktur 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="no_manuf"  readonly="true">
																	<input type="hidden" class="form-control" id="id_mnf">
																</div>
															</div>
														</div>
														<div style="display: none;">
															<div class="form-group">
																<label class="col-md-12 control-label left">Warehouse
																</label>
																<div class="col-md-12">
																	<select class="form-control select2" id="gud">
																		<?php
																			if( is_array($gud) || is_object($gud)) {
    																			foreach($gud as $au) {
																					echo"<option value=".$au->gud_no.">".$au->gud_name."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>													
														<div class="col-md-3">
															<div class="form-group">
																
																<label class="col-md-12 control-label left">No Bahan Baku 
																</label>
																<div class="col-md-12">
																	<div class="input-group">
																	<div class="input-icon">
																		<input type="text" class="form-control" id="no_bb_manuf">
																	</div>
																	<div class="input-group-btn">
																		<a class="btn btn-default" data-toggle="modal" href="#show_product_single_bb"><i class="fa fa-ellipsis-h"></i></a>
																	</div>
																</div>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group" style="margin-top:25px;">
																<div class="col-md-2" style="margin-top: 10px;padding-left: 25px;">
																	<input type="checkbox" class="form-control" id="chk_adjust_qty" >
																</div>
																<label class="col-md-10 control-label left"> Adjust Qty Pemakaian
																</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-12 control-label left">Keterangan 
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="ket_manuf"  >
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-12 control-label left">Keterangan Bahan Baku
																</label>
																<div class="col-md-12">
																	<input type="text" class="form-control" id="ket_bb_manuf"  >
																</div>
															</div>
														</div>
														<div class="col-md-4" style="display: none;">
															<div class="form-group">
																<label class="col-md-12 control-label left">Kategori
																</label>
																<div class="col-md-12">
																	<select class="form-control select2" id="kat_brg_mnf">
																		<option value="0">None</option>
																		<?php
																			if( !empty($kat) ) {
    																			foreach($kat as $ab) {
																					echo"<option value=".$ab->cat_id.">".$ab->nama."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<!-- <div class="col-md-6" style="margin-bottom: 20px;">
															
														</div> -->
													</div>
													<input type="hidden" id="type_det">

													<div class="row">
														<div class="col-md-12" style="text-align: right;">
															<!-- <a class="btn green-seagreen" data-toggle="modal" href="#show_product"><i class="fa fa-plus"></i> Pilih Barang</a> -->
															<a class="btn green-seagreen" id="btn_pilih_bb"><i class="fa fa-plus"></i> Pilih Barang</a>
														</div>
													</div>

													<div class="table-scrollable">
														<table class="table table-striped table-hover table-bordered" id="tbl_bb_manuf">
															<thead>
																<tr align="center">
																	<th class="th-judul" colspan="12" style="text-align:center">PEMAKAIAN BAHAN BAKU</th>
																</tr>
																<tr>
																	<th class="th-kode" width="9%">
																		 Kode Barang
																	</th>
																	<th class="th-nama" width="12%">
																		 Nama Barang
																	</th>
																	<th class="th-unit" width="9%">
																		 Unit
																	</th>
																	<th class="th-qty" width="8%">
																		 Qty
																	</th>
																	<th class="th-harga" width="9%">
																		 Harga
																	</th>
																	<th class="th-subtot" width="9%">
																		 Sub Total
																	</th>
																	<th width="2%"></th>
																	<th class="th-qty-kemas" width="8%">
																		 Qty Kemasan
																	</th>
																	<th class="th-qty-pakai" width="8%">
																		 Qty Pemakaian
																	</th>
																	<th class="th-qty-butuh" width="8%">
																		 Qty Dibutuhkan
																	</th>
																	<th class="th-hj" width="9%">
																		 Harga Jual
																	</th>
																	<th class="th-subtot2" width="9%">
																		 Sub Total
																	</th>
																</tr>
															</thead>
															<tbody id="tbl_bb_manuf_body">
															</tbody>
															<tfoot>
																<tr style="background-color: rgba(148, 148, 148, .2)">
																	<td></td>
																	<td></td>
																	<td></td>
																	<td id="col-qty-satuan-bb">0</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td id="col-qty-pakai-bb">0</td>
																	<td id="col-qty-butuh-bb">0</td>
																	<td id="col-qty-hj-bb">0</td>
																	<td id="col-qty-st2-bb">0</td>
																</tr>
															</tfoot>
														</table>
													</div>

													<div class="row">
														<div class="col-md-12" style="text-align: right;">
															<!-- <a class="btn green-seagreen" data-toggle="modal" href="#show_product"><i class="fa fa-plus"></i> Pilih Barang</a> -->
															<a class="btn green-seagreen" id="btn_pilih_mnf" ><i class="fa fa-plus"></i> Pilih Barang</a>
														</div>
													</div>

													<div class="table-scrollable">
														<table class="table table-striped table-hover table-bordered" id="tbl_prosesmnf">
															<thead>
																<tr align="center">
																	<th class="th-judul" colspan="10" style="text-align:center">BARANG PRODUKSI</th>
																</tr>
																<tr>
																	<th class="th-kode" width="12%">
																		 Kode Barang
																	</th>
																	<th class="th-nama" width="18%">
																		 Nama Barang
																	</th>
																	<th class="th-unit" width="8%">
																		 Unit
																	</th>
																	<th class="th-qty" width="10%">
																		 Qty
																	</th>
																	<th class="th-jenis" width="12%">
																		 Jenis
																	</th>
																	<th width="2%"></th>
																	<th class="th-qty-kemas" width="12%">
																		Qty Kemasan
																	</th>
																	<th class="th-hj" width="13%">
																		 Harga Jual
																	</th>
																	<th class="th-subtot" width="13%">
																		 Sub Total
																	</th>
																</tr>
															</thead>
															<tbody id="tbl_prosesmnf_body">
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL ADD USER-->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#" id="frm-user">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-user"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-user"><i class="fa fa-check"></i> Simpan</button>
										<button class="btn green-seagreen" id="btn-rs-user"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
											<!-- <li>
												<a href="#tab_account" data-toggle="tab">
												Account </a>
											</li> -->
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-user" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-user" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:20px;">	
														<div class="col-md-12" style="padding-right: 30px;">
															<div class="form-group">
																<label class="col-md-3 control-label">Username <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" id="nama_user" >
																	<input type="hidden" class="form-control" id="id_user">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Password <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="password" class="form-control" id=pass_user >
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label"> Konfirmasi <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<input type="password" class="form-control" id="passkon_user" >
																	<span id='message' style="font-size:12px;margin-top:5px;margin-left:5px;"></span>
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Status <span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<div class="radio-list">
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_act_user" value="1" checked> Active</label>
																		<label class="radio-inline">
																		<input type="radio" name="status_user" id="is_non_user" value="0" checked> Non-Active </label>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Akses<span class="required">
																* </span>
																</label>
																<div class="col-md-9">
																	<select class="table-group-action-input form-control" id="slc_akse_user">
																		<option value="0">None</option>
																		<?php
																			if( !empty($akses_user) ) {
    																			foreach($akses_user as $au) {
																					echo"<option value=".$au->group_user_id.">".$au->user_name."</option>";
																				}
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_satuan">
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL ADD AKSES-->
<div class="modal fade" id="add_akses" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" method="post" id="frm-user-akses">
							<div class="portlet">
								<div class="portlet-title">
									<div class="actions btn-set">
										<button class="btn default" id="btn-r-akses"><i class="fa fa-reply"></i> Reset</button>
										<button class="btn green-seagreen" id="btn-s-akses"><i class="fa fa-check"></i> Simpan</button>
										<button class="btn green-seagreen" id="btn-rs-akses"><i class="fa fa-check-circle"></i> Simpan & Tambah Baru</button>
										<button class="btn default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												Infomasi </a>
											</li>
											<!-- <li>
												<a href="#tab_account" data-toggle="tab">
												Account </a>
											</li> -->
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="alert alert-danger alert-dismissible" id="validation-akses" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="alert alert-success alert-dismissible" id="validation-s-akses" style="display:none;">
												  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
												</div>
												<div class="form-body">
													<div class="row" style="margin-top:20px;">	
														<div class="col-md-8">
															<div class="form-group">
																<label class="col-md-4 control-label">Nama Akses <span class="required">
																* </span>
																</label>
																<div class="col-md-8" name="input_nama_akses">
																	<input type="text" class="form-control" id="nama_akses">
																	<span class="required" id="name_validation" style="color: red;display:none;margin-top:5px;font-style: italic;"></span>
																	<input type="hidden" class="form-control" id="id_akses" >
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<div class="col-md-2" style="margin-top:10px;">
																	<input type="checkbox" class="form-control" id="is_super_akses"  onclick="super_user_check();">
																</div>
																<label class="col-md-10 control-label" style="text-align:left;">Super User</label>
															</div>
														</div>
														<div class="col-sm-12">
															<div class="portlet green-seagreen box">
																<div class="portlet-title tree-modal">
																	<div class="caption" style="font-size: 13px;font-weight: 500;">
																		Hak Akses
																	</div>
																</div>
																<div class="portlet-body">
																	<div id="tree_1" class="tree-demo">
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL DELETE AKSES-->
<div class="modal fade" id="del_akses" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row"  style="text-align: center;">
					<div class="col-sm-12" style="margin-top:10px;">
						<img src="<?php echo base_url();?>assets/images/delete.png" class="img-popup"/>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<h4 style="font-size:18px;"><strong>Anda yakin ingin menghapus data yang dipilih?</strong></h4>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<button type="button" id="btn-h-akses" class="btn btn-rounded red-sunglo">Hapus</button>
						<button type="button" class="btn btn-rounded default" data-dismiss="modal">Batal</button>
					</div>
				</div>
				 
			</div>
			
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL ARSIP AKSES-->
<div class="modal fade" id="ars_akses" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row"  style="text-align: center;">
					<div class="col-sm-12" style="margin-top:10px;">
						<img src="<?php echo base_url();?>assets/images/archiv.png" class="img-popup"/>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<h4 style="font-size:18px;"><strong>Anda yakin ingin mengarsipkan data yang dipilih?</strong></h4>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<button type="button" id="btn-a-akses" class="btn btn-rounded yellow-casablanca">Arsip</button>
						<button type="button" class="btn btn-rounded default" data-dismiss="modal">Batal</button>
					</div>
				</div>
				 
			</div>
			
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL SHOW PRODUCT MULTIPLE SELECT-->
<div class="modal fade bs-modal-lg" id="show_product" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#">
							<div class="portlet">
								<div class="portlet-title">
									<div class="caption">
										<strong>Daftar Barang</strong>
									</div>
									<div class="actions btn-set">
										<!-- <button class="btn default"><i class="fa fa-reply"></i> Reset</button> -->
										<button class="btn green-seagreen" id="pilih_prod_ml"><i class="fa fa-check"></i> Pilih</button>
										<button class="btn default" id="btl_prod_ml"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="form-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-group input-xlarge">
												<input type="text" class="form-control form-filter input-sm" id="productlistmp_search">
												<span class="input-group-btn">
													<button class="btn btn-sm green-seagreen" id="btn-productlistmp_search"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-group">
												<div class="radio-list">
													<label class="radio-inline">
													<input type="radio" name="optTipeBrgMl" id="opt_all_ml" value="0" checked> All </label>
													<label class="radio-inline">
													<input type="radio" name="optTipeBrgMl" id="opt_brg_ml" value="1" checked> Barang </label>
													<label class="radio-inline">
													<input type="radio" name="optTipeBrgMl" id="opt_mnf_ml" value="2" checked> Manufaktur </label>
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" id="myTextBb">
									<input type="hidden" id="status_modal_sp">
									<div class="table-scrollable" style="border: 0px solid #dddddd;margin-top:10px;">
										<table class="table table-hover" id="datatable_productslist">
											<thead class="thead-dark">
												<tr role="row" class="heading">
													<th width="1%" style="background-color: #1BA39C!important;">
														<input type="checkbox" class="group-checkable">
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
														 Persediaan
													</th>
													<th width="8%" style="background-color: #1BA39C!important;color:white!important;">
														 Hrg. Beli
													</th>
													<th width="8%" style="background-color: #1BA39C!important;color:white!important;">
														 Hrg. Jual
													</th>
												</tr>
												<tr role="row" class="filter panel-collapse collapse" id="collapse_2">
													<td>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="product_kode">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="product_name">
													</td>
													<td>
														<select name="product_category" class="form-control form-filter input-sm">
															<option value="">All</option>
															<option value="1">Mens</option>
															<option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Footwear</option>
															<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clothing</option>
															<option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accessories</option>
															<option value="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fashion Outlet</option>
															<option value="6">Football Shirts</option>
															<option value="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Premier League</option>
															<option value="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Football League</option>
															<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Serie A</option>
															<option value="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bundesliga</option>
															<option value="11">Brands</option>
															<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adidas</option>
															<option value="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nike</option>
															<option value="14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Airwalk</option>
															<option value="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USA Pro</option>
															<option value="16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kangol</option>
														</select>
													</td>
													<td>
														<div class="margin-bottom-5">
															<input type="text" class="form-control form-filter input-sm" name="product_quantity_from" placeholder="From"/>
														</div>
														<input type="text" class="form-control form-filter input-sm" name="product_quantity_to" placeholder="To"/>
													</td>
													<td>
														<div class="margin-bottom-5">
															<input type="text" class="form-control form-filter input-sm" name="product_buy_from" placeholder="From"/>
														</div>
														<input type="text" class="form-control form-filter input-sm" name="product_buy_to" placeholder="To"/>
													</td>
													<td>
														<div class="margin-bottom-5">
															<input type="text" class="form-control form-filter input-sm" name="product_sell_from" placeholder="From"/>
														</div>
														<input type="text" class="form-control form-filter input-sm" name="product_sell_to" placeholder="To"/>
													</td>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL SHOW PRODUCT SINGLE-->
<div class="modal fade bs-modal-lg" id="show_product_single" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#">
							<div class="portlet">
								<div class="portlet-title">
									<div class="caption">
										<strong>Daftar Barang</strong>
									</div>
									<div class="actions btn-set">
										<button class="btn default" data-dismiss="modal" id="sps_btl"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="form-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-group input-xlarge">
												<input type="text" class="form-control form-filter input-sm" name="productlist_search" id="singleprod_search">
												<span class="input-group-btn">
													<button class="btn btn-sm green-seagreen" id="productlist_searchbtn"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-group">
												<div class="radio-list">
													<label class="radio-inline">
													<input type="radio" name="optTipeBrg" id="opt_all_sg" value="0" checked> All </label>
													<label class="radio-inline">
													<input type="radio" name="optTipeBrg" id="opt_brg_sg" value="1" checked> Barang </label>
													<label class="radio-inline">
													<input type="radio" name="optTipeBrg" id="opt_mnf_sg" value="2" checked> Manufaktur </label>
												</div>
											</div>
										</div>
									</div>
									<div class="table-scrollable" style="border: 0px solid #dddddd;margin-top:10px;">
										<table class="table table-hover" id="datatable_productslistsingle">
											<thead class="thead-dark">
												<tr role="row" class="heading">
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
														 Persediaan
													</th>
													<th width="8%" style="background-color: #1BA39C!important;color:white!important;">
														 Hrg. Beli
													</th>
													<th width="8%" style="background-color: #1BA39C!important;color:white!important;">
														 Hrg. Jual
													</th>
													<th width="3%" style="background-color: #1BA39C!important;color:white!important;">
														
													</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!--MODAL SHOW PRODUCT SINGLE BB-->
<div class="modal fade bs-modal-lg" id="show_product_single_bb" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal form-row-seperated" action="#">
							<div class="portlet">
								<div class="portlet-title">
									<div class="caption">
										<strong>Daftar Barang</strong>
									</div>
									<div class="actions btn-set">
										<button class="btn default" data-dismiss="modal" id="spsbb_btl"><i class="fa fa-times"></i> Batal</button>
									</div>
								</div>
								<div class="form-body">
									<div class="row">
										<div class="col-sm-8">
											<div class="input-group input-xlarge">
												<input type="text" class="form-control form-filter input-sm" name="productlistbb_search" id="singleprodbb_search">
												<span class="input-group-btn">
													<button class="btn btn-sm green-seagreen" id="productlistbb_searchbtn"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</div>
										<div class="col-sm-4"></div>
									</div>
									<div class="table-scrollable" style="border: 0px solid #dddddd;margin-top:10px;">
										<table class="table table-hover" id="datatable_productslistsinglebb">
											<thead class="thead-dark">
												<tr role="row" class="heading">
													<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
														 Tanggal
													</th>
													<th width="20%" style="background-color: #1BA39C!important;color:white!important;">
														 No&nbsp;Bahan&nbsp;Baku
													</th>
													<th width="27%" style="background-color: #1BA39C!important;color:white!important;">
														 Nama&nbsp;Hasil&nbsp;Proses
													</th>
													<th width="28%" style="background-color: #1BA39C!important;color:white!important;">
														 Keterangan
													</th>
													<th width="5%" style="background-color: #1BA39C!important;color:white!important;">
														
													</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!-- END PAGE CONTENT-->
			</div>
			<!-- <div class="modal-footer"> -->
				<!-- <button type="button" class="btn default btn-sm" data-dismiss="modal">Cancel</button> -->
				<!-- <button type="button" class="btn blue">Save</button> -->
			<!-- </div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL-->

<!----MODAL ADD QTY----->

<div class="modal fade bs-modal-sm" id="modal_add_qty" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content rounded">
			<div class="modal-header">
				<button type="button" class="close" id="btn-b-qty"></button>
			</div>
			<div class="modal-body">
				<div class="row">
				    <div class="col-md-7" style="margin-bottom: 5px;">
				    	<label>Qty Barang</label>
				    </div>
				    <div class="col-md-5" style="margin-bottom: 5px;padding-left: 0px;">
				    	<label>Satuan</label>
				    </div>
				    <div class="col-md-7 text-center">
				    	<div class="input-group" id="input-group-qty">
							<span class="input-group-btn">
								<button class="btn btn-icon-only btn-circle btn-sm qty grey-gallery" id="btn-minus" style="margin-right: 5px;" data-field="quantity">
									<i class="fa fa-minus" data-field="quantity"></i>
								</button>
							</span>
							<input type="number" id="quantity" name="quantity" class="form-control border-0 text-center input-sm input-circle qty" step="1" min="0">
							<input type="hidden" class="form-control" id="id_prod_qty" >
							<span class="input-group-btn">
								<button class="btn btn-icon-only btn-circle btn-sm qty grey-gallery" id="btn-plus" style="margin-left: 5px;" data-field="quantity">
									<i class="fa fa-plus" data-field="quantity"></i>
								</button>
							</span>
						</div>
				    </div>
				    <div class="col-md-5" style="padding-left: 0px;">
				    	<div class="input-group">
				    		<select class="form-control input-sm input-rounded" id="uom_qty">
							</select>
				    	</div>
				    </div>
				    <div class="col-md-1"></div>
				</div>
			</div>
			<div class="modal-footer" style="padding: 10px;">
				<button type="button" class="btn green-seagreen btn-sm" id="btn-s-qty">Simpan</button>
				<button type="button" class="btn default btn-sm" id="btn-btl-qty">Batal</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!------END MODAL ADD QTY------>

<!--MODAL LOGOUT-->
<div class="modal fade bs-modal-sm" id="modal_logout" tabindex="-1" role="dialog" aria-labelledby="LogoutModal" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content modal-popup">
			<!-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			</div> -->
			<div class="modal-body">
				<div class="row"  style="text-align: center;">
					<div class="col-sm-12" style="margin-top:10px;">
						<img src="<?php echo base_url();?>assets/images/warning.png" class="img-popup"/>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<h4 style="font-size:20px;"><strong>Anda yakin ingin keluar?</strong></h4>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<a href="<?php echo base_url('logout');?>" type="button" class="btn btn-rounded green-seagreen">Ya</a>
						<button type="button" class="btn btn-rounded default" data-dismiss="modal">Tidak</button>
					</div>
				</div>
				 
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn green-seagreen">Ya</button>
				<button type="button" class="btn default" data-dismiss="modal">Tidak</button>
			</div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL LOGOUT-->

<!--MODAL UNAUTHORIZED-->
<div class="modal fade bs-modal-sm" id="modal_unauthorized" tabindex="-1" role="dialog" aria-labelledby="UnautorizedModal" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content modal-popup">
			<!-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			</div> -->
			<div class="modal-body">
				<div class="row"  style="text-align: center;">
					<div class="col-sm-12" style="margin-top:10px;">
						<img src="<?php echo base_url();?>assets/images/war_y.png" class="img-popup"/>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<h4 style="font-size:18px;"><strong>Anda tidak memiliki akses!</strong></h4>
					</div>
					<div class="col-sm-12" style="margin-top:10px;">
						<button type="button" class="btn btn-rounded default" data-dismiss="modal">OK</button>
					</div>
				</div>
				 
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn green-seagreen">Ya</button>
				<button type="button" class="btn default" data-dismiss="modal">Tidak</button>
			</div> -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL UNAUTHORIZED-->

<!--MODAL QTY SATUAN-->
<div class="modal fade" id="modal_qty" tabindex="-1" role="dialog" aria-labelledby="QtyModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-popup">
			<div class="modal-header">
				<button type="button" class="close" id="btn-close-qty"></button>
				<h4 class="modal-title"><b>Qty Kemasan</b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-row-seperated" action="" id="frm-qty">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-md-6 control-label left">Qty Pemakaian /</label>
									<div class="col-md-6">
										<select class="form-control input-sm liter" id="qty_paksat">
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="number" step="any" class="form-control input-sm underline-form right" id="qty_paksat_input">
									<input type="hidden" id="id_detail_bb" >
									<input type="hidden" id="prod_kemasan" >
									<input type="hidden" id="jenis_tbl" >
								</div>
							</div>
						</div>
						<div class="col-sm-12">	
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-md-6 control-label left">Qty Kemasan /</label>
									<div class="col-md-6">
										<select class="form-control input-sm" id="qty_kemsat">
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<select class="form-control input-sm" id="sat_hit" style="display: none;">
									</select>
									<input type="number" step="any" class="form-control input-sm underline-form right" id="qty_kemsat_input" >	
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-md-12 control-label">Qty Pemakaian</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="number" step="any" class="form-control input-sm underline-form green-bg right" id="qty_pakai" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-12">	
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-md-12 control-label">Qty Dibutuhkan</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="number" step="any" class="form-control input-sm underline-form right" id="qty_butuh" >
								</div>
							</div>
						</div>
						<div class="col-sm-12 m-0 p-0">	
							<div class="col-sm-11 mb-2">
								<hr/>
							</div>
							<div class="col-sm-1" style="margin-top: 10px;">
								X
							</div>
						</div>
						<div class="col-sm-12">	
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-md-12 control-label left">Hasil Qty Pemakaian</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="number" step="any" class="form-control input-sm underline-form red-bg right" id="qty_hasil_pakai" readonly>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" >
				<button type="button" class="btn green-seagreen" id="btn-pilih-qty">Pilih</button>
				<button type="button" class="btn default" id="btn-keluar-qty">Keluar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--END MODAL qty satuan-->

