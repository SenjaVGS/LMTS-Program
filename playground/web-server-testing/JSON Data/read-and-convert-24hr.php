<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: x-requested-with, x-requested-by');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/json; charset=UTF-8');
    die();
}
header('Access-Control-Allow-Origin: *');
$ret = [
    'result' => 'OK',
];
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);
$servername = "localhost";

          $user = "LMTS50";
          $password = "HansArneErKul";
          $database = "LMTS50";
          $conn = new mysqli($servername, $user, $password, $database);
          $stmt = $conn->prepare("SELECT ID, Temperatur, Fuktighet, TidUNIX FROM `LMTS50` ORDER BY ID DESC LIMIT 24");$stmt->bind_param("s", $obj->limit);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);
?>
