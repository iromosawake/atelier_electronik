<?php ob_start(); ?>

<div class="container">
    <h4><?= $title ?></h4>
    <hr>
    <form method="POST" action="../../index.php?action=new_client">

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" required="true" id="nom" name="nom" placeholder="Nom">
        </div>       

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text"  name="prenom" class="form-control" required="true" id="prenom" placeholder="Prénom">
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" class="form-control" required="true" name="telephone" id="telephone" placeholder="0410203040" >
        </div>

        <div class="form-group">
            <label for="rue">N° et rue</label>
            <input type="text" class="form-control" required="true" name="rue" id="rue" placeholder="Rue de la fontaine" >
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" required="true" name="ville" id="ville" placeholder="Orcines" >
        </div>
        <div class="form-group">
            <label for="code_postal">Code postal</label>
            <input type="text" class="form-control" required="true" name="code_postal" id="code_postal" placeholder="63000" >
        </div>

        <button type="submit" id='save_client_button' class="btn btn-primary">Enregistrer</button>
    </form>
</div>

<script>
    $(function () {
        $("#save_client_button").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'index.php?action=add_client',
                data: {nom: $('#nom').val(),
                    prenom: $('#prenom').val(),
                    telephone: $('#telephone').val(),
                    rue: $('#rue').val(),
                    ville: $('#ville').val(),
                    code_postal: $('#code_postal').val()
                },
                dataType: "json",
                success: function (response) {
                    switch (response.mess) {
                     case 1:
                     alert('Client ajouté avec succès');
                     $('#empModal').modal('hide');
                     break;
                     case 2:
                     alert('Le client existe déjà');
                     break;
                     
                     case 3:
                     alert('Veuillez remplir tous les champs obligatoires');
                     break;
                     
                     }
                }
            });
        });
    });
</script>
<?php
$content = ob_get_clean();
