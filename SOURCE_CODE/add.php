<?php

// connect to database
include('includes/connection.php');

if( isset( $_POST['add'] ) ) {

    $firstName = $lastName=$middleName= $homePhone = $homePhoneNumber = $cellPhone=$cellPhoneNumber=$workPhone = $workPhoneNumber = $homeAddress=$homeCity=$homeState=$homeZip=$workAddress=$workCity=$workState=$workZip=$birthday="";

    if( !$_POST["firstName"] || !$_POST['lastName'] ) {
        $nameError = "Please enter a first name and last name! <br>";
    } else {
        $firstName =  $_POST["firstName"];
        $lastName =  $_POST["lastName"] ;
    }

    echo($nameError);

    $middleName  =  $_POST["middleName"] ;
    $homePhone    =  $_POST["homePhone"] ;
    $homePhoneNumber    =  $_POST["homePhoneNumber"];
    $cellPhone    =  $_POST["cellPhone"] ;
    $cellPhoneNumber    =$_POST["cellPhoneNumber"] ;
    $workPhone    =  $_POST["workPhone"] ;
    $workPhoneNumber    = $_POST["workPhoneNumber"] ;
    $homeAddress   =  $_POST["homeAddress"] ;
    $homeCity    = $_POST["homeCity"];
    $homeState    =  $_POST["homeState"] ;
    $homeZip    =  $_POST["homeZip"] ;
    $workAddress   =  $_POST["workAddress"] ;
    $workCity   =  $_POST["workCity"] ;
    $workState   =  $_POST["workState"] ;
    $workZip    =  $_POST["workZip"] ;
    $date    =  $_POST["date"] ;
    $date_type    =  $_POST["date_type"] ;


        mysqli_query($conn, "SET AUTOCOMMIT=0");
mysqli_begin_transaction($conn);
$query="INSERT INTO CONTACT (Contact_id, Fname, Mname, Lname) VALUES (NULL, '$firstName', '$middleName', '$lastName')";
if(!mysqli_query($conn, $query))
{
	mysqli_rollback($conn);
//      echo "Error: ". $query ."<br>" . mysqli_error($conn);
}
    $lastid=mysqli_insert_id($conn);
    $query1="INSERT INTO ADDRESS (Contact_id, Address, City, State,ZIP,Address_type) VALUES ('$lastid', '$homeAddress', '$homeCity', '$homeState','$homeZip','home'),('$lastid', '$workAddress', '$workCity', '$workState','$workZip','work')";
if(!mysqli_query($conn, $query1))
{
	mysqli_rollback($conn);
/*      echo "Error: ". $query1 ."<br>" . mysqli_error($conn);  */    }
$query2="INSERT INTO PHONE (Contact_id, Area_code, Number,Phone_type) VALUES ('$lastid', '$homePhone', '$homePhoneNumber','home'),('$lastid','$workPhone','$workPhoneNumber','work')";
    if(!mysqli_query($conn, $query2))
{
	mysqli_rollback($conn);
/*      echo "Error: ". $query2 ."<br>" . mysqli_error($conn);  */ }
$query3="INSERT INTO DATE (Contact_id, Date, Date_type) VALUES ('$lastid', '$date', '$date_type')" ;
 if(!mysqli_query($conn,$query3))
{
	mysqli_rollback($conn);
/*      echo "Error: ". $query3 ."<br>" . mysqli_error($conn);   */ }
     else{
	      header( "Location: index.php?alert=success" );
     }
mysqli_commit($conn);

    }


// close the mysql connection
mysqli_close($conn);


include('includes/header.php');
?>

<h1>Add Contact</h1>

<form style="border:3px solid black; padding: 12px; border-radius:25px; background: #8da09f; "action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">

 <div class="form-group col-md-4">
      <label for="firstName">First Name *</label>
      <input type="text" class="form-control" id="firstName" name="firstName">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Middle Name</label>
      <input type="text" class="form-control" id="middleName" name="middleName">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Last Name *</label>
      <input type="text" class="form-control" id="lastName" name="lastName">
    </div>
     <div class="form-group col-md-2">
      <label for="inputEmail4">Home Phone</label>
      <input type="text" class="form-control" id="homePhone" placeholder="Area code:xxx" name="homePhone">
    </div>
    <div class="form-group col-md-4">
	     <label for="inputEmail4">Number</label>
      <input type="text" class="form-control" id="homePhoneNumber" name="homePhoneNumber">
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">Cell Phone</label>
      <input type="text" class="form-control" id="cellPhone" placeholder="Area code:xxx" name="cellPhone">
    </div>
	<div class="form-group col-md-4">
		<label for="inputPassword4">Number</label>
      <input type="text" class="form-control" id="cellPhoneNumber" name="cellPhoneNumber">
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">Work Phone</label>
      <input type="text" class="form-control" id="workPhone" placeholder="Area code:xxx" name="workPhone">
    </div>
	<div class="form-group col-md-4">
		<label for="inputPassword4">Number</label>
      <input type="text" class="form-control" id="workPhoneNumber" name="workPhoneNumber">
    </div>
  <div class="form-group col-md-12">
    <label for="inputAddress">Home Address</label>
    <input type="text" class="form-control" id="homeAddress" placeholder="1234 Main St" name="homeAddress">
  </div>
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="homeCity" name="homeCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <input type= "text",class="form-control" id="homeState" name="homeState">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="homeZip" name="homeZip">
    </div>

  <div class="form-group col-md-12">
    <label for="inputAddress2">Work Address</label>
    <input type="text" class="form-control" id="workAddress" placeholder="1234 Main St" name="workAddress">
  </div>

     <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="workCity" name="workCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <input type= "text",class="form-control" id="workState" name="workState">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="workZip" name="workZip">
    </div>
  <div class="form-group col-md-6">
      <label for="inputdate">Date</label>
      <input type="text" class="form-control" id="date" name="date">
    </div>
      <div class="form-group col-md-6">
      <label for="inputZip">Date type</label>
      <input type="text" class="form-control" id="date_type" name="date_type">
    </div>
    <div class="col-sm-12">
            <a href="index.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" id="add" name="add">Add Contact</button>
    </div>
    </form>
    <script>
	 $document.ready(function(){
		 $("#add").click(function(){
			if(<?=$nameError?>!=""){
				alert(<?=$nameError?>);
			}
		 });
	 });
	</script>
<?php

?>
