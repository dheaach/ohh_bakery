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
	<div class="row" style="margin-bottom: 0px!important;">
		<div class="col-12" style="margin-bottom: 0px!important;">
			<p style="margin-bottom: 0px;font-size: 24px;"><b>Rote Price</b></p>
			<hr>	
		</div>
	</div>
	<?php
		$nobuk = '';
		$tgl = '';
		$kode = '';
		$nama = '';
		if (is_array($get_data)) {
			foreach ($get_data as $master) {
				$nobuk = $master->hap_no;
				$tgl = explode(" ",$master->tgl);
				$ket = $master->keterangan;
			}
		}
	?>
	<table style="width:80%;">
		<tr>
			<td>No. Proses</td>
			<td>: <?php echo $nobuk;?></td>
			<td>Tanggal</td>
			<td>: <?php echo $tgl[0];?></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td colspan="3">: <?php echo $ket;?></td>
		</tr>
	</table>
	<div style="margin-bottom: 5px;"></div>
	<table style="width:80%; border-spacing: 0px;">
		<tr>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:5%;">No</th>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:55%;">Nama Barang</th>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:15%;">Unit</th>
			<th style="border-bottom: 1px solid black;border-top: 1px solid black;padding:3px;width:25%;text-align:right;">Harga</th>
		</tr>
		<?php
			$no = 0;
			$satuan = '';
			if (is_array($get_unit)) {
				foreach ($get_unit as $det) {
					$no++;
					if($det->satuan == 1){
						$satuan = $det->prod_uom;
					}else if ($det->satuan == 2) {
						$satuan = $det->prod_uom2;
					}else if ($det->satuan == 3) {
						$satuan = $det->prod_uom3;
					}else{
						$satuan = $det->prod_uom;
					}
		?>
		<tr>
			<td style="padding:3px;text-align: center;"><?php echo $no; ?></td>
			<td style="padding:3px;"><?php echo $det->prod_name0;?></td>
			<td style="padding:3px;"><?php echo $det->satuan;?></td>
			<td style="padding:3px;text-align: right;"><?php echo $det->harga_satuan;?></td>
		</tr>
		<?php
				}
			}
		?>
	</table>
</div>
