<?php
class Student {
    private $id;
    private $name;
    private $birthday;
    private $image;
    private $sectionId;

    public function __construct($id, $name, $birthday, $image, $sectionId) {
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->sectionId = $sectionId;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getBirthday() { return $this->birthday; }
    public function getImage() { return $this->image; }
    public function getSectionId() { return $this->sectionId; }
}