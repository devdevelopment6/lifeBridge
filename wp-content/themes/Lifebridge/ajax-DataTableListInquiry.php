<?php
header("Access-Control-Allow-Origin: *");

require_once('../../../wp-config.php');
global $wpdb;
 global $current_user;



global $wpdb;    
//echo "SELECT * FROM " . $wpdb->prefix . "appointment where patientId='".$getPIdValue."' ";     

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
  $searchQuery = " and (inqueryDate like '%".$searchValue."%' or 
        inquerytime like '%".$searchValue."%' or 
        method like'%".$searchValue."%' ) ";
}

## Total number of records without filtering


/*$sel = mysqli_query($con,"select count(*) as allcount from employee");
$records = mysqli_fetch_assoc($sel);*/

 $sel = $wpdb->get_row("select count(*) as allcount FROM lb_inquirey ");
//$totalRecords = $wpdb->num_rows;
$totalRecords = $sel->allcount;


## Total number of records with filtering
/*$sel = mysqli_query($con,"select count(*) as allcount from employee WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];*/

 $sel = $wpdb->get_row("select count(*) as allcount FROM lb_inquirey  WHERE 1 ".$searchQuery);
 $totalRecordwithFilter =  $sel->allcount;


## Fetch records
/*$empQuery = "select * from employee WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);*/

/*echo "SELECT * FROM " . $wpdb->prefix . " inquirey  order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ";*/
$empQuery =$wpdb->get_results("SELECT * FROM lb_inquirey  order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");

$data = array();
$i=1;
foreach ($empQuery as $key => $getVal) {

if($getVal->inqueryMethod=='1'){
                $method='Phone Call';
              }else if($getVal->inqueryMethod=='2'){
                 $method='Text'; 
              }else if($getVal->inqueryMethod=='3'){
                 $method='Email'; 
              }
    $getInquirydate=date('m-d-Y',strtotime($getVal->inqueryDate)); 
    $inquieryTime=date("h.i A", $getVal->inquerytime); 
   /* $getdate=explode('-',$getVal->inqueryDate); 
    $getInquirydate= $getdate[1].'-'. $getdate[2].'-'.$getdate[0];*/
    //print_r($getdate); die;       
    $data[] = array(
        "id"=>$getVal->id,
        "inqueryDate"=>$getInquirydate,
        "inquerytime"=>$getVal->inquerytime,
        "method"=>ucfirst($getVal->inqueryMethod)
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


