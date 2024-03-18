<?php
  /* 
   * Paging
   */

  //var_dump($_POST["selected"]);

  if(is_array($tot) ) {
    foreach($tot as $totUs) {
      $totRec = $totUs->total;
    }
  }

  $iTotalRecords = $totRec;
  $iDisplayLength = intval($_REQUEST['length']);
  $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  $iDisplayStart = intval($_REQUEST['start']);
  $sEcho = intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 

  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

  if(is_array($grp) ) {
    $page = array_slice($grp, $iDisplayStart, $iDisplayLength);
    foreach($page as $ud) {
      $onclick = "cae_product('".$ud->prod_no."')";
      $clickqty = "qty_product('".$ud->prod_no."')";
      $records["data"][] = array(
      '<input class="chk-barang" type="checkbox" name="id[]" value="'.$ud->prod_no.'" onclick="checkProduct()">',
      $ud->prod_code0,
      '<a class="font-blue" data-toggle="modal" style="text-decoration:none;" onclick="'.$onclick.'" id="21C" >'.$ud->prod_name0.'</a>',
      $ud->nama_kat,
      $ud->stok,
      'Rp. '.$ud->prod_buy_price2,
      'Rp. '.number_format($ud->prod_sell_price,2,'.',','),
      (((int)$ud->is_stok == 1)? 'Manufaktur' : 'Barang'),
      '<button class="btn yellow-gold btn-sm btn-rounded" onclick="'.$clickqty.'"><i class="fa fa-plus"></i></button>'
      );
    }
  }

  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  $records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
?>