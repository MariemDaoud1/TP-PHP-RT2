<?php
class Section {
    private $id;
    private $designation;
    private $description;

    public function __construct($id, $designation, $description) {
        $this->id = $id;
        $this->designation = $designation;
        $this->description = $description;
    }

    public function getId() { return $this->id; }
    public function getDesignation() { return $this->designation; }
    public function getDescription() { return $this->description; }
}