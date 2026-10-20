<?php
    require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Human Resource</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
        <div id="content">
            <?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>

        <main id="section">
            <h3>Human Resource and Order Entries Management</h3>
        </main>
        </div>
        <?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
    </body>
</html>
