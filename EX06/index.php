<?php
require_once "dbh.inc.php";
require_once "user.php";
require_once "section.php";
require_once "repository.php";

// Créer des instances de Repository
$userRepo = new Repository($pdo, 'users', 'User');
$sectionRepo = new Repository($pdo, 'sections', 'Section');

// Test 1 : findAll (tous les utilisateurs)
echo "<h2>Tous les utilisateurs :</h2>";
$users = $userRepo->findAll();
foreach ($users as $user) {
    echo "ID: {$user->getId()}, Username: {$user->getUsername()}, Email: {$user->getEmail()}, Role: {$user->getRole()}<br>";
}

// Test 2 : findById (utilisateur avec ID 1)
echo "<h2>Utilisateur ID 1 :</h2>";
$user = $userRepo->findById(1);
if ($user) {
    echo "ID: {$user->getId()}, Username: {$user->getUsername()}, Email: {$user->getEmail()}, Role: {$user->getRole()}<br>";
} else {
    echo "Utilisateur non trouvé.<br>";
}

// Test 3 : create (ajouter un nouvel utilisateur)
echo "<h2>Ajout d'un nouvel utilisateur :</h2>";
$newUser = new User(null, 'testuser', 'test@example.com', 'user', 'test123');
$userRepo->create($newUser);
echo "Utilisateur ajouté. Vérifiez la base de données.<br>";

// Test 4 : findAll (tous les sections)
echo "<h2>Toutes les sections :</h2>";
$sections = $sectionRepo->findAll();
foreach ($sections as $section) {
    echo "ID: {$section->getId()}, Designation: {$section->getDesignation()}, Description: {$section->getDescription()}<br>";
}

// Test 5 : findById (section avec ID 1)
echo "<h2>Section ID 1 :</h2>";
$section = $sectionRepo->findById(1);
if ($section) {
    echo "ID: {$section->getId()}, Designation: {$section->getDesignation()}, Description: {$section->getDescription()}<br>";
} else {
    echo "Section non trouvée.<br>";
}

// Test 6 : create (ajouter une nouvelle section)
echo "<h2>Ajout d'une nouvelle section :</h2>";
$newSection = new Section(null, 'Section C', 'Troisième année maths');
$sectionRepo->create($newSection);
echo "Section ajoutée. Vérifiez la base de données.<br>";

// Test 7 : delete (supprimer un utilisateur)
echo "<h2>Suppression de l'utilisateur ID 2 :</h2>";
$userRepo->delete(2);
echo "Utilisateur ID 2 supprimé. Vérifiez la base de données.<br>";

// Test 8 : delete (supprimer une section)
echo "<h2>Suppression de la section ID 2 :</h2>";
$sectionRepo->delete(2);
echo "Section ID 2 supprimée. Vérifiez la base de données.<br>";