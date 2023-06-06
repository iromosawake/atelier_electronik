<?php

function new_appareil() {
    $title = 'Saisi d\'un nouveau appareil';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik//view/appareil/new_appareil_new.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/template.php';
}

function post_appareil_client($id_client, $reference_appareil, $type_app, $code_defaut, $symptome, $panne) {
    $photo = "";
    if (isset($_POST['images'][0])) {
        $photo = uniqid('', true) . '.jpg';
        //file_put_contents("./public/photo_bdd/" . $photo, base64_to_jpeg($_POST['images'][0]));
    }
    $montant_autorise = isset($_POST['montant_autorise']) ? $_POST['montant_autorise'] : 0;
    $appareil_imposant = isset($_POST['taille_appareil']) ? $_POST['taille_appareil'] : 0;
    
    $id_insert = add_appareil($reference_appareil, $type_app, $photo, $_POST['images'][0], 1, $code_defaut, $symptome, $panne, "", $id_client, $_POST['marque_app']
            , $montant_autorise, $_SESSION['id_utilisateur'], $_POST['cat_app'], $appareil_imposant);
    
    header('Location:index.php?action=fiche_appareil&id_appareil='.$id_insert);
}

function getAppareilsAtelier() {
    $title = 'Les appareils en atlier';
    $appareils = get_appareils();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/appareil/all_appareils_view.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/template.php';
}

function getAppareilsPrets() {
    $title = 'Les appareils terminées';
    $appareils = get_appareilsPrets();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/appareil/all_appareils_view.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/template.php';
}

function getAppareilAtelier() {
    if (isset($_POST['appareil_id'])) {
        $appareil = get_appareil($_POST['appareil_id']);

        $statut = get_statut_byId($_POST['appareil_id']);
        $statuts = get_statut_list();

        $types = get_types_list();
        //$type = getTypeAppareilByID($_POST['appareil_id']);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/view/appareil/appareil_view.php';
    }
    $statuts = get_statut_list();
    echo $content;
}

function fiche_appareil($id_appareil) {
    $title = 'Fiche appareil';
    $appareil = get_appareil($id_appareil);
    $statut = get_statut_byId($id_appareil);
    $types = get_types_list();
    $depannage = get_appareil($id_appareil);
    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/appareil/fiche_depannage_view.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/template.php';
}

function print_fiche_appareil($id_appareil) {
    $title = 'Fiche appareil #' . $id_appareil;
    $ClientAppareil = getAppareilClientByIdAppareil($id_appareil);


// Include the main TCPDF library (search for installation path).
    require_once($_SERVER['DOCUMENT_ROOT'] . '/TCPDF-main/examples/tcpdf_include.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/TCPDF-main/tcpdf.php');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($_SESSION['entreprise']);
    $pdf->SetTitle($title);

    $pdf->SetHeaderData($_SERVER['DOCUMENT_ROOT'] . "public/images/logoES.png", 227, $title, "PDF_HEADER_STRING", array(0, 64, 255), array(0, 64, 128));
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__) . '/lang/fra.php')) {
        require_once(dirname(__FILE__) . '/lang/fra.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->setFontSubsetting(true);
    $pdf->SetFont('dejavusans', '', 14, '', true);
    $pdf->AddPage();
    $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
    $html = "
    <h2>Fiche dépannage " . $ClientAppareil['idappareil'] . "</h2><hr>
    <br/>
    <p>Client : " . $ClientAppareil['nom'] . " " . $ClientAppareil['prenom'] . "<br/>
    Adresse : " . $ClientAppareil['rue'] ."<br>". $ClientAppareil['ville'] ."<br>". $ClientAppareil['code_postal'] ."<br></p>
    <br/><p>Ref appareil : " . $ClientAppareil['reference'] . "<br/>
    <br/><p>Panne : " . $ClientAppareil['symptome'] . "<br/>
    Description : " . $ClientAppareil['description'] . "<br/>
    Montant autorisé : " . $ClientAppareil['montant_autorise'] . "</p><br/>
    <hr>
    <p>
    <img src='". $ClientAppareil['photo2'] ."'>
    </p>
        ";

    $pdf->writeHTML($html, true, false, false, true, '');
    $pdf->Output('fiche_dépannage.pdf', 'I');
}

function getAppareilsDepannage() {
    $title = 'Les appareils à l\'atelier en cours de dépannage';
    $appareils = get_appareilAtelier();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/appareil/all_appareils_view.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/template.php';
}

function getAppareilsArchives() {
    $title = 'Les appareils rendus ou détruits';
    $appareils = get_appareilArchives();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/appareil/all_appareils_view.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/template.php';
}

function new_client() {
    $title = 'Nouveau client';
    //
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/client/new_client_view.php';
    echo $content;
}

function all_clients() {
    $title = 'Liste client';
    $clients = get_client_list();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/client/all_client_view.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/template.php';
}

function add_client_controller() {
    if ((isset($_POST['nom']) && $_POST['nom'] != "") && (isset($_POST['prenom']) && $_POST['prenom'] != "") &&
            (isset($_POST['telephone']) && $_POST['telephone'] != "") && (isset($_POST['ville']) && $_POST['ville'] != "") &&
            (isset($_POST['rue']) && $_POST['rue'] != "") && (isset($_POST['code_postal']) && $_POST['code_postal'] != "")) {

        if (!client_existe($_POST['nom'], $_POST['prenom'])) {
            add_client($_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['rue'], $_POST['ville'], $_POST['code_postal']);
            echo jsonResponse(1);
        } else {
            echo jsonResponse(2);
        }
    } else {
        echo jsonResponse(3);
    }
}

function jsonResponse($message) {
    $mess = array('mess' => $message);
    return json_encode($mess);
}

function userConnexion() {
    if (isset($_POST['inputLogin']) && isset($_POST['inputPassword'])) {
        //securiser
        $login = htmlspecialchars($_POST['inputLogin']);
        $pass = htmlspecialchars($_POST['inputPassword']);
        $pass = sha1($pass);
        $user = connexion($login, $pass);
        if (!$user) {
            throw new Exception("Erreur de connexion, le nom d\'utilisateur ou le mot de passe ne corréspond pas.");
        } else {
            $_SESSION['id_utilisateur'] = $user['idutilisateur'];
            $_SESSION['login_utilisateur'] = $user['login'];
            $_SESSION['inscrit_depuis_utilisateur'] = $user['inscrit_depuis'];
            $_SESSION['entreprise'] = 'Electronik Service';
        }
        header('Location:index.php?action=tableau_bord');
    }if (isset($_SESSION['login_utilisateur'])) {
        header('Location:index.php?action=tableau_bord');
    } else {

        $title = 'Connexion';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/user/user_view.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/template.php';
    }
}

function dashboard() {
    $title = 'Tableau de bord';
    $nb_total_appareil = get_total_appareil();
    $nb_appareil_non_vus = get_nb_appareil_non_vue();
    $nb_appareil_attente_mois = get_nb_appareil_deposees_depuis_un_mois();
    $nb_blanc = get_nb_appareil_blanc();
    $nb_brun = get_nb_appareil_brun();
    $nb_gris = get_nb_appareil_gris();
    $nb_appareil_prets = get_nb_appareil_pret();
    $nb_pieces_att = get_nb_appareil_att_pieces();
    $nb_appareil_gros_electromenager_atelier = "";
    $nb_appareil_gros_TV_atelier = "";
    $nb_appareil_gros_electromenager_atelier = "";

    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/appareil/dashboard_view.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/template.php';
}

function user_deconnexion() {
    $_SESSION = array();
    session_destroy();
    //suppression des cokies
    header('Location:../../index.php');
}

function base64_to_jpeg($base64_string) {
    $data = explode(',', $base64_string);
    return base64_decode($data[1]);
    ;
}
