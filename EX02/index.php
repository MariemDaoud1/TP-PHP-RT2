<?php 
session_start();
include_once "Session.php";
if (isset($_POST['reset'])) {
    Session::reinitialiserSession();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion de Session</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 100px;
        }
        .card {
            border-radius: 15px;
        }
        .btn-danger {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-3">Gestion de Session</h2>
        <div class="alert 
            <?php echo (Session::getNombre_visite() == 0) ? 'alert-primary' : 'alert-success'; ?>">
            <?php 
            if (Session::getNombre_visite() == 0) {
                echo "Bienvenue à notre plateforme.";
            } else {
                echo "Merci pour votre fidélité, c'est votre " . Session::getNombre_visite() . "ᵉ visite.";
            }
            Session::incrementerVisite();
            ?>
        </div>
        <form action="PageSession.php" method="POST">
            <button type="submit" name="reset" class="btn btn-danger">Réinitialiser la session</button>
        </form>
    </div>
</div>
</body>
</html>