<?php 
/*$id = $this->uri->segment(3);*/
$project_name = $project[0]->name;
$project_id = $project[0]->project_id;
$project_apikey = $project[0]->apikey;

$id = $_GET['id'];

if($filter_date) {
	$date_from = $filter_date[0]->date_from;
	$date_end = $filter_date[0]->date_end;

	$ini_date = date('m/d/Y', strtotime($filter_date[0]->date_from));
	$end_date = date('m/d/Y', strtotime($filter_date[0]->date_end));
} else {
	$date_from = '';
	$date_end = '';

	$ini_date = date('m/d/Y', strtotime('first day of this month'));
	$end_date = date('m/d/Y', strtotime('last day of this month'));
}

?>
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
		<li class="active"><?=$project_name?></li>
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
			      	<li><a href="{base_url}project?id=<?=$id?>">Overview<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
			        <li class="dropdown active open">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Database <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
			          <ul class="dropdown-menu forAnimate" role="menu">
			            <li class="active"><a href="{base_url}project/dbfb/<?=$id?>">Facebook</a></li>
			            <li><a href="{base_url}project/dbgp?id=<?=$id?>">Google plus</a></li>
			          </ul>
			        </li>
			        <!-- <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Analytics <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-stats"></span></a>
			          <ul class="dropdown-menu forAnimate" role="menu">
			            <li><a href="#">Activities</a></li>
			            <li><a href="#">Graph</a></li>
			          </ul>
			        </li>
			        <li><a href="{base_url}project/notifications?id=<?=$id?>">Notifications<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li> -->
			        <li><a href="{base_url}project/settings?id=<?=$id?>">Settings<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench"></span></a></li>
			      </ul>
			    </div>
			  </div>
			</nav>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-6 col-xs-6">
			<div class="panel panel-default">
				<div class="filter_container">	
					<label>Date: </label> <input type="text" name="daterange" value="<?=$ini_date?> - <?=$end_date?>" />
					<button class="button filter">Filter</button>
					<a class="export_excel" download="firebase_fb_<?=strtolower(str_replace(' ','_',$project_name))?>.xls" href="#" onclick="return ExcellentExport.excel(this, 'datatable', 'Test');">Export to Excel</a>
				</div>
				<table class="table table-condensed table-bordered" id="datatable">
					<thead>
						<tr class="bg-info database">
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody id="data_list">
					</tbody>
				</table>
				<div class="panel-footer">
					<!-- pagination -->
					<div class="pagination"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase-database.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/excellentexport.min.js"></script>

<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script type="text/javascript">
$(document).ready(function() {
// Initialize Firebase
var project_apikey = "<?php echo $project_apikey?>";
var project_id = "<?php echo $project_id ?>";
var id = "<?php echo $id ?>";


var config = {
apiKey: project_apikey,
authDomain: project_id+".firebaseapp.com",
databaseURL: "https://"+project_id+".firebaseio.com"
};
firebase.initializeApp(config);
var database = firebase.database();
var html = '';
var counter = 1;

var month_ini = "<?php echo $date_from ?>";
var month_end = "<?php echo $date_end ?>";
generate_data(month_ini, month_end);


$('.button.filter').on('click',function(){
	var date_range = $('input[name="daterange"]').val();
	var sep = date_range.split(" - ");
	var ini = sep[0].split('/');
	var end = sep[1].split('/');
	var month_ini = ini[2]+'-'+ini[0]+'-'+ini[1];
	var month_end = end[2]+'-'+end[0]+'-'+end[1];
	// console.log(id);
	$.ajax({
	 	type: "POST",
	 	url: "<?=base_url()?>project/insert_filtering", 
	 	data: {id: id, month_ini: month_ini, month_end: month_end},
	 	success: function(result){
	 		console.log(result);
	 		location.reload();
	    }
	});
});


function generate_data(month_ini, month_end) {
	var userDataRef = database.ref("fb").startAt(month_ini).endAt(month_end).orderByChild('date');
	userDataRef.on("value", function(snapshot) {
    	snapshot.forEach(function(childSnapshot) {
		var key = childSnapshot.key;
		var childData = childSnapshot.val();
		html +="<tr>";
		html += "<td>" + counter + "</td>";
		html += "<td>" + childData.name + "</td>";
		html += "<td>" + childData.email + "</td>";
		html += "<td>" + childData.date + "</td>";
		html +="</tr>";
        counter++;
  		});
  		$('#data_list').html(html);
	});
}

$('input[name="daterange"]').daterangepicker();
});
</script>

</body>
</html>
