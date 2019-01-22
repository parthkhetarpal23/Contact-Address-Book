<?php

include('includes/connection.php');

$querynum=isset($_POST['query'])?"SELECT CONTACT.Contact_id,
CONCAT(CONTACT.Fname,' ',CONTACT.Mname,' ',CONTACT.Lname) AS name,ADDRESS.Address,ADDRESS.Address_type,ADDRESS.City,ADDRESS.State,ADDRESS.ZIP,PHONE.Phone_type,PHONE.Area_code,PHONE.Number,DATE.Date,DATE.Date_type FROM ((CONTACT JOIN ADDRESS ON CONTACT.Contact_id=ADDRESS.Contact_id) JOIN PHONE ON PHONE.Contact_id=CONTACT.Contact_id)
JOIN DATE ON DATE.Contact_id=CONTACT.Contact_id WHERE CONCAT(CONTACT.Fname,' ',CONTACT.Mname,' ',CONTACT.Lname) LIKE '%".$_POST['query']."%'
OR Address LIKE '%".$_POST['query']."%' OR State LIKE '%".$_POST['query']."%' OR City LIKE '%" .$_POST['query']."%' OR ZIP LIKE '%" .$_POST['query']."%' OR Address_type LIKE '%".$_POST['query']."%' OR Phone_type LIKE '%".$_POST['query']."%' OR Area_code LIKE '%".$_POST['query']."%'
OR Number LIKE '%".$_POST['query']."%' OR Date LIKE '%".$_POST['query']."%' OR Date_type LIKE '%".$_POST['query']."%'":"SELECT CONTACT.Contact_id,CONTACT.Fname,CONTACT.Mname,CONTACT.Lname,ADDRESS.Address,ADDRESS.Address_type,ADDRESS.City,ADDRESS.State,ADDRESS.ZIP,PHONE.Phone_type,PHONE.Area_code,PHONE.Number,
DATE.Date,DATE.Date_type FROM ((CONTACT JOIN ADDRESS ON CONTACT.Contact_id=ADDRESS.Contact_id) JOIN PHONE ON PHONE.Contact_id=CONTACT.Contact_id) JOIN DATE ON DATE.Contact_id=CONTACT.Contact_id ";




$result = mysqli_query( $conn, $querynum );

$count = mysqli_num_rows($result);



if(isset($_POST['query']))
{
	$search = mysqli_real_escape_string($conn, $_POST['query']);
	$search=$search;
	$query = "SELECT CONTACT.Contact_id,CONCAT(CONTACT.Fname,' ',CONTACT.Mname,' ',CONTACT.Lname) AS name,ADDRESS.Address,ADDRESS.Address_type,ADDRESS.City,ADDRESS.State,ADDRESS.ZIP,PHONE.Phone_type,PHONE.Area_code,PHONE.Number,DATE.Date,DATE.Date_type FROM ((CONTACT JOIN ADDRESS ON CONTACT.Contact_id=ADDRESS.Contact_id) JOIN
	PHONE ON PHONE.Contact_id=CONTACT.Contact_id) JOIN DATE ON DATE.Contact_id=CONTACT.Contact_id WHERE Fname LIKE '%".$search."%' OR Mname LIKE '%".$search."%' OR Lname LIKE '%".$search."%'
	OR Address LIKE '%".$search."%' OR State LIKE '%".$search."%' OR City LIKE '%" .$search."%' OR ZIP LIKE '%" .$search."%' OR Address_type LIKE '%".$search."%' OR Phone_type LIKE '%".$search."%' OR Area_code LIKE '%".$search."%' OR Number LIKE '%".$search."%' OR Date LIKE '%".$search."%'
	OR Date_type LIKE '%".$search."%'";
	}else{

$query =
"SELECT CONTACT.Contact_id,CONCAT(CONTACT.Fname,' ',CONTACT.Mname,' ',CONTACT.Lname) AS name,ADDRESS.Address,ADDRESS.Address_type,ADDRESS.City,ADDRESS.State,ADDRESS.ZIP,PHONE.Phone_type,PHONE.Area_code,PHONE.Number,DATE.Date,DATE.Date_type FROM ((CONTACT JOIN ADDRESS ON CONTACT.Contact_id=ADDRESS.Contact_id)
JOIN PHONE ON
PHONE.Contact_id=CONTACT.Contact_id)
JOIN DATE ON DATE.Contact_id=CONTACT.Contact_id "; }


$result = mysqli_query( $conn, $query );

mysqli_close($conn);
echo "<table class='table table-hover table-condensed table-bordered' style='background: #BDBDBD ' >";
echo "<tr><td colspan='15'><div class='text-center'><a href='add.php' type='button' class='btn btn-bg btn-primary'><span class='glyphicon glyphicon-user'></span> Add Contacts</a></div></td></tr>";
echo "  <tr class='success'>
        <th style='width:20px'> Contact id</th>
        <th style='width:300px'>Name</th>
        <th style='width:100px'>Address Type</th>
        <th style='width:200px'>Address</th>
        <th style='width:50px'>City</th>
        <th style='width:75px'>State</th>
        <th style='width:50px'>Zip</th>
        <th style='width:50px'>Phone Type</th>
        <th style='width:50px'>Phone</th>
        <th style='width:100px'>Date</th>
        <th style='witdh:20px'>Date Type</th>
				<th style = 'width:50px'>Edit</th>
        <th style = 'width:50px'>Delete</th><tr>";

    if (mysqli_num_rows($result) > 0 ) {

        while( $row = mysqli_fetch_assoc($result) ) {
 $id=$row['Contact_id'];

            echo "<td>".$row['Contact_id'] . "</td><td>" . $row['name'] . "</td>";
            echo "</td><td>".$row['Address_type']."</td><td>".$row['Address']."</td><td>".$row['City']."</td><td>".$row['State']."</td><td>".$row['ZIP']."</td><td>".$row['Phone_type']."</td><td>".$row['Area_code'].$row['Number']."</td>
						<td>".$row['Date']."</td><td>".$row['Date_type']."</td>";

						echo '<td><a href="edit.php?id=' . $row['Contact_id'] .' & atype=' . $row['Address_type'] . '& ptype=' . $row['Phone_type'] . '" type="button" class="btn btn-warning btn-sm">
                    <span class="glyphicon glyphicon-pencil"></span>
                    </a></td>' ;

										echo '<td><a href="delete.php?id=' . $row['Contact_id'] .'" type="button" class="btn btn-danger btn-sm">
														<span class="glyphicon glyphicon-trash"></span>
														</a></td>' ;

            echo "</form></td></tr>";
        }
    }
		else
		{ // if no entries
        echo "<div class='alert alert-warning'>You have no contacts!</div>";
    }

echo "</table>";   echo "<div class='text-center'>";

echo "</div>";
echo "<hr/>";




?>
<script>


</script>
