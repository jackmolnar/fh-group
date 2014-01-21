<?php

include ('../global_includes/connect.php');
include ('../global_includes/functions.php');



$error=0;

$action_type = $_GET['type'];
$lead_id = $_GET['lead_id'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$middle_name = $_POST['middle_name'];
$maiden_name = $_POST['maiden_name'];
$address_1 = $_POST['address_1'];
$address_2 = $_POST['address_1'];
$city = $_POST['city'];
$state = $_POST['state'];
$county = $_POST['county'];
$zip = $_POST['zip'];
$country = $_POST['country'];
$cell_phone = $_POST['cell_phone'];
$home_phone = $_POST['home_phone'];
$email = $_POST['email'];
$comments = $_POST['comments'];
$high_school = $_POST['high_school'];
$grad_year = $_POST['grad_year'];
if($_POST['da']=='checked') {$int_da = 1;} else {$int_da = 0;}
if($_POST['dae']=='checked') {$int_dae = 1;} else {$int_dae = 0;}
if($_POST['dms']=='checked') {$int_dms = 1;} else {$int_dms = 0;}
if($_POST['ma']=='checked') {$int_ma = 1;} else {$int_ma = 0;}
if($_POST['mae']=='checked') {$int_mae = 1;} else {$int_mae = 0;}
if($_POST['hit']=='checked') {$int_hit = 1;} else {$int_hit = 0;}
if($_POST['moa']=='checked') {$int_moa = 1;} else {$int_moa = 0;}
if($_POST['mt']=='checked') {$int_mt = 1;} else {$int_mt = 0;}
if($_POST['mbc']=='checked') {$int_mbc = 1;} else {$int_mbc = 0;}
if($_POST['pct']=='checked') {$int_pct = 1;} else {$int_pct = 0;}
if($_POST['pt']=='checked') {$int_pt = 1;} else {$int_pt = 0;}
if($_POST['phleb']=='checked') {$int_phleb = 1;} else {$int_phleb = 0;}
if($_POST['st']=='checked') {$int_st = 1;} else {$int_st = 0;}
if($_POST['va']=='checked') {$int_va = 1;} else {$int_va = 0;}
if($_POST['bmt']=='checked') {$int_bmt = 1;} else {$int_bmt = 0;}
if($_POST['bop']=='checked') {$int_bop = 1;} else {$int_bop = 0;}
if($_POST['cnc']=='checked') {$int_cnc = 1;} else {$int_cnc = 0;}
if($_POST['elc']=='checked') {$int_elc = 1;} else {$int_elc = 0;}
if($_POST['eet']=='checked') {$int_eet = 1;} else {$int_eet = 0;}
if($_POST['bet']=='checked') {$int_et = 1;} else {$int_et = 0;}
if($_POST['iart']=='checked') {$int_iart = 1;} else {$int_iart = 0;}
if($_POST['mnt']=='checked') {$int_mnt = 1;} else {$int_mnt = 0;}
if($_POST['mgd']=='checked') {$int_mgd = 1;} else {$int_mgd = 0;}
if($_POST['ndp']=='checked') {$int_ndp = 1;} else {$int_ndp = 0;}
if($_POST['weld']=='checked') {$int_weld = 1;} else {$int_weld = 0;}
if($_POST['rhvac']=='checked') {$int_rhvac = 1;} else {$int_rhvac = 0;}
if($_POST['cosmo']=='checked') {$int_cos = 1;} else {$int_cos = 0;}
if($_POST['cosmoe']=='checked') {$int_cose = 1;} else {$int_cose = 0;}
if($_POST['cost']=='checked') {$int_cost = 1;} else {$int_cost = 0;}
if($_POST['coste']=='checked') {$int_coste = 1;} else {$int_coste = 0;}
if($_POST['man']=='checked') {$int_man = 1;} else {$int_man = 0;}
if($_POST['costr']=='checked') {$int_costr = 1;} else {$int_costr = 0;}


//GET LEAD STATUS ID
$lead_status = $_POST['leadstatus'];
$result = mysql_query("SELECT * FROM lead_status WHERE status='$lead_status'");
while($row = mysql_fetch_array($result))
  {
	$StatusId = $row['id'];
  }
//

if ($action_type == 'create'){
	
	$current_time = time();
	$orig_date = get_current_date_sql();

switch ('')
{
	case $first_name : echo 'You Must Enter a First Name'; $error=1;
	break;
	case $last_name : echo 'You Must Enter a Last Name'; $error=1;
	break;
	case $home_phone : echo 'You Must Enter a Home Phone'; $error=1;
	break;
	case $email : echo 'You Must Enter an Email Address'; $error =1;
	break;
	
	default: mysql_query("INSERT INTO db33581_leads_db.leads (LeadsId, ProsFirstName, ProsLastName, ProsMiddleName, ProsMaiden, ProsAddress1, ProsAddress2, ProsCity, ProsState, ProsCounty, ProsZip, ProsCell, ProsPhone, ProsEmail, ProsComments, ProsHighSchool, ProsGradYear, OrigDate, ProIntDA, ProIntDAE, ProIntDMS, ProIntMA, ProIntMAE, ProIntMS, ProIntPT, ProIntST, ProIntVA, ProIntMT, ProIntCOS, ProIntCOSE, ProCOST, ProIntCOSTE, ProIntMDG, ProIntNDP, ProIntGPCT, ProIntBET, ProIntBMT, ProIntOSS, ProIntMAN, ProIntIAR, ProIntGPhleb, ProIntGMBC, ProIntECNC, ProIntEMAIN, ProIntEWELD, ProIntERHVAC, ProIntEGHIT, ProIntCOSTR, ProIntEELC, ProsTimeStamp, StatusId) VALUES ('$lead_id', '$first_name', '$last_name', '$middle_name', '$maiden_name', '$address_1', '$address_2', '$city', '$state', '$county', '$zip', '$cell_phone', '$home_phone', '$email', '$comments', '$high_school', '$grad_year', '$orig_date', '$int_da', '$int_dae', '$int_dms', '$int_ma', '$int_mae', '$int_moa', '$int_pt', '$int_st', '$int_va', '$int_mt', '$int_cos', '$int_cose', '$int_cost', '$int_coste', '$int_mgd', '$int_ndp', '$int_pct', '$int_et', '$int_bmt', '$int_bop', '$int_man', '$int_iart', '$int_phleb', '$int_mbc', '$int_cnc', '$int_mnt', '$int_weld', '$int_rhvac', '$int_hit', '$int_costr', '$int_elc', '$current_time', '$StatusId' )");
	
		//ADD CREATED LEAD HISTORY
		//ADD CREATED LEAD HISTORY
		//ADD CREATED LEAD HISTORY
		history_created ($lead_id, $_SESSION['user_id']);
	
	
	

}

} else if ($action_type=='edit'){




switch ('')
{
	case $first_name : echo 'You Must Enter a First Name'; $error=1;
	break;
	case $last_name : echo 'You Must Enter a Last Name'; $error=1;
	break;
	case $home_phone : echo 'You Must Enter a Home Phone'; $error=1;
	break;
	case $email : echo 'You Must Enter an Email Address'; $error =1;
	break;
	
	
	default: mysql_query("UPDATE db33581_leads_db.leads SET ProsFirstName='$first_name', ProsLastName='$last_name', ProsMiddleName='$middle_name', ProsMaiden='$maiden_name', ProsAddress1='$address_1', ProsAddress2='$address_2', ProsCity='$city', ProsState='$state', ProsCounty='$county', ProsZip='$zip', ProsCell='$cell_phone', ProsPhone='$home_phone', ProsEmail='$email', ProsComments='$comments', ProsHighSchool='$high_school', ProsGradYear='$grad_year', ProIntDA='$int_da', ProIntDAE='$int_dae', ProIntDMS='$int_dms', ProIntMA='$int_ma', ProIntMAE='$int_mae', ProIntMS='$int_moa', ProIntPT='$int_pt', ProIntST='$int_st', ProIntVA='$int_va', ProIntMT='$int_mt', ProIntCOS='$int_cos', ProIntCOSE='$int_cose', ProCOST='$int_cost', ProIntCOSTE='$int_coste', ProIntMDG='$int_mgd', ProIntNDP='$int_ndp', ProIntGPCT='$int_pct', ProIntBET='$int_et', ProIntBMT='$int_bmt', ProIntOSS='$int_bop', ProIntMAN='$int_man', ProIntIAR='$int_iart', ProIntGPhleb='$int_phleb', ProIntGMBC='$int_mbc', ProIntECNC='$int_cnc', ProIntEMAIN='$int_mnt', ProIntEWELD='$int_weld', ProIntERHVAC='$int_rhvac', ProIntEGHIT='$int_hit', ProIntCOSTR='$int_costr', ProIntEELC ='$int_elc', StatusId='$StatusId' WHERE LeadsId='$lead_id' ");

}	
	
	
	
}




if ($error==1){
	
}else{
	//header("Location: lead_overview_ajax.php");
	 echo"
	 	<div id='cover' ></div>
		
		<div id='return_box'>
		Lead Saved Successfully!<br><br>
		<a href='dashboard.php' style='color:000' >Click Here to Return to the Dashboard</a><br><br>
		<a href='lead_detail.php?lead_id=".$lead_id."&type=edit' id='continue_edit' >Click Here to Contine Editing</a>
		</div>
		";
	
}



?>