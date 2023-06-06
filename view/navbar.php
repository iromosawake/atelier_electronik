<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-list-4">        
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../atelier-electronik/index.php?action=tableau_bord">Tableau de bord<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../atelier-electronik/index.php?action=new_appareil">Dépannage<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../atelier-electronik/index.php?action=all_clients">Clients<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../atelier-electronik/index.php?action=get_appareils_depannage">Appareils en cours<span class="sr-only">(current)</span></a>
            </li>                  
            <li class="nav-item active">
                <a class="nav-link" href="../atelier-electronik/index.php?action=get_appareils_prets">Appareils prêts<span class="sr-only">(current)</span></a>
            </li>
<!--            <li class="nav-item active">
                <a class="nav-link" href="../index.php?action=get_appareils_archives">Archives<span class="sr-only">(current)</span></a>
            </li>    -->
            <?php if (isset($_SESSION['login_utilisateur'])) { ?>
            <li class="nav-item active">
                <a class="nav-link" href="../atelier-electronik/index.php?action=parametres">Paramètres<span class="sr-only">(current)</span></a>
            </li> 
                <li class="nav-item active">
                    <a class="nav-link" href="../atelier-electronik/index.php?action=user_deconnexion">Déconnexion<span class="sr-only">(current)</span></a>
                </li>                 
            <?php } ?>
                
        </ul>
    </div>

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="nom prenom reference appareil" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>

</div>
</nav>

