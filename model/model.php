<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//USER
function connexion($login, $pass) {
    $req = DataBase::getConnection()->prepare("SELECT * FROM utilisateur where login=:lg and passeword=:p;");
    $req->bindParam(':lg', $login, PDO::PARAM_STR);
    $req->bindParam(':p', $pass, PDO::PARAM_STR);
    $req->execute();

    $user = $req->fetch();
    $req->closeCursor();
    return $user;
}

//CLIENT
function get_client_list() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM client order by nom");
    $req->execute();
    $user = $req->fetchAll();
    $req->closeCursor();
    return $user;
}

//TYPES APPAREIL
function get_types_list() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM type_appareil order by libelle");
    $req->execute();
    $types = $req->fetchAll();
    $req->closeCursor();
    return $types;
}


function get_cat_list() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM categorie_appareil order by lib_categorie_appareil");
    $req->execute();
    $types = $req->fetchAll();
    $req->closeCursor();
    return $types;
}

function get_marque_list() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM marque_appareil order by lib_marque;");
    $req->execute();
    $marques = $req->fetchAll();
    $req->closeCursor();
    return $marques;
}

//Appareil
function get_appareils() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM appareil order by date_depot;");
    $req->execute();
    $appareils = $req->fetchAll();
    $req->closeCursor();
    return $appareils;
}

function get_appareilsPrets() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM appareil 
                    INNER JOIN client ON id_client=idclient
                    INNER JOIN statut_appareil ON idstatut_appareil=statut
                    where  statut in (4,7) 
                    AND date_sortie IS NULL
                    group by idappareil
                    order by date_depot desc;");
    $req->execute();
    $appareils = $req->fetchAll();
    $req->closeCursor();
    return $appareils;
}

function get_appareilAtelier() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM appareil 
                    INNER JOIN client ON id_client=idclient
                    INNER JOIN statut_appareil ON idstatut_appareil=statut
                    where  statut in (1,2,3,6) group by idappareil
                    order by date_depot desc;");
    $req->execute();
    $appareils = $req->fetchAll();
    $req->closeCursor();

    return $appareils;
}

function get_appareilArchives() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM appareil inner join statut_appareil where idstatut_appareil=statut and statut in (5,8) order by date_depot;");
    $req->execute();
    $appareils = $req->fetchAll();
    $req->closeCursor();

    return $appareils;
}

function get_appareil($id) {
    $req = DataBase::getConnection()->prepare("SELECT * FROM appareil inner join statut_appareil where idstatut_appareil=statut and idappareil=$id;");
    $req->execute();
    $appareil = $req->fetch();
    $req->closeCursor();
    return $appareil;
}

function getAppareilClientByIdAppareil($idAppareil) {
    $req = DataBase::getConnection()->prepare("SELECT * FROM client inner join appareil where appareil.id_client = client.idclient and idappareil=$idAppareil;");
    $req->execute();
    $ClientAppareil = $req->fetch();
    $req->closeCursor();
    return $ClientAppareil;
}

function add_appareil($ref, $type, $photo1, $photo2, $statut, $code_defaut, $symptome, $description, $solution, $id_client, $marque, $montant_autorise, $technicien_prenan_encharge, $categorie, $appareil_imposant) {
    $req = DataBase::getConnection()->prepare("INSERT INTO appareil (reference,type,date_depot,photo1,photo2,statut,code_defaut,symptome,description,solution,id_client,marque,montant_autorise,
        technicien_prenan_encharge,categorie,appareil_imposant) 
        VALUES (:reference,:type,:date_depot,:photo1,:photo2,:statut,:code_defaut,:symptome,:description,:solution,:client,:marque,:montant_autorise,:technicien_prenan_encharge,:categorie,:appareil_imposant);");

    $req->execute(array(
        'reference' => $ref,
        'type' => $type,
        'date_depot' => date('Y-m-d H:i:s'),
        'photo1' => $photo1,
        'photo2' => $photo2,
        'statut' => $statut,
        'code_defaut' => $code_defaut,
        'symptome' => $symptome,
        'description' => $description,
        'solution' => $solution,
        'client' => $id_client,
        'marque' => $marque,
        'montant_autorise' => $montant_autorise,
        'technicien_prenan_encharge' => $technicien_prenan_encharge,
        'categorie' => $categorie,
        'appareil_imposant' => $appareil_imposant
    ));
    return DataBase::getConnection()->lastInsertId();
}

function add_client($nom, $prenom, $tel, $rue, $ville, $cp) {
    $req = DataBase::getConnection()->prepare("INSERT INTO client (nom,prenom,numero_tel,rue,ville,code_postal) VALUES (:nom, :prenom, :tel,:r,:v,:cp);");
    $req->execute(array(
        'nom' => ucfirst($nom),
        'prenom' => ucfirst($prenom),
        'tel' => $tel,
        'r' => $rue,
        'v' => $ville,
        'cp' => $cp
    ));
}

function client_existe($nom, $prenom) {
    $req = DataBase::getConnection()->prepare("SELECT idclient FROM client where nom='$nom' and prenom='$prenom';");
    $req->execute();
    $aclient = $req->fetch();
    $req->closeCursor();
    return $aclient;
}

//STATUT APPAREIL
function get_statut_byId($id) {
    $req = DataBase::getConnection()->prepare("SELECT libelle FROM appareil inner join statut_appareil where idstatut_appareil=statut and idappareil=$id;");
    $req->execute();
    $appareil = $req->fetch();
    $req->closeCursor();
    return $appareil;
}

function get_statut_list() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM statut_appareil;");
    $req->execute();
    $statuts = $req->fetchAll();
    $req->closeCursor();
    return $statuts;
}

function get_statut_applicable_list() {
    $req = DataBase::getConnection()->prepare("SELECT * FROM statut_appareil where idstatut_appareil <> 1;");
    $req->execute();
    $statuts = $req->fetchAll();
    $req->closeCursor();
    return $statuts;
}

//DASHBOARD
//
//nombre total des appareils à l'atelier
function get_total_appareil() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) as nb_total FROM appareil;");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

//appareil non vu
function get_nb_appareil_non_vue() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) as non_vus FROM appareil where statut=1;");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

//les appareil datant d'un mois ou plus
function get_nb_appareil_deposees_depuis_un_mois() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) as nb_app_un_mois FROM appareil where MONTH(date_depot) <= (SELECT MONTH(NOW())-1) AND  YEAR(date_depot)=YEAR(NOW()) and statut <> 4;");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

//appareil blanc
function get_nb_appareil_blanc() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) as nb_blanc FROM appareil where type=2 AND date_sortie IS NULL AND statut NOT IN(4,5,7,8,9);");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

//appareil blanc
function get_nb_appareil_brun() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) as nb_brun FROM appareil where type=1 AND date_sortie IS NULL AND statut NOT IN(4,5,7,8,9);");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

//appareil blanc
function get_nb_appareil_gris() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) as nb_gris FROM appareil where type=3 AND date_sortie IS NULL AND statut NOT IN(4,5,7,8,9);");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

//appareil dépannees attente recupération
function get_nb_appareil_pret() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) AS app_prets FROM appareil where date_sortie IS NULL AND statut=4;");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}

//appareil attente pieces
function get_nb_appareil_att_pieces() {
    $req = DataBase::getConnection()->prepare("SELECT count(*) AS nb_attente_pieces FROM appareil where date_sortie is null and statut=3;");
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result;
}