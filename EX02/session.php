<?php 
class Session {
    private static $nombre_visite = 0;

    public static function getNombre_visite() {
        return isset($_SESSION['nombre_visite']) ? $_SESSION['nombre_visite'] : 0;
    }

    public static function incrementerVisite() {
        $_SESSION['nombre_visite'] = self::getNombre_visite() + 1; 
    }

    public static function reinitialiserSession() {
        session_destroy();
        $_SESSION['nombre_visite']=0;
        header("location:PageSession.php");
    }
}
?>