<? 

//connect to database - grab necessary functions

include ('global_includes/connect.php');
include ('global_includes/functions.php');

session_start();

check_login();

//GET USER ID
$user_id = $_SESSION['user_id'];

//TODAYS DATE
$todays_date = date('m/d/y', time());

//GET LEAD ID
//IF CREATING A LEAD ASSIGN LEAD ID OF LAST USED PLUS 3
if ($_REQUEST['type']=='create'){
$result = mysql_query("SELECT LeadsId FROM leads ORDER BY LeadsId DESC LIMIT 1 ");
while($row = mysql_fetch_array($result))
  { $lead_id = $row['LeadsId']+3; }
}else{
	$lead_id = $_REQUEST['lead_id'];
}

//ON YES LIST???
$result = mysql_query("SELECT LeadsId FROM yes_list");
while($row = mysql_fetch_array($result))
  {
	//LEAD IS ON YES LIST
	if ($lead_id == $row['LeadsId']){
		$on_yes_list = 'yes';
	}
  }

//GET THE SCHOOL ID OF THE LEAD
$result = mysql_query("SELECT school FROM leads WHERE LeadsId=$lead_id ");
while($row = mysql_fetch_array($result))
  { 
  
  $school_id = $row['school'];
  
  }


//IF VIEWED BY ASSIGNED REP
$result = mysql_query("SELECT rep_id, Reviewed FROM leads WHERE LeadsId=$lead_id ");
while($row = mysql_fetch_array($result))
  { 
  $reviewed = $row['Reviewed'];
  $rep_id = $row['rep_id'];
  }
 
if ($_SESSION['user_id'] == $rep_id && $_SESSION['role'] == '1' && $reviewed == '0'){
	mysql_query("UPDATE leads SET Reviewed='1' WHERE LeadsId=$lead_id");
	history_reviewed_by_rep ($lead_id, $_SESSION['user_id']);
}
 

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lead Detail | Lead Database Management</title>
<link href="styles/global_styles.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script language="JavaScript" src="calendar/ui_datepicker.js"></script>

<link href="styles/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function(){
//

//CHANGE LEAD STATUS HANDLERS
//CHANGE LEAD STATUS HANDLERS
//CHANGE LEAD STATUS HANDLERS

$('#lead_status').change(function(){
	switch ($('#lead_status :selected').text()){
		//
		case 'Interview Scheduled':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/schedule_interview_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
		//
		case 'Interview Cancelled':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/cancel_interview_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
		//
		case 'Interview No Show':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/interview_show_dialog.php?lead_id=<? echo $lead_id; ?>&show=no", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
		//
		case 'Interview Show':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/interview_show_dialog.php?lead_id=<? echo $lead_id; ?>&show=yes", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
		//
		case 'Contact Attempted':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/contact_attempted_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
		//
		case 'Closed':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/close_lead_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
		//
		case 'Contacted':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/contacted_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
		//
		case 'Applied':
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
			$.post("dialogs/applied_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
		break;
	
	}
})
//ASSIGN SCHOOL LIST HANDLER
//ASSIGN SCHOOL LIST HANDLER
//ASSIGN SCHOOL LIST HANDLER
$('#school').change(function(){
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
		$.post("dialogs/assign_school_dialog.php?lead_id=<? echo $lead_id; ?>", 
			{
			school_assigned:$("#school :selected").val(),
			},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
})
//ASSIGN REP SELECT LIST HANDLER
//ASSIGN REP SELECT LIST HANDLER
//ASSIGN REP SELECT LIST HANDLER
$('#rep_assigned').change(function(){
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
		$.post("dialogs/assign_rep_dialog.php?lead_id=<? echo $lead_id; ?>", 
			{
			rep_id_assigned:$("#rep_assigned :selected").val(),
			rep_name_assigned:$("#rep_assigned :selected").text(),
			},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
})
//MAIN SOURCE HANDLER - NO DIALOG
//MAIN SOURCE HANDLER - NO DIALOG
//MAIN SOURCE HANDLER - NO DIALOG
$('#source_type').change(function(){
		$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
		$.post("ajax/main_source_ajax.php?lead_id=<? echo $lead_id; ?>", 
			{
			source_type:$("#source_type :selected").val(),
			},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
})
//CONTINUE EDITING LEAD BUTTON
//CONTINUE EDITING LEAD BUTTON
//CONTINUE EDITING LEAD BUTTON
$("#continue_edit").click(function(){
	$("#cover").hide()
	$("#return_box").hide()
});
//LOG NEW CONTACT ATTEMPT BUTTON
//LOG NEW CONTACT ATTEMPT BUTTON
//LOG NEW CONTACT ATTEMPT BUTTON
$("#log_new_attempt_button").click(function(){
$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
$("#create_loader").show()
$.post("dialogs/contact_attempted_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
});
//RESCHEDULE INTERVIEW BUTTON
//RESCHEDULE INTERVIEW BUTTON
//RESCHEDULE INTERVIEW BUTTON
$("#reschedule_interview_button").click(function(){
$("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
$("#create_loader").show()
$.post("dialogs/reschedule_interview_dialog.php?lead_id=<? echo $lead_id; ?>", {},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
});
//CLOSE REMINDER BUTTON
//CLOSE REMINDER BUTTON
//CLOSE REMINDER BUTTON
$("#close_reminder").click(function(){
	$.post("ajax/close_reminder_ajax.php?&reminder_status=Closed", 
			{
				reminder_id: $("#reminder_id").val(),
			},
			function(result){
      			$("#reminder_tab").effect('blind');
   			});
});
//YES LIST BUTTON
//YES LIST BUTTON
//YES LIST BUTTON
$("#add_yes_list_button").click(function(){
	  $("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("dialogs/add_yes_list_dialog.php?lead_id=<? echo $lead_id; ?>&school=<? echo $school_id; ?>", 
			{
			//rep_name_assigned:$("#rep_assigned :selected").text(),
			},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
  	});
	
	$("#edit_yes_list_button").click(function(){
	  $("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("dialogs/edit_yes_list_dialog.php?lead_id=<? echo $lead_id; ?>&school=<? echo $school_id; ?>", 
			{
			//rep_name_assigned:$("#rep_assigned :selected").text(),
			},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
  	});

//DELETE LEAD BUTTON
//DELETE LEAD BUTTON
//DELETE LEAD BUTTON
$("#delete_lead_button").click(function(){
	  $("#lead_update_status").html("Loading ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("dialogs/delete_lead_dialog.php?lead_id=<? echo $lead_id; ?>", 
			{
			},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
   			});
  	});
	
	


//UPDATE LEAD BUTTON
//UPDATE LEAD BUTTON
//UPDATE LEAD BUTTON
 $("#update_lead_button").click(function(){
	  $("#lead_update_status").html("Saving Lead <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("ajax/update_leads_ajax.php?type=<? echo $_GET['type']?>&lead_id=<? echo $lead_id; ?>", 
			{
			first_name:$("#first_name").val(),
			last_name:$("#last_name").val(),
			middle_name:$("#middle_name").val(),
			maiden_name:$("#maiden_name").val(),
			address_1:$("#address_1").val(),
			address_2:$("#address_2").val(),
			city: $("#city").val(),
			state:$("#state").val(),
			county:$("#county").val(),
			zip:$("#zip").val(),
			country: $("#country").val(),
			home_phone:$("#home_phone").val(),
			cell_phone: $("#cell_phone").val(),
			email: $("#email").val(),
			high_school: $("#high_school").val(),
			grad_year: $("#grad_year").val(),
			comments: $("#comments").val(),
			da: $("#da:checked").val(),
			dae: $("#dae:checked").val(),
			dms: $("#dms:checked").val(),
			ma: $("#ma:checked").val(),
			mae: $("#mae:checked").val(),
			hit: $("#hit:checked").val(),
			moa: $("#moa:checked").val(),
			mbc: $("#mbc:checked").val(),
			mt: $("#mt:checked").val(),
			pct: $("#pct:checked").val(),
			pt: $("#pt:checked").val(),
			phleb: $("#phleb:checked").val(),
			st: $("#st:checked").val(),
			va: $("#va:checked").val(),
			bmt: $("#bmt:checked").val(),
			bop: $("#bop:checked").val(),
			cnc: $("#cnc:checked").val(),
			elc: $("#elc:checked").val(),
			eet: $("#eet:checked").val(),
			et: $("#et:checked").val(),
			iart: $("#iart:checked").val(),
			mnt: $("#mnt:checked").val(),
			mgd: $("#mgd:checked").val(),
			ndp: $("#ndp:checked").val(),
			weld: $("#weld:checked").val(),
			rhvac: $("#rhvac:checked").val(),
			cosmo: $("#cos:checked").val(),
			cosmoe: $("#cosmoe:checked").val(),
			cost: $("#cost:checked").val(),
			coste: $("#coste:checked").val(),
			man: $("#man:checked").val(),
			costr: $("#costr:checked").val(),
			leadstatus: $("#lead_status").val(),
			},
			function(result){
				$("#create_loader").hide()
      			$("#lead_update_status").html(result);
				
   			});
  	});


//
//
});

</script>






</head>

<!-- REMINDER -->
<!-- REMINDER -->
<?
//ADD REMINDER TAB IF APPLICABLE
$result = mysql_query("SELECT * FROM reminders, leads WHERE reminders.user_id='$user_id' AND reminders.LeadsId ='$lead_id' AND reminder_status='Open' ORDER BY reminders.time_stamp DESC ");
while($row = mysql_fetch_array($result))
  {
	  if ($todays_date == date('m/d/y', $row['time_stamp'])){
 		 $reminder_id = $row['reminder_id'];
	  }
  }
if (isset($reminder_id)){
	reminder_get_lead_reminder ($reminder_id);
}
?>

<div id="logout_button" ><a href="index.php?login=no">LOGOUT<img src="images/logout.png" /></a></div>

<body>

<div id="wrapper">

<?

//EDIT LEAD CODE
//EDIT LEAD CODE
//EDIT LEAD CODE
if ($_GET['type']== 'edit')
{

//GET LEAD INFO AND STATUS INFO 
$result = mysql_query("SELECT * FROM leads, lead_status WHERE leads.LeadsId=$lead_id AND lead_status.id=leads.StatusId");

while($row = mysql_fetch_array($result))
  {
	  /////IF LEAD IS UNOPENED, SET TO OPEN AND UPDATE LEAD TABLE AND LEAD HISTORY TABLE
	if ($row['StatusId'] == 0) {
		  mysql_query("UPDATE leads SET StatusId=1 WHERE LeadsId=$lead_id");
		  $lead_status = 'Open';
		  history_opened($lead_id, $_SESSION['user_id']);
	} else {
		/////IF STATUS OTHER THEN UNOPENED GRAB THE ALREADY SET STATUS
		 $lead_status = $row['status'];
	}
	//////////////////
	  
	  
  $lead_id = $row['LeadsId'];
  $closed = $row['Closed'];
  $create_date = $row['CreatDate'];
  $main_source_type = $row['MainSourceType'];
  $source_name = $row['SourceName'];
  $first_name = $row['ProsFirstName'];
  $middle_name = $row['ProsMiddleName'];
  $last_name = $row['ProsLastName'];
  $maiden_name = $row['ProsMaiden'];
  $address1 = $row['ProsAddress1'];
  $address2 = $row['ProsAddress2'];
  $city = $row['ProsCity'];
  $state = $row['ProsState'];
  $county = $row['ProsCounty'];
  $zip = $row['ProsZip'];
  $cell_phone = $row['ProsCell'];
  $phone = $row['ProsPhone'];
  $email = $row['ProsEmail'];
  $interest = $row['ProsInterest'];
  $comments = $row['ProsComments'];
  $high_school = $row['ProsHighSchool'];
  $grad_year = $row['ProsGradYear'];
  $school = get_school_from_lead($row['school']);
  $school_id = $row['school'];
  $orig_date = date('m/d/Y',$row['OrigDate']);
  $interview_date = date('m/d/y h:i A', $row['InterviewDate']);
  $username = $row['Username'];
  $rep_id = $row['rep_id'];
  if ($row['ProIntDA'] > 0) {$int_da = 'checked';} else {$int_da = "";}
  if ($row['ProIntDAE'] > 0) {$int_dae = 'checked';} else {$int_dae = "";}
  if ($row['ProIntDMS'] > 0) {$int_dms = 'checked';} else {$int_dms = "";}
  if ($row['ProIntMA'] > 0) {$int_ma = 'checked';} else {$int_ma = "";}
  if ($row['ProIntMAE'] > 0) {$int_mae = 'checked';} else {$int_mae = "";}
  if ($row['ProIntMS'] > 0) {$int_ms = 'checked';} else {$int_ms = "";}
  if ($row['ProIntPT'] > 0) {$int_pt = 'checked';} else {$int_pt = "";}
  if ($row['ProIntST'] > 0) {$int_st = 'checked';} else {$int_st = "";}
  if ($row['ProIntVA'] > 0) {$int_va = 'checked';} else {$int_va = "";}
  if ($row['ProIntMT'] > 0) {$int_mt = 'checked';} else {$int_mt = "";}
  if ($row['ProIntMTE'] > 0) {$int_mte = 'checked';} else {$int_mte = "";}
  if ($row['ProIntCOS'] > 0) {$int_cos = 'checked';} else {$int_cos = "";}
  if ($row['ProIntCOST'] > 0) {$int_cost = 'checked';} else {$int_cost = "";}
  if ($row['ProIntCOSTE'] > 0) {$int_cose = 'checked';} else {$int_cose = "";}
  if ($row['ProIntCOSTE'] > 0) {$int_coste = 'checked';} else {$int_coste = "";}
  if ($row['ProIntCET'] > 0) {$int_cet = 'checked';} else {$int_cet = "";}
  if ($row['ProIntMDG'] > 0) {$int_mdg = 'checked';} else {$int_mdg = "";}
  if ($row['ProIntNDP'] > 0) {$int_ndp = 'checked';} else {$int_ndp = "";}
  if ($row['ProIntPCT'] > 0) {$int_pct = 'checked';} else {$int_pct = "";}
  if ($row['ProIntACC'] > 0) {$int_acc = 'checked';} else {$int_acc = "";}
  if ($row['ProIntBET'] > 0) {$int_bet = 'checked';} else {$int_bet = "";}
  if ($row['ProIntBMT'] > 0) {$int_bmt = 'checked';} else {$int_bmt = "";}
  if ($row['ProIntOSS'] > 0) {$int_oss = 'checked';} else {$int_oss = "";}
  if ($row['ProIntSNA'] > 0) {$int_sna = 'checked';} else {$int_sna = "";}
  if ($row['ProIntWDD'] > 0) {$int_wdd = 'checked';} else {$int_wdd = "";}
  if ($row['ProIntMAN'] > 0) {$int_man = 'checked';} else {$int_man = "";}
  if ($row['ProIntHCM'] > 0) {$int_hcm = 'checked';} else {$int_hcm = "";}
  if ($row['ProIntHOS'] > 0) {$int_hos = 'checked';} else {$int_hos = "";}
  if ($row['ProIntSMM'] > 0) {$int_smm = 'checked';} else {$int_smm = "";}
  if ($row['ProIntIAR'] > 0) {$int_iar = 'checked';} else {$int_iar = "";}
  if ($row['ProIntGPCT'] > 0) {$int_gpct = 'checked';} else {$int_gpct = "";}
  if ($row['ProIntGPhleb'] > 0) {$int_phleb = 'checked';} else {$int_phleb = "";}
  if ($row['ProIntGMBC'] > 0) {$int_mbc = 'checked';} else {$int_mbc = "";}
  if ($row['ProIntECNC'] > 0) {$int_cnc = 'checked';} else {$int_cnc = "";}
  if ($row['ProIntEMAIN'] > 0) {$int_main = 'checked';} else {$int_main = "";}
  if ($row['ProIntEWELD'] > 0) {$int_weld = 'checked';} else {$int_weld = "";}
  if ($row['ProIntERHVAC'] > 0) {$int_rhvac = 'checked';} else {$int_rhvac = "";}
  if ($row['ProIntEGHIT'] > 0) {$int_hit = 'checked';} else {$int_hit = "";}
  if ($row['ProIntCOSTR'] > 0) {$int_costr = 'checked';} else {$int_costr = "";}
  if ($row['ProIntEELC'] > 0) {$int_elc = 'checked';} else {$int_elc = "";}
  
  //GET LEAD HISTORY
  //GET LEAD HISTORY
  //GET LEAD HISTORY
$result = mysql_query("SELECT * FROM lead_history WHERE LeadsId = $lead_id ORDER BY time_stamp DESC");

while($row = mysql_fetch_array($result))
  {
	 $time = date("m/d/Y - h:i:s A", $row['time_stamp']);
	 $action = $row['action'];
	 $details = $row['details'];
	 $history_user = $row['user_id'];
	 
	 //GET USERNAME FOR HISTORY
	 $result2 = mysql_query("SELECT * FROM users WHERE user_id = $history_user");
	 while($row = mysql_fetch_array($result2)) { $history_username = $row['firstname'].' '.$row['lastname']; }
	 //
	 
	$lead_history_info .= "<tr><td class='items'>".$time."</td><td class='items'>".$action."</td><td class='items'>".$details."</td><td class='items'>".$history_username."</td></tr>   ";
  }
  //END GET LEAD HISTORY
  //END GET LEAD HISTORY
  //END GET LEAD HISTORY

  }
} else {



}

?>
<div id="navigation">
<? include 'global_includes/navigation.php'; ?>
</div>
<div id="header">
<!-- NAVIGATION -->
<!-- NAVIGATION -->






<h1>Lead Detail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lead ID - <? echo $lead_id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Original Date - <? echo $orig_date; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
School - 

<? 
//IF EDIT ADD SCHOOL DROP DOWN, IF CREATE SKIP DROPDOWN
if ( $_REQUEST['type'] == 'edit' ){ 
echo "<select name='school' id='school'><option value='0'";

 if ($school_id==0){echo"selected='true'";} 
 
 echo ">SELECT SCHOOL</option>";

$result = mysql_query("SELECT * FROM school");
while($row = mysql_fetch_array($result))
  {
	echo "<option value='".$row["schoolid"]."' ";
	if ($school_id == $row["schoolid"]) {echo "selected='true'"; } 
	echo ">".$row["school"]."</option>"; 
  }
echo "</select>";
}
?>


</h1>


<!-- LEAD BUTTONS -->
<!-- LEAD BUTTONS -->
<input type="button" name="Button" id="update_lead_button" value="Save Changes" style="float:left;"  />
<? if ( $_REQUEST['type'] == 'edit' ){ 
 echo '<input type="button" name="Button" id="delete_lead_button" value="Delete Lead" style="float:left;"  />';
}
?>
<?
if ( $_REQUEST['type'] == 'edit' ){ 
if ($on_yes_list == 'yes'){
	echo '<input type="button" name="edit_yes_list_button" id="edit_yes_list_button" value="Edit Yes List Info" style="float:left" />';
} else {
	echo '
<input type="button" name="add_yes_list_button" id="add_yes_list_button" value="Add Yes List Info" style="float:left" />';
}
}
?>

<div id="lead_update_status"></div>
</div>





<div id="lead_info">
<table width="1010px" style="margin-top:-10px;">
<tr>
<td colspan="4"><h2>Lead Information / Status</h2></td>
</tr>
<tr>
<td >Rep Assigned</td><td  >
<? 

if ( $_REQUEST['type'] == 'edit' ){ 
$result = mysql_query("SELECT * FROM users WHERE role_id='1' AND active = '1' AND $school='1'");

echo "<select name='rep_assigned' id='rep_assigned' style='float:left;'><option>ASSIGN REP</option>";
while($row = mysql_fetch_array($result))
  {
	echo "<option value='".$row["user_id"]."' ";
	if ($rep_id == $row["user_id"]) {echo "selected='true'"; }
	echo ">".$row["firstname"]." ".$row["lastname"]."</option>";
  }
echo "</select>";
}
?>

</td>


<td >Lead Status</td>
<td >
<?
$result = mysql_query("SELECT * FROM lead_status");

echo "<select name='lead_status' id='lead_status'>";
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	echo "<option value='".$row["status"]."' ";
	if ($lead_status == $row["status"]) {echo "selected='true'"; }
	echo ">".$row["status"]."</option>";
  }
echo "</select>";

if ($lead_status=='Contact Attempted'){
	echo "<input type='button' name='log_new_attempt' id='log_new_attempt_button' value='Log New Attempt' style='font-size:11px' />";
	} else if ($lead_status=='Interview Scheduled'){
	echo "<input type='button' name='reschedule_interview_button' id='reschedule_interview_button' value='Reschedule Interview' style='font-size:11px' />";
	}
?>



</td>
</tr>
<tr>
<td width="175px" >Main Source: </td>
<td width="325px" >
<?
$result = mysql_query("SELECT * FROM source_type");

echo "<select name='source_type' id='source_type'><option>SELECT SOURCE</option>";
while($row = mysql_fetch_array($result)) 
{
	//POPULATE SELECT LIST
	echo "<option value='".$row["source_id"]."' ";
	if ($main_source_type == $row["source_id"]) {echo "selected='true'"; }
	echo ">".$row["source"]."</option>";
}
echo "</select>";
?>
</td>
<td width="175px" >
 
</td><td width="325px" >
<? if ($lead_status=='Interview Scheduled'){
	echo '<b>Scheduled for:</b> '.$interview_date;
	}
	?>
</td>
</tr>
</table>



</div>




<div id="left_side">

<!-- CONTACT INFO SECTION -->
<!-- CONTACT INFO SECTION -->
<!-- CONTACT INFO SECTION -->


<div id="contact_info">
<table style="margin-top:-10px;">
<tr>
<td colspan="4"><h2>Contact Information</h2></td>
</tr>
<tr>
<td width="89">First Name:</td><td width="151"><input name="first_name" type="text" id="first_name" value="<? echo $first_name; ?>"></td>
<td width="88">Last Name:</td><td width="152"><input name="last_name" type="text" id="last_name" value="<? echo $last_name; ?>" /></td>
</tr>
<tr>
<td>Middle Name:</td><td><input name="middle_name" type="text" id="middle_name" value="<? echo $middle_name; ?>" /></td>
<td>Maiden Name:</td><td><input name="maiden_name" type="text" id="maiden_name" value="<? echo $maiden_name; ?>" /></td>
</tr>
<tr>
<td>Address 1:</td><td><input name="address_1" type="text" id="address_1" value="<? echo $address1; ?>" /></td><td>City:</td><td><input name="city" type="text" id="city" value="<? echo $city; ?>" /></td>
</tr>
<tr>
<td>Address 2:</td><td><input name="address_2" type="text" id="address_2" value="<? echo $address2; ?>" /></td><td>State:</td><td><input name="state" type="text" id="state" value="<? echo $state; ?>" /></td>
</tr>
<tr>
<td>County:</td><td><input name="county" type="text" id="county" value="<? echo $county; ?>"/></td><td>Zip Code:</td><td><input name="zip" type="text" id="zip" value="<? echo $zip; ?>" /></td>
</tr>
<tr>
<td>Home Phone:</td><td><input name="home_phone" type="text" id="home_phone" value="<? echo $phone; ?>" /></td><td>Cell Phone:</td><td><input name="cell_phone" type="text" id="cell_phone" value="<? echo $cell_phone; ?>" /></td>
</tr>
<tr>
<td>
<? if ($email != ''){
	echo "<a href='mailto:".$email."' class='text_link'>Email:</a>";
}else {
	echo 'Email:';
}

?>
</td><td><input name="email" type="text" id="email" value="<? echo $email; ?>" /></td><td></td><td></td>
</tr>
<tr>
<td>High School:</td><td><input name="high_school" type="text" id="high_school" value="<? echo $high_school; ?>" /></td><td>Grad Year:</td><td><input name="grad_year" type="text" id="grad_year" value="<? if ($grad_year == 0) { echo ""; } else { echo $grad_year; } ?>" /></td>
</tr>
</table>
</div>


<div id="comments_section">

<table  style="margin-top:-10px; padding-bottom:12px;">
<tr>
<td ><h2>Comments</h2></td>
</tr>
<tr>
<td ><textarea cols="58" id="comments" rows="7"><? echo $comments; ?></textarea></td>
</tr>
</table>
</div>



</div>


<!-- END LEFT SIDE -->
<!-- END LEFT SIDE -->
<!-- END LEFT SIDE -->

<!-- START RIGHT SIDE -->
<!-- START RIGHT SIDE -->
<!-- START RIGHT SIDE -->

<div id="right_side">

<!-- PROGRAMS OF INTEREST SECTION -->
<!-- PROGRAMS OF INTEREST SECTION -->
<!-- PROGRAMS OF INTEREST SECTION -->


<div id="program_interest">

<table width="500px" style="margin-top:-10px;">
<tr>
<td colspan="4"><h2>Programs of Interest</h2></td>
</tr>
<tr>
<td colspan="2"><span class="subhead3">GLIT</span></td>
<td colspan="2"><span class="subhead3">EIT</span></td>
</tr>
<tr>
<td width="169">Dental Assistant</td><td width="62"><input name="da" type="checkbox" id="da" <? echo $int_da; ?> /> 
PM <input name="dae" type="checkbox" id="dae" <? echo $int_dae; ?> /></td>

<td width="192">Biomedical Equipment Technology</td><td width="40"><input name="bmt" type="checkbox" id="bmt" <? echo $int_bmt; ?>/></td>
</tr>
<tr>
<td>Diagnostic Medical Sonographer</td><td><input name="dms" type="checkbox" id="dms" <? echo $int_dms; ?> /></td>
<td>Business Office Professional</td><td><input name="bop" type="checkbox" id="bop" <? echo $int_oss; ?>/></td>
</tr>
<tr>
<td>Health Information Technology</td><td><input name="hit" type="checkbox" id="hit" <? echo $int_hit; ?> /></td>
<td>CNC / Machinist Technician</td><td><input name="cnc" type="checkbox" id="cnc" <? echo $int_cnc; ?> /></td>
</tr>
<tr>
<td>Massage Therapist</td><td><input name="ma" type="checkbox" id="mt" <? echo $int_mt; ?>/></td>
<td>Electrician</td><td><input name="elc" type="checkbox" id="elc" <? echo $int_elc; ?>/></td>
</tr>
<tr>
<td>Medical Assistant</td><td><input name="ma" type="checkbox" id="ma" <? echo $int_ma; ?>/> 
PM <input name="mae" type="checkbox" id="mae" <? echo $int_mae; ?>/></td>
<td>Electronics Engineering Technology</td><td><input name="eet" type="checkbox" id="eet" <? echo $int_cet; ?>/></td>
</tr>
<tr>
<td>Medical Billing and Coding</td><td><input name="mbc" type="checkbox" id="mbc" <? echo $int_mbc; ?> /></td>
<td>Electronics Technician</td><td><input name="et" type="checkbox" id="et" <? echo $int_bet; ?>/></td>
</tr>
<tr>
<td>Medical Office Assistant</td><td><input name="moa" type="checkbox" id="moa" <? echo $int_ms; ?>/></td>
<td>Industrial Automation Robotics</td><td><input name="iart" type="checkbox" id="iart" <? echo $int_iar; ?> /></td>
</tr>
<tr>
<td>Patient Care Technician</td><td><input name="pct" type="checkbox" id="pct" <? echo $int_gpct; ?> /></td>
<td>Maintenance Technician</td><td><input name="mt" type="checkbox" id="mnt" <? echo $int_main; ?>/></td>
</tr>
<tr>
<td>Pharmacy Technician</td><td><input name="pt" type="checkbox" id="pt" <? echo $int_pt; ?>/></td>
<td>Multimedia Graphic Design</td><td><input name="mgd" type="checkbox" id="mgd" <? echo $int_mdg; ?> /></td>
</tr>
<tr>
<td>Phlebotomy Technician</td><td><input name="phleb" type="checkbox" id="phleb" <? echo $int_phleb; ?> /></td>
<td>Network &amp; Database Prof.</td><td><input name="ndp" type="checkbox" id="ndp" <? echo $int_ndp; ?>  /></td>
</tr>
<tr>
<td>Surgical Technologist</td><td><input name="st" type="checkbox" id="st" <? echo $int_st; ?> /></td>
<td>RHVAC Technology</td><td><input name="hvac" type="checkbox"  id="rhvac" <? echo $int_rhvac; ?>/></td>
</tr>
<tr>
<td>Veterinary Assistant</td><td><input name="va" type="checkbox" id="va" <? echo $int_va; ?>/></td>
<td>Welding Technology</td><td><input name="weld" type="checkbox" id="weld" <? echo $int_weld; ?>/></td>
</tr>
<tr>
<td colspan="4" style="padding-top:8px"><span class="subhead3">Toni &amp; Guy</span></td>
</tr>
<tr>
<td>Cosmetology</td><td><input name="cos" type="checkbox" id="cos" <? echo $int_cos; ?> /> PM <input name="cose" type="checkbox" id="cose" <? echo $int_cose; ?>/></td>
<td>Cosmetology Teacher</td><td><input name="cost" type="checkbox" id="cost" <? echo $int_cost; ?> /> PM <input name="coste" type="checkbox" id="coste" <? echo $int_coste; ?> /> </td>
</tr>
<tr>
<td>Manicurist</td>
<td><input name="man" type="checkbox" id="man" <? echo $int_man; ?> /></td>
<td>Cosmetology Trans.</td><td><input name="costr" type="checkbox" id="costr" <? echo $int_costr; ?> /></td>
</tr>
</table>
</div>



</div>


<div id="lead_history">

<table width="1010px" style="margin-top:-10px">
<tr>
<td colspan="4"><h2>Lead History</h2></td>
</tr>
<tr>
<td width="175px" height="20px" valign="top" class="headers" >Date / Time</td>
<td width="150px" height="20px" valign="top" class="headers">Action</td>
<td width="485px" height="20px" valign="top" class="headers">Details</td>
<td width="200px" height="20px" valign="top" class="headers">User</td>
</tr>

<? echo $lead_history_info; ?>




</table>


</div>






</div>







</body>
</html>