<?php
require_once "dbh.inc.php";

// Vérifie si l'id est fourni dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide.");
}

$id = $_GET['id'];

try {
    $query = "SELECT * FROM students WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        die("Étudiant non trouvé.");
    }
} catch (PDOException $e) {
    die("Erreur de requête : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'étudiant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Détails de l'étudiant</h1>
    <div class="student-details">
        <p><strong>ID :</strong> <?= $student['id'] ?></p>
        <p><strong>Nom :</strong> <?= htmlspecialchars($student['name']) ?></p>
        <p><strong>Date de naissance :</strong> <?= $student['date_de_naissance'] ?></p>
        <p><strong>Âge :</strong> 
            <?php
            $birthDate = new DateTime($student['date_de_naissance']);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;
            echo $age;
            ?> ans
        </p>
    </div>
</body>
</html>