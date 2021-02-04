<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////-CORS Behandling

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
header("Content-Type: application/json; ");

/////////////////////////////////////////////////////////////////////////////////////////////////////-CORS Behandling

$data = json_decode(file_get_contents("php://input"));

$obj = json_decode($data, false);

function mysql_query_24hr($DB, $DB_table) {
    $DB_servername = "localhost";
    $DB_user = "admin";
    $DB_password = "LeMaTempSens";
    $DB;
    $DB_table;
    $conn = new mysqli($DB_servername, $DB_user, $DB_password, $DB);
    $stmt = $conn->prepare("SELECT ID, Temperatur, Fuktighet, TidUNIX FROM `" . $DB_table . "` ORDER BY ID DESC LIMIT 13");
    $stmt->bind_param("s", $obj->limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataNonJSON24hr = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($dataNonJSON24hr);
    $conn->close();
}

function mysql_query_totalt($DB, $DB_table) {
    $DB_servername = "localhost";
    $DB_user = "admin";
    $DB_password = "LeMaTempSens";
    $DB;
    $DB_table;
    $conn = new mysqli($DB_servername, $DB_user, $DB_password, $DB);
    $stmt = $conn->prepare("SELECT ID, Temperatur, Fuktighet, TidUNIX FROM `" . $DB_table . "` ORDER BY ID DESC");
    $stmt->bind_param("s", $obj->limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataNonJSONtotalt = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($dataNonJSONtotalt);
    $conn->close();
}

function mysql_query_CSV() {
    $DB_servername = "localhost";
    $DB_user = "admin";
    $DB_password = "LeMaTempSens";
    $DB = "Finnfjordbotn";
    $conn = new mysqli($DB_servername, $DB_user, $DB_password, $DB);
    $stmt = $conn->prepare("SELECT ID, Temperatur, Fuktighet, Tid FROM `Rom 235` ORDER BY ID DESC");
    $stmt->bind_param("s", $obj->limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataNonJSONtotalt = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($dataNonJSONtotalt);
    $conn->close();
}

function mysql_query_AVG($DB, $DB_table) {
    $DB_servername = "localhost";
    $DB_user = "admin";
    $DB_password = "LeMaTempSens";
    $DB;
    $DB_table;
    $conn = new mysqli($DB_servername, $DB_user, $DB_password, $DB);
    $stmt = $conn->prepare("SELECT AVG(Temperatur), AVG(Fuktighet) FROM `" . $DB_table . "`");
    $stmt->bind_param("s", $obj->limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataNonJSONavg = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($dataNonJSONavg);
    $conn->close();
}

//Rom 235 | Finnfjordbotn | nmr 1
if ($data->id === "en") {
    $DB = "Finnfjordbotn";
    $DB_table = "Rom 235";
    if ($data->dataType === "en") {
        mysql_query_24hr($DB, $DB_table);
    }
    elseif ($data->dataType === "to") {
        mysql_query_totalt($DB, $DB_table);
    }
    elseif ($data->dataType === "tre") {
        mysql_query_AVG($DB, $DB_table);
    }
    elseif ($data->dataType === "fire") {
        mysql_query_CSV($DB, $DB_table);
    }
    else {
        echo ("fail");
    }
} 
//Server Rom | Gibostad | nmr 2
elseif ($data->id === "to") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Gibostad", "`Server Rom`");
        break;
        case "to":
            mysql_query_totalt_csv("Gibostad", "`Server Rom`");
        break;
        case "tre":
            mysql_query_AVG("Gibostad", "`Server Rom`");
        break;
        case "fire":
            mysql_query_totalt_csv("Gibostad", "`Server Rom`");
        break;
    }
}
//Kantine Kjøl | Finnfjordbotn | nmr 3 
elseif ($data->id === "tre") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Kantine Kjøl`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Kantine Kjøl`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Kantine Kjøl`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Kantine Kjøl`");
        break;
    }
}
//Kantine Kjøl | Gibostad | nmr 4
elseif ($data->id === "fire") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Gibostad", "`Kantine Kjøl`");
        break;
        case "to":
            mysql_query_totalt_csv("Gibostad", "`Kantine Kjøl`");
        break;
        case "tre":
            mysql_query_AVG("Gibostad", "`Kantine Kjøl`");
        break;
        case "fire":
            mysql_query_totalt_csv("Gibostad", "`Kantine Kjøl`");
        break;
    }
}
//Kantine Frys | Finnfjordbotn | nmr 5
elseif ($data->id === "fem") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Kantine Frys`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Kantine Frys`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Kantine Frys`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Kantine Frys`");
        break;
    }
}
//Kantine Frys | Gibostad | nmr 6
elseif ($data->id === "seks") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Gibostad", "`Kantine Frys`");
        break;
        case "to":
            mysql_query_totalt_csv("Gibostad", "`Kantine Frys`");
        break;
        case "tre":
            mysql_query_AVG("Gibostad", "`Kantine Frys`");
        break;
        case "fire":
            mysql_query_totalt_csv("Gibostad", "`Kantine Frys`");
        break;
    }
}
//Rom 256 | Finnfjordbotn | nmr 7
elseif ($data->id === "syv") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Rom 256`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 256`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Rom 256`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 256`");
        break;
    }
}
//Rom 257 | Finnfjordbotn | nmr 8
elseif ($data->id === "aatte") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Rom 257`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 257`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Rom 257`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 257`");
        break;
    }
}
//Rom 258 | Finnfjordbotn | nmr 9
elseif ($data->id === "ni") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Rom 258`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 258`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Rom 258`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 258`");
        break;
    }
}
//Rom 261  | Finnfjordbotn | nmr 10
elseif ($data->id === "ti") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Rom 261`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 261`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Rom 261`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 261`");
        break;
    }
}
//Rom 260  | Finnfjordbotn | nmr 11
elseif ($data->id === "elleve") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Rom 260`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 260`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Rom 260`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 260`");
        break;
    }
}
//Rom 273 | Finnfjordbotn | nmr 12
elseif ($data->id === "tolv") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Finnfjordbotn", "`Rom 273`");
        break;
        case "to":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 273`");
        break;
        case "tre":
            mysql_query_AVG("Finnfjordbotn", "`Rom 273`");
        break;
        case "fire":
            mysql_query_totalt_csv("Finnfjordbotn", "`Rom 273`");
        break;
    }
}
//Baat Simulator | Gibostad
elseif ($data->id === "tretten") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Gibostad", "`Baat Simulator`");
        break;
        case "to":
            mysql_query_totalt_csv("Gibostad", "`Baat Simulator`");
        break;
        case "tre":
            mysql_query_AVG("Gibostad", "`Baat Simulator`");
        break;
        case "fire":
            mysql_query_totalt_csv("Gibostad", "`Baat Simulator`");
        break;
    }
}
//Traktor Simulator  | Gibostad | nmr 14
elseif ($data->id === "fjorten") {
    switch ($data->dataType) {
        case "en":
            mysql_query_24hr("Gibostad", "`Traktor Simulator`");
        break;
        case "to":
            mysql_query_totalt_csv("Gibostad", "`Traktor Simulator`");
        break;
        case "tre":
            mysql_query_AVG("Gibostad", "`Traktor Simulator`");
        break;
        case "fire":
            mysql_query_totalt_csv("Gibostad", "`Traktor Simulator`");
        break;
    }   
}
else {
    echo "fail";
}
?>