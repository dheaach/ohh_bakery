<?php
  /* 
   * Paging
   */

  //var_dump($_POST["selected"]);


  if(is_array($tot) || is_object($tot) ) {
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

  if(is_array($grp) || is_object($grp) ) {
    $page = array_slice($grp, $iDisplayStart, $iDisplayLength);
    foreach($page as $ud) {
      $onclick = "getProdNo('".$ud->prod_no."')";
      $records["data"][] = array(
      $ud->prod_code0,
      $ud->prod_name0,
      $ud->nama_kat,
      $ud->stok,
      'Rp. '.$ud->prod_buy_price2,
      'Rp. '.number_format($ud->prod_sell_price,2,'.',','),
      '<button class="btn btn-sm green-seagreen" id="btn_pilih_prod[]" onclick="return '.$onclick.'">Pilih</button>',
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