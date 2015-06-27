<?php
$servername = "oniddb.cws.oregonstate.edu";
$username = "anderleo-db";
$password = "wqTNDsuHj21IEyZm";
$dbname = "anderleo-db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT pokemon_id, name, description FROM pokemon";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo '<table cellpadding="1" cellspacing="0.5" class="poke-table" border="solid">';
		echo '<tr><th>Pokemon Index</th><th>Name</th><th>Description</th></tr>';
		while($row = $result->fetch_assoc()) {
			echo '<tr>';
			foreach($row as $key=>$value) {
				echo '<td>',$value,'</td>';
			}
			echo '</tr>';
		}
		echo '</table><br />';
} else {
    echo "0 results";
}
$conn->close();
?>