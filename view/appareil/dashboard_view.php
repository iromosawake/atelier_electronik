<?php ob_start(); ?>
<div class="container">    
    <h4><?= $title ?></h4>
    <hr>
    <?php
    $nombre_total_autorise = 40;
    ?>
    Nombre total appareil atelier <?= $nb_total_appareil['nb_total'] ?>/<?= $nombre_total_autorise ?>
    <div class="progress">        
        <div class="progress-bar bg-success" role="progressbar" style="width:<?= ($nb_total_appareil['nb_total'] * 100) / $nombre_total_autorise ?>%" aria-valuenow="<?= $nb_total_appareil['nb_total'] ?>" 
             aria-valuemin="0" aria-valuemax="40">            
        </div>
    </div>
    <p>Dont <span class="dangr"><?= $nb_appareil_non_vus['non_vus'] ?></span> appareil non diagnostiquées</p>
    
    <p>Appareils attente pièces commande : <span class="attnt"><?= $nb_pieces_att['nb_attente_pieces'] ?></span></p>
    
    <h6>Dépannages non terminées/catégorie</h6>
    <p> BLANC : <span><?= $nb_blanc['nb_blanc'] ?></span> </p>
    <p> BRUN  : <span><?= $nb_brun['nb_brun'] ?></span> </p>
    <p> GRIS  : <span><?= $nb_gris['nb_gris'] ?></span></p>
    <br>
    <p>Appareils PRÊTS <span class="attnt"><?= $nb_appareil_prets['app_prets'] ?></span> attente récupération client</p>
    <p>Appareils <span class="sslign">non dépannés</span> à l'atelier depuis UN MOIS ou PLUS : <span class="dangr"><?= $nb_appareil_attente_mois['nb_app_un_mois'] ?></span></p>
</div>


<?php $content = ob_get_clean();
?>
