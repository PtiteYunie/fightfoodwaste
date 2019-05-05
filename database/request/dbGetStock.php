<?php

require_once __DIR__ . '/../../includes.php';

function getProductsByDemandeId($demande)
{
    $db = DatabaseManager::getManager();

    $request = "SELECT * FROM `produit` WHERE `id_demande`= ?";
    return ($db->getAll($request, [$demande]));
}

function getAllProduct()
{
    $db = DatabaseManager::getManager();

    $request = "SELECT * FROM `produit`";
    return ($db->getAll($request));
}

function getProductByIdList($list)
{
    $db = DatabaseManager::getManager();

    $where = $list;

    $request = "SELECT * FROM `produit` WHERE `identifiant` IN (" . $where . " )";
    return ($db->getAll($request));
}

function deleteProductById($id){
    $db = DatabaseManager::getManager();

    $request = "DELETE FROM `produit` WHERE `identifiant`=?";
    return ($db->exec($request,[$id]));
}