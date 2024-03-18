<style>
	table, td, th {
	  border: 1px solid;
	}

	table {
	  width: 100%;
	  border-collapse: collapse;
	}
</style>
<table class="table table-hover" id="datatable_products_pdf">
	<thead class="thead-dark">
		<tr role="row" class="heading">
			<th width="8%">
				 Kode&nbsp;Barang
			</th>
			<th width="22%">
				 Nama&nbsp;Barang
			</th>
			<th width="14%">
				 Kategori
			</th>
			<th width="7%">
				 Qty
			</th>
			<th width="7%">
				 Harga Beli
			</th>
			<th width="7%">
				 Harga Jual
			</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if( is_array($grp) || is_object($grp)) {
	    foreach($grp as $ud) {
	?>
		<tr>
			<td><?php echo $ud->prod_code0;?></td>
			<td><?php echo $ud->prod_name0;?></td>
			<td><?php echo $ud->nama_kat;?></td>
			<td><?php echo $ud->stok;?></td>
			<td><?php echo 'Rp. '.$ud->prod_buy_price2;?></td>
			<td><?php echo 'Rp. '.number_format((float)$ud->prod_sell_price,2,'.',',');?></td>
		</tr>
	<?php
	    }
	  }
	?>	
	</tbody>
</table>