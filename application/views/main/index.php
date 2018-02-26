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
		<div class="system_title"><span>Firebase</span><small>Projects</small></div>
		
	</div>
	<div class="row projects">
		<div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6 add_project">
			<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#addproject">
				<span class="glyphicon glyphicon-plus"></span>
				<span class="add_project"> Add project </span>
			</a>
		</div>
		<?php foreach ($projects as $proj) {?>
			<div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6 project_name">
				<a href="{base_url}project?id=<?=$proj->id?>" class="btn btn-default btn-block">
					<h3><?=$proj->name?></h3>
					<p><?=$proj->project_id?></p>
				</a>
			</div>
		<?php } ?>

		
	</div>
</div>

<!-- Modal -->
<div id="addproject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <form action="{base_url}main/addproject" method="post">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Create a project</h4>
	      </div>
	      <div class="modal-body addproj_modal">
	        <div class="form-group">
			  <label for="projname">Project Name</label>
			  <input type="text" class="form-control" name="name" placeholder="My awesome project">
			</div>
			<div class="form-group">
			  <label for="pid">Project ID</label>
			  <input type="text" class="form-control" name="pid" placeholder="Project id from firebase">
			</div>
			<div class="form-group">
			  <label for="apikey">API Key</label>
			  <input type="text" class="form-control" name="apikey" placeholder="Project key">
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default create_cancel" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-default create_project">Create project</button>
	      </div>
	    </div>
    </form>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

});
</script>

</body>
</html>
