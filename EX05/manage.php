<?php
require_once "auth.inc.php";
require_once "dbh.inc.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($action === 'add_student') {
        $query = "INSERT INTO students (name, birthday, section_id) VALUES (:name, :birthday, :section_id)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['name' => $_POST['name'], 'birthday' => $_POST['birthday'], 'section_id' => $_POST['section_id']]);
    } elseif ($action === 'edit_student') {
        $query = "UPDATE students SET name = :name, birthday = :birthday, section_id = :section_id WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['name' => $_POST['name'], 'birthday' => $_POST['birthday'], 'section_id' => $_POST['section_id'], 'id' => $_GET['id']]);
    } elseif ($action === 'add_section') {
        $query = "INSERT INTO sections (designation, description) VALUES (:designation, :description)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['designation' => $_POST['designation'], 'description' => $_POST['description']]);
    } elseif ($action === 'edit_section') {
        $query = "UPDATE sections SET designation = :designation, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['designation' => $_POST['designation'], 'description' => $_POST['description'], 'id' => $_GET['id']]);
    }
    header("Location: index.php");
    exit();
} elseif ($action === 'delete_student') {
    $query = "DELETE FROM students WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $_GET['id']]);
    header("Location: index.php");
    exit();
} elseif ($action === 'delete_section') {
    $query = "DELETE FROM sections WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $_GET['id']]);
    header("Location: index.php");
    exit();
}

// Charger les données pour les formulaires
$sections = $pdo->query("SELECT * FROM sections")->fetchAll(PDO::FETCH_ASSOC);
$student = null;
$section = null;
if ($action === 'edit_student') {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($action === 'edit_section') {
    $stmt = $pdo->prepare("SELECT * FROM sections WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $section = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php if ($action === 'add_student' || $action === 'edit_student'): ?>
            <h1><?= $action === 'add_student' ? 'Ajouter un étudiant' : 'Modifier un étudiant' ?></h1>
            <form action="" method="post">
                <input type="text" name="name" value="<?= $student ? htmlspecialchars($student['name']) : '' ?>" placeholder="Nom" required>
                <input type="date" name="birthday" value="<?= $student ? $student['birthday'] : '' ?>" required>
                <select name="section_id" required>
                    <option value="">Choisir une section</option>
                    <?php foreach ($sections as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= $student && $s['id'] == $student['section_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['designation']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit"><?= $action === 'add_student' ? 'Ajouter' : 'Modifier' ?></button>
            </form>
        <?php elseif ($action === 'add_section' || $action === 'edit_section'): ?>
            <h1><?= $action === 'add_section' ? 'Ajouter une section' : 'Modifier une section' ?></h1>
            <form action="" method="post">
                <input type="text" name="designation" value="<?= $section ? htmlspecialchars($section['designation']) : '' ?>" placeholder="Désignation" required>
                <textarea name="description" placeholder="Description"><?= $section ? htmlspecialchars($section['description']) : '' ?></textarea>
                <button type="submit"><?= $action === 'add_section' ? 'Ajouter' : 'Modifier' ?></button>
            </form>
        <?php endif; ?>
        <a href="index.php">Retour</a>
    </div>
</body>
</html>