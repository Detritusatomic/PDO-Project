<?php
//charger la config
require_once './config/config.php';

//charger l'app
require_once './App.php';

//charger les classes
require_once './Class/Database.class.php';
require_once './Class/Controller.class.php';
require_once './Class/MoteurVue.class.php';
require_once './Class/Session.class.php';
require_once './Class/Post.class.php';
require_once './Class/Token.class.php';
require_once './Class/Upload.class.php';
require_once './Class/Tools.class.php';

//charger les entites
require_once './Entite/Class/Entity.php';
require_once './Entite/Users.php';
require_once './Entite/Categories.php';
require_once './Entite/Commandes.php';
require_once './Entite/Produits.php';
require_once './Entite/Config.php';
require_once './Entite/Format.php';

Session::start(); //start the session
Session::set("start", true);

$url = $_SERVER['REQUEST_URI'];

$app = new App($url);
$app->run();