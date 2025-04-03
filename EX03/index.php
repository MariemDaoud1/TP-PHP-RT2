<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat de Pokémon</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php
        class AttackPokemon {
        private $attackMinimal;
        private $attackMaximal;
        private $specialAttack;
        private $probabilitySpecialAttack;

        public function __construct($attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack) {
            $this->attackMinimal = $attackMinimal;
            $this->attackMaximal = $attackMaximal;
            $this->specialAttack = $specialAttack;
            $this->probabilitySpecialAttack = $probabilitySpecialAttack;
        }

        public function getAttackMinimal() { return $this->attackMinimal; }
        public function getAttackMaximal() { return $this->attackMaximal; }
        public function getSpecialAttack() { return $this->specialAttack; }
        public function getProbabilitySpecialAttack() { return $this->probabilitySpecialAttack; }
    }

    class Pokemon {
        protected $name;
        protected $url;
        protected $hp;
        protected $attackPokemon;

        public function __construct($name, $url, $hp, $attackPokemon) {
            $this->name = $name;
            $this->url = $url;
            $this->hp = $hp;
            $this->attackPokemon = $attackPokemon;
        }

        public function getName() { return $this->name; }
        public function getUrl() { return $this->url; }
        public function getHp() { return $this->hp; }
        public function getAttackPokemon() { return $this->attackPokemon; }
        public function setName($name) { $this->name = $name; }
        public function setUrl($url) { $this->url = $url; }
        public function setHp($hp) { $this->hp = $hp; }
        public function setAttackPokemon($attackPokemon) { $this->attackPokemon = $attackPokemon; }
        public function isDead() { return $this->hp <= 0; }

        public function attack($pokemon) {
            $attack = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
            if (rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack()) {
                $attack *= $this->attackPokemon->getSpecialAttack();
            }
            $pokemon->setHp($pokemon->getHp() - $attack);
            return $attack;
        }

        public function whoAmI() {
            echo "<div class='pokemon'>";
            echo "<h1>Je suis " . $this->name . "</h1>";
            echo "<img src='" . $this->url . "' alt='Image de " . $this->name . "'>";
            echo "<p>J'ai " . $this->hp . " points de vie</p>";
            echo "</div>";
        }
    }

    class PokemonFeu extends Pokemon {
        public function attack($pokemon) {
            $attack = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
            if (rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack()) {
                $attack *= $this->attackPokemon->getSpecialAttack();
            }
            if ($pokemon instanceof PokemonPlante) $attack *= 2;
            elseif ($pokemon instanceof PokemonFeu || $pokemon instanceof PokemonEau) $attack *= 0.5;
            $pokemon->setHp($pokemon->getHp() - $attack);
            return $attack;
        }
    }

    class PokemonEau extends Pokemon {
        public function attack($pokemon) {
            $attack = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
            if (rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack()) {
                $attack *= $this->attackPokemon->getSpecialAttack();
            }
            if ($pokemon instanceof PokemonFeu) $attack *= 2;
            elseif ($pokemon instanceof PokemonEau || $pokemon instanceof PokemonPlante) $attack *= 0.5;
            $pokemon->setHp($pokemon->getHp() - $attack);
            return $attack;
        }
    }

    class PokemonPlante extends Pokemon {
        public function attack($pokemon) {
            $attack = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
            if (rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack()) {
                $attack *= $this->attackPokemon->getSpecialAttack();
            }
            if ($pokemon instanceof PokemonEau) $attack *= 2;
            elseif ($pokemon instanceof PokemonPlante || $pokemon instanceof PokemonFeu) $attack *= 0.5;
            $pokemon->setHp($pokemon->getHp() - $attack);
            return $attack;
        }
    }

    // Instanciation avec les URLs fournies
    $pikachu = new Pokemon("Pikachu", "https://img.pokemondb.net/artwork/large/charmander.jpg", 100, new AttackPokemon(20, 40, 3, 50));
    $bulbizarre = new PokemonPlante("Bulbizarre", "https://img.pokemondb.net/artwork/large/bulbasaur.jpg", 100, new AttackPokemon(10, 20, 2, 50));

    // Affichage initial
    echo "<h2>Avant le combat</h2>";
    $pikachu->whoAmI();
    $bulbizarre->whoAmI();

    // Scénario de combat
    echo "<div class='combat'>";
    echo "<h2>Combat : Pikachu vs Bulbizarre</h2>";
    $tour=1;
    while (!$pikachu->isDead() && !$bulbizarre->isDead()) {
        echo "<h3>Tour $tour</h3>";
        $degatsPikachu = $pikachu->attack($bulbizarre);
        echo "<p>Pikachu attaque Bulbizarre et inflige $degatsPikachu dégâts. Bulbizarre : " . $bulbizarre->getHp() . " HP</p>";
        if ($bulbizarre->isDead()) {
            echo "<h1>Bulbizarre est mort !  </h1>";
            echo "<p>Le vaiqueur est Pikachu !". $pikachu->whoAmI() ."</p>";
            break;
        }
        $degatsBulbizarre = $bulbizarre->attack($pikachu);
        echo "<p>Bulbizarre attaque Pikachu et inflige $degatsBulbizarre dégâts. Pikachu : " . $pikachu->getHp() . " HP</p>";
        if ($pikachu->isDead()) {
            echo "<h1>Pikachu est mort !</h1>";
            echo "<p>Le vaiqueur est Bulbizarre !". $bulbizarre->whoAmI() ."</p>";
            break;
        }
        $pikachu->whoAmI();
        $bulbizarre->whoAmI();
        $tour++;
    }
    echo "</div>";
    ?>
</body>
</html>