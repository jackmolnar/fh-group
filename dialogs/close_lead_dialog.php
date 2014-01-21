
<script>



$("#close_lead_button").click(function(){
	$("#close_lead_box_status").html("Closing Lead ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("ajax/close_lead_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>",
			{
			close_details: $("#close_details").val(),
			},
			function(result){
					$("#close_lead_box_status").html("");
      			$("#close_lead_box").html(result);
   			});

});
</script>

<div id='cover' ></div>



<div id='close_lead_box'>
<div id="close_lead_box_status" style="margin-bottom:10px; color:#900;"> </div>

Close the lead?<br>
<br />
Closing Details
<br />
<textarea id="close_details" name="close_details"></textarea>
<br /><br />
<input type='button' name='Button' id='close_lead_button' value='Close Lead' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Cancel</a></div>
