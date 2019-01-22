<?php

// get ID sent by GET collection
$contactID = $_GET['id'];

// connect to database
include('includes/connection.php');
include('includes/header.php');
$query = "SELECT * FROM CONTACT WHERE Contact_id='$contactID'";
$result = mysqli_query( $conn, $query );

// if result is returned
if( mysqli_num_rows($result) > 0 ) {

    // we have data!
    // set some variables
    while( $row = mysqli_fetch_assoc($result) ) {
        $firstName     = $row['Fname'];
        $middleName    = $row['Mname'];
        $lastName    = $row['Lname'];
    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}

if( isset($_POST['delete']) ) {
    // new database query & result

    $contactID=$_GET['id'];
    $query = "DELETE FROM CONTACT WHERE Contact_id='$contactID'";
    $result = mysqli_query( $conn, $query );

    if( $result ) {

        // redirect to client page with query string
        header("Location: index.php?alert=deleted&deleteID=$contactID");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

}

// close the mysql connection
mysqli_close($conn);


?>

<h1>Delete Contact <?php echo $_GET['id'] ;?> ? </h1>



<form style="border:3px solid black; padding: 12px; border-radius:25px; background: #8da09f;"action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $contactID; ?>" method="post" class="row">

 <div class="form-group col-md-4">
      <h3><center><b>First Name<b></center></h3>
      <button type="text" class="form-control" id="firstName" name="firstName" maxlength="15" > <?php echo $firstName; ?></button>
    </div>
    <div class="form-group col-md-4">
      <h3><center><b>Middle Name<b></center></h3>
      <button type="text" class="form-control" id="middleName" name="middleName" maxlength="15"> <?php echo($middleName);?></button>
    </div>
    <div class="form-group col-md-4">
      <h3><center><b>Last Name<b></center></h3>
      <button type="text" class="form-control" id="lastName" name="lastName" maxlength="15"> <?php echo($lastName);?></button>
    </div>

    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-primary btn-lg btn-block btn-danger" name="delete">DELETE CONTACT</button>
        <br>
        <br>
        <div class="pull-left">
            <a href="index.php" type="button" class="btn btn-lg btn-default">Change your mind? Cancel</a>

        </div>
    </div>
</form>
<script>
	$(document).ready(function(){

		var options =  {
  onComplete: function(cep) {
    alert('CEP Completed!:' + cep);
  },
  onKeyPress: function(cep, event, currentField, options){
    console.log('A key was pressed!:', cep, ' event: ', event,
                'currentField: ', currentField, ' options: ', options);
  },
  onChange: function(cep){
    console.log('cep changed! ', cep);
  },
  onInvalid: function(val, e, f, invalid, options){
    var error = invalid[0];
    console.log ("Digit: ", error.v, " is invalid for the position: ", error.p, ". We expect something like: ", error.e);
  }
};

	$('#date').mask('0000-00-00');
		$('#workZip').mask('00000',options);
		$('#homeZip').mask('00000');
		$('#workZip').mask('00000');
		$('#homePhone').mask('(000)');
		$('#workPhone').mask('(000)0000000');
		$('#cellPhone').mask('000');
		$('#homePhoneNumber').mask('0000000');
		$('#cellPhoneNumber').mask('0000000');
		$('#workPhoneNumber').mask('0000000');
	});

	</script>
<?php


?>
