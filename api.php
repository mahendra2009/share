<?php
ob_start();
header('Access-Control-Allow-Origin: *');  
include('library/conn.php');
require_once('library/class.db.php'); 

$responses=array();
$cat = (!isset($_GET['c']))?'':$_GET['c'];
$route = (!isset($_GET['q']))?'':$_GET['q'];
$route=trim($route,'/');
$check_error='';

function check_path($route){$ss='';$route=trim($route,'/');if($route){$ss=substr_count($route, '/');}return $ss;}
$parts = explode('/', $route);
foreach ($parts as $key => $value) {
  $arr = explode(':', $value);
  if(isset($arr[1])){
 ${$arr[0]} =  $arr[1];

  }else{
    $check_error='error';
  }
 
}

 
function echoResponse($response) { 
if($response){
$responses["status"] = "success";
$responses["message"] = 'Display';
$responses["data"] = $response;
 }else{
$responses["status"] = "success";
$responses["message"] = 'Sorry no results found ';
$responses["data"] = '';
 }
  
   header('Content-Type: application/json');
     echo json_encode($responses,JSON_NUMERIC_CHECK);
}


if($check_error){
$responses["status"] = "error";
$responses["message"] = 'failed: ';
$responses["data"] = '';
header('Content-Type: application/json');
echo json_encode($responses,JSON_NUMERIC_CHECK); 
 }else{
$database = new DB(); 

// ---------------------------- Start  ---------------------------

//http://server/works/s/api/report/date_from:2018-02-02/date_to:2018-02-10

//
 if ($cat === 'report' && check_path('date_from/date_to') == check_path($route)) {
    // Fetch only favourite + active stocks
    $name_all = [];
    $query_cat = "SELECT name FROM cat WHERE fav = 1 AND status = 1";
    $cat_data = $database->get_results($query_cat);
    
    foreach ($cat_data as $item) {
        $name_all[] = "'" . trim($item['name']) . "'";
    }

    if (empty($name_all)) {
        echoResponse([]);
        exit;
    }

    $name_list = implode(",", $name_all);

    // Fetch records from daily table for given date range
    $query_daily = "
        SELECT names, dates, c_rate, p_rate, percent
        FROM daily
        WHERE (dates BETWEEN '$date_from' AND '$date_to')
        AND names IN ($name_list)
        ORDER BY percent DESC, dates ASC
    ";

    $response_data = $database->get_results($query_daily);
    echoResponse($response_data);
    exit;
}

 
/* if ($cat === 'prediction') {
    // Get query string values
    $date_from = isset($query['date_from']) ? $query['date_from'] : date('Y-m-d', strtotime('-15 days'));
    $date_to   = isset($query['date_to']) ? $query['date_to'] : date('Y-m-d');

    // Only show positive percent stocks (i.e., gainers)
    $query = "
        SELECT names, dates, c_rate, p_rate, percent
        FROM daily
        WHERE dates BETWEEN '$date_from' AND '$date_to'
        AND percent > 0
        ORDER BY dates DESC, percent DESC
    ";

    $result = $database->get_results($query);
    echoResponse($result);
    exit;
} */

if ($cat === 'prediction') {
    // Get query string values
    $date_from = isset($query['date_from']) ? $query['date_from'] : date('Y-m-d', strtotime('-15 days'));
    $date_to   = isset($query['date_to']) ? $query['date_to'] : date('Y-m-d');
    $type      = isset($query['type']) ? $query['type'] : ''; // 'gain' or 'lose'
    $limit     = isset($query['limit']) ? intval($query['limit']) : 20;
    $offset    = isset($query['offset']) ? intval($query['offset']) : 0;

    // Base query
    $query_sql = "
        SELECT names, dates, c_rate, p_rate, percent
        FROM daily
        WHERE dates BETWEEN '$date_from' AND '$date_to'
    ";


    // Type filter
    if (!$type ) {

        // Only show positive percent stocks (i.e., gainers)
    $query = "
        SELECT names, dates, c_rate, p_rate, percent
        FROM daily
        WHERE dates BETWEEN '$date_from' AND '$date_to'
        AND percent > 0
        ORDER BY dates DESC, percent DESC
    ";

    $result = $database->get_results($query);
    echoResponse($result);
    exit;


    }
    if ($type === 'gain') {
        $query_sql .= " AND percent > 0";
    } elseif ($type === 'lose') {
        $query_sql .= " AND percent < 0";
    }

    // Sorting and pagination
    $query_sql .= " ORDER BY dates DESC, percent DESC LIMIT $limit OFFSET $offset";

    $result = $database->get_results($query_sql);
    echoResponse($result);
    exit;
}

 



 
 }?>