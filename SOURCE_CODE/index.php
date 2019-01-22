<?php


include('includes/header.php');



// check for query string
if( isset( $_GET['alert'] ) ) {

    // new contact added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New contact added! <a class='close' data-dismiss='alert'>&times;</a></div>";

    // contact updated
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Contact updated! <a class='close' data-dismiss='alert'>&times;</a></div>";

    // contact deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Contact deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }

}
?>




	   <center> <h1>My Contacts</h1></center>

		<br/>
		<div class="container">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Search</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search " class="form-control" />

        </div>
		</div>

</div>
		<div style="clear:both">
		</div>

<script>
$(document).ready(function(){

load_data()
	function load_data(query)
	{
		$.ajax({
			url:"search.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}

	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();
		}
	});

	$("#result").load("search.php");

   // Delete





});
</script>


	<div id="result" >



</div>

</div>
