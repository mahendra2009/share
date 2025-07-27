<?php
ob_start();
header('Access-Control-Allow-Origin: *');  
include('../library/conn.php');
require_once('../library/class.db.php'); 

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
if($cat=='report' && check_path('date_from/date_to')==check_path($route) ){
$name_all=array();
$queryre = "SELECT name FROM cat where fav=1 and status=1"; 
$arr = $database->get_results( $queryre );

foreach ($arr as $key => $value) {$name_all[$key]=$value['name'];}
 


//$name_all=array('20MICRONS');
//print_r($name_all);
    $name_all = "'".implode("','", $name_all)."'";

  $queryre = "SELECT names,dates,c_rate,p_rate,percent   FROM `daily` WHERE (dates BETWEEN '".$date_from."' AND '".$date_to."') AND names IN ($name_all)  order by dates ASC"; 

 $responses = $database->get_results( $queryre );
/*echo '<pre>';
print_r($responses);*/

echoResponse($responses);
exit;
}
 


if($cat=='createreport' && check_path('date_from')==check_path($route) ){
  
   $queryre = "SELECT names	 FROM `daily` WHERE  dates='".$date_from."'  "; 

 
if( $database->num_rows( $queryre ) > 0 )
{
 $responses= 'Already in DB';  
}else{


$date_from=str_replace('-','/' , $date_from);
/////////////////////////////////

$cat_all = array();

$query = "SELECT name FROM cat";
$cat = $database->get_results( $query );
foreach($cat as $key => $valuec) {

$cat_all[$key]=trim($valuec['name']);
}
function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
  
          $keys = array();
          $out = array();
          $names = array();
 
  $latest_date= date('dmY', strtotime('0 day', strtotime($date_from)));
        $url='https://nsearchives.nseindia.com/archives/nsccl/volt/CMVOLT_'.$latest_date.'.CSV' ; 
       // $url='https://nsearchives.nseindia.com/archives/nsccl/var/C_VAR1_'.$latest_date.'_1.DAT' ; 
        
 
 function http_get_contents($url) {
    fopen("cookies.txt", "w");
    $parts = parse_url($url);
    $host = $parts['host'];
    $ch = curl_init();
    $header = array('GET /1575051 HTTP/1.1',
        "Host: {$host}",
        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language:en-US,en;q=0.8',
        'Cache-Control:max-age=0',
        'Connection:keep-alive',
        'Host:adfoc.us',
        'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36',
    );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);

    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//$url = "http://adfoc.us/1575051";
/*$url = "https://nsearchives.nseindia.com/archives/nsccl/volt/CMVOLT_12092023.CSV";
$html = getUrlContent($url);

print_r($html);*/


function http_get_contents2($url, $opts = [])
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
  curl_setopt($ch, CURLOPT_USERAGENT, "{$_SERVER['SERVER_NAME']}");
  curl_setopt($ch, CURLOPT_URL, $url);
  if(is_array($opts) && $opts) {
    foreach($opts as $key => $val) {
      curl_setopt($ch, $key, $val);
    }
  }
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  if(FALSE === ($retval = curl_exec($ch))) {
    error_log(curl_error($ch));
  } else {
    return $retval;
  }
}

 $data = http_get_contents($url);
 
//$data = file_get_contents($url);

$rows = explode("\n",$data);

 
 if(count($rows)!=2){
 
foreach($rows as $key => $row) {
if($key!=0){
$get_row= str_getcsv($row);
$get_row=array_slice($get_row, 0, count($get_row)-4,true);

 if($get_row){
    $out[]=$get_row;
    $name_new=trim($get_row[1]);

     if(!in_array($name_new, $cat_all)){     
        array_push($names,$name_new);      
     }

}}
  }
 if (!empty($out)) {
              
  $diff_names= array_unique( $names );
               // $cat
 
 
 //$diff_names= array_unique( $diff_names );
 
if(!empty($diff_names)){
 
foreach($diff_names as $key => $values) {
  if($values!=''){
$namess = array(
'name' => trim($values)
);

$add_query = $database->insert( 'cat ', $namess );
}
}}

 
 foreach($out as $key => $value) {
               
    
    $per=($value[2]-$value[3])*100/$value[3];
              // echo $value[4];
 
  $newDate = date("Y-m-d", strtotime($value[0]));

$names = array(
'dates' => trim($newDate),
'names' => trim($value[1]),
'c_rate' => trim($value[2]),
'p_rate' => trim($value[3]),
'percent' => trim($per)
);


 
$add_query = $database->insert( 'daily ', $names );




                
              }
              
              //$message = '<span class="green">File has been uploaded successfully</span>';
              $responses = 'Created successfully';
            }
} else{ $responses= 'not'; }  
///////////////////////////////////////////
  

}

 

echoResponse($responses);
exit;
}



 
 }?>