<?php
/**
 * Created by PhpStorm.
 * User: Sandrine
 * Date: 08/04/2019
 * Time: 15:59
 */
require_once __DIR__.'/../includes.php';

$allUsers=getAllUsers();

foreach($allUsers as $user){
    $row="<tr><th scope=\"row\">".$user['identifiant']."</th>";
    $row.="<td>".$user['nom']."</td>";
    $row.="<td>".$user['prenom']."</td>";
    $row.="<td>".$user['adresse_mail']."</td>";
    $row.="<td>".$user['adresse']."</td>";
    $row.="<td>".$user['ville']."</td>";

    echo $row;
}