<?php ob_start(); ?>

<div class="container">
    <h4><?= $title ?></h4>
    <hr>
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
    <!---Fin modal --->

    <button class="btn btn-light" onclick="modal_client()">Nouveau client</button>
    <hr>
    <form method="POST" action="../../index.php?action=post_appareil" id="form" enctype="multipart/form-data">
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="id_client">Client *</label>
                </div>

                <select name="id_client" class="custom-select" id="id_client">
                    <?php
                    $users = get_client_list();
                    foreach ($users as $u) {
                        echo "<option value='" . $u['idclient'] . "'>" . ucfirst($u['nom']) . " " . ucfirst($u['prenom']) . "</option>";
                    }
                    ?>
                </select>
            </div> 
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Référence appareil *</span>
                </div>
                <input type="text" class="form-control" id="reference" name="reference_appareil" placeholder="Reference de l'appareil">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="marque_app">Marque *</label>
                </div>
                <select name="marque_app" class="custom-select" id="marque_app">
                    <?php
                    $marques = get_marque_list();
                    foreach ($marques as $m) {
                        echo "<option value='" . $m['idmarque_appareil'] . "'>" . strtoupper($m['lib_marque']) . "</option>";
                    }
                    ?>
                </select>
            </div> 


        </div>

        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="type_app">Appereil de catégorie *</label>
                </div>
                <select name="type_app" class="custom-select" id="type_app">
                    <?php
                    $types = get_types_list();
                    foreach ($types as $t) {
                        echo "<option value='" . $t['idtype_appareil'] . "'>" . ucfirst($t['libelle']) . "</option>";
                    }
                    ?>
                </select>
            </div> 
        </div>

        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="cat_app">Catégorie *</label>
                </div>
                <select name="cat_app" class="custom-select" id="cat_app">
                    <?php
                    $cats = get_cat_list();
                    foreach ($cats as $c) {
                        echo "<option value='" . $c['id_categorie_appareil'] . "'>" . ucfirst($c['lib_categorie_appareil']) . "</option>";
                    }
                    ?>
                </select>
            </div> 
        </div>

        <div class="form-group">
            <label for="fileinput" class="label-file">Prendre photo</label>
            <input id="fileinput" data-maxwidth="620" data-maxheight="400"  class="form-control input-file" type="file" accept="image/*" capture="user">
            <div id="preview"></div>
        </div>

        <div class="form-group">
            <label><input  name="taille_appareil" type="checkbox" value="true" id="taille_appareil"> Appareil imposant </label>
        </div>
        

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Code défaut</span>
                </div>
                <input type="text"  name="code_defaut" class="form-control" id="code_defaut" placeholder="ex : E16">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Symptôme panne *</span>
                </div>
                <textarea class="form-control" name="symptome" id="symptome" placeholder="Plus rien à l'affichage" rows="1"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="panne">Pronostique rapide *</label>
            <textarea class="form-control" name="panne" id="panne" placeholder="Tester les LEDs..." rows="3"></textarea>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Montant autorisé </span>
                </div>
                <input type="text" class="form-control" name="montant_autorise" id="montant_autorise" placeholder="80€">
            </div>
        </div>
        <button type="submit" value="Upload" class="btn btn-primary btn-lg btn-block">Enregistrer</button>
    </form>
</div>

<script type='text/javascript'>
    function modal_client() {
        //var appareil_id = $(this).data('id');
        // AJAX request
        $.ajax({
            url: 'index.php?action=new_client',
            type: 'post',
            data: {appareil_id: 1},
            success: function (response) {
                $('.modal-body').html(response);
                $('#empModal').modal('show');
            }
        });
    }
</script>

<script type="text/javascript">
    var fileinput = document.getElementById('fileinput');
    var max_width = fileinput.getAttribute('data-maxwidth');
    var max_height = fileinput.getAttribute('data-maxheight');
    var preview = document.getElementById('preview');
    var form = document.getElementById('form');
    function processfile(file) {
        if (!(/image/i).test(file.type)) {
            alert("Fichier " + file.name + " n\'est pas une image.");
            return false;
        }
        // read the files
        var reader = new FileReader();
        reader.readAsArrayBuffer(file);
        reader.onload = function (event) {
            // blob stuff
            var blob = new Blob([event.target.result]); // create blob...
            window.URL = window.URL || window.webkitURL;
            var blobURL = window.URL.createObjectURL(blob); // and get it's URL
            // helper Image object
            var image = new Image();
            image.src = blobURL;
            //preview.appendChild(image); // preview commented out, I am using the canvas instead
            image.onload = function () {
                // have to wait till it's loaded
                var resized = resizeMe(image); // send it to canvas
                var newinput = document.createElement("input");
                newinput.type = 'hidden';
                newinput.name = 'images[]';
                newinput.value = resized; // put result from canvas into new hidden input
                form.appendChild(newinput);
            }
        };
    }

    function readfiles(files) {
        // remove the existing canvases and hidden inputs if user re-selects new pics
        var existinginputs = document.getElementsByName('images[]');
        var existingcanvases = document.getElementsByTagName('canvas');
        while (existinginputs.length > 0) { // it's a live list so removing the first element each time
            // DOMNode.prototype.remove = function() {this.parentNode.removeChild(this);}
            form.removeChild(existinginputs[0]);
            preview.removeChild(existingcanvases[0]);
        }
        for (var i = 0; i < files.length; i++) {
            processfile(files[i]); // process each file at once
        }
        fileinput.value = ""; //remove the original files from fileinput
        // TODO remove the previous hidden inputs if user selects other files
    }

// this is where it starts. event triggered when user selects files
    fileinput.onchange = function () {
        if (!(window.File && window.FileReader && window.FileList && window.Blob)) {
            alert('The File APIs are not fully supported in this browser.');
            return false;
        }
        readfiles(fileinput.files);
    }
// === RESIZE ====
    function resizeMe(img) {
        var canvas = document.createElement('canvas');
        var width = img.width;
        var height = img.height;
        // calculate the width and height, constraining the proportions
        if (width > height) {
            if (width > max_width) {
                //height *= max_width / width;
                height = Math.round(height *= max_width / width);
                width = max_width;
            }
        } else {
            if (height > max_height) {
                //width *= max_height / height;
                width = Math.round(width *= max_height / height);
                height = max_height;
            }
        }
        // resize the canvas and draw the image data into it
        canvas.width = width;
        canvas.height = height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);
        preview.appendChild(canvas); // do the actual resized preview
        return canvas.toDataURL("image/jpeg", 0.7); // get the data from canvas as 70% JPG (can be also PNG, etc.)
    }

</script>

<?php
$content = ob_get_clean();
