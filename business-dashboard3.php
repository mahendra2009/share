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
	.search_box1{ background:#fff; padding:15px 10px ;  }	
  .search_box{ padding: 0;background: #fff; border-bottom: 1px #eee solid;}
	.search_box .form-control{ height: 35px;border: 1px #ddd solid; } 
  .search_box label{ text-align:center; display: block; color: #333;    text-transform: uppercase;    font-size: 14px; }
  
 
 
.s_div1{width:  calc(100% - 610px); float: left; }
.s_div1 > div, .s_div2 > div{border-left: 1px #e7e7e7 solid; padding-top: 15px; padding-bottom: 20px; }
.s_div2 > div:last-child{ border: none; }

.s_div1 .row > div{ padding-left: 5px; padding-right: 5px; }
.s_div2{ width:610px;float: right;   }
.to_date, .from_date, .platform {width: 170px; float: left; padding:0 5px;  }
.search_box .submit_div { width: 100px;float: left; padding:15px 5px 20px;}
.to_date:hover, .from_date:hover, .platform:hover, .s_div1 > div:hover{ background:rgba(242,246,247,0.4) ; }




#funnel{ margin-top: 50px; }
#funnel svg text{ display: none; }
#funnel{ width: 250px; height: 300px; }
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

.leads_summery{ text-align: right; font-size: 40px;
    margin-top: 40px;
    margin-bottom: 10px; }
.leads_summery i{ position: absolute; left: 30px;
    top: 43px;}
.leads_summery > div{ background: #fff; width: 23%; position: relative; 
  float: left ; margin:0 2% 0 0;
padding:25px  40px; color: #333;   border-radius: 10px; 
    box-shadow: 0px 0px 38px 0px rgba(0,0,0,0.11);
    border-color: #e6e6e6 !important;
   }
.leads_summery > div:nth-child(1){margin-left: 1%;}
.leads_summery > div:nth-child(1) {  color: #2e5aef ;}
.leads_summery > div:nth-child(2) { color: #dc3545 ;  }
.leads_summery > div:nth-child(3) { color: #28a745 ;   }
.leads_summery > div:last-child{ margin-right: 0;}
.leads_summery > div:last-child {color: #ffc107 ;}
.leads_summery span{ display: inline-block; }
.leads_summery span small{ font-size: 13px; color: #333; }
.leads_summery strong{ display: block; font-size:16px; font-weight: normal; color: #333;}

@media (max-width:768px){
.to_date, .from_date, .platform, .s_div2, .s_div1{ width: 100%; }
}

</style>
</head>

<body class="no-sidebar">
	<?php include('include/header.php');?>
  <form action="" name="fromsearch" id="fromsearch" method="post">

<div class="container-fluid search_box">
    <div class="s_div1">

 <div class="col-xs-12 col-sm-7">
<label>Geography  </label>
  <div class="row ">
 <div class="col-xs-12 col-sm-4 ">
<select class="form-control" name="country_name" id="country_name">
<option value="">All </option>
</select>
</div><div class="col-xs-12 col-sm-4 ">
<select class="form-control" name="city_name" id="city_name">
<option value="">All</option>
</select>
</div><div class="col-xs-12 col-sm-4">
<select class="form-control" name="place_name" id="place_name">
<option value="">All</option>
</select>
</div></div>
</div>
<div class="col-xs-12 col-sm-5 ">
<label>Category  </label>
<div class="row ">
<div class="col-xs-12 col-sm-6">
<select class="form-control" name="campaign_name" id="campaign_name">
<option value="">All</option>
</select>
</div>
<div class="col-xs-12 col-sm-6">
<select class="form-control" name="campaign_class" id="campaign_class"> 
<option value="">Super Ace</option>
</select>
</div> 
</div>

</div>
</div><div class="s_div2">
<div class="platform">
  <label> Platform</label>
    <select class="form-control" name="platfrom" id="platfrom">
<option value="">All</option>
<option value="all">Facebook</option>
</select>
   
</div> <div class="from_date">
<label>From Date</label>
 <input type="text" id="date_picker" value="<?php //echo $start_week;?>"  name="date_picker" class="form-control picker" placeholder="From Date" />
</div>
<div class="to_date">
<label>To Date</label>
 <input type="text" id="date_to" value="<?php //echo $end_week;?>" name="date_to" class="form-control picker" placeholder="To Date" />
</div>

<div class="submit_div">

    <label>   &nbsp; </label>

<button   type="submit" class="form-control btn btn-primary" id="searchreq_btn">Search</button>
                   
</div>


</div></div> 
</form>

  



	<div id="page-wrapper"> 
<div class="spinner active1"> <div></div>  <div></div>  <div></div>  <div></div></div>
<div class="rows  leads_summery"> 
      <div><i class="fa  fa-line-chart"></i>
        <span class="counter" data-start="" data-count="165" data-end=" %"><small>Loading...</small></span> 
<strong>Leads Today</strong>
 
</div><div><i class="fa   fa-area-chart"></i> 
  <span class="counter" data-start="" data-count="5090" data-end=" k"><small>Loading...</small></span> 
<strong>Leads This Month</strong>
 
 
</div><div><i class="fa fa-shopping-cart"></i>
  <span class="counter" data-start="" data-count="20" data-end=" %"><small>Loading...</small></span> 
<strong> Sales Today</strong>
</div><div><i class="fa   fa-bar-chart"></i>
  <span class="counter" data-start="" data-count="39" data-end=" k"><small>Loading...</small></span>
<strong> Sales This Month</strong>
</div></div>
		<div class="row  "> 
			<div class="col-sm-12">        

<div class="row  "> 
      <div class="col-sm-8"> 
				<div class="panel  mt30">
					 
					<div class="panel-body">


 <h2 class="head">Conversion Funnel</h2>
  <div class="rows p20"> 

<div class="row ">
 <div class="col-xs-12 col-sm-4">
   <div id="funnel"  ></div>
</div><div class="col-xs-12 col-sm-8">
<div class="table-responsive">
<table   class="table    chart_table f16" cellspacing="0" width="100%">
          <thead>
               
            <tr>
              <th>Source</th>
              <th class="text-right">Target</th>
              <th  class="text-right" >Achieved</th>
              <th class="text-right">% Achieved  </th> 
            </tr>
          </thead>
          <tbody id="funnel_text" >
           
    
          </tbody>

        </table>
        </div>

</div></div>
 
 </div>

 
					</div>
				</div>
</div><div class="col-sm-4"> <div class="panel  mt30">
   <div class="panel-body">

<div class="p10 lead_dashboard">



<div class="row">
 <h2>Total Spend <span class="text-success">74.34% <i class="fa fa-caret-up"></i></span></h2> 
<div class="barfiller active" style="height:8px;"> 
 <span class="fill" data-percentage="80" style="background: #6f34fd; width: 80%;">
 <span class="text_top"><sapn class="counter" data-start="" data-count="800000" data-end="">0</sapn></span></span>
 <span class="f_traget" data-percentage="70" style="width: 70%;">
 <span class="text_bottom">Target: 7,00,000</span></span>
 </div>
</div> 


<div class="row">
 <h2>Online Spend    <span class="text-danger">74.34% <i class="fa fa-caret-down"></i></span></h2> 
<div class="barfiller active" style="height:8px;"> 
 <span class="fill" data-percentage="50" style="background: #5390e9; width: 40%;">
 <span class="text_top"><sapn class="counter" data-start="" data-count="200000" data-end="">0</sapn></span></span>
 <span class="f_traget" data-percentage="100" style="width: 40%;">
 <span class="text_bottom">Target: 3,00,000</span></span>
 </div>
</div> 


<div class="row">
 <h2>Offline Spend    <span class="text-success">74.34% <i class="fa fa-caret-up"></i></span></h2> 
<div class="barfiller active" style="height:8px;"> 
 <span class="fill" data-percentage="30" style="background: #975892; width: 10%;">
 <span class="text_top"><sapn class="counter" data-start="" data-count="20000" data-end="">0</sapn></span></span>
 <span class="f_traget" data-percentage="90" style="width: 50%;">
 <span class="text_bottom">Target: 30,000</span></span>
 </div>
</div> 


<div class="row">
 <h2>Cost Per Leads       <span class="text-danger">74.34% <i class="fa fa-caret-down"></i></span></h2> 
<div class="barfiller active" style="height:8px;"> 
 <span class="fill" data-percentage="80" style="background: #e04d57; width: 80%;">
 <span class="text_top"><sapn class="counter" data-start="" data-count="800000" data-end="">0</sapn></span></span>
 <span class="f_traget" data-percentage="70" style="width: 70%;">
 <span class="text_bottom">Target: 7,00,000</span></span>
 </div>
</div> 
 
 

 
<div class="row">
 <h2>Cost Per Sale        <span class="text-danger">74.34% <i class="fa fa-caret-up"></i></span></h2> 
<div class="barfiller active" style="height:8px;"> 
 <span class="fill" data-percentage="80" style="background: #70b37d; width: 80%;">
 <span class="text_top"><sapn class="counter" data-start="" data-count="800000" data-end="">0</sapn></span></span>
 <span class="f_traget" data-percentage="70" style="width: 70%;">
 <span class="text_bottom">Target: 7,00,000</span></span>
 </div>
</div> 


 
 
 


</div></div>
      </div></div>



			</div>
<div class="panel  mt30">
       
          <div class="panel-body">
<div class="row ">
 <div class="col-xs-12 col-sm-12">
  <h2 class="head">Spend/Lead/Sale Performance</h2>
<div id="chart_div" style="width: 100%; height: 500px;"></div>


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

$('.barfiller').each(function(index, el) {
  var get_t=$(this);
  var get_this=get_t.find('.fill');
  var f_traget=get_t.find('.f_traget');

  window.setTimeout(function () {
get_t.addClass('active');
get_this.css( "width", get_this.attr('data-percentage')+"%" );
f_traget.css( "width", f_traget.attr('data-percentage')+"%" );    
  }, 1000 );


});




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
maxDate:moment(current_date).subtract(1, "day").endOf("day"),
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
maxDate:moment(current_date).subtract(1, "day").endOf("day"),
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
maxDate:moment(current_date).subtract(1, "day").endOf("day"),
autoCloseOnSelect: true
});
 

  
  
    </script>
 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.16/d3.min.js"></script>
        <script src="assets/js/d3-funnel.min.js" type="text/javascript"></script>
     
        <script type="text/javascript">
        	
function formatNumber (number) {
 
  if(number.toString().length>2){
    if(number!='' && typeof number != 'undefined'){
      var desc='';
      number= number.toString().split('.'), numbers=number[0];
      desc=number[1];
      if(typeof desc == 'undefined'){
      desc='';
    }
	   numbers=numbers.toString();
var lastThree = numbers.substring(numbers.length-3);
var otherNumbers = numbers.substring(0,numbers.length-3);
if(otherNumbers != '')
    lastThree = ',' + lastThree;
var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
    }    
if(desc){
 res=res+'.'+desc;
}

 return res;
}else{
  return number;
}
}
 showfunnel();

function showfunnel() {
    var data = [
        ['Impressions', 1088,0,'#5390e9'],
        ['Clicks',    1200,1800,'#70b37d'],
        ['Visits', 700,800,'#ec932f'],
        ['Leads',      300,60,'#e04d57'], 
        ['Leads to CRM',    200,90,'#975892'],
        ['Dealer Called', 500,80,'#6f34fd'],
         ['Leads Interested', 100,80,'#9b7850'],
        ['Sales',      500,200,'#cd517b'] 
 
       
    ];
    var options = { 
      block: {dynamicHeight: true,minHeight: 2}  }
    var chart = new D3Funnel('#funnel');
    chart.draw(data, options);
 
var c_html='';
//var g_total=0;
//$.each( data, function( key, obj ) {g_total+=obj[1];});	 
 
$.each( data, function( key, obj ) {

  var get_t=Math.round(obj[2]*100/obj[1]);
  get_t=(get_t-100);

  if (get_t > 0) {
get_t=(get_t)+' <i class="fa fa-caret-up"></i>';
}else{
get_t=(get_t)+' <i class="fa fa-caret-down"></i>';

}

$('#funnel g:nth-child('+(key+1)+') path').css({ fill: obj[3] });

 c_html+='<tr><td class="text-left"  ><i style="background:'+obj[3]+'" class="cir"></i> '+obj[0]+' </td><td  class="text-right" > '+formatNumber(obj[1])+'</td><td class="text-right">'+formatNumber(obj[2])+' </td><td  class="text-right"><strong>'+get_t +'</strong>  </td></tr>';
  
}); 

$('#funnel_text').html(c_html);

}



$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count'),
      data_start = $this.attr('data-start'),
      data_end = $this.attr('data-end');
    if(typeof data_start == 'undefined'){data_start='';    }
    if(typeof data_end == 'undefined'){data_end='';    }
    
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {

    duration: 2000,
    easing:'linear',
    step: function() {
      $this.text(Math.ceil(this.countNum));      
    },
    complete: function() {
      $this.text(data_start+''+formatNumber(this.countNum)+''+data_end); 
    }

  });  
  
  

}); 
        </script>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Month', 'Leads', 'Sales','Average'],
         ['Jan 17',100,200,100],
         ['Feb 17',  50,80,80],
         ['Mar 17',  200,150,500],
         ['Apr 17',  300,400,600],
         ['Jun 17',  800,870,800],
         ['Jul 17',  582,500,600],
         ['Aug 17',  50,80,80],
         ['Sep 17',  200,150,500],
         ['Aug 17',  300,400,600],
         ['Oct 17',  800,870,800],
         ['Nov 17',  582,500,600],
         ['Dec 17',  582,500,600]
         
      ]);

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
      seriesType: 'bars',
      series: {0: {
                type: "bars", 
                color: "#3366cc"
            },
            1: {
                type: "bars", 
                color: "#ff9900"
            },
            2: {
        type: 'line',
       color: '#109618'
  }},
fontSize:10, 
legendFontSize:14, 
titleFontSize:26, 
tooltipFontSize:12  

//2: {type: 'line'}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);

  }
 

    </script>
</body>

</html>