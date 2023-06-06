<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Système de Routeur
 * Projet php MVC
 */
require_once './controller/controller.php';
require_once './model/dataBase.class.php';
require_once './model/model.php';
require_once './controller/init-admin.php';
try {
//Routeur
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'user_connexion':
                userConnexion();
                break;
            case 'tableau_bord':
                dashboard();
                break;
            case 'user_deconnexion':
                user_deconnexion();
                break;
            //SAISIE NOUVEAU APPAREIL
            case 'new_appareil':
                new_appareil();
                break;
            //INSERT APPAREIL CLIENT
            case 'post_appareil':
                if ((isset($_POST['id_client']) && $_POST['id_client'] > 0) && (isset($_POST['reference_appareil']) && $_POST['reference_appareil']!='') 
                        && (isset($_POST['symptome']) && $_POST['symptome']!='')
                        && (isset($_POST['panne']) && $_POST['panne']!= '')) {
                    post_appareil_client($_POST['id_client'], $_POST['reference_appareil'], $_POST['type_app'], $_POST['code_defaut'], $_POST['symptome'], $_POST['panne']);
                } else {
                    throw new Exception('Veuillez remplir tous les champs obligatoires');
                }
                break;
            //TOUS LES APPAREILS
            case 'get_appareil':
                getAppareilAtelier();
                break;

            case 'get_appareils':
                getAppareilsAtelier();
                break;
            
            case 'get_appareils_prets':
                getAppareilsPrets();
                break;
            
            case 'get_appareils_depannage':
                getAppareilsDepannage();
                break;

            case 'get_appareils_archives':
                getAppareilsArchives();
                break;
            
            case 'new_client':
                new_client();
                break;
            
            case 'add_client':
                add_client_controller();
                break;
            
             case 'all_clients':
                 all_clients();
                break;
            
            case 'fiche_appareil':
                 fiche_appareil($_GET['id_appareil']);
                break;
            
            case 'print_fiche_appareil':
                print_fiche_appareil($_GET['id_appareil']);
                break;
            
        }
    }else{
        dashboard();
    }
} catch (Exception $e) {
    $exception = $e->getMessage();
    print_r($exception);
}