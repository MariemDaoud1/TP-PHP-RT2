<?php

require_once "dbh.inc.php";

$query="SELECT * FROM students;";
$stmt=$pdo->query($query);
$students=$stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1 style="text-align: center;">Liste des étudiants</h1>

<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date de naissance</th>
                <th>Âge</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= $student['date_de_naissance'] ?></td>
                <td>
                    <?php
                    // Calcul de l'âge
                    $birthDate = new DateTime($student['date_de_naissance']);
                    $today = new DateTime();
                    $age = $today->diff($birthDate)->y;
                    echo $age;
                    ?> ans
                </td>
                <td><a href="detailEtudiant.php?id=<?= $student['id'] ?>">Détails</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>