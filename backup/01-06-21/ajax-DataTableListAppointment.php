<?php
header("Access-Control-Allow-Origin: *");

require_once('../../../wp-config.php');
global $wpdb;
 global $current_user;



global $wpdb;    

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($wpdb,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
  $searchQuery = " and (patientId like '%".$searchValue."%' or 
        dateOfSession like '%".$searchValue."%' or 
        gender like'%".$searchValue."%' or 
        age like'%".$searchValue."%' or 
        specialty like'%".$searchValue."%'  or 
        employmentstatus like'%".$searchValue."%'   or 
        appointmentType like'%".$searchValue."%'  or 
        counselor like'%".$searchValue."%' or 
        billable like'%".$searchValue."%' ) ";
}

## Total number of records without filtering



 $sel = $wpdb->get_row("select count(*) as allcount FROM lb_appointment ");

$totalRecords = $sel->allcount;



 $sel = $wpdb->get_row("select count(*) as allcount FROM lb_appointment  WHERE 1 ".$searchQuery);
 $totalRecordwithFilter =  $sel->allcount;


//echo "SELECT * FROM appointment  order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ";
$empQuery =$wpdb->get_results("SELECT * FROM lb_appointment  order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");

$data = array();
$i=1;
foreach ($empQuery as $key => $getVal) {

    if($getVal->billable=='1'){
        $billablePay="MCMS Pay";
        }else{
        $billablePay="Self Pay";
    }

    if($getVal->gender=='m'){
        $gen="Male";
        }else{
        $gen="Female";
    }

    $data[] = array(
        "id"=>$getVal->id,
        "patientId"=>$getVal->patientId,
        "dateOfSession"=>date('d-M-y',strtotime($getVal->dateOfSession)),
        "gender"=>$gen,
        "age"=>$getVal->age,
        "specialty"=>$getVal->specialty,
        "employmentstatus"=>$getVal->employmentstatus,
        "appointmentType"=>$getVal->appointmentType,
        "counselor"=>$getVal->counselor,
        "billable"=>$billablePay
      );
    $i++;
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);


?>


