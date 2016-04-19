<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categories extends Entity {

    public $id;
    public $nom;
    public $in_menu;
    public $description;
    public $color;
    public $deleted;
    public $slug;
    public $id_format;

    public function __construct() {
        parent::__construct();
        $this->table = 'categories';
        $this->class = __CLASS__;
    }

    /**
     * Method : recuperer les categories
     * @return type
     */
    public static function getCategories() {
        $sql = "SELECT * FROM categories where deleted = 0";
        $database = Database::getInstance();
        $req = $database->prepare($sql);
        $req->execute();
        $array = [];
        foreach ($req->fetchAll(PDO::FETCH_OBJ) as $object) {
            $array[] = $object;
        }
        return $array;
    }

    /** 
     * Method : permet de recupérer le nom et la couleur associes a la categorie
     * @param type $id
     * @return type
     */
    public static function getNameById($id) {
        $sql = "SELECT nom, color FROM categories WHERE id = " . (int) $id;
        $database = Database::getInstance();
        $req = $database->prepare($sql);
        $req->execute();
        return $array = $req->fetch();
    }

    /**
     * Method : recuperer une categorie en fonction de son id
     * @param type $id
     * @return type
     */
    public static function getCategorieById($id) {
        $sql = "SELECT * FROM categories WHERE id = " . (int) $id;
        $database = Database::getInstance();
        $req = $database->prepare($sql);
        $req->execute();
        return $array = $req->fetchObject(__CLASS__);
    }

    /** 
     * Method : permet de construire le menu
     * @return type
     */
    public static function getMenu() {
        $sql = "SELECT nom, slug FROM categories WHERE in_menu = 1 AND deleted = 0";
        $database = Database::getInstance();
        $req = $database->prepare($sql);
        $req->execute();
        return $array = $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getNbCategories(){
        $sql = "SELECT * FROM categories WHERE deleted = 0";
        $database = Database::getInstance();
        $req = $database->prepare($sql);
        $req->execute();
        return $req->rowCount();
    }
    
    public static function getCategorieBySlug($slug){
        $sql = "SELECT nom FROM categories WHERE deleted = 0 AND slug = '" . $slug . "'";
        $database = Database::getInstance();
        $req = $database->prepare($sql);
        $req->execute();
        return $array = $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /** non static */
    public function save(){
        $database = Database::getInstance();
        $sql = "INSERT INTO " . $this->table . " (nom, description, in_menu, color, slug) "
                . "VALUES (" . $database->quote($this->nom) . ", '" . html_entity_decode($this->description) . "', " . $database->quote($this->in_menu) .
                ", " . $database->quote($this->color) .", '" . strtolower($this->slug) . "')";
        $req = $database->prepare($sql);
        $req->execute();
        return true;
    }



    /** getters and setter */
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }
    function getIn_menu() {
        return $this->in_menu;
    }

    function getDescription() {
        return $this->description;
    }

    function getColor() {
        return $this->color;
    }

    function setIn_menu($in_menu) {
        $this->in_menu = $in_menu;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function getDeleted() {
        return $this->deleted;
    }

    function getSlug() {
        return $this->slug;
    }

    function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    function setSlug($slug) {
        $this->slug = $slug;
    }
    function getId_format() {
        return $this->id_format;
    }

    function setId_format($id_format) {
        $this->id_format = $id_format;
    }



}
