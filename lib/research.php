<?php
// Binôme Groupe 3 : Monoy Olivier / Nollet Antoine
$content = "http://vlille.fil.univ-lille1.fr/?";

const METHOD = INPUT_POST;
const SERVICE_VALUES = ["EN SERVICE","HORS SERVICE"];

$nom = filter_input(METHOD,'nom',FILTER_SANITIZE_STRING);
if ($nom === NULL) $nom = "";
else if ($nom === FALSE) $nom = "";
else if ($nom == "") $nom = "";
else{
    $nom = str_replace(" ","%20",$nom);
    $tmp = str_replace("'","%27",$nom);
    $nom = "&nom=$tmp";
}

$commune = filter_input(METHOD,'commune',FILTER_SANITIZE_STRING);
if ($commune === NULL) $commune = "";
else if ($commune === FALSE) $commune = "";
else if ($commune == "") $commune = "";
else {
  $commune = str_replace(" ","%20",$commune);
  $tmp = str_replace("'","%27",$commune);
  $commune = "&commune=$tmp";
}

$velos = filter_input(METHOD,'velos',FILTER_VALIDATE_INT);
if ($velos === NULL) $velos = "";
else if ($velos === FALSE) $velos = "";
else $velos = "&nbvelosdispo=$velos";

$bornes = filter_input(METHOD,'bornes',FILTER_VALIDATE_INT);
if ($bornes === NULL) $bornes = "";
else if ($bornes === FALSE) $bornes = "";
else $bornes = "&nbplacesdispo=$bornes";

$service = filter_input(METHOD,'service',FILTER_SANITIZE_STRING);
if ($service === NULL) $service = "";
else if (!in_array($service,SERVICE_VALUES) || $service === FALSE ) $service = "";
else {
  $service = str_replace(" ","%20",$service);
  $service = "&etat=$service";
}

$content = $content.$nom.$commune.$velos.$bornes.$service;
$content = file_get_contents($content);
$reponse = json_decode($content,TRUE);


?>
