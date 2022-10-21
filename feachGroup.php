<?php   
include("library/database.php");
header('Content-Type: application/json');

$sql = "SELECT * FROM st_group ORDER BY gid ASC";
$query = dbQuery($sql);
$resultArray = array();
while ($result = dbFetchArray($query)) {
    array_push($resultArray,$result);
}

echo json_encode($resultArray);

?>