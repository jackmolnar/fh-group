<?
//GENERAL FUNCTIONS
//GENERAL FUNCTIONS
//GENERAL FUNCTIONS

function date_clean_to_sql ($fdate, $tdate) {
$from_date_array = explode("/", $fdate);
	$to_date_array = explode("/", $tdate);
	global $from_date_string, $to_date_string;
	$from_date_string = $from_date_array[2].$from_date_array[0].$from_date_array[1];
	$to_date_string = $to_date_array[2].$to_date_array[0].$to_date_array[1];
	return $from_date_string;
	return $to_date_string;
}

function date_sql_to_clean ($sql_date){
	$sql_date_array = explode("-", $sql_date);
	global $clean_date;
	$clean_date = $sql_date_array[1].'/'. $sql_date_array[2].'/'. $sql_date_array[0];
	return $clean_date;
}

function get_current_date(){
	$my_t=getdate(date("U"));
	$current_date = $my_t[mon].'/'. $my_t[mday].'/'. $my_t[year];
	echo $current_date;
}

function get_current_date_sql(){
	$my_t=getdate(date("U"));
	$current_date = $my_t[year].'-'. $my_t[mon].'-'. $my_t[mday] ;
	return $current_date;
}

function destroy_session_and_data(){
	session_start();
	$_SESSION = array();
	if (session_id() != "" || isset($_COOKIE[session_name()]))
	setcookie(session_name(), '', time() - 2592000, '/');
	session_destroy();
}


function check_login (){
	if (isset($_SESSION['username'])){
	$username= $_SESSION['username'];
	$password= $_SESSION['password'] ;
	$firstname= $_SESSION['firstname'] ;
	$lastname=$_SESSION['lastname'] ;
	$role=$_SESSION['role'];
	$user_id=$_SESSION['user_id'];
	} else {
	echo 'You Have Been Logged Out.
	<br><br>
	<a href="index.php">Click Here to Log In.</a>';
	destroy_session_and_data();
	}
}

function get_time_from_sql_timestamp($t){
  $php_timestamp = strtotime($t);
  $lead_time_hour = date('H' , $php_timestamp);
  $lead_time_minute = date('i' , $php_timestamp);
  $lead_time_hour +=3;
  if ($lead_time_hour>12) { $lead_time_hour -=12; $am_pm = 'pm'; } else if ($lead_time_hour==12) {$am_pm='pm';} else if ($lead_time_hour>24) { $lead_time_hour -=24; $am_pm='am'; } else { $am_pm = 'am'; }
  $lead_time_final = $lead_time_hour.':'.$lead_time_minute.' '.$am_pm;
  return $lead_time_final;
}

function get_school_from_lead ($schoolid){
	$result = mysql_query("SELECT * FROM school WHERE schoolid=$schoolid");
	while($row = mysql_fetch_array($result))
  	{
	  	$school_name = $row['school'];
 	}
	return $school_name;
}

//HISTORY FUNCTIONS
//HISTORY FUNCTIONS
//HISTORY FUNCTIONS
function history_created ($lead_id, $created_user){
	$result = mysql_query("SELECT * FROM leads WHERE LeadsId=$lead_id");
	while($row = mysql_fetch_array($result))
  	{
	  	$create_time_stamp = $row['ProsTimeStamp'];
 	}
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', '$create_time_stamp', 'Lead Created', '', '$created_user')");
}

function history_opened ($lead_id, $opened_user){
	$opened_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', '$opened_timestamp', 'Lead Opened', '', '$opened_user')");
}

function history_applied ($lead_id, $applied_user, $detail_text){
	$applied_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', '$applied_timestamp', 'Applied', '$detail_text', '$applied_user')");
}

function history_interview_scheduled ($lead_id, $interview_user, $detail_text, $interview_timestamp){
	$interview_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$interview_timestamp', 'Interview Scheduled', '$detail_text', '$interview_user')");
}

function history_interview_rescheduled ($lead_id, $interview_user, $detail_text, $interview_timestamp){
	$interview_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$interview_timestamp', 'Interview Rescheduled', '$detail_text', '$interview_user')");
}

function history_interview_canceled ($lead_id, $interview_user, $detail_text){
	$interview_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$interview_timestamp', 'Interview Canceled', '$detail_text', '$interview_user')");
}

function history_interview_showed ($lead_id, $interview_user, $detail_text){
	$interview_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$interview_timestamp', 'Interview Showed', '$detail_text', '$interview_user')");
}

function history_interview_no_showed ($lead_id, $interview_user, $detail_text){
	$interview_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$interview_timestamp', 'Interview No Show', '$detail_text', '$interview_user')");
}

function history_new_rep_assigned ($lead_id, $assigning_user, $detail_text){
	$rep_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', '$rep_timestamp', 'New Rep Assigned', '$detail_text', '$assigning_user')");
	
}

function history_contact_attempted ($lead_id, $attempting_user, $detail_text){
	$contact_attempted_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$contact_attempted_timestamp', 'Contact Attempted', '$detail_text', '$attempting_user')");
}
function history_contacted ($lead_id, $attempting_user, $detail_text){
	$contacted_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$contacted_timestamp', 'Contacted', '$detail_text', '$attempting_user')");
}

function history_added_yes_list ($lead_id, $adding_user){
	$added_yes_list_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$added_yes_list_timestamp', 'Added to Yes List', '', '$adding_user')");
}

function history_edited_yes_list ($lead_id, $adding_user){
	$edited_yes_list_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', 					'$edited_yes_list_timestamp', 'Edited Yes List', '', '$adding_user')");
}

function history_close_lead ($lead_id, $closing_user, $close_details){
	$close_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', '$close_timestamp', 'Closed Lead', '$close_details', '$closing_user')");
}

function history_reviewed_by_rep ($lead_id, $viewing_user){
	$view_timestamp = time();
	mysql_query("INSERT INTO db33581_leads_db.lead_history (LeadsId, time_stamp, action, details, user_id) VALUES ('$lead_id', '$view_timestamp', 'Lead Reviewed by Assigned Rep', '', '$viewing_user')");
}

//REMINDER FUNCTIONS
//REMINDER FUNCTIONS
//REMINDER FUNCTIONS

function reminder_get_lead_reminder ($reminder_id){
			
	$result = mysql_query("SELECT * FROM reminders WHERE reminder_id='$reminder_id'");
	while($row = mysql_fetch_array($result))
  		{
			$reminder_id = $row['reminder_id'];
			$reminder_action = $row['reminder_action'];
			$reminder_details = $row['details'];
			$reminder_status = $row['reminder_status'];
			$reminder_time_stamp = date('h:i A',$row['time_stamp']);

			if ($reminder_status == 'Open'){
				
			echo '<div id="reminder_tab" "><span style="font-weight:bold;">'.$reminder_action.' - '.$reminder_time_stamp.'</span><span id="close_reminder"><img src="images/close.png" alt="Delete Reminder"></span><br>'.$reminder_details.'<input type="hidden" id="reminder_id" value="'.$reminder_id.'" ></div>';
			}
 		}
}


function reminder_interview_scheduled ($lead_id, $reminder_time, $detail_text, $user_id){
	mysql_query("INSERT INTO db33581_leads_db.reminders (LeadsId, time_stamp, reminder_action, details, user_id, reminder_status) VALUES ('$lead_id', '$reminder_time', 'Interview Scheduled', '$detail_text', '$user_id', 'Open')");
}

function reminder_attempt_contact ($lead_id, $reminder_time, $detail_text, $user_id){
	mysql_query("INSERT INTO db33581_leads_db.reminders (reminder_id, LeadsId, time_stamp, reminder_action, details, user_id, reminder_status) VALUES ('null', '$lead_id', '$reminder_time', 'Attempt Contact', '$detail_text', '$user_id', 'Open')");
}

function reminder_add_new ($reminder_time, $action, $detail_text, $user_id){
	mysql_query("INSERT INTO db33581_leads_db.reminders (reminder_id, time_stamp, reminder_action, details, user_id, reminder_status) VALUES ('null', '$reminder_time', '$action', '$detail_text', '$user_id', 'Open')");
}

//DASHBOARD FUNCTIONS
//DASHBOARD FUNCTIONS
//DASHBOARD FUNCTIONS
function get_latest_history ($lead_id){
	 $result = mysql_query("SELECT * FROM lead_history WHERE LeadsId='$lead_id' ORDER BY history_id DESC LIMIT 1");
while($row = mysql_fetch_array($result))
	{
	$last_hist_time = date('m/d/y - h:i A', $row['time_stamp']);
	return $last_hist_time; 
	}
}

//YES LIST FUNCTIONS
//YES LIST FUNCTIONS
//YES LIST FUNCTIONS

function create_blank_form ($school_id){

$blank_form .= '
<h2>Yes List</h2>

<div id="save_yes_box_status" style="margin-bottom:10px; color:#900;"> </div>

<form id="yes_list_form">
<div id="yes_list" style="border:thin #666; width:700px; text-align:center;">
<table width="700px">
<tr><td>

<div id="general_info" style="text-align:center; margin-top:-10px; width:700px;">
<table width="700px" style="text-align:left;" >
<tr><td colspan="6"><h3>General Info</h3></td></tr>
<tr>
<td style="text-align: right">Status:</td><td style="text-align: left"><select name="status" id="status"><option value="no">No</option><option value="maybe">Maybe</option><option value="yes">Yes</option></select></td>
<td style="text-align: right">Program:</td>
<td>
<select id="program" name="program">';

$result = mysql_query("SELECT * FROM programs WHERE schoolid='$school_id' AND active=1");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	$blank_form.='<option value="'.$row["ProgramId"].'">'.$row["ProgramName"].'</option>';
  }
  
$blank_form.='
</select>
</td>
<td style="text-align: right">Schedule Date</td><td><input type="text" name="date_time_picker_start" id="date_time_picker_start" /></td>
</tr>
</table>
</div>

<div id="supply_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Welcome Letters</h3></td></tr>
<tr>
<td style="text-align: right">Orientation Letter</td><td style="text-align: left"><input type="checkbox" id="orient_letter" name="orient_letter" /></td>

<td style="text-align: right">Program Director</td><td style="text-align: left"><input type="checkbox" id="prog_dir_letter" name="prog_dir_letter" /></td>
<td style="text-align: right">Placement</td><td style="text-align: left"><input type="checkbox" id="placement_letter" name="placement_letter" /></td>
</tr>
<tr>
<td style="text-align: right">Director of Ed.</td><td style="text-align: left"><input type="checkbox" id="dir_ed_letter" name="dir_ed_letter" /></td>
<td style="text-align: right">Executive Director</td><td style="text-align: left"><input type="checkbox" id="exec_dir_letter" name="exec_dir_letter" /></td><td style="text-align: right"></td><td style="text-align: left"></td>
</tr>
</table>
</div>

<div id="transfer_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Transfer Info</h3></td></tr>
<tr>
<td>Trans In:</td><td><input type="radio" name="trans_in_out" value="in"/></td><td>Trans Out:</td><td><input type="radio" name="trans_in_out" value="out"/></td><td>Class</td><td><input type="text" id="trans_class" name="trans_class" /></td>
</tr>
</table>
</div>

<div id="financial_aid_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="3"><h3>Financial Aid</h3></td></tr>
<tr>
<td width="168">FA Date:</td><td width="163"><input type="text" name="date_time_picker_fa" id="date_time_picker_fa" /></td><td width="335" >Comments</td>
</tr>
<tr>
<td>FA Status:</td>
<td>
<select id="fa_status" name="fa_status">';

$result = mysql_query("SELECT * FROM fa_status");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	$blank_form.='<option value="'.$row["fa_status"].'">'.$row["fa_status"].'</option>';
  }

$blank_form.='
</select>
</td><td rowspan="2"><textarea id="fa_comments" name="fa_comments" cols="50"></textarea></td>
</tr>
<tr>
<td>FA Rep</td>
<td>
<select id="fa_rep" name="fa_rep">';

$result = mysql_query("SELECT * FROM school WHERE schoolid = '$school_id'");
while($row = mysql_fetch_array($result))
  {
	//GET SCHOOL
	$school_name = $row["school"];
  }

$result = mysql_query("SELECT * FROM users WHERE role_id = 3 AND '$school_name'=1");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	$blank_form .='<option value="'.$row["user_id"].'">'.$row["firstname"].' '.$row["lastname"].'</option>';
  }

$blank_form.='
</select>
</td>
</tr>
</table>
</div>

<div id="enrollment components" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="8"><h3>Enrollment Components</h3></td></tr>
<tr>
<td width="114" style="text-align: right">100 Paid:</td><td width="74" style="text-align: left"><input type="checkbox" id="100_paid" name="100_paid" /></td><td width="98" style="text-align: right" >Enrollment</td><td width="65" style="text-align: left"><input type="checkbox" id="enrollment" name="enrollment" /></td><td width="128" style="text-align: right">Transcript</td><td width="59" style="text-align: left"><input type="checkbox" id="transcript" name="transcript" /></td><td width="106" style="text-align: right" >Physical</td><td width="20" style="text-align: left"><input type="checkbox" id="physical" name="physical" /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Immunization</td><td style="text-align: left"><input type="checkbox" id="immunization" name="immunization" /></td><td style="text-align: right" >Drug Test</td><td style="text-align: left"><input type="checkbox" id="drug_test" name="drug_test" /></td><td style="text-align: right">Criminal Rec.</td><td style="text-align: left"><input type="checkbox" id="crim_rec" name="crim_rec" /></td><td style="text-align: right" >Child Abuse</td><td style="text-align: left"><input type="checkbox" id="child_abuse" name="child_abuse" /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Buck Am</td><td style="text-align: left"><input type="checkbox" id="buck_am" name="buck_am" /></td><td style="text-align: right" >Cat Sheet</td><td style="text-align: left"><input type="checkbox" id="cat_sheet" name="cat_sheet" /></td><td style="text-align: right">Acceptance</td><td style="text-align: left"><input type="checkbox" id="acceptance" name="acceptance" /></td><td style="text-align: right" ></td><td style="text-align: left"></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right"></td><td style="text-align: left"></td><td style="text-align: right" >Test</td><td><input type="text" name="test" id="test" /></td><td style="text-align: right">Agency</td><td>value</td><td ></td><td></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Comments</td><td colspan="7"><textarea id="gen_comments" name="gen_comments" cols="75"></textarea></td>
</tr>
</table>
</div>

<input type="button" class="add_button" style="font-size:12px;" value="Add to Yes List" / ><br><br>

<a href="" class="continue_button" >Click Here to Cancel</a>

</td>
</tr>
</table>
</form>';

return $blank_form;

};


function get_starting_yes_list ($yid, $school_id) {
$result = mysql_query("SELECT * FROM yes_list WHERE YId='$yid' ");

while($row = mysql_fetch_array($result))
  {
	  $y_id = $row['YId'];
	  $lead_id = $row['LeadsId'];
	  $y_class = $row['YClass'];
	  $y_yes = $row['YYes'];
	  $y_maybe = $row['YMaybe'];
	  $y_no = $row['YNo'];
	  if ($row['YTransIn']=='Y') {$trans_in= 'checked';}else{$trans_in= '';}
	  if ($row['YTransOut']=='Y') {$trans_out= 'checked';}else{$trans_out= '';}
	  $program2 = $row['YProgram'];
	  if ($row['YFADate'] != ''){ $fa_date = date("m/d/Y", $row['YFADate']); };
	  $fa_status = $row['YFAStatus'];
	  $fa_rep = $row['YFARep'];
	  if ($row['Y100Paid']=='on') {$hun_paid= 'checked';}else{$hun_paid= '';}
	  if ($row['YHSTransGEI']=='on') {$transcript= 'checked';}else{$transcript= '';}
	  if ($row['YPhys']=='on') {$physical= 'checked';}else{$physical= '';}
	  if ($row['YImmune']=='on') {$immunization= 'checked';}else{$immunization= '';}
	  if ($row['YBuckAm']=='on') {$buck_am= 'checked';}else{$buck_am= '';}
	  if ($row['YCatSheet']=='on') {$cat_sheet= 'checked';}else{$cat_sheet= '';}
	  if ($row['YPants']=='on') {$placement_letter= 'checked';}else{$placement_letter= '';}
	  if ($row['YShirt']=='on') {$prog_dir_letter= 'checked';}else{$prog_dir_letter= '';}
	  if ($row['YCoat']=='on') {$dir_ed_letter= 'checked';}else{$dir_ed_letter= '';}
	  if ($row['YCrimRec']=='on') {$crim_rec= 'checked';}else{$crim_rec= '';}
	  if ($row['YDrugTest']=='on') {$drug_test= 'checked';}else{$drug_test= '';}
	  if ($row['YClearanceNot']=='on') {$exec_dir_letter= 'checked';}else{$exec_dir_letter= '';}
	  if ($row['YTest']=='on') {$test= 'checked';}else{$test= '';}
	  if ($row['YChildAbuse']=='on') {$child_abuse= 'checked';}else{$child_abuse= '';}
	  if ($row['YAcceptance']=='on') {$acceptance= 'checked';}else{$acceptance= '';}
	  if ($row['YComplete']=='on') {$complete= 'checked';}else{$complete= '';}
	  if ($row['YPrereq']=='on') {$orient_letter= 'checked';}else{$orient_letter= '';}
	  $gen_comments = $row['YComments'];
	  if ($row['YEnrollment']=='on') {$enrollment= 'checked';}else{$enrollment= '';}
	  $fa_comments = $row['YFAComments'];  
	  $reason_not_coming = $row['YReasonNotComing'];
	  $key = $row['YKey'];
	  if ($row['ScStDate'] != '') {$start_date = date("m/d/Y", $row['ScStDate']);};
	  $program2 = $row['Program'];
	  $YShift = $row['shift'];
	  $YTimeStamp = $row['current_timestamp'];
	  $Username = $row['username'];
	  $Yagency = $row['agency'];
	  
	  switch (1)
		{
		case $y_yes : $y_yes = 'selected'; $y_maybe=''; $y_no='';
		break;
		case $y_maybe : $y_yes = ''; $y_maybe='selected'; $y_no='';
		break;
		case $y_no : $y_yes = ''; $y_maybe=''; $y_no='selected';
		break;
		}//end switch
	  
	  
	 $tabs_content_html .='
<h2>Yes List</h2>
<div id="save_yes_box_status" style="margin-bottom:10px; color:#900;"> </div>
<form id="yes_list_form'.$tab_count.'">
<div id="yes_list" style="border:thin #666; width:700px; text-align:center;">
<table width="700px">
<tr><td>

<div id="general_info" style="text-align:center; margin-top:-10px; width:700px;">
<table width="700px" style="text-align:left;" >
<tr><td colspan="6"><h3>General Info</h3></td></tr>
<tr>
<td style="text-align: right">Status:</td><td style="text-align: left"><select name="status" id="status"><option value="no" '. $y_no.'>No</option><option value="maybe" '. $y_maybe.'>Maybe</option><option value="yes" '. $y_yes.'>Yes</option></select></td>
<td style="text-align: right">Program:</td>
<td>
<select id="program" name="program">';



$result = mysql_query("SELECT * FROM programs WHERE schoolid='$school_id' AND active=1");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	if ($program2 == $row["ProgramId"]){
	 $tabs_content_html .= "<option value='".$row["ProgramId"]."' selected='selected'>".$row["ProgramName"]."</option>";
	} else {
	 $tabs_content_html .= "<option value='".$row["ProgramId"]."'>".$row["ProgramName"]."</option>";
	}
  }


$tabs_content_html .= '
</select>
</td>
<td style="text-align: right">Schedule Date</td><td><input type="text" name="date_time_picker_start" id="date_time_picker_start" value="'. $start_date.'" /></td>
</tr>
</table>
</div>

<div id="supply_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Welcome Letters</h3></td></tr>
<tr>
<td style="text-align: right">Orientation Letter</td><td style="text-align: left"><input type="checkbox" id="orient_letter" name="orient_letter" 
'.$orient_letter.' /></td>

<td style="text-align: right">Program Director</td><td style="text-align: left"><input type="checkbox" id="prog_dir_letter" name="prog_dir_letter" '. $prog_dir_letter.' /></td>
<td style="text-align: right">Placement</td><td style="text-align: left"><input type="checkbox" id="placement_letter" name="placement_letter" '. $placement_letter.' /></td>
</tr>
<tr>
<td style="text-align: right">Director of Ed.</td><td style="text-align: left"><input type="checkbox" id="dir_ed_letter" name="dir_ed_letter" '. $dir_ed_letter.' /></td>
<td style="text-align: right">Executive Director</td><td style="text-align: left"><input type="checkbox" id="exec_dir_letter" name="exec_dir_letter" '. $exec_dir_letter.' /></td><td style="text-align: right"></td><td style="text-align: left"></td>
</tr>
</table>
</div>

<div id="transfer_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Transfer Info</h3></td></tr>
<tr>
<td>Trans In:</td><td><input type="radio" name="trans_in_out" value="in" '. $trans_in.'/></td><td>Trans Out:</td><td><input type="radio" name="trans_in_out" value="out" '. $trans_out.'/></td><td>Class</td><td><input type="text" id="trans_class" name="trans_class" /></td>
</tr>
</table>
</div>

<div id="financial_aid_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="3"><h3>Financial Aid</h3></td></tr>
<tr>
<td width="168">FA Date:</td><td width="163"><input type="text" name="date_time_picker_fa" id="date_time_picker_fa" value="'. $fa_date.'" /></td><td width="335" >Comments</td>
</tr>
<tr>
<td>FA Status:</td>
<td>
<select id="fa_status" name="fa_status">';

$result = mysql_query("SELECT * FROM fa_status");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	if ($fa_status == $row["fa_status_id"]) {
		$tabs_content_html .= "<option value='".$row["fa_status_id"]."' selected='selected'>".$row["fa_status"]."</option>";
	} else {
		$tabs_content_html .= "<option value='".$row["fa_status_id"]."' >".$row["fa_status"]."</option>";
	}
  }

$tabs_content_html .= '
</select>
</td><td rowspan="2"><textarea id="fa_comments" name="fa_comments" cols="50">'. $fa_comments.'</textarea></td>
</tr>
<tr>
<td>FA Rep</td>
<td>
<select id="fa_rep" name="fa_rep">';


$result = mysql_query("SELECT * FROM school WHERE schoolid = '$school_id'");
while($row = mysql_fetch_array($result))
  {
	//GET SCHOOL NAME
	$school_name = $row['school'];
  }

$result = mysql_query("SELECT * FROM users WHERE role_id = 3 AND '$school_name'=1");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	if ($fa_rep == $row['user_id']){
	$tabs_content_html .= "<option value='".$row["user_id"]."' selected='selected'>".$row["firstname"]." ".$row["lastname"]."</option>";
	} else {
	$tabs_content_html .= "<option value='".$row["user_id"]."' >".$row["firstname"]." ".$row["lastname"]."</option>";
	}
  }

$tabs_content_html .= '
</select>
</td>
</tr>
</table>
</div>

<div id="enrollment components" style="width:680px;">
<table width="680px" style="text-align:center;">
<tr><td colspan="8"><h3>Enrollment Components</h3></td></tr>
<tr>
<td width="114" style="text-align: right">100 Paid:</td><td width="74" style="text-align: left"><input type="checkbox" id="100_paid" name="100_paid" '. $hun_paid.'  /></td><td width="98" style="text-align: right" >Enrollment</td><td width="65" style="text-align: left"><input type="checkbox" id="enrollment" name="enrollment" '. $enrollment.' /></td><td width="128" style="text-align: right">Transcript</td><td width="59" style="text-align: left"><input type="checkbox" id="transcript" name="transcript" '. $transcript.' /></td><td width="106" style="text-align: right" >Physical</td><td width="20" style="text-align: left"><input type="checkbox" id="physical" name="physical" '. $physical.' /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Immunization</td><td style="text-align: left"><input type="checkbox" id="immunization" name="immunization" '. $immunization.' /></td><td style="text-align: right" >Drug Test</td><td style="text-align: left"><input type="checkbox" id="drug_test" name="drug_test" '. $drug_test.' /></td><td style="text-align: right">Criminal Rec.</td><td style="text-align: left"><input type="checkbox" id="crim_rec" name="crim_rec" '. $crim_rec.' /></td><td style="text-align: right" >Child Abuse</td><td style="text-align: left"><input type="checkbox" id="child_abuse" name="child_abuse" '. $child_abuse .' /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Buck Am</td><td style="text-align: left"><input type="checkbox" id="buck_am" name="buck_am" '. $buck_am.' /></td><td style="text-align: right" >Cat Sheet</td><td style="text-align: left"><input type="checkbox" id="cat_sheet" name="cat_sheet" '. $cat_sheet.' /></td><td style="text-align: right">Acceptance</td><td style="text-align: left"><input type="checkbox" id="acceptance" name="acceptance" '. $acceptance .' /></td><td style="text-align: right" ></td><td style="text-align: left"></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right"></td><td style="text-align: left"></td><td style="text-align: right" >Test</td><td><input type="text" name="test" id="test" 
'. $test.' /></td><td style="text-align: right">Agency</td><td>value</td><td ></td><td></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Comments</td><td colspan="7"><textarea id="gen_comments" name="gen_comments" cols="75">'. $gen_comments.'</textarea></td>
</tr>
</table>
</div>

<input type="button" class="edit_button" style="font-size:12px;" value="Update Yes List"/><br><br>

<a href="" class="continue_button" >Click Here to Cancel</a>

</td>
</tr>
</table>
</div>
</form>
'; 

  }//end while
  
  return $tabs_content_html;
  
}//end function






?>