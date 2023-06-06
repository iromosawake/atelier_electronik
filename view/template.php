<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../atelier-electronik/public/styles/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../../public/styles/style_nut.css" type="text/css">
        <script src="../../public/js/jquery-3.5.1.js" type="text/javascript"></script>
        <script src="../../public/js/bootstrap.bundle.js" type="text/javascript"></script>
        <script defer src="../../public/fontawesome-free-5.15.2-web/js/all.js"></script>          
    </head>

    <body>
        <?php if (isset($exception)) { ?>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <?= $exception ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/atelier-electronik/view/navbar.php'; ?>
        <?= $content ?>
    </body>


    <footer>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="#">CHAKHGUEREEV LIOMA</a>
        </div>
    </footer>
</html>