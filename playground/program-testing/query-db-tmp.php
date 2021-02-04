<?php

$temp = $_POST["temp"];
$fukt = $_POST["fukt"];
$ID = $_POST["ID"];
//$Loop_ID = $_POST["loopID"];


//----------------------------- G R E N S E R -----------------------------


//Grenser for å igjenskjenne en Bug.
$fuktBug = "200";
$tempBug = "15";

//Server Rom Grenser.
$ServerRomGrenseHøy = "28.5";

//Simulator Rom Grenser.
$varselTempHøySim = "27";

//R&M Grenser.
$kjølGrenserHøyRogM = "4";
$kjølGrenserLavRogM = "-0.5";

//R&M Grenser Frukt og Grønt Grenser.
$kjølGrenserFruktHøy = "10";
$kjølGrenserFruktLav = "2";

//Kantine Finnfjordbotn og Gibostad Grenser.
$frysGrenserHøy = "-18";
$kjølGrenserHøy = "5";
$kjølGrenserLav = "2";


//----------------------------- F U N K S J O N E R -----------------------------


//Query function for adding data to DB
function Query() {  
  $temp = $_POST["temp"];
  $fukt = $_POST["fukt"];
  $tid = $_POST["tid"];
  $DB_serverName = $_POST["server"];
  $DB = $_POST["db"];
  $DB_table = $_POST["table"];
  $DB_username = $_POST["usr"];
  $DB_password = $_POST["passwd"];


  $conn = new mysqli($DB_serverName, $DB_username, $DB_password, $DB);
  if ($conn->connect_error) {
    echo "FAIL";
  }
  $sql = "INSERT INTO " . $DB_table . " (Temperatur, Fuktighet, TidUNIX) VALUES ($temp, $fukt, $tid)";
  if ($conn->query($sql) === TRUE) {
    echo "success";
    //echo "Data ble lagt inn riktig inn i " . $DB_table . ". Data-arket er nå oppdatert.";
    //$conn->close();
    //exit("Data ble lagt inn riktig inn i " . $DB_table . ". Data-arket er nå oppdatert.");
  }
  else {
    echo "FAIL";
  }
  $conn->close();
}

//Send mail function for sending bug warnings and temperature warnings.
function SendMail($to, $email_subject, $email_body, $email_address) {
  require_once "Mail.php";
  $host = "ssl://smtp.gmail.com";
  $username = 'lmts.varsel.mail@gmail.com';
  $password = 'K!steFje11';
  $port = "465";
  
  $to;

  $email_from = "lmts.varsel.mail@gmail.com";

  $email_subject;
  $email_body;
  $email_address;

  $content = "text/html; charset=utf-8";
  $mime = "1.0";
  $headers = array ('From' => $email_from,
  'To' => $to,
  'Subject' => $email_subject,
  'Reply-To' => $email_address,
  'MIME-Version' => $mime,
  'Content-type' => $content);
  $params = array  ('host' => $host,
  'port' => $port,
  'auth' => true,
  'username' => $username,
  'password' => $password);
  $smtp = Mail::factory ('smtp', $params);
  $mail = $smtp->send($to, $headers, $email_body);
}

//$temp = $_POST["temp"];
//$fukt = $_POST["fukt"];

//----------------------------- V A R S L I N G -----------------------------
/*
if($fukt < $fuktBug && $temp < $ServerRomGrenseHøy) {
  switch($ID) {

  }
} else {
  echo "FAIL";
  switch($ID) {
    case "1":
      if($fukt > $fuktBug) {
        $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
        $emailTittel = "Varsel for Rom 235! (Finnfjordbotn)";
        $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 235 (IKT-Rom).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
        $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
        SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      }
      else {
        $til = "lexus.andersen@tffk.no, markus.thuv.karlsen@tffk.no, hans.arne.sorensen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
        $emailTittel = "Varsel for Rom 235! (IKT-Rom)";
        $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 235 (IKT-Rom) .<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
        $tilEmailer = "lexus.andersen@tffk.no, markus.thuv.karlsen@tffk.no, hans.arne.sorensen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
        Query(); 
        SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);       
      }
    break;
    case "2":
      if($fukt > $fuktBug) {
        $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
        $emailTittel = "Varsel for Server-Rommet! (Gibostad)";
        $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Server-Rommet (Gibostad).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
        $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
        SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      } else {
        
      }
    break;
  }
}
*/


/*
if($i = 0 $i < $ID && $fukt > $fuktBug) {
  if($ID === "1") {
    $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
    $emailTittel = "Varsel for Rom 235! (Finnfjordbotn)";
    $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 235 (IKT-Rom).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
    $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
    SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    echo "FAIL";
  }
  elseif($ID === "2") {

  }
  elseif($ID === "3") {

  }
  elseif($ID === "4") {

  }
  elseif($ID === "5") {

  }
  elseif($ID === "6") {

  }
  elseif($ID === "7") {

  }
  elseif($ID === "8") {

  }
  elseif($ID === "9") {

  }
  elseif($ID === "10") {

  }
  elseif($ID === "11") {

  }
  elseif($ID === "12") {

  }
  elseif($ID === "13") {

  }
  elseif($ID === "14") {

  } 
} else {
  echo "FUNCTION NOT OK";
}
*/


//Bug fiksing --- 1-14         FERDIG
if ($fukt > $fuktBug) {
  # Fiks det siste som må gjøres i mailene.
  switch($ID){
    //Rom 235
    case "1":  
        $til = "lexus.andersen@tffk.no";
        $emailTittel = "Varsel for Rom 235! (Finnfjordbotn)";
        $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 235 (IKT-Rom).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
        $tilEmailer = "lexus.andersen@tffk.no";
        SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
        echo "FAIL";
      break;
    case "2":
      $til = "lexus.andersen@tffk.no";
      $emailTittel = "Varsel for Server-Rommet! (Gibostad)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Server-Rommet (Gibostad).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "3":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Kantine Kjøl! (Finnfjordbotn)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Kantine Kjøl (Finnfjordbotn).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "4":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Kantine Kjøl! (Gibostad)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Kantine Kjøl (Gibostad).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "5":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Kantine Frys! (Finnfjordbotn)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Kantine Frys (Finnfjordbotn).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "6":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Kantine Frys! (Gibostad)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Kantine Frys (Gibostad).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "7":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Rom 256 (R&M Kjøl Frukt og Grønt)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 256 (R&M Kjøl Frukt og Grønt).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "8":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Rom 257 (R&M Kjøl Fisk)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 257 (R&M Kjøl Fisk).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "9":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Rom 258 (R&M Kjøl Melk)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 258 (R&M Kjøl Melk).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "10":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Rom 261! (Kjøl Kjøtt)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 261! (Kjøl Kjøtt).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "11":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Rom 260! (Kjøtt Frys)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 260 (Kjøtt Frys).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "12":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Rom 273! (Frys Fisk)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Rom 273 (Frys Fisk).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "13":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Båt Simulator Rommet! (Gibostad)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Båt Simulator Rommet (Gibostad).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
    case "14":
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, markus.thuv.karlsen@tffk.no";
      $emailTittel = "Varsel for Traktor Simulator Rommet! (Gibostad)";
      $emailInnhold = "Hei!<br>Det var en feil på målingen av sensoren på Traktor Simulator Rommet (Gibostad).<br>Dette ble lest:<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
      echo "FAIL";
      break;
  }
} 
//Server rom varsling --- 1-2         FERDIG
elseif($temp > $ServerRomGrenseHøy) {
  switch($ID){
    case "1":
      $til = "lexus.andersen@tffk.no, markus.thuv.karlsen@tffk.no, hans.arne.sorensen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $emailTittel = "Varsel for Rom 235! (IKT-Rom)";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 235 (IKT-Rom) .<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      $tilEmailer = "lexus.andersen@tffk.no, markus.thuv.karlsen@tffk.no, hans.arne.sorensen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);

      Query();
    break;
    
    case "2":
      Query();

      //$til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $emailTittel = "Varsel for Server-Rommet! (Gibostad) ";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Server-Rommet (Gibostad) .<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      //$tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $tilEmailer = "lexus.andersen@tffk.no";
      $til = "lexus.andersen@tffk.no";
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;
  }
}
//Kantine Varsling Kjøl --- 3-4         FERDIG
/*
elseif($temp > $kjølGrenserHøy || $temp < $kjølGrenserLav) {
  switch($ID){
    case "3":
      Query();

      $til = "lexus.andersen@tffk.no, markus.thuv.karlsen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $emailTittel = "Varsel for Kantine Kjøl! (Finnfjordbotn)";
      $tilEmailer = "lexus.andersen@tffk.no, markus.thuv.karlsen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      
      if($temp > $kjølGrenserHøy) {
        $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Kantine Kjøl. (Finnfjordbotn)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      } else {
        $emailInnhold = "Hei!<br>Det ble målt for lav temperatur på Kantine Kjøl. (Finnfjordbotn)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      }

      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

    case "4":
      Query();

      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $emailTittel = "Varsel for Kantine Kjøl (Gibostad)";

      if($temp > $kjølGrenserHøy) {
        $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Kantine Kjøl. (Gibostad)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      } else {
        $emailInnhold = "Hei!<br>Det ble målt for lav temperatur på Kantine Kjøl. (Gibostad)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      }

       SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;
  }
}
*/
//Kantine og R&M Varsling Frys --- 5-6, 11-12         FERDIG
/*
elseif($temp > $frysGrenserHøy) {
  switch($ID){
    case("5"):
      Query();
      
      $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $emailTittel = "Varsel for Kantine Frys! (Finnfjordbotn)";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Kantine Frys. (Finnfjordbotn)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

    case("6"):
      Query();
      
      $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $emailTittel = "Varsel for Kantine Frys! (Gibostad)";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Kantine Frys. (Gibostad)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

    case("11"):
      Query();
      
      $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $emailTittel = "Varsel for Rom 260! (Kjøtt Frys)";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 260. (Kjøtt Frys)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

    case("12"):
      Query();
      
      $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $emailTittel = "Varsel for Rom 260! (Kjøtt Frys)";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 273. (Fisk Frys)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

  }
}
*/
//R&M Varsling Frukt og Grønt --- 7         FERDIG
/*
elseif($temp < $kjølGrenserFruktLav || $temp > $kjølGrenserFruktHøy) {
  if($ID === "7") {
    Query();
      
    $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
    $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
    $emailTittel = "Varsel for Rom 256! (Frukt og Grønnt Kjøl)";

    if($temp < $kjølGrenserFruktLav) {
      $emailInnhold = "Hei!<br>Det ble målt for lav temperatur på Rom 256. (Frukt og Grønnt Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
    } else {
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 256. (Frukt og Grønnt Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";  
    }
       
    SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
  }
}
*/
//R&M Varsling Kjøl --- 8-10         FERDIG
/*
elseif($temp > $kjølGrenserHøyRogM || $temp < $kjølGrenserLavRogM) {
  switch($ID){
    case("8"):
      Query();
      
      $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $emailTittel = "Varsel for Rom 257! (Fisk Kjøl)";

      if($temp > $kjølGrenserHøyRogM) {
        $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 257. (Fisk Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      } else {
        $emailInnhold = "Hei!<br>Det ble målt for lav temperatur på Rom 257. (Fisk Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      }
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

    case("9"):
      Query();
      
      $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $emailTittel = "Varsel for Rom 258! (Melk Kjøl)";

      if($temp > $kjølGrenserHøyRogM) {
        $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 258. (Melk Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      } else {
        $emailInnhold = "Hei!<br>Det ble målt for lav temperatur på Rom 258. (Melk Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      }
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

    case("10"):
      Query();
      
      $til = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $tilEmailer = "lexus.andersen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no, vegard.hansen@tffk.no";
      $emailTittel = "Varsel for Rom 261! (Kjøtt Kjøl)";

      if($temp > $kjølGrenserHøyRogM) {
        $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Rom 261. (Kjøtt Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      } else {
        $emailInnhold = "Hei!<br>Det ble målt for lav temperatur på Rom 261. (Kjøtt Kjøl)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      }
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;
  }
}
*/
/*
//Simulator Rom --- 13-14         FERDIG
elseif($temp > $varselTempHøySim) {
  switch($ID){
    case("13"):
      Query();
      
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $emailTittel = "Varsel for Båt Simulator Rommet! (Gibostad)";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Båt Simulator Rommet. (Gibostad)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
    break;

    case("14"):
      Query();
      
      $til = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      $emailTittel = "Varsel for Traktor Simulator Rommet! (Gibostad)";
      $emailInnhold = "Hei!<br>Det ble målt for høy temperatur på Traktor Simulator Rommet. (Gibostad)<br>Dette ble lest:<br>---------------------<br>Temperatur: " . $temp . " *C<br>Fuktighet: " . $fukt . " %<br>---------------------<br>";
      $tilEmailer = "lexus.andersen@tffk.no, tom.kristiansen@tffk.no, roger.haugnes@tffk.no, thomas.andresen@tffk.no";
      
      SendMail($til, $emailTittel, $emailInnhold, $tilEmailer);
   break;
  }
} 
*/
else {
  Query();
}

?>