<?php/* * To change this license header, choose License Headers in Project Properties. * To change this template file, choose Tools | Templates * and open the template in the editor. */class News extends Entity {    public $id;    public $titre;    public $contenu;    public $date;    public $id_categorie;    public $id_produit;    public $id_user;    public function __construct() {        parent::__construct();        $this->table = 'news';        $this->class = __CLASS__;    }    /**     * Method : Recuperer tous les news     * @return Produit object     */    public static function getNews() {        $sql = "SELECT * FROM news order by id desc";        $database = Database::getInstance();        $req = $database->prepare($sql);        $req->execute();        return $array = $req->fetchAll(PDO::FETCH_OBJ);    }		public static function getCoolNews() {        $sql = "SELECT * 				FROM news n 					JOIN produits p ON n.id_produit=p.id				order by p.avis_site desc, p.nom asc";        $database = Database::getInstance();        $req = $database->prepare($sql);        $req->execute();        return $array = $req->fetchAll(PDO::FETCH_OBJ);    }    public function save() {        $database = Database::getInstance();        $sql = "INSERT INTO " . $this->table . " (titre, contenu, date, id_categorie, id_produit, id_user) "                . "VALUES (" . $database->quote($this->titre) . ", '" . html_entity_decode($this->contenu) . "', " . $database->quote($this->date) .                ", " . $database->quote($this->id_categorie) . ", " . $database->quote($this->id_produit) . ", " . $database->quote($this->id_user) . ")";        $req = $database->prepare($sql);        $req->execute();        return true;    }		public static function display($article){		$produit=Produits::getProductById($article->id_produit);		$auteur=Users::getUserById($article->id_user);		$display='		<div class="article-container card hoverable no-margin-b jaquette4">					<img data-caption="'.$produit->getNom().'" width="100%" src="'.$produit->getUrl_image().'">			<div class="article-caption card-content white">				<p>'.date("d/m/Y",strtotime($article->date)).'</p>				<p><strong class="uppercase">'.$produit->getNom().'</strong> <br/> '.$article->titre.'</p><br/>				<span class="right">'.rand(0,25).' <i class="material-icons">comment</i></span>														'.$produit->getStars().'				<p class="'.$produit->getTextColor().'">'.$produit->getCategorie($produit->getId()).'</p>				<br/>				<div class="chip">					<img src="../../media/img/avatar.png" alt="Contact Person">					'.$auteur->prenom.' '.$auteur->nom.'				</div>									</div>		</div>';		return $display;	}		public static function displayMobile($article){		$produit=Produits::getProductById($article->id_produit);		$auteur=Users::getUserById($article->id_user);		$display='		<div class="card hoverable white no-margin-b">			<div class="card-content no-padding padding-md-r">				<div class="row no-margin-b">					<div class="col m3 s5">						<img data-caption="'.$produit->getNom().'" width="100%" class="left" src="'.$produit->getUrl_image().'">					</div>					<div class="col m9 s7 padding-md-t">						<span class="right hide-on-small-only">'.rand(0,25).' <i class="material-icons">comment</i></span>								'.date("d/m/Y",strtotime($article->date)).'<br/>						<p><strong class="uppercase">'.$produit->getNom().'</strong> <br/> '.$article->titre.'</p>						<div class="hide-on-small-only">'.$produit->getStars().'</div>						<div class="chip right no-margin hide-on-small-only">							<img src="../../media/img/avatar.png" alt="Contact Person">							'.$auteur->prenom.' '.$auteur->nom.'						</div>								<p class="'.$produit->getTextColor().' hide-on-small-only">'.$produit->getCategorie($produit->getId()).'</p>					</div>				</div>			</div>		</div>';		return $display;	}	    function getId() {        return $this->id;    }    function getTitre() {        return $this->titre;    }    function getContenu() {        return $this->contenu;    }    function getDate() {        return $this->date;    }    function getId_categorie() {        return $this->id_categorie;    }    function getId_produit() {        return $this->id_produit;    }    function getId_user() {        return $this->id_user;    }    function setId($id) {        $this->id = $id;    }    function setTitre($titre) {        $this->titre = $titre;    }    function setContenu($contenu) {        $this->contenu = $contenu;    }    function setDate($date) {        $this->date = $date;    }    function setId_categorie($id_categorie) {        $this->id_categorie = $id_categorie;    }    function setId_produit($id_produit) {        $this->id_produit = $id_produit;    }    function setId_user($id_user) {        $this->id_user = $id_user;    }}