<?php


// get ID sent by GET collection
$contactID = $_GET['id'];


include('includes/connection.php');
include('includes/header.php');


$states = array("Alaska",
                  "Alabama",
                  "Arkansas",
                  "American Samoa",
                  "Arizona",
                  "California",
                  "Colorado",
                  "Connecticut",
                  "District of Columbia",
                  "Delaware",
                  "Florida",
                  "Georgia",
                  "Guam",
                  "Hawaii",
                  "Iowa",
                  "Idaho",
                  "Illinois",
                  "Indiana",
                  "Kansas",
                  "Kentucky",
                  "Louisiana",
                  "Massachusetts",
                  "Maryland",
                  "Maine",
                  "Michigan",
                  "Minnesota",
                  "Missouri",
                  "Mississippi",
                  "Montana",
                  "North Carolina",
                  " North Dakota",
                  "Nebraska",
                  "New Hampshire",
                  "New Jersey",
                  "New Mexico",
                  "Nevada",
                  "New York",
                  "Ohio",
                  "Oklahoma",
                  "Oregon",
                  "Pennsylvania",
                  "Puerto Rico",
                  "Rhode Island",
                  "South Carolina",
                  "South Dakota",
                  "Tennessee",
                  "Texas",
                  "Utah",
                  "Virginia",
                  "Virgin Islands",
                  "Vermont",
                  "Washington",
                  "Wisconsin",
                  "West Virginia",
                  "Wyoming");

$query = "SELECT * FROM CONTACT WHERE Contact_id='$contactID'";
$result = mysqli_query( $conn, $query );

if( mysqli_num_rows($result) > 0 ) {

    while( $row = mysqli_fetch_assoc($result) ) {
        $firstName     = $row['Fname'];
        $middleName    = $row['Mname'];
        $lastName    = $row['Lname'];
    }
} else {
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}

$query1 = "SELECT * FROM ADDRESS WHERE Contact_id='$contactID' AND Address_type='home'";
$result1 = mysqli_query( $conn, $query1 );
if( mysqli_num_rows($result1) > 0 ) {

    while( $row = mysqli_fetch_assoc($result1) ) {
        $homeAddress     = $row['Address'];
        $homeCity    = $row['City'];
        $homeState    = $row['State'];
        $homeZip     = $row['ZIP'];
    }
} else {
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}

$query2 = "SELECT * FROM ADDRESS WHERE Contact_id='$contactID' AND Address_type='work'";
$result2 = mysqli_query( $conn, $query2 );
if( mysqli_num_rows($result2) > 0 ) {

    while( $row = mysqli_fetch_assoc($result2) ) {
        $workAddress     = $row['Address'];
        $workCity    = $row['City'];
        $workState    = $row['State'];
        $workZip     = $row['ZIP'];
    }
} else {
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}

$query3 = "SELECT * FROM PHONE WHERE Contact_id='$contactID' AND Phone_type='home'";
$result3 = mysqli_query( $conn, $query3 );
if( mysqli_num_rows($result3) > 0 ) {


    while( $row = mysqli_fetch_assoc($result3) ) {
        $homePhone     = $row['Area_code'];
        $homePhoneNumber   = $row['Number'];
          }
} else {
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}

$query4 = "SELECT * FROM PHONE WHERE Contact_id='$contactID' AND Phone_type='cell'";
$result4 = mysqli_query( $conn, $query4 );
if( mysqli_num_rows($result4) > 0 ) {


    while( $row = mysqli_fetch_assoc($result4) ) {
        $cellPhone     = $row['Area_code'];
        $cellPhoneNumber    = $row['Number'];
    }
} else {
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}

$query5 = "SELECT * FROM PHONE WHERE Contact_id='$contactID' AND Phone_type='work'";
$result5 = mysqli_query( $conn, $query5 );
if( mysqli_num_rows($result5) > 0 ) {

    while( $row = mysqli_fetch_assoc($result5) ) {
        $workPhone     = $row['Area_code'];
        $workPhoneNumber    = $row['Number'];
    }
} else {
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}

$query6 = "SELECT * FROM DATE WHERE Contact_id='$contactID'";
$result6 = mysqli_query( $conn, $query6 );
if( mysqli_num_rows($result6) > 0 ) {

    while( $row = mysqli_fetch_assoc($result6) ) {
        $date     = $row['Date'];
        $dateType   = $row['Date_type'];
    }
} else {
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='index.php'>Head back</a>.</div>";
}
if( isset($_POST['update']) ) {

    $firstName     =  $_POST["firstName"] ;
    $middleName    =  $_POST["middleName"] ;
    $lastName    =  $_POST["lastName"] ;
    $homePhone  =  $_POST["homePhone"] ;
    $homePhoneNumber  =  $_POST["homePhoneNumber"] ;
    $cellPhone    =  $_POST["cellPhone"] ;
    $cellPhoneNumber  =  $_POST["cellPhoneNumber"] ;
    $workPhone  =  $_POST["workPhone"] ;
    $workPhoneNumber  =  $_POST["workPhoneNumber"] ;
    $homeAddress  =  $_POST["homeAddress"] ;
    $homeCity  =  $_POST["homeCity"] ;
    $homeState  =  $_POST["homeState"] ;
    $homeZip  =  $_POST["homeZip"] ;
    $workAddress  =  $_POST["workAddress"] ;
    $workCity  =  $_POST["workCity"] ;
    $workState  =  $_POST["workState"] ;
    $workZip  =  $_POST["workZip"] ;
    $date =  $_POST["date"] ;
    $dateType  =  $_POST["date_type"] ;
    $contactID=$_GET['id'];


    $query = "UPDATE CONTACT,ADDRESS,PHONE,DATE
            SET CONTACT.Fname='$firstName',
            CONTACT.Mname='$middleName',
            CONTACT.Lname='$lastName',
            ADDRESS.Address =
            CASE ADDRESS.Address_type
            WHEN 'home' THEN '$homeAddress'
            WHEN 'work' THEN '$workAddress'
            END,
            ADDRESS.City=
            CASE ADDRESS.Address_type
            WHEN 'home' THEN '$homeCity'
            WHEN 'work' THEN '$workCity'
            END,
            ADDRESS.State=
            CASE ADDRESS.Address_type
            WHEN 'home' THEN '$homeState'
            WHEN 'work' THEN '$workState'
            END,
            ADDRESS.ZIP=
            CASE ADDRESS.Address_type
            WHEN 'home' THEN '$homeZip'
            WHEN 'work' THEN '$workZip'
            END,
            PHONE.Area_code=
            CASE PHONE.Phone_type
            WHEN 'home' THEN '$homePhone'
            WHEN 'work' THEN '$workPhone'
            WHEN 'cell' THEN '$cellPhone'
            END,
            PHONE.Number=
            CASE PHONE.Phone_type
            WHEN 'home' THEN '$homePhoneNumber'
            WHEN 'work' THEN '$workPhoneNumber'
            WHEN 'cell' THEN '$cellPhoneNumber'
            END,
            DATE.Date=
            CASE DATE.Date_type
            WHEN 'birthday' THEN '$date'
            END WHERE CONTACT.Contact_id=$contactID AND ADDRESS.Contact_id=$contactID AND PHONE.Contact_id=$contactID
            AND DATE.Contact_id=$contactID";
    $result = mysqli_query( $conn, $query );

    if( $result) {
  // redirect to client page with query string
        header("Location: index.php?alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


mysqli_close($conn);


?>

<h1>Edit Contact</h1>



<form style="border:3px solid black; padding: 12px; border-radius:25px; background: #8da09f;" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $contactID; ?>" method="post" class="row">

 <div class="form-group col-md-4">
      <label for="firstName">First Name *</label>
      <input type="text" class="form-control" id="firstName" name="firstName" maxlength="15" value="<?php echo $firstName; ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Middle Name</label>
      <input type="text" class="form-control" id="middleName" name="middleName" maxlength="15" value=<?php echo($middleName);?>>
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Last Name *</label>
      <input type="text" class="form-control" id="lastName" name="lastName" maxlength="15" value="<?php echo($lastName);?>">
    </div>
     <div class="form-group col-md-2">
      <label for="inputEmail4">Home</label>
      <input type="text" class="form-control" id="homePhone" name="homePhone" placeholder="Area code:xxx" name="homePhone" value="<?php echo($homePhone); ?>">
    </div>
    <div class="form-group col-md-4">
	     <label for="inputEmail4">Number</label>
      <input type="text" class="form-control" id="homePhoneNumber" name="homePhoneNumber" value="<?php echo $homePhoneNumber;?>">
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">Cell</label>
      <input type="text" class="form-control" id="cellPhone" placeholder="Area code:xxx" name="cellPhone" value="<?php echo $cellPhone;?>">
    </div>
	<div class="form-group col-md-4">
		<label for="inputPassword4">Number</label>
      <input type="text" class="form-control" id="cellPhoneNumber" name="cellPhoneNumber" value="<?php echo $cellPhoneNumber;?>">
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">Work</label>
      <input type="text" class="form-control" id="workPhone" placeholder="Area code:xxx" name="workPhone" value="<?php echo $workPhone;?>">
    </div>

	<div class="form-group col-md-4">
		<label for="inputPassword4">Number</label>
      <input type="text" class="form-control" id="workPhoneNumber" name="workPhoneNumber" value="<?php echo $workPhoneNumber;?>">
    </div>
  <div class="form-group col-md-12">
    <label for="inputAddress">Home Address</label>
    <input type="text" class="form-control" id="homeAddress" placeholder="1234 Main St" name="homeAddress" value="<?php echo($homeAddress);?>">
  </div>
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="homeCity" name="homeCity" value="<?php echo($homeCity);?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
<select name="homeState" id="homeState" class="form-control" name="homeState">
  <option value="" selected="selected">Select a State</option>
    <?php foreach($states as $state){
	    if($homeState==$state){
		    $selected="selected";
	    }else{
		    $selected="";
	    }
	  echo "<option value='".$state."' ".$selected.">".$state."</option>";
  }?>
</select>
</div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="homeZip" name="homeZip" value="<?php echo($homeZip);?>">
    </div>

  <div class="form-group col-md-12">
    <label for="inputAddress2">Work Address</label>
    <input type="text" class="form-control" id="workAddress" placeholder="1234 Main St" name="workAddress" value="<?php echo($workAddress);?>">
  </div>

     <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="workCity" name="workCity" value="<?php echo($workCity);?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
<select name="workState" id="workState" class="form-control" name="workState">
  <option value="" selected="selected">Select a State</option>
    <?php foreach($states as $state){
	    if($workState==$state){
		    $selected="selected";
	    }else{
		    $selected="";
	    }
	  echo "<option value='".$state."' ".$selected.">".$state."</option>";
  }?>
 </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="workZip" name="workZip" value="<?php echo($workZip);?>">
    </div>
  <div class="form-group col-md-6">
      <label for="inputdate">Date</label>
      <input type="text" class="form-control" id="date" name="date"  value="<?php echo($date);?>">
    </div>
      <div class="form-group col-md-6">
      <label for="inputZip">Date type</label>
      <input type="text" class="form-control" id="date_type" name="date_type" value="<?php echo($dateType);?>">
    </div>
    <div class="col-sm-12">
        <hr>
        <div class="pull-right">
            <a href="index.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-warning" name="update">Update</button>
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
		$('#workZip').mask('00000',options);
		$('#homeZip').mask('00000');
		$('#workZip').mask('00000');
		$('#homePhone').mask('000');
		$('#workPhone').mask('000');
		$('#cellPhone').mask('000');
		$('#homePhoneNumber').mask('0000000');
		$('#cellPhoneNumber').mask('0000000');
		$('#workPhoneNumber').mask('0000000');
	});

	</script>
<?php
?>
