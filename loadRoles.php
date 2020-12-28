<?php

$conn = mysqli_connect('localhost', 'root','');
$select = mysqli_select_db($conn, 'khired_networks'); 

$val = $_GET['job'];

$query = "SELECT * FROM ROLES WHERE ROLES.JOB = '$val'";
$result = mysqli_query($conn, $query);

$response = array();
foreach ($result as $row){
	$response[] = $row['ROLE'];
}
echo json_encode($response);

?>