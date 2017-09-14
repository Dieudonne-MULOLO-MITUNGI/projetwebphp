<?php
//demarrage de la session
session_start();

// définition du dossier racine du projet
//ici le dossier projet
define("ROOT_PATH", dirname(__DIR__));

//Inclusion du fichier d'autochargement de controller
//de composer
require ROOT_PATH."/vendor/autoload.php";
//inclusion du dossier racine du projet

require ROOT_PATH.'/src/config.php';
require ROOT_PATH.'/src/framework/mvc.php';
// Enregistrement des fonctions d'autochargement des classes
//spl_autoload_register("autoloader");

//instantiation de klogger
$logger = new \Katzgrau\KLogger\Logger(ROOT_PATH."/logs");


//récuperation du controller
//avec gestion dela page de défaut
if(isset($_GET["controller"])){
	$controllerName = $_GET ["controller"];
} else{
	$controllerName = "accueil";
}
//sécurisation de l'accè àa l'administration

session_regenerate_id(true);

$securedRoutes = [
'accueil-admin'=> 'ADMIN',
'accueil-formateur' => 'FORMATEUR',
'accueil-stagiaire'=> 'STAGIAIRE'
];
//Gestion de l 'utilisateur avec la POO
$user = getUser();
$role = $user->getRole();

//si on tente d'accèder à une page sécurisée sans être identifié au préalable alors la route est modifiée pour afficher le formulaire
if(array_key_exists($controllerName, $securedRoutes)
    && $role!= $securedRoutes[$controllerName]){

    $_SESSION["flash"] = "Vous n'avez pas le droits pour accéder à cette page, veuillez vous identifier";
    //$controleName="login"; ici le nom de l'url ne serrait pas modifié

        header("location:index.php?controller=login");
        exit;
    }




// definition du schemin du controller

$controllerPath=ROOT_PATH.'/src/controllers/'.$controllerName.'.php';
// test de l 'exixstence du controller
if(! file_exists($controllerPath)){
	// envoie vers le fichier du controller
	$controllerPath = ROOT_PATH.'/src/controllers/erreur.php';
}
// exécution du controleur
require $controllerPath;