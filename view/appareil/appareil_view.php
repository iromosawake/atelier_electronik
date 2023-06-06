<?php ob_start(); ?>

<form>
    <div class="form-group">
        <h1>Reference : <?= htmlspecialchars($appareil['reference']) ?></h1>
    </div>
    <div class="form-group">
        <?php if (isset($appareil['photo1']) && $appareil['photo1'] != "") { ?>
            <div class="col-12">
                <img src="<?= $appareil['photo2'] ?>" class="img-thumbnail"  alt="Photo principale">
            </div>
        <?php } else { ?>
            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" 
                 preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6c757d"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Photo</text></svg>                
        <?php } ?>

    </div>
    <div class="form-group">
        <label for="type_app">Etat :<span class="attnt"> <?= ucfirst($statut['libelle']) ?> </span>     
<!--                <select name="type_app" class="form-control">
            <?php
            /* foreach ($statuts as $st) {
              echo "<option value='" . $st['idstatut_appareil'] . "'>" . ucfirst($st['libelle']) . "</option>";
              } */
            ?>
            </select>-->
    </div>
    <div class="form-group">
        <label for="type_app">Catégorie : <?= ucfirst($types[0]['libelle']) ?> </label>       

<!--        <select name="type_app" class="form-control">
        <?php
        /*
          foreach ($types as $t) {
          echo "<option value='" . $t['idtype_appareil'] . "'>" . ucfirst($t['libelle']) . "</option>";
          } */
        ?>
</select>-->
    </div>

    <div class="form-group">
        <label for="reference">Code défaut : <span class="dangr"><?= $appareil['code_defaut'] ?></span></label>   
    </div>

    <div class="form-group">
        <label for="symptome">Symptôme : <?= $appareil['symptome'] ?></label>
    </div>

    <div class="form-group">
        <label for="panne">Description défaut : <?= $appareil['description'] ?></label>
    </div>
    <a href="../../index.php?action=fiche_appareil&id_appareil=<?= $_POST['appareil_id'] ?>" type="button"  id="sauver" class="btn btn-primary" >Aller à la fiche</a>

</form>

<?php $content = ob_get_clean(); ?>
