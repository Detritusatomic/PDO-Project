<?php/*  * To change this license header, choose License Headers in Project Properties. * To change this template file, choose Tools | Templates * and open the template in the editor. */class adminProductController extends Controller {        public function __construct() {        parent::__construct();        $this->page_name = "adminProduits";    }        public function indexAction() {        //recuperer tous les produits        $products = Produits::getProduits();        //charger les parametres        $params['produits'] = $products;        $this->moteur_vue->loadVueAdmin('admin/product/index.php', $params);    }    public function editAction($id = null) { //param par defaut        if(Post::is_set('edit_product') == true){            //on verifie si il y a une image            if(isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])){                //modification avec une image                $upload = new Upload;                $imageName = $upload->upload_image_product($_FILES['image']);            }            //modification d'un produit            $produit = Produits::getProductById($id);            $produit->setNom(Post::getValue('nom'));            $produit->setDescription((Post::getValue('description')));            $produit->setPrix(Post::getValue('prix'));            $produit->setVersion(Post::getValue('version'));            $produit->setId_categorie(Post::getValue('categorie'));            $produit->setQuantite(Post::getValue('quantite'));            $produit->setSynopsis((Post::getValue('synopsis')));            $produit->setGenre(Post::getValue('genre'));            $produit->setAvis_site(Post::getValue('avis'));            $produit->setNote(Post::getValue('note'));            $produit->setBandeau(Post::getValue('bandeau'));            $produit->setActeurs(Post::getValue('acteurs'));            //verification avec l'image             if(isset($imageName)){                $produit->setUrl_image(__BASE__NO__PROTOCOL__ . 'media/img/product/'.$imageName);            }                        $produit->update(); //mise a jour du produit            $this->moteur_vue->redirectWithParam('adminProduct', 'edit', $id);        }                $produit = Produits::getProductById((int)$id);        $categories = Categories::getCategories();         if($produit)            $this->moteur_vue->loadVueAdmin('admin/product/edit.php', array(                'produit' => $produit,                'categories' => $categories,            ));        else            $this->moteur_vue->redirect('adminProduct', 'index');    }        public function createAction(){        if(isset($_POST['create_product'])){            //on verifie si il y a une image            if(isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])){                //modification avec une image                $upload = new Upload;                $imageName = $upload->upload_image_product($_FILES['image']);                $is_image = true;            } else {                $is_image = false; //pas d'image pour l'instant            }            //creation d'un produit            $produit = new Produits();            //creation d'un produit            $produit->setNom(Post::getValue('nom'));            $produit->setDescription((Post::getValue('description')));            $produit->setPrix(Post::getValue('prix'));            $produit->setVersion(Post::getValue('version'));            $produit->setId_categorie(Post::getValue('categorie'));            $produit->setQuantite(Post::getValue('quantite'));            $produit->setSynopsis((Post::getValue('synopsis')));            $produit->setGenre(Post::getValue('genre'));            $produit->setAvis_site(Post::getValue('avis'));            $produit->setNote(Post::getValue('note'));            $produit->setBandeau(Post::getValue('bandeau'));            $produit->setActeurs(Post::getValue('acteurs'));            if($is_image)                $produit->setUrl_image(__BASE__NO__PROTOCOL__ . 'media/img/product/'.$imageName);            else //pas d'image                $produit->setUrl_image('');            $produit->save();            $this->moteur_vue->redirect('adminProduct', 'index');        }        //recuperation des categories        $categories = Categories::getCategories();        $params['categories'] = $categories;        $this->moteur_vue->loadVueAdmin('admin/product/create.php', $params);    }        public function settingsAction() {        if(isset($_POST['mise_avant'])){            Config::set('_MISE_EN_AVANT_1_', Post::getValue('mise_en_avant_1'));            Config::set('_MISE_EN_AVANT_2_', Post::getValue('mise_en_avant_2'));        }                $produits = Produits::getProduits();        $produit1 = config::get('_MISE_EN_AVANT_1_');        $produit2 = config::get('_MISE_EN_AVANT_2_');        $this->moteur_vue->loadVueAdmin('admin/product/settings.php', array(            'produits' => $produits,            'mise_en_avant_1' => $produit1,            'mise_en_avant_2' => $produit2        ));    }}