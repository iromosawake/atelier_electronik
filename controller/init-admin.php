<?php
/*
 * Verifie s'il existe une session est si non renvoi sur la page de connexion
 */
if (!isset($_SESSION['login_utilisateur']) && $_GET['action']!='user_connexion') {
    header('Location:index.php?action=user_connexion');
}