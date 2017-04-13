<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";
$student_id="";
$tname="";
if($_SERVER["REQUEST_METHOD"]== "POST") {
$tname=$_POST['name'];
if($tname==NULL)
	exit("Name field is empty");
$tn=explode(",",$tname);
$size=count($tn);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
}
$join="";
$x=0;
while($x < $size) {
	if($x+1<$size){
		$join=$join." ".$tn[$x]." NATURAL JOIN ";
	}
	else{
		$join=$join." ".$tn[$x];
	}
    $x++;
}	
	$sql = "SELECT * FROM ".$join."";
		$result = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}else{
   echo("<table>");
$first_row = true;
while ($row = $result->fetch_assoc()) {
    if ($first_row) {
        $first_row = false;
        // Output header row from keys.
        echo '<tr>';
        foreach($row as $key => $field) {
            echo '<th>' . htmlspecialchars($key) . '</th>';
        }
        echo '</tr>';
    }
    echo '<tr>';
    foreach($row as $key => $field) {
        echo '<td>' . htmlspecialchars($field) . '</td>';
    }
    echo '</tr>';
}
echo("</table>");
} 
$conn->close();
?>