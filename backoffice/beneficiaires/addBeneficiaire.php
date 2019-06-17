<?php
/**
 * Created by PhpStorm.
 * User: Sandrine
 * Date: 23/05/2019
 * Time: 00:26
 */

require_once __DIR__ . '/../../includes.php';

$check = true;

if (isset($_POST['nom']) === true && isset($_POST['adress']) === true && isset($_POST['city']) === true && isset($_POST['lat']) === true && isset($_POST['long']) === true && isset($_POST['type']) === true) {
    $nom = htmlspecialchars($_POST['nom']);
    $adress = htmlspecialchars($_POST['adress']);
    $city = htmlspecialchars($_POST['city']);
    $type = htmlspecialchars($_POST['type']);
    $lat = htmlspecialchars($_POST['lat']);
    $long = htmlspecialchars($_POST['long']);
} else {
    $check = false;
}

if ($check === true) {
    addBeneficiaire($nom, $adress, $city, $lat, $long, $type);
    echo 'Bénéficiaire ajouté !';
} else {
    echo 'Error : missing Value';
}