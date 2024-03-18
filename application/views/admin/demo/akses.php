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
  
  if( is_array($set) ) {
    $page = array_slice($set, $iDisplayStart, $iDisplayLength);
    foreach($page as $ud) {
      $records["data"][] = array(
          '<input class="chk-akses" type="checkbox" name="id[]" value="'.$ud->group_user_id.'" onclick="checkAkses()">',
          '<a class="font-blue user-target" data-toggle="modal" style="text-decoration:none;" id="53C" onclick="cae_akses('.$ud->group_user_id.');">'.$ud->user_name.'</a>',
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