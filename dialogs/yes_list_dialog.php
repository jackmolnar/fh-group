<script>
$('#date_time_picker_start').datepicker({
	ampm:true,
	numberOfMonths:2
});


$('#date_time_picker_fa').datepicker({
	ampm:true,
	numberOfMonths:2
});

</script>

<?
include ('../global_includes/connect.php');
include ('../global_includes/functions.php');

$school_id = $_GET['school'];
$lead_id = $_GET['lead_id'];


//BUILD PAGE HTML
//BUILD PAGE HTML
//BUILD PAGE HTML
//BUILD PAGE HTML
//BUILD PAGE HTML
//BUILD PAGE HTML



//find the number of yes list records
$rec_num_result = mysql_query("SELECT * FROM yes_list WHERE LeadsId=$lead_id ORDER BY YId DESC");
$number_of_records = mysql_num_rows($rec_num_result);

//if more than one record get the buttons to control them
//if more than one record get the buttons to control them
//if more than one record get the buttons to control them
if ($number_of_records>0){
	while($row = mysql_fetch_array($rec_num_result))
	{
		
		$yes_list_links_num +=1;
		if ($yes_list_links_num ==1){$first_yid = $row['YId'];}
		$yes_list_links .= "<li><button class='yes_list_buttons' name='".$row['YId']."'>".$yes_list_links_num."</button></li>";
		//RUN CODE TO GET YES LIST INFO
		$yes_list_info = get_starting_yes_list ($first_yid, $school_id);
		$add_yes_list_button = '<button id="add_yes_list_button">Add New Yes List</button>';
	} 
} else {
	//RUN CODE FOR BLANK FORM
	$yes_list_info = create_blank_form ($school_id);
}











?>



    
    
<div id='cover' ></div>


<!-- start main dialog box -->
<div id='yes_list_box'>



<div id="yes_list_links">
<ul>
<? echo $yes_list_links; ?>
</ul>
</div>

<div id="yes_list_new_button">
<? echo $add_yes_list_button; ?>
</div>



<!-- start content -->
<div id="tabs" style="float:left;">
<? echo $yes_list_info;  ?>
</div> 
<!-- end content -->

</div> <!-- end the dialog container -->

<script>

	
	$(".yes_list_buttons").button().click(function(){
	   $("#save_yes_box_status").html("Getting Yes List Record ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
		var yid = $(this).attr("name")
		
    	$.post("ajax/get_yes_list_info_ajax2.php?lead_id=<? echo $_GET['lead_id']; ?>&school_id=<? echo $school_id; ?>&blank=no", { y_id: yid},
			function(result){
				$("#yes_list_form").hide()
				$("#create_loader").hide()
      			$("#tabs").html(result);
   			});
  	});
	
	$("#add_yes_list_button").button().click(function(){
	   $("#save_yes_box_status").html("Getting Blank Form ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("ajax/get_yes_list_info_ajax2.php?lead_id=<? echo $_GET['lead_id']; ?>&school_id=<? echo $school_id; ?>&blank=yes", 
			function(result){
				$("#yes_list_form").hide()
				$("#create_loader").hide()
      			$("#tabs").html(result);
   			});
  	});
	
	$(".edit_button").button().click( function(){
	   $("#save_yes_box_status").html("Saving to Yes List ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("ajax/edit_yes_list_info_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>&y_id=<? echo $y_id; ?>", $("#yes_list_form").serialize(),
			function(result){
				$("#yes_list_form").hide()
				$("#create_loader").hide()
      			$("#save_yes_box_status").html(result);
   			});
  	});
	
	$(".add_button").button().click( function(){
	   $("#save_yes_box_status").html("Saving to Yes List ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("ajax/add_yes_list_info_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>", $("#yes_list_form").serialize(),
			function(result){
				$("#yes_list_form").hide()
				$("#create_loader").hide()
      			$("#save_yes_box_status").html(result);
   			});
  	});
	
	$(".continue_button").button().click(function(){
				$("#yes_list_box").hide()
  	});







</script>