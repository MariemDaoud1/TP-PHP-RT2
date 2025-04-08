<?php
require_once "auth.inc.php";
require_once "dbh.inc.php";
require_once "user.php";
require_once "student.php";
require_once "section.php";

// Si connecté, charger les données
if (isset($_SESSION['user_id'])) {
    $query = "SELECT * FROM students";
    $stmt = $pdo->query($query);
    $students = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $students[] = new Student($row['id'], $row['name'], $row['birthday'], $row['image'], $row['section_id']);
    }

    $query = "SELECT * FROM sections";
    $stmt = $pdo->query($query);
    $sections = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $sections[] = new Section($row['id'], $row['designation'], $row['description']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des étudiants</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <h2>Connexion</h2>
            <?php if (isset($_GET['error'])): ?>
                <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
            <?php endif; ?>
            <form action="index.php" method="post">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit" name="login">Se connecter</button>
            </form>
        <?php else: ?>
            <h1>Tableau de bord - Bienvenue, <?= $_SESSION['username'] ?></h1>
            <a href="index.php?logout=true" class="logout">Déconnexion</a>

            <?php if ($_SESSION['role'] === 'admin'): ?>
                <h2>Gestion des étudiants</h2>
                <a href="manage.php?action=add_student">Ajouter un étudiant</a>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Date de naissance</th>
                            <th>Section</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= $student->getId() ?></td>
                                <td><?= htmlspecialchars($student->getName()) ?></td>
                                <td><?= $student->getBirthday() ?></td>
                                <td><?= $student->getSectionId() ?></td>
                                <td>
                                    <a href="manage.php?action=edit_student&id=<?= $student->getId() ?>">Modifier</a>
                                    <a href="manage.php?action=delete_student&id=<?= $student->getId() ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h2>Gestion des sections</h2>
                <a href="manage.php?action=add_section">Ajouter une section</a>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Désignation</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sections as $section): ?>
                            <tr>
                                <td><?= $section->getId() ?></td>
                                <td><?= htmlspecialchars($section->getDesignation()) ?></td>
                                <td><?= htmlspecialchars($section->getDescription()) ?></td>
                                <td>
                                    <a href="manage.php?action=edit_section&id=<?= $section->getId() ?>">Modifier</a>
                                    <a href="manage.php?action=delete_section&id=<?= $section->getId() ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <h2>Étudiants (lecture seule)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Date de naissance</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= $student->getId() ?></td>
                                <td><?= htmlspecialchars($student->getName()) ?></td>
                                <td><?= $student->getBirthday() ?></td>
                                <td><?= $student->getSectionId() ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>