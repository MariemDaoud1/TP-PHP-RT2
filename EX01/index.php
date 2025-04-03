<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS\style.css">
</head>
<body>
    <?php
    class etudiant{
        public $nom;
        public $notes;
        public function __construct($nom,$notes){
            $this->nom=$nom;
            $this->notes=$notes;
        }
        public function afficherNotes(){
            foreach($this->notes as $note){
                if ($note<10){
                    echo "<p style='background-color:#e88080'>$note</p>";
                }elseif($note>10){
                    echo "<p style='background-color:#80e898'>$note</p>";
                }else{
                    echo "<p style='background-color:#ec8b03'>$note</p>";
                }
        }
    }
        public function calculMoyenne(){
            $somme=array_sum($this->notes);
            $moyenne=$somme/count($this->notes);
            return $moyenne;
        }
        public function estAdmis(){
            if ($this->calculMoyenne()>=10){
                return "admis";
            }else{
                return "non admis";
            }
        }
}

$aymen=new etudiant("Aymen",[11,13,18,7,10,13,2,5,11]);
$skander=new etudiant("Skander",[15,9,8,16]);

echo "<div class=\"etudiant\">";
echo "<h1>$aymen->nom</h1>";
$aymen->afficherNotes();
echo "<p style='background-color:lightblue'>Votre moyenne est ".$aymen->calculMoyenne()."</p>";
echo "</div>";

echo "<div class=\"etudiant\">";
echo "<h2>$skander->nom</h2>";
$skander->afficherNotes();
echo "<p style='background-color:lightblue'>Votre moyenne est ".$skander->calculMoyenne()."</p>";
echo "</div>";

    ?>
</body>
</html>