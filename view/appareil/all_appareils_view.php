<?php ob_start(); ?>
<!-- Modal -->
<div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>

<div class="container">    
    <h4><?= $title ?></h4>
    <hr>
        <div class="row">               
            <?php
            foreach ($appareils as $a) {
                ?>
                <div class="col-12 col-sm-4 col-md-3">
                    <div class="card" >
                        <?php if ($a['photo1'] == "") { ?>
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" 
                                 preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6c757d"></rect>
                                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Photo</text></svg>
                        <?php } else { ?>
                            <img src="<?= $a['photo2'] ?>" height="200px" class="card-img-top" alt="Photo principale">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $a['nom'] . ' ' . $a['prenom'] ?></h5>
                                <h6 class="card-title">Ref : <?= $a['reference'] ?></h6>
                                <p class="card-text"><?= $a['description'] ?></p>     
                                <p class="card-text etat_appareil"><?= (isset($a['libelle'])) ? ucfirst($a['libelle']) : '' ?></p>   
                                <a href="../../index.php?action=update_appareil&id_appareil=<?= $a['idappareil'] ?>" data-id='<?= $a['idappareil'] ?>' class='appareil_info btn btn-primary col-sm-auto'>Aperçu</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Date de dépôt : <?= $a['date_depot'] ?></small>
                            </div>
                    </div> 
                </div>       
                <?php
            }
            ?>

        </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $('.appareil_info').click(function (e) {
            e.preventDefault();
            var appareil_id = $(this).data('id');
            // AJAX request
            $.ajax({
                url: 'index.php?action=get_appareil',
                type: 'post',
                data: {appareil_id: appareil_id},
                success: function (response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#empModal').modal('show');
                }
            });
        });
    });
</script>

<?php
$content = ob_get_clean();
