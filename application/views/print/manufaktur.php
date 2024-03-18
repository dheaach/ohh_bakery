<style type="text/css">
	.container {
	  width: 100%;
	  font-family: Arial, sans-serif;
	}

	.row {
	  width: 100%;
	  display: flex;
	  flex-wrap: wrap;
	  margin-top: 5px;
	}

	/* 1/12 */
	.col-1 {
	  width: 8.33%;
	}

	/* 2/12 */
	.col-2 {
	  width: 16.66%;
	}

	/* 3/12 */
	.col-3 {
	  width: 25%;
	}

	/* 4/12 */
	.col-4 {
	  width: 33.33%
	}

	/* 5/12 */
	.col-5 {
	  width: 41.66%;
	}

	/* 6/12 */
	.col-6 {
	  width: 50%;
	}

	/* 7/12 */
	.col-7 {
	  width: 58.33%;
	}

	/* 8/12 */
	.col-8 {
	  width: 66.66%;
	}

	/* 9/12 */
	.col-9 {
	  width: 75%;
	}

	/* 10/12 */
	.col-10 {
	  width: 83.33%;
	}

	/* 11/12 */
	.col-11 {
	  width: 91.66%;
	}

	/* 12/12 */
	.col-12 {
	  width: 100%;
	}

	/* viewport <= 1000px */
	@media screen and (max-width: 1000px) {
	  * {
	    font-size: 1em;
	  }
	}

	/* viewport <= 630px */
	@media screen and (max-width: 630px) {
	  .row div {
	    padding: 1.5%;  
	  }    
	} 

	/* viewport <= 500px */
	@media screen and (max-width: 500px) {
	  * {
	    font-size: 0.9em;
	  }
	}

</style>
<div class="container">
	<?php
		$nobuk = '';
		$tgl = '';
		$kode = '';
		$nama = '';
		if (is_array($get_data)) {
			foreach ($get_data as $master) {
				$nobuk = $master->pr_no;
				$tgl = explode(" ",$master->pr_date);
				$kode = $master->prod_code0;
				$nama = $master->prod_name0;
				$ket = $master->keterangan;
			}
		}
	?>
	<!-- <div class="row">
		<div class="col-3">No. Bukti</div>
		<div class="col-3">: <?php echo $nobuk;?></div>
		<div class="col-3">Tanggal</div>
		<div class="col-3">: <?php echo $tgl;?></div>
	</div> -->
	<table style="width:100%;">
		<tr>
			<td rowspan="5" style="width:300px;"></td>
			<td><b>No. Produksi</b></td>
			<td><b>: <?php echo $nobuk;?></b></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: <?php echo $tgl[0];?></td>
		</tr>
		<tr>
			<td>Kode</td>
			<td>: <?php echo $kode;?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>: <?php echo $nama;?></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>: <?php echo $ket;?></td>
		</tr>
		<tr>
			<td colspan="3"><b>PRODUKSI</b></td>
		</tr>
	</table>
	<table style="width:100%; border-spacing: 0px;">
		<tr>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:10%;">No</th>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:20%;">Kode</th>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:50%;">Nama Barang</th>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;text-align: right;width:10%;">Qty</th>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:10%;">Satuan</th>
		</tr>
		<?php
			$no = 0;
			if (is_array($get_unit)) {
				foreach ($get_unit as $det) {
					$no++;
		?>
		<tr>
			<td style="padding:3px;text-align: center;"><?php echo $no; ?></td>
			<td style="padding:3px;"><?php echo $det->prod_code0;?></td>
			<td style="padding:3px;"><?php echo $det->prod_name0;?></td>
			<td style="padding:3px;text-align: right;"><?php echo $det->qty_sat;?></td>
			<td style="padding:3px;text-align: left;"><?php echo $det->uom;?></td>
		</tr>
		<?php
				}
			}
		?>
		<tr>
			<td colspan="5"></td>
		</tr>
		<tr>
			<td colspan="2" style="border-top: 1px solid black;padding:3px;text-align: left;"><b>Total Item : <?php echo $no;?></b></td>
			<td colspan="3" style="border-top: 1px solid black;padding:3px;"></td>
		</tr>
		<tr>
			<td colspan="2" style="padding:3px;text-align: left;"><?php echo date('Y-m-d H:i:s');?></td>
			<td colspan="3" style="padding:3px;text-align: left;">Dibuat : <?php echo $det->pr_ket;?></td>
		</tr>
	</table>
</div>
