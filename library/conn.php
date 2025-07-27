<?php

define( 'DB_HOST', 'localhost' ); // set database host

define( 'DB_USER', 'root' ); // set database user

define( 'DB_PASS', '' ); // set database password

define( 'DB_NAME', 'share' ); // set database name
define( 'DB_PORT', 3307 ); // set database name

define( 'SEND_ERRORS_TO', 'infosss@gmail.com' ); //set email notification email address

define( 'DISPLAY_DEBUG', true ); //display db errors?
 function curl($url) {
// Assigning cURL options to an array
$options = Array(
CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
CURLOPT_TIMEOUT => 240,  // Setting the maximum amount of time for cURL to execute queries
CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
);

$ch = curl_init();  // Initialising cURL
curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
$data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable

curl_close($ch);    // Closing cURL
return $data;   // Returning the data from the function
}	

 
 function extractFromAdress($components, $type){
  $total=count($components);
    for ($i=0; $i<$total; $i++){
	
	$total2=count($components[$i]->types);
        for ($j=0; $j<$total2; $j++){
            if ($components[$i]->types[$j]==$type){
			 return $components[$i]->long_name;
			 }
			}
			}
    return "";
}
 

 
function convert2link($string)
{
	$string = strtolower($string);

	$special_chars[] = '!';
	$special_chars[] = '"';
	$special_chars[] = '#';
	$special_chars[] = '$';
	$special_chars[] = '%';
	$special_chars[] = ' & ';
	$special_chars[] = "'";
	$special_chars[] = '(';
	$special_chars[] = ')';
	$special_chars[] = '*';
	$special_chars[] = '+';
	$special_chars[] = ',';
	$special_chars[] = '-';
	$special_chars[] = '.';
	$special_chars[] = '/';
	$special_chars[] = ':';
	$special_chars[] = ';';
	$special_chars[] = '<';
	$special_chars[] = '=';
	$special_chars[] = '>';
	$special_chars[] = '?';
	$special_chars[] = '@';
	$special_chars[] = '[';
	$special_chars[] = "\\";
	$special_chars[] = "]";
	$special_chars[] = "^";
	$special_chars[] = "_";
	$special_chars[] = "`";
	$special_chars[] = "{";
	$special_chars[] = "|";
	$special_chars[] = "}";
	$special_chars[] = "~";
	$special_chars[] = " ";
	
	
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = "";
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '_';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = '';
	$special_chars2[] = "";
	$special_chars2[] = "";
	$special_chars2[] = "";
	$special_chars2[] = "_";
	$special_chars2[] = "";
	$special_chars2[] = "";
	$special_chars2[] = "";
	$special_chars2[] = "";
	$special_chars2[] = "";
	$special_chars2[] = "-";

	$string = str_replace($special_chars,$special_chars2,$string);

	return $string;
}

 
function search_value($column, $address_detail)
{
	foreach ($address_detail as $key => $val)
	{
	 
		if($key==$column)
		{
		return $val;
		break;
		}
	
	}
}

function getletlong($address){
 $apiurl='https://maps.googleapis.com/maps/api/geocode/xml?address='.str_replace(" ", "%20",strtolower($address)).'&key=AIzaSyB0ciaZmiHHi4yqgh0i-xc-yQwZ4NM7tPg';
	$first_data=curl($apiurl);
	$xml = simplexml_load_string($first_data);
	
	if(count($xml)>1){
	$result=$xml->status;
	}else{$result="";}
	if($result=='OK'){
		
	$latvalue=$xml->result->geometry->location->lat;	
		
		
$formattedads=$xml->result->formatted_address;


	$longvalue=$xml->result->geometry->location->lng;
	$latlongvalue=$latvalue.','.$longvalue;
	return $latlongvalue;
		
	}else{

		return '';
		}
		
	}

?>