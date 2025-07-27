<?php
ob_start();
session_start();
require_once( 'library/conn.php' );
require_once( 'library/class.db.php' );
include('include/constants.php');
$database = new DB();
 

$today_date=date("Y/m/d");
 
$start_week =date('dd-mm-YYYY', strtotime('-15 day', strtotime($today_date)));
$end_week =date('dd-mm-YYYY', strtotime('0 day', strtotime($today_date)));

$country_money='$';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Admin </title>
	<?php include('include/css.php');?>
	<link href="assets/css/calentim.min.css" rel="stylesheet"/>
	<style type="text/css" media="screen">
  ul.row, ul.row > li, ul.rows, ul.rows > li{ display: block }
	.search_box1{ background:#fff; padding:15px 10px ;  }	
  .search_box{margin: 20px 0 0; padding:  0 20px;  }

	.search_box .form-control{ height: 35px;border: 1px #ddd solid;   } 

  button.btn-default, .picker{/* background-color: #eee; */text-align: left;   border:none !important;    }

  .search_box label{   display: block; color: #333;    text-transform: uppercase;    font-size: 14px; text-align: left }
  
 .dropdown-menu  input[type="checkbox"] {
   margin: 0px 5px 0 0;    
    vertical-align: middle;
    display: inline-block; pointer-events: none;
  
}
 
.s_div1{width:  calc(100% - 780px); float: left; }
.s_div1 > div, .s_div2 > div{/* border-left: 1px #e7e7e7 solid; */ position: relative; padding-top: 25px; padding-bottom: 20px; }
.s_div2 > div:last-child{ border: none; }

.s_div1 .row > div{ padding-left: 5px; padding-right: 5px; }
.s_div2{ width:780px;float: right;   }
 
 .s_div1 > div:nth-child(1) {  background-color:    #93B8F2 ;    border-radius: 10px; }
.s_div1 > div:nth-child(2) {  background-color:  #93B8F2 ;    border-radius: 10px; } 
 

.s_div2 > div:nth-child(1) {  background-color:    #93B8F2 ;    border-radius: 10px;}
.s_div2 > div:nth-child(2) {  background-color: #93B8F2 ;    border-radius: 10px;} 
.s_div2 > div:nth-child(3) {  background-color:    #93B8F2 ;color: #000;    border-radius: 10px 0 0 10px;}
.s_div2 > div:nth-child(4) {  background-color:  #93B8F2 ; color: #000;    border-radius: 0 10px 10px 0; }  

 


.to_date, .from_date, .platform, .campaign {width: 170px; float: left; padding:0 5px;  }
.search_box .submit_div { width: 100px;float: left; padding:25px 5px 20px;}
.to_date:hover, .from_date:hover, .platform:hover,.campaign:hover, .s_div1 > div:hover{ /* background:rgba(242,246,247,0.4) ; */ }

.business_roi { font-size: 16px;color:#666;  }
.business_roi h2{ color:#000;  font-weight: 500; font-size: 24px; margin: 0; padding: 0 0 5px; }
.business_roi .row{ border-bottom: 1px #ccc solid;margin-bottom: 15px;
    padding-bottom: 30px; }
.business_roi .row:last-child{ border: none; }
.business_roi span{ font-weight:bolid;  }
.barfiller .lead_first{ margin-top: -86px; font-size: 56px;    font-weight: 500;}


#funnels{ margin-top: 20px; }
#funnels svg text{ display: none; }
#funnels{ width: 250px; height: 300px; }
#funnel_text{ margin-top: 50px; }
#funnel_text td{  line-height:28px;}
#funnel_text   i.cir{ width: 14px;
    height: 14px;
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px; }

.barfiller { float: left; width: 100%;  height: 12px;  background: #cccccc;  border: 1px solid #ccc;  position: relative;  margin-bottom: 20px;  margin:100px 0;color: #666;}

.barfiller .fill {  display: block;  position: relative;
  width:0px; height: 100%;  background: #cccccc;  z-index: 1;   transition: width 1s ease-in-out;  }
 
.fill:after { content: "";    display: block;    position: absolute;    right: -3px;    top: -4px;    z-index: 9;    bottom: 0;    background: #333;    width: 6px; }
 

 .barfiller .f_traget {      display: none;
    position: absolute;
    width: 0px;
    height: 100%;
    z-index: 1;
    transition: width 0s ease-in-out; 
    top: 0; }
 
.f_traget:after { content: "";    display: block;    position: absolute;    right: 3px;    bottom: -10px;   
 z-index: 9;    top: 0; border-left: 2px #333 dashed;  width:2px;}

  
.barfiller .text_top {    margin-top: -56px;
    padding: 2px 4px;   font-size: 31px;    color: #333;    right: -180px;
    position: absolute;    z-index: 2;    /* background: #333; */ font-weight: 500;
    width: 360px;    text-align: center; transition: left 1s ease-in-out; display: none;}
 
.barfiller .text_bottom {    margin-top: -56px;
    padding: 2px 4px;
           right: -180px;    position: absolute;
    z-index: 2;     width: 360px;    text-align: center; transition: left 1s ease-in-out; bottom: -44px; font-size: 16px;}
.barfiller.active .f_traget, .barfiller.active .text_top{ display: block; }


#page-wrapper .fa-caret-up{   color: #6eb27c; font-size: 24px; vertical-align: middle;}
#page-wrapper .fa-caret-down{ color: #e55153; font-size: 24px;vertical-align: middle;}
.chart_table .fa-minus{ color: #8d8d8d; }
.box_s{ display: inline-block; background: #5191e7; height: 16px; }

table   .fa-caret-up, table .fa-caret-down, table .fa-minus{ margin:0 4px; }

.lead_dashboard { font-size: 14px;color:#666;  }
.lead_dashboard h2{ color:#000;  font-weight: 500; font-size:18px; margin: 0; padding: 0 0 5px; letter-spacing: 0.3px; }
.lead_dashboard .row{ border-bottom: 1px #ccc solid;margin-bottom: 15px;
    padding-bottom:25px; }
.lead_dashboard .row:last-child{ border: none; }
.lead_dashboard span{ font-weight:bold;  }
.barfiller .lead_first{ margin-top: -86px; font-size: 56px;    font-weight: 500;}
.lead_dashboard strong{ font-size: 13px; }

.lead_dashboard .barfiller{ margin: 20px 0 4px; border: none; }
.lead_dashboard .text_top {
      margin-top: -30px;
    font-size: 19px;
    right: -97px;
    width: 200px; 
}

.lead_dashboard .text_bottom {
      margin-top: -56px;
    right: 6px;
    width: 200px;
    bottom: -24px;
    font-size: 13px;
    text-align: right;
}


.roi_percent{ text-align: right; }
.roi_percent span{ display: block; font-weight: 500; font-size:20px;  }
.roi_percent strong{display: block;font-weight: 600; font-size:24px;}


.roi_percent i.fa {height: 32px;}

.speedometers strong{ font-size: 28px;}
strong{ color: #444; }
#chart_div{ display: inline-block;    vertical-align: middle;}
.budget{ font-size: 16px; color: #333;    margin-left: 20px; position: absolute; }

.media_conve_strong{  display: block; line-height:45px; font-size: 20px; }
.spinner{ width: 100%;
    float: left; 
    overflow: hidden; 
    height:30px; left: 0; right: 0; top: -5px;
    position: absolute; display: none;}
.spinner.active{ display: block; }
.spinner div {
  width: 20px;
  height: 20px;
  position: absolute;
  left: -20px;
  top:5px;
  background-color: #27ae60;
  border-radius: 50%;
  animation: move 4s infinite cubic-bezier(.2,.64,.81,.23);
}
.spinner div:nth-child(2) {
  animation-delay: 150ms; background-color: #c0392b;
}
.spinner div:nth-child(3) {
  animation-delay: 300ms; background-color: #f1c40f;
}
.spinner div:nth-child(4) {
  animation-delay: 450ms; background-color: #3498db;
}
@keyframes move {
  0% {left: 0%;}
  75% {left:100%;}
  100% {left:100%;}
}

.leads_summery{ text-align: right; font-size: 29px;
    margin-top: 20px; font-weight: 500;  }
.leads_summery i{  font-size: 20px;
    top: 43px;}
.leads_summery i.fa-caret-up{color: #e55153 !important}
.leads_summery i.fa-caret-down{color: #6eb27c !important;}
.leads_summery h3{ text-align: center; font-size: 22px;  font-weight: normal; }
.leads_summery .panel{ text-align: center; float: left; width: 100%; }
.leads_summery .panel .rows{ padding: 0; margin: 0; }
.leads_summery .panel .rows > .col-xs-12{ padding: 0; margin: 0;}
.leads_summery1   > div{ background: #fff;   position: relative; 
  
padding:25px  15px; color: #333;   border-radius: 10px; 
    box-shadow: 0px 0px 38px 0px rgba(0,0,0,0.11);
    border-color: #e6e6e6 !important;
   }

.leads_summery1 > div:nth-child(1) {  color: #2e5aef ;}
.leads_summery1 > div:nth-child(2) { color: #dc3545 ;  }
.leads_summery1 > div:nth-child(3) { color: #28a745 ;   }
.leads_summery1 > div:nth-child(4) { color: #fd7e14 ;   }
.leads_summery1 > div:nth-child(5) { color: #6f34fd ;   }
.leads_summery1 > div:nth-child(6) { color: #9b7850 ;   }
.leads_summery1 > div:last-child{ margin-right: 0;}
.leads_summery1 > div:last-child {color: #ffc107 ;}
.leads_summery span{ display: inline-block; }
.leads_summery span.text{ display: block; font-size: 12px; color:#8e8e8e   }
.leads_summery span small{ font-size: 13px; color: #333; }
.leads_summery strong{ display: block; font-size:14px; font-weight: normal; color: #8e8e8e;}
#funnel{ float: left; width: 100%; }


.search_box .dropdown-menu { 
    max-height: 400px;
    overflow-y: auto;
}
.button-group { position: relative }
.button-group.open button:after{position: absolute;
    bottom: 0;
    left: 50%;
    display: inline-block;
    border-right: 9px solid transparent;
    border-bottom: 9px solid #CCC;
    border-left: 9px solid transparent;
    border-bottom-color: rgba(0,0,0,0.2);
    content: '';
    transform: translate(-50%, 0);}
.filter_mobile, .filter_head{ display: none; }
.visible-xs{ display: none; }

 .navbar-top-links li a{ font-size: 13px; }
@media (max-width:768px){
.to_date, .from_date, .platform, .campaign, .s_div2, .s_div1{ width: 100%; }
.filter_head{ display: block; }
.panel{float: left;
    width: 100%;
    margin-bottom: 10px;}
.navbar-top-links li{ display: block; }
 .navbar-top-links li a{ color: #333;  }
 .new_nav.navbar-top-links{ width: 100%; }
.new_nav.navbar-default .navbar-brand {
    color: #333;
    font-size: 18px;
    font-weight: 500;
     letter-spacing: 0;
    text-transform: uppercase;
    height: auto;
    padding-bottom: 0;
    font-weight: normal;
}

.search_box { display: none;
    margin: 0;
    padding:0px;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    overflow-y: scroll;
    z-index: 1000;
    background: #fff;
}
.s_div2 > div:nth-child(3), .s_div2 > div:nth-child(4), .s_div1 > div:nth-child(2) .row > div{ width: 50%; }

.s_div2 > div:last-child { 
    width: 100%;
    float: left;
    padding: 0;
    margin: 10px 0; 
}
.visible-xs{ display: block; }
.search_box .form-control.btn-primary{ height: 45px; }

.filter_mobile, .filter_head{ display: block; width: 100%; float: left; background: #024484; color: #fff; padding: 16px 0;  font-size: 16px; }
.filter_mobile a, .filter_head a{ color: #fff; font-size: 16px; }
.filter_head{padding: 15px 20px;}
.navbar-default {     padding: 5px 0 0;}

#page-wrapper{ float: left; width: 100%; }

.s_div1 > div, .s_div2 > div{ margin: 5px 0;  }
.search_panel_mob{ height: 100%; width: 100%; overflow-y: auto; }
#chart_div{width: 800px  !important;height: 500px !important;}

.chart_wrap{width: 100%  !important; float: left; overflow-x: auto;}
}


@keyframes loader2 {
  0% {
    top: 20px;
    left: 20px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 6px;
    left: 6px;
    width: 28px;
    height: 28px;
    opacity: 0;
  }
}
@-webkit-keyframes loader2 {
  0% {
    top: 20px;
    left: 20px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 6px;
    left: 6px;
    width: 28px;
    height: 28px;
    opacity: 0;
  }
 }
.loader2 { position: absolute;
    left: 0;
    right: 0;
    text-align: center;
    margin: 0 auto;
    top: 45%;
}
.loader2 span {
  box-sizing: content-box;
  position: absolute;
  border-width: 2px;
  border-style: solid;
  opacity: 1;
  border-radius: 50%;
  -webkit-animation: loader2 3.2s cubic-bezier(0, 0.2, 0.8, 1) infinite;
  animation: loader2 3.2s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.loader2 span:nth-child(1) {
  border-color: #0055a5;
}
.loader2 span:nth-child(2) {
  border-color: #45aee7;
  -webkit-animation-delay: -1.6s;
  animation-delay: -1.6s;
}
.loader2 {
  width: 50px !important;
  height: 50px !important;
  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
}
.loader_wrap{ position: relative; }
.loader_wrap .loader_display, .loader_wrap.active .loader2{ display: none; }
.loader_wrap.active .loader_display{ display: block; }

.loader_wrap{ min-height: 150px; }

.google-visualization-tooltip {position: absolute !important;background:  #fff; width: 200px;font-size:  13px !important;   }
.tooltip{ padding:4px 10px; line-height:18px; }
.tooltip h3{ padding: 0; margin: 0; font-size: 16px; }

</style>
</head>

<body class="no-sidebar">
<?php  include('include/header.php');?>
  


	<div id="page-wrapper"> 
 <form action="" name="fromsearch" id="fromsearch" method="post">

 <div class="rows">
   
<div class="container"> 

<div class="row"></div>
<div class="col-xs-12 col-sm-4">
   <input type="text" id="date_picker" value="<?php echo $start_week;?>"  name="date_picker" class="form-control picker" placeholder="From Date" />
</div>
<div class="col-xs-12 col-sm-4">
   <input type="text" id="date_to" value="<?php echo $end_week;?>" name="date_to" class="form-control picker" placeholder="To Date" />

</div>
<div class="col-xs-12 col-sm-4">
   <button   type="submit" class="form-control btn btn-primary text-center" id="searchreq_btn">Apply</button>
  
</div>
</div>

 </div>
  
</form>

 

		<div class="row  "> 
			<div class="col-sm-12">        

  
<div class="panel  mt20">       
<div class="panel-body">
<div class="row ">
 <div class="col-xs-12 col-sm-12">




  <h2 class="head">Spend/Lead/Sale Performance</h2>

   <div class="rows   loader_wrap active">
 
 
  <div class="chart_wrap loader_display">
<div id="chart_div" style="width: 100%; height: 800px;"></div>

</div>
 <span  class="loader2"><span></span><span></span></span> 
</div>
  </div></div>

</div></div>
		</div>
		<!-- /.row -->
		<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
	<?php include('include/footer.php');?>
	   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="assets/js/moment.min.js"></script>
<script src="assets/js/calentim.min.js"></script>
  
<script type="text/javascript">

$(document).ready(function() {
  
  function date_format_new(c_formate,new_date,required_format) {
  var dates='';
  format = c_formate || 'yyyy-mm-dd'; // default format
  var parts = new_date.match(/(\d+)/g),
      i = 0, fmt = {};
   format.replace(/(yyyy|dd|mm)/g, function(part) { fmt[part] = i++; });

if(required_format=='yyyy-mm-dd'){
dates=parts[fmt['yyyy']]+'-'+ (parts[fmt['mm']]) +'-'+ parts[fmt['dd']];
}else if (required_format=='dd-mm-yyyy') {
dates=parts[fmt['dd']]+'-'+ (parts[fmt['mm']]) +'-'+ parts[fmt['yyyy']];  
}
 
  return dates;
}
 

 function date_format(x, y) {
    var z = {
    M: x.getMonth() + 1,
    d: x.getDate(),
    h: x.getHours(),
    m: x.getMinutes(),
    s: x.getSeconds()
    };
    y = y.replace(/(M+|d+|h+|m+|s+)/g, function(v) {
        return ((v.length > 1 ? "0" : "") + eval('z.' + v.slice(-1))).slice(-2)
    });

    return y.replace(/(y+)/g, function(v) {
    return x.getFullYear().toString().slice(-v.length)
    });
}

var current_date = moment(); 

function update_issuedate(startDate,loop){

var start_d=moment(startDate).add(0, "day").endOf("day");
$("#date_to").calentim({ 
singleDate: true,
calendarCount: 1,
showTimePickers: false, 
autoAlign:false,
showHeader:false,
startEmpty:true,
format: "DD-MM-YYYY",
minDate:start_d,
maxDate:moment(current_date).subtract(0, "day").endOf("day"),
autoCloseOnSelect: true
}).val(date_format(start_d._d,'dd-MM-yyyy')).focus();
   
} 
 
///------------------------------///
$("#date_picker").calentim({ 
singleDate: true,
calendarCount: 1,
showTimePickers: false, 
autoAlign:false,
showHeader:false,
startEmpty:true,
format: "DD-MM-YYYY",
minDate:moment(current_date).subtract(2, "year").endOf("day"),
maxDate:moment(current_date).subtract(0, "day").endOf("day"),
autoCloseOnSelect: true,
onafterselect: function(calentim, startDate, endDate){   
        update_issuedate(startDate,endDate); 
      }
});

 
$("#date_to").calentim({ 
singleDate: true,
calendarCount: 1,
showTimePickers: false, 
autoAlign:false,
showHeader:false,
startEmpty:true,
format: "DD-MM-YYYY",
minDate:moment(current_date).subtract(2, "year").endOf("day"),
maxDate:moment(current_date).subtract(0, "day").endOf("day"),
autoCloseOnSelect: true
}); 


  $('#searchreq_btn').click(function(){ 
  var date_from=date_format_new('dd-mm-yyyy',$("#date_picker").val(),'yyyy-mm-dd');
  var date_to=date_format_new('dd-mm-yyyy',$("#date_to").val(),'yyyy-mm-dd');

 load_data(date_from,date_to)
  return false;
  });
 
});

var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};

var options = {
      title : 'Spend/Lead/Sale Performance',
       titleTextStyle: { 
        fontSize:20,
        bold: false
    },
      vAxis: {title: 'Spends', 
      titleFontSize:20,
      titleColor:'#000',
      titleItalic:false},
      hAxis: {titleFontSize:20,title: 'Leads/Sales',titleColor:'#000',titleitalic:false},
      seriesType: 'line',
      series: {0: {
                type: "line", 
                color: "#3366cc"
            } 
            },
fontSize:10, 
legendFontSize:14, 
titleFontSize:26, 
tooltipFontSize:12   
    };

    function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}

function show_map(datas){
  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

 function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable(datas);

    
 
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);

  }

}


let data= []; 

  function load_data(date_from,date_to){
var url=roots+'api/report/date_from:'+date_from+'/date_to:'+date_to;
   // alert('Your query count: ' + data);   2018-05-16  
   
  $.ajax({
            type: 'POST', 
            url: url,
      dataType:"json",
            data: $('#fromsearch').serialize()+'&id=myreport',
            success:function(response){ 
   
    data=response.data;
  

  
var datas=[]; 
var head_arr = [];
var body_arr = [];
var date_arr = [];
head_arr.push("date");
date_arr.push("months");


var elementId = [];

var newArr = data.filter((el,index,arr) => {
head_arr.push(el.names);
});
 
 head_arr = head_arr.filter( onlyUnique ); 
body_arr.push(head_arr);
var newArr = data.filter((el,index,arr) => {       
 var indexsd = contains.call(date_arr, el.dates);
if(indexsd==false){

  date_arr.push(el.dates);
  var totoal_head=head_arr.length;
var i;
var new_arr=[];
for (i = 0; i < head_arr.length; i++) { 
     new_arr[i]=0;
}
  body_arr[date_arr.indexOf(el.dates)]=new_arr;

}

 


var get_ind=head_arr.indexOf(el.names); 
body_arr[date_arr.indexOf(el.dates)][0]=el.dates;
head_arr.forEach( function(element, index) {
 
body_arr[date_arr.indexOf(el.dates)][get_ind]=el.percent;

});

 

  if (elementId.indexOf(el.dates) === -1) { 
       elementId.push(el.dates);
 
    }  

}); 
  
 show_map(body_arr);

  },
            error: function(xhr, textStatus, errorThrown) {
        alert('Aw, Snap! Something went wrong while displaying this webpage.'); 
             }
}); 

  } 
    </script>
   
</body>

</html>