<?php ob_start(); ?>
<div class="container">
    <h4>Fiche dépannage #<?= $depannage['idappareil'] ?></h4>

    <a href="../../index.php?action=print_fiche_appareil&id_appareil=<?= $depannage['idappareil'] ?>" target="_blank" class="btn btn-light" id="print_fiche">Imprimer fiche</a>
    <hr>

        <h5>Reference : <?= htmlspecialchars($depannage['reference']) ?></h5>


        <?php if (isset($depannage['photo1']) && $depannage['photo1'] != "") { ?>
            <div class="container-fluid">
                <img style="text-align:center;display:inline-block;display:inline;float:none;" src="<?= $depannage['photo2'] ?>" class="img-thumbnail"  alt="Photo principale">
            </div>
        <?php } else { ?>
            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" 
                 preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6c757d"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Photo</text></svg>                
        <?php } ?>
        <div class="center">
            <p>Etat : <?= ucfirst($statut['libelle']) ?> </p> 
        </div>
        <div class="row">
            <div class="btn-statut">
                <button id="2" class="btn btn-outline-primary btn-lg btn-block" >Devis envoyé client</button>
            </div>


            <div class="btn-statut">
                <button id="3" class="btn btn-outline-secondary btn-lg btn-block" >Pieces en commande</button>
            </div>
            <div class="btn-statut">
                <button id="4" class="btn btn-outline-success btn-lg btn-block">Prêt terminé</button>
            </div>
            <div class="btn-statut">
                <button id="5" class="btn btn-outline-warning btn-lg btn-block">Recyclé</button> 
            </div>
            <div class="btn-statut">
                <button id="6" class="btn btn-outline-dark btn-lg btn-block">En extérieur </button>
            </div>
            <div class="btn-statut">
                <button id="7" class="btn btn-outline-danger btn-lg btn-block">Devis refusé</button>
            </div>
            <div class="btn-statut">
                <button id="8" class="btn btn-outline-info btn-lg btn-block"> Attente destruction</button>
            </div>
        </div>

        <label for="reference">Code défaut : <?= $depannage['code_defaut'] ?></label>   

        <label for="symptome">Symptôme : <?= $depannage['symptome'] ?>"</label>

        <label for="panne">Description défaut : <?= $depannage['description'] ?></label>


        <form>
            <div class="form-group">
                <label for="devis">Devis</label> 
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Marque</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>PANASONIC</option>
                        <option value="1">SONY</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </form>
</div>
<?php $content = ob_get_clean(); ?>
