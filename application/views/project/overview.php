<!DOCTYPE html>
<html>
<head>
	<title>{app_name} : Dashboard</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{base_url}assets/css/style.css">
</head>
<body>

<div class="container">
	<div class="page-header">
		<div class="pull-right system_logout">
			 <a class="" href="{base_url}secure/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
		</div>
		<!-- <h3>{app_name} <small>{app_name_sub}</small></h3> -->
		<div class="system_title"><a href="<?=base_url()?>"><span>Firebase</span><small>Projects</small></a></div>
		
	</div>
	<ol class="breadcrumb proj_breadcrum">
		<li><a href="{base_url}">Dashboard</a></li>
		<li class="active"><?=$project[0]->name?></li>
	</ol>
	<div class="row projects">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
			<nav class="navbar navbar-default sidebar" role="navigation">
			    <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>      
			    </div>
			    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
			      <ul class="nav navbar-nav proj_nav">
			      	<li class="active"><a href="{base_url}project?id=<?=$_GET['id']?>">Overview<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Database <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
			          <ul class="dropdown-menu forAnimate" role="menu">
			            <li><a href="{base_url}project/dbfb?id=<?=$_GET['id']?>">Facebook</a></li>
			            <li><a href="{base_url}project/dbgp?id=<?=$_GET['id']?>">Google plus</a></li>
			          </ul>
			        </li>
			        <li ><a href="{base_url}project/settings?id=<?=$_GET['id']?>">Settings<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench"></span></a></li>
			      </ul>
			    </div>
			  </div>
			</nav>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-6 col-xs-6">
			<div class="main_content panel panel-default row">
				<div class="det name col-md-2">
					<p>Project Name</p>
					<p>Project ID</p>
					<p>Web API Key</p>
					<p>Date Created</p>
				</div>
				<div class="det value col-md-10">
					<p><?=$project[0]->name?></p>
					<p><?=$project[0]->project_id?></p>
					<p><?=$project[0]->apikey?></p>
					<p><?=$project[0]->date_created?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

</body>
</html>
