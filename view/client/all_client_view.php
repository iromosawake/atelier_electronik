<?php ob_start(); ?>

<!-- Modal -->
<div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">

        Modal content
        <div class="modal-content">

            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a href="../../index.php?action=update_appareil&id_appareil=" type="button"  id="sauver" class="btn btn-primary" ></a>
                <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>

<!--- --->

<div class="container">
    <h4><?= $title ?></h4>
    <hr>      
        <ol class="list-group">
            <?php
            foreach ($clients as $a) {
                ?>
                <a href="../../index.php?action=update_appareil&id_appareil=<?= $a['idclient'] ?>" data-id='<?= $a['idclient'] ?>' >
                    <li class="list-group-item"><?= $a['nom'] . ' ' . $a['prenom'] ?>  
                    </li>
                </a>
                <?php
            }
            ?>
        </ol>
</div>

    <script type='text/javascript'>
        $(document).ready(function () {
            $('.appareil_info').click(function () {
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
    