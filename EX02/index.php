<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    class SessionManager{
        private $visites;
        public function __construct(){
                $this->visites=0;
        }
        public function getVisites(){
            return $this->visites;
        }
        public function incrementerVisites(){
            $this->visites++;
        }
        public function estPremiereVisite(){
            return $this->visites==0;
        }
        public function resetSession(){
            $this->visites=0;
        }
    }
    $session=new SessionManager();
    echo "<form method='post'>";
    if (isset($_POST['reset'])){
        $session->resetSession();
    }else{
        $session->incrementerVisites();}
echo "<p>Nombre de visites: ".$session->getVisites()."</p>";
    if ($session->estPremiereVisite()){
        echo "<p>Bienvenu à notre plateforme</p>";}
    else{
        echo "<p>Merci pour votre fidélité, c'est votre". $session->getVisites()." ème visite  fois</p>";
    }
    
    
    
    echo "<input type='submit' name='reset' value='Réinitialiser la session'>";
    echo "</form>";
    

    ?>
</body>
</html>