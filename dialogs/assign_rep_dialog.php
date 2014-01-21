<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>

<?

$rep_id_assigned = $_POST['rep_id_assigned']; 

$rep_name_assigned = $_POST['rep_name_assigned'] ;


?>

<script>

$("#assign_rep_button").click(function(){
	$("#interview_box_status").html("Assigning Rep ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("ajax/assign_rep_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>&rep_id=<? echo $rep_id_assigned; ?>", 
			{
			email_rep: $('#send_please_god:checked').val(),
			},
			function(result){
				$("#interview_box_status").html("")
      			$("#assign_rep_box").html(result);
   			});
});

</script>

<div id='cover' ></div>

<div id='assign_rep_box'>

<div id="interview_box_status" style="margin-bottom:10px; color:#900;"></div>

Assign Rep<br><br>

Assign this lead to <? echo $rep_name_assigned; ?>?<br><br>

Send <? echo $rep_name_assigned; ?> a notification email?<input type="checkbox" id="send_please_god" name="send_please_god"/><br /><br />

<input type='button' name='Button' id='assign_rep_button' value='Assign to Rep' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Cancel</a>


</div>


