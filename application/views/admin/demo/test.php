<?php 
	if( is_array($tot) ) {
	    foreach($tot as $totUs) {
	      $totRec = $totUs->total;
	    }
	  }


  if (is_array($bb) ){
    foreach($bb as $ud) {
      $onclick = "cae_bahanbaku('".$ud->bb_no."')";
      $records["data"][] = array(
      '<input class="chk-ing" type="checkbox" name="id[]" value="'.$ud->bb_no.'" onclick="checkIng()">',
      date('d-m-Y',strtotime($ud->tgl)),
      '<a class="font-blue" data-toggle="modal" style="text-decoration:none;" onclick="'.$onclick.'" id="21C" >'.$ud->bb_no.'</a>',
      $ud->prod_name0,
      $ud->keterangan,
      );
    }
  }

  print_r($records); 

  ?>