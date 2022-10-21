<?php   
include("library/database.php");
header('Content-Type: application/json');

//หน่วยรับผิดชอบ
$sql = "SELECT * FROM user ORDER BY ID ASC";
$query  = dbQuery($sql);

$resultArray = array();

while ($result = dbFetchArray($query)) {
    array_push($resultArray,$result);
}

echo json_encode($resultArray);

?>