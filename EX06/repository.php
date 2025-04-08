<?php
class Repository {
    protected $pdo;
    protected $table;
    protected $entityClass;

    public function __construct(PDO $pdo, string $table, string $entityClass) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->entityClass = $entityClass;
    }

    // Retourne tous les enregistrements
    public function findAll(): array {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->query($query);
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $this->createEntity($row);
        }
        return $results;
    }

    // Retourne un enregistrement par ID
    public function findById(int $id): ?object {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->createEntity($row) : null;
    }

    // Ajoute un nouvel enregistrement
    public function create(object $entity): void {
        $data = $entity->toArray();
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($data);
    }

    // Supprime un enregistrement par ID
    public function delete(int $id): void {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    // Crée une instance de l'entité à partir d'un tableau
    private function createEntity(array $data): object {
        if ($this->entityClass === 'User') {
            return new User(
                $data['id'],
                $data['username'],
                $data['email'],
                $data['role'],
                $data['password']
            );
        } elseif ($this->entityClass === 'Section') {
            return new Section(
                $data['id'],
                $data['designation'],
                $data['description']
            );
        }
        throw new Exception("Entité non supportée : {$this->entityClass}");
    }
}