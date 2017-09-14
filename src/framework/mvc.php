<?php
use m2i\web\User;
/**
@param string $view : Le nom de la vue
@param array $data : Un tableau des données passées à la vue
@return string Le code html de la vue
*/
function getTemplate(string $view, array $data = []){
    //mise en tampon du résultat de l'interprétation PHP 
    //N'envoie pas de réponse HTPP implicite 
    ob_start();

    //transformation du tableau associatif des données
    //en une suite de variables
    extract($data);

    //Inclusion de fichier de la vue dans le tampon
    require ROOT_PATH."/src/views/{$view}.php";
    //Récupération le contenu du tampon dans une variable
    $content = ob_get_clean();

    return $content;
}

/**
Affiche le résultat d'une vue décorée par un gabarit
@param string $view : Le nom de la vue
@param array $data : Un tableau associatif des données pasées à la vue
@param string $layout : Le gabarit qui décorera la vue
*/
function renderView(
    string $view, 
    array $data = [], 
    string $layout = "gabarit"){
        //Récupération du code html (interpolé) de la vue
        $viewContent = getTemplate($view, $data);

        //Ajout du rendu de la vue aux données passées au gabarit
        $data["content"] = $viewContent;

        //Application du gabarit
        $result = getTemplate($layout, $data);

        echo $result;

}

/**
* Fonction de connexion à une base de données avec 
* la bibliothèque PDO
* @return PDO
*/
function getPDO(){
    $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    return new PDO(DSN,DB_USER,DB_PASS, $options);
}

/**
 * fonction d'auto chargement des classes
 * utilisée par spl_autoload_register
 * @param $className
 * @throws Exception
 */

function autoloader ($className){
    $path = ROOT_PATH."/src/classes/{$className}.php";
    if(file_exists($path)){

        require_once $path;

    }else {
        throw new Exception("le fichier $path ne peut être chargé");
    }
}

/**
 * Retourne l 'utilisateur authnetifié
 * @return User
 */

function getUser(){
    if(isset($_SESSION["user"])){
        $user = unserialize($_SESSION["user"]);

    }else{
        $user = new User;
        //utilisateur par défaut
        $user->setUserName("invité")->setRole("GUEST");
        $_SESSION["user"] = serialize($user);
    }
    return $user;

}