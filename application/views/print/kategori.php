<style>
	table, td, th {
	  border: 1px solid;
	}

	table {
	  width: 100%;
	  border-collapse: collapse;
	}
</style>
<table class="table table-hover" id="datatable_category_print">
	<thead class="thead-dark">
		<tr role="row" class="heading">
			<th width="6%">
				 Kode&nbsp;Kategori
			</th>
			<th width="20%">
				 Nama&nbsp;Kategori
			</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if( is_array($cat) || is_object($cat)) {
	    foreach($cat as $ud) {
	?>
		<tr>
			<td><?php echo $ud->kode;?></td>
			<td><?php echo $ud->nama;?></td>
		</tr>
	<?php
	    }
	  }
	?>	
	</tbody>
</table>