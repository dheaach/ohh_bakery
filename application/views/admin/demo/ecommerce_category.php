<?php
  /* 
   * Paging
   */

  //var_dump($_POST["selected"]);

  if( is_array($tot) || is_object($tot)) {
    foreach($tot as $totUs) {
      $totRec = $totUs->total;
    }
  }

  $iTotalRecords = $totRec;
  $iDisplayLength = intval($_REQUEST['length']);
  // $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  $iDisplayStart = intval($_REQUEST['start']);
  $sEcho = intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 

  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;


  if( is_array($cat) || is_object($cat)) {
    $page = array_slice($cat, $iDisplayStart, $iDisplayLength);
    foreach($page as $ud) {
      $records["data"][] = array(
        '<input class="chk-cat" type="checkbox" name="id[]" value="'.$ud->cat_id.'" onclick="checkCategory();">',
        $ud->kode,
        '<a class="font-blue" data-toggle="modal" style="text-decoration:none;" onclick="cae_kategori('.$ud->cat_id.');" id="22C">'.$ud->nama.'</a>',
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