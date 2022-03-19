<?php
$servername = "10.208.5.20";
$username = "root";
$password = "expled08";
$dbname = "INVERTEC";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM alumno";
$result = $conn->query($sql);


$userData = array();




if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "id: " . $row["numero"]. " - numero: " . $row["numero"]. " " . $row["numero"]. "<br>";
	echo $userData['AllUsers'][] = $row;
  }
} else {
  echo "0 results";
}
echo json_encode($userData);
$conn->close();
?>