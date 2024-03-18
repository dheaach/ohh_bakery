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
				 Kode&nbsp;Sub-Kategori
			</th>
			<th width="20%">
				 Nama&nbsp;Sub-Kategori
			</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if( is_array($grp) || is_object($grp)) {
	    foreach($grp as $ud) {
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