<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";
$student_id="";
$tname="";
$tatt="";
if($_SERVER["REQUEST_METHOD"]== "POST") {
$tname=$_POST['name'];
$tatt=$_POST['aname'];
if($tatt==NULL or $tname==NULL  ){
	exit("Atrribute or table name field is empty");
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
}	
if($tname == "administrator"){
	$sql = "INSERT INTO `administrator` (`Name`, `Id`, `Password`) VALUES (".$tatt.")";
	$result = $conn->query($sql);
	$sql = "SELECT * FROM ".$tname."";
	$result = $conn->query($sql);
}
else if ($tname == "operator"){
	$sql = "INSERT INTO `operator` (`Name`, `Id`, `Password`, `Status`) VALUES (".$tatt.")";
	$result = $conn->query($sql);
	$sql = "SELECT * FROM ".$tname."";
	$result = $conn->query($sql);
}
else{
	exit("Other tables generate may generate foreign key constraint errors.");
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