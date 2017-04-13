<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";
$student_id="";
$tname="";
$tatt="";
$twhere="";
$tatta="";
if($_SERVER["REQUEST_METHOD"]== "POST") {
$tname=$_POST['name'];
$tatt=$_POST['aname'];
$twhere=$_POST['where'];
if($tname==NULL)
	exit("table name is empty");
if($tatt==NULL){
	$tatta="*";
}
else
	$tatta=$tatt;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
}	
if($twhere == NULL){
	$sql = "SELECT ".$tatta." FROM ".$tname."";
	$result = $conn->query($sql);
}
else{
	$sql = "SELECT ".$tatta." FROM ".$tname." WHERE ".$twhere."";
	$result = $conn->query($sql);
}
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