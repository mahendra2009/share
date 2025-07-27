<?php
ob_start();
session_start();
require_once( 'library/conn.php' );
require_once( 'library/class.db.php' );
include('include/constants.php');
$database = new DB(); 
 
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
	 
</head>

<body class="no-sidebar">
	<?php include('include/header.php');?>
    
	<div id="page-wrapper">  
  <div class="row  "> 
<div class="col-sm-8 col-sm-offset-2">        

<div class="panel  mt30">
<div class="panel-body">
 <h2 class="head">Youtube Data</h2>
  <form action="" name="fromsearch" id="fromsearch" method="post">

 <div class="row">
  <div class="col-sm-4">
<label>From Date</label>
 <input type="text" id="date_picker"  required=""  name="date_picker" class="form-control picker" placeholder="From Date" />
</div>

 
<div class="col-sm-4">
<label>&nbsp;</label>
 <button  class="form-control btn-primary"  id="searchreq_btn"  />LOGIN</button>
</div> </div>
</form>
<div class="alert-danger text-center p10 mt20" style="display: none" id="error_msg">Error</div>
<div  id="success_msg" class="alert-success text-center p10 mt20" style="display: none" >Success </div>



</div>
				</div>
 
		</div> 
	</div> 
	<?php include('include/footer.php');?> 
	<script src="assets/js/moment.min.js"></script>
<script src="assets/js/calentim.min.js"></script>
<script type="text/javascript">
      function date_format_new(c_formate,new_date,required_format) {
  var dates='';
  format = c_formate || 'yyyy-mm-dd'; // default format
  var parts = new_date.match(/(\d+)/g),
      i = 0, fmt = {};
   format.replace(/(yyyy|dd|mm)/g, function(part) { fmt[part] = i++; });

if(required_format=='yyyy-mm-dd'){
dates=parts[fmt['yyyy']]+'-'+ (parts[fmt['mm']]) +'-'+ parts[fmt['dd']];
}else if (required_format=='yyyy/mm/dd') {

dates=parts[fmt['yyyy']]+'/'+ (parts[fmt['mm']]) +'/'+ parts[fmt['dd']]; 
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

$('#searchreq_btn').click(function(){ 
  var date_from=$("#date_picker").val();

 
if(date_from!=''){
date_from=date_format_new('dd-mm-yyyy',date_from,'yyyy-mm-dd');
  
 create_data(date_from);

}

  return false;
  });
  
 function create_data(date_from){
var url=roots+'api/createreport/date_from:'+date_from;
   
   $('#success_msg').hide();
$('#error_msg').hide();

  $.ajax({
            type: 'POST', 
            url: url,
      dataType:"json",
            data: $('#fromsearch').serialize()+'&id=myreport',
            success:function(response){ 
   
    //response.data;
    if(response.data=='not'){ 
$('#error_msg').html('Date Issue (Sunday/Holiday)').show();

}else{
$('#success_msg').html(response.data).show();
}
    

  }, error: function(xhr, textStatus, errorThrown) {
        alert('Aw, Snap! Something went wrong while displaying this webpage.'); 
             }
}); 

  } 
    </script>
  
</body>

</html>