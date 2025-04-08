<?php
session_start();

// Vérifie si l'utilisateur est connecté
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?error=not_logged_in");
        exit();
    }
}

// Gestion de la connexion
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once "dbh.inc.php";

    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['username' => $username]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userData && $password === $userData['password']) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['username'] = $userData['username'];
        $_SESSION['role'] = $userData['role'];
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php?error=login_failed");
        exit();
    }
}

// Gestion de la déconnexion
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}