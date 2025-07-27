<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
		<a class="navbar-brand" href="#" id="logo" style="color: #333;"> Admin Login </a> </div>
	<ul class="nav navbar-top-links navbar-right  navbar-collapse ">
		
<li class="active"><a href="dashboard.php"><i class="fa  fa-th fa-fw"></i> Dashboard</a></li> 
<li><a href="day.php"><i class="fa fa-user fa-fw"></i>   Add Data</a> </li> 

<?php 
$l_name=isset($_SESSION['user_email'])?$_SESSION['user_email']:"Admin";
?>
		<li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> Hi, <?php echo ucwords($l_name);?> <i class="fa fa-caret-down"></i> </a>
			<ul class="dropdown-menu dropdown-user">

				<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>
				<li><a href="#"><i class="fa fa-key fa-fw"></i> Change Password</a> </li>
				<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> </li>
				<li class="divider"></li>
				<li><a href="logout.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
			</ul>
		</li>
		<li><a href="logout.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>

	</ul>
	 
</nav>

 
<script type="text/javascript">
	var roots='<?php echo BASE_URL;?>';
</script>
<style type="text/css" media="screen">
#fromsearch{ margin-top: 30px; }
@media (max-width: 767px){
.nav.navbar-top-links.navbar-right {
    float: right;
    width: 100%;
}
	.navbar-top-links li {
    display: block;
}
.navbar-top-links li a {  
    color: #333;
}

	}
</style>

