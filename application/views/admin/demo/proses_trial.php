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

  $status_list = array(
    array("success" => "Publushed"),
    array("info" => "Not Published"),
    array("danger" => "Deleted")
  );

  if (is_array($pr) || is_object($pr)){
    $page = array_slice($pr, $iDisplayStart, $iDisplayLength);
    foreach($page as $ud) {
      $onclick = "cae_prosestrial('".$ud->pr_no."')";
      $records["data"][] = array(
      '<input class="chk-trial" type="checkbox" name="id[]" value="'.$ud->pr_no.'" onclick="checkProsesTrial()">',
      date('d-m-Y',strtotime($ud->pr_date)),
      '<a class="font-blue" data-toggle="modal" style="text-decoration:none;" onclick="'.$onclick.'" id="41C" >'.$ud->pr_no.'</a>',
      $ud->pr_ket,
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