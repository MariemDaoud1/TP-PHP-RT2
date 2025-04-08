<?php
class User {
    private $id;
    private $username;
    private $email;
    private $role;
    private $password;

    public function __construct($id, $username, $email, $role, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->password = $password;
    }

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }
    public function getPassword() { return $this->password; }

    // Méthode pour convertir en tableau (utile pour create)
    public function toArray() {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password
        ];
    }
}