<?php
/**
 * Created by PhpStorm.
 * User: Sandrine
 * Date: 04/04/2019
 * Time: 11:01
 */

$_POST['commercant'] = 'commercant';
$_POST['email'] = 'patin@free.fr';


require_once __DIR__ . '/../includes.php';

if (isset($_POST['particulier']) === true) {
    if (isset($_POST['nom']) === true && isset($_POST['prenom']) === true && isset($_POST['email']) === true && isset($_POST['pwd']) === true && isset($_POST['adresse']) === true && isset($_POST['ville']) === true) { //Si toutes les variables sont set
        $name = htmlspecialchars($_POST['nom']);
        $pname = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $adress = htmlspecialchars($_POST['adresse']);
        $city = htmlspecialchars($_POST['ville']);

        $state = 1;
        $verif = true;
        //Password hash
        $password = password_hash(htmlspecialchars($_POST['pwd']), PASSWORD_DEFAULT);
        if ($password === false) {
            $verif = false;
        }

        //Email unicity check
        $result = getUserIdByMail($email);
        if ($result !== [0]) {
            echo "mail already set";
            $verif = false;
        }

        if ($verif === true) {
            set_particulier($name, $pname, $email, $password, $adress, $city, $state);
            set_role($email, 'particulier');
            echo "Variables set";
        } else {
            http_response_code(400);
            echo("Error : Verification Error");
        }
    } else {
        echo "Error : Variables not set";
    }

} elseif (isset($_POST['commercant']) === true) {
    if (isset($_POST['name']) === true && isset($_POST['Siret']) === true && isset($_POST['email']) === true && isset($_POST['pwd']) === true && isset($_POST['adress']) === true && isset($_POST['city']) === true) {
        $nameShop = htmlspecialchars($_POST['name']);
        $SIRET = htmlspecialchars($_POST['Siret']);
        $email = htmlspecialchars($_POST['email']);
        $adress = htmlspecialchars($_POST['adress']);
        $city = htmlspecialchars($_POST['city']);

        $state = 1;
        $verif = true;

        //Password hash
        $password = password_hash(htmlspecialchars($_POST['pwd']), PASSWORD_DEFAULT);
        if ($password === false) {
            $verif = false;
        }

        //Email unicity check
        $result = getUserIdByMail($email);
        if ($result !== [0]) {
            $verif = false;
        }

        if ($verif === true) {
            set_commercant($nameShop, $SIRET, $email, $password, $adress, $city, $state);
            set_role($email, 'commercant');

        } else {
            http_response_code(400);
            echo("Error : Verification Error");
        }
    } else {
        echo "Error : Variables not set";
    }
}


function set_role($mail, $roleToSet)
{
    $idUser = getUserIdByMail("\"" . $mail . "\"");
    $idRole = getRoleId($roleToSet);

    setRoleUser($idUser['identifiant'], $idRole['identifiant']);
}

