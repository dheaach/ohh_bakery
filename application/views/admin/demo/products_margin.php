<?php
  /* 
   * Paging
   */

  //var_dump($_POST["selected"]);


  if( is_array($tot) ) {
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

  if( is_array($grp) ) {
    $page = array_slice($grp, $iDisplayStart, $iDisplayLength);
    foreach($page as $ud) {
      $records["data"][] = array(
      '<input class="chk-barang-margin" type="checkbox" name="id[]" value="'.$ud->prod_no.'" onclick="checkMargin()">',
      $ud->prod_code0,
      $ud->prod_name0,
      $ud->nama_kat,
      $ud->stok,
      'Rp. '.number_format($ud->harga_lama,2,'.',','),
      'Rp. '.number_format($ud->harga_baru,2,'.',','),
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