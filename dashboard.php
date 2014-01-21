<? 

//connect to database - grab necessary functions

include ('global_includes/connect.php');
include ('global_includes/functions.php');

session_start();
check_login();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script language="JavaScript" src="calendar/ui_datepicker.js"></script>

<link href="styles/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<title>The Career Schools Lead Manager</title>

<link href="styles/global_styles.css" rel="stylesheet" type="text/css" />

<link href="styles/dashboard_styles.css" rel="stylesheet" type="text/css" />

<script>

$(document).ready(function(){

//UNOPENED FUNCTIONS
//UNOPENED FUNCTIONS
//UNOPENED FUNCTIONS
$("#unopened_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_loader").show()
$.post("ajax/unopened_leads_ajax.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
	function(result){
	$("#create_loader").hide()
     $("#unopened_links").html(result);
});

$("#unopened_leads_refresh").click(function(){
$("#unopened_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_loader").show()
$.post("ajax/unopened_leads_ajax.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#unopened_links").html(result);
   			});
});

var refreshID = setInterval(function() {
   $("#unopened_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
   $("#create_loader").show()
   $.post("ajax/unopened_leads_ajax.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#unopened_links").html(result);
   			});
   }, 30000);

//REMINDER FUNCTIONS
//REMINDER FUNCTIONS
//REMINDER FUNCTIONS
$("#reminders_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_loader").show()
$.post("ajax/reminder_dashboard_ajax.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
	function(result){
	$("#create_loader").hide()
     $("#reminders_links").html(result);
});

$("#reminders_refresh").click(function(){
$("#reminders_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_loader").show()
$.post("ajax/reminder_dashboard_ajax.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#reminders_links").html(result);
   			});
});

$("#reminders_new").click(function(){
$("#lead_update_status").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_loader").show()
$.post("dialogs/add_reminder_dialog.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
});

//CURRENT LEADS FUNCTIONS
//CURRENT LEADS FUNCTIONS
//CURRENT LEADS FUNCTIONS
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_loader").show()
$.post("ajax/current_leads_ajax.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
	function(result){
	$("#create_loader").hide()
     $("#current_leads_links").html(result);
});

$("#current_leads_refresh").click(function(){
	$("#fn_arrow").html("");
	$("#ln_arrow").html("");
	$("#status_arrow").html("");
	$("#edit_arrow").html("");
	$("#create_arrow").html("");
$("#current_leads_links").html("<img style='margin-top:50px; margin-left:50%' id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
$("#create_loader").show()
$.post("ajax/current_leads_ajax.php?user_id=<? echo $_SESSION['user_id']; ?>&the_role=<? echo $_SESSION['role']; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#current_leads_links").html(result);
   			});
});

//CURRENT LEADS COLUMN SORTERS
//CURRENT LEADS COLUMN SORTERS
//CURRENT LEADS COLUMN SORTERS

	//First Name
first_name_status=0;
$("#first_name_col").click(function(){
	if (first_name_status==0)
	{
	first_name_status=1;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#fn_arrow").html("<img src='images/down.png' />");
$("#ln_arrow").html("");
$("#status_arrow").html("");
$("#edit_arrow").html("");
$("#create_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "ProsFirstName", order: "ASC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
});
} else {
		first_name_status=0;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#fn_arrow").html("<img src='images/up.png' />");
$("#ln_arrow").html("");
$("#status_arrow").html("");
$("#edit_arrow").html("");
$("#create_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "ProsFirstName", order: "DESC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
			});
}
  	});
	//
		//Last Name
		last_name_status=0;
$("#last_name_col").click(function(){
	if(last_name_status==0){
		last_name_status=1;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#ln_arrow").html("<img src='images/down.png' />");
$("#fn_arrow").html("");
$("#status_arrow").html("");
$("#edit_arrow").html("");
$("#create_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "ProsLastName", order: "ASC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
   			});
	}else{
		last_name_status=0;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#ln_arrow").html("<img src='images/up.png' />");
$("#fn_arrow").html("");
$("#status_arrow").html("");
$("#edit_arrow").html("");
$("#create_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "ProsLastName", order: "DESC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
   			});
	}
  	});
//
//Status
status_status=0;
$("#status_col").click(function(){
if(status_status==0){
		status_status=1;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#status_arrow").html("<img src='images/down.png' />");
$("#fn_arrow").html("");
$("#ln_arrow").html("");
$("#edit_arrow").html("");
$("#create_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "Status", order: "ASC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
   			});
	}else{
		status_status=0;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#status_arrow").html("<img src='images/up.png' />");
$("#ln_arrow").html("");
$("#status_arrow").html("");
$("#edit_arrow").html("");
$("#create_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "Status", order: "DESC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
   			});
	}
  	});
//
//Create Date
create_status=0;
$("#create_date_col").click(function(){
if(create_status==0){
		create_status=1;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_arrow").html("<img src='images/down.png' />");
$("#fn_arrow").html("");
$("#status_arrow").html("");
$("#edit_arrow").html("");
$("#ln_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "OrigDate", order: "ASC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
   			});
	}else{
		create_status=0;
$("#current_leads_links").html("<span style='margin:50%;'><img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  /></span>");
$("#create_arrow").html("<img src='images/up.png' />");
$("#fn_arrow").html("");
$("#status_arrow").html("");
$("#edit_arrow").html("");
$("#ln_arrow").html("");
$("#create_loader").show()
$.get("ajax/current_leads_ajax.php", {sort_type: "OrigDate", order: "DESC", user_id:<? echo $_SESSION['user_id']; ?>, the_role:<? echo $_SESSION['role']; ?>},
			function(result){
				$("#loader").hide()
      			$("#current_leads_links").html(result);
   			});
	}
  	});

//

$('#date_time_picker').datetimepicker({
	ampm:true,
	numberOfMonths:2
});

});
</script>


</head>
<div id="logout_button"><a href="index.php?login=no">LOGOUT&nbsp;<img src="images/logout.png" /></a></div>
<body>

<div id="wrapper">

<div id="header">
<h1 >Welcome to your Dashboard, <? echo $_SESSION['firstname']; ?>.</h1>
</div>

<div id="navigation">
<? include 'global_includes/navigation.php'; ?>

<div id="lead_update_status"></div>


</div>




<div id="todays_leads">
<span class="subhead4">Unopened Leads<img id="unopened_leads_refresh" src="images/refresh.png" /></span>

<div id="unopened_links" style="overflow:auto; width:476px; height:175px;" ></div>


</div>


<div id="todays_reminders" style="margin-left:15px;">
<span class="subhead4">Todays Reminders<img id="reminders_refresh" src="images/refresh.png" /><!--<img id="reminders_new" src="images/new.png" />--></span>
<div id="reminders_links" style="overflow:auto; width:476px; height:175px;" ></div>

</div>


<div id="current_leads">
<span class="subhead4">Leads Currently Working<img id="current_leads_refresh" src="images/refresh.png" /></span>

	<div id="sort_headers" style="font-size:12px;">
	<table width="962px">
	<tr>
	<td width="100px" id="first_name_col">FIRST NAME&nbsp;<span id="fn_arrow"></span></td>
	<td width="125px" id="last_name_col">LAST NAME&nbsp;<span id="ln_arrow"></span></td>
	<td width="100px">PHONE</td>
	<td width="175px">EMAIL</td>
	<td width="125px" id="status_col">STATUS&nbsp;<span id="status_arrow"></span></td>
	<td width="125px" id="edit_date_col">LAST EDIT&nbsp;<span id="edit_arrow"></span></td>
	<td width="125px" id="create_date_col">CREATED&nbsp;<span id="create_arrow"></span></td>
	</tr>
	</table>
	</div>
<div id="current_leads_links" style="overflow:auto; width:982px; height:250px;" ></div>

</div>




</div>


</body>

<script>
$('#tour_date').datetimepicker({
	ampm:true,
	numberOfMonths:1
});
</script>

</html>