<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script language="JavaScript" src="../calendar/ui_datepicker.js"></script>
<script>

$("#cancel_interview_button").click(function(){
	$("#interview_box_status").html("Canceling Interview ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("ajax/cancel_interview_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>",
			{
			cancel_interview_details: $("#interview_comments").val(),
			},
			function(result){
			$("#interview_box_status").html("");
      		$("#interview_box").html(result);
   			});

});

	

</script>
    

<div id='cover' ></div>

<div id='interview_box'>

<div id="interview_box_status" style="margin-bottom:10px; color:#900;"></div>

Cancel Interview<br><br>

Reason for canceling?<br>

<textarea cols='25' id='interview_comments' rows='2'></textarea><br /><br />

<input type='button' name='Button' id='cancel_interview_button' value='Cancel Interview' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Go Back</a></div>

