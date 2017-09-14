
<?php

//Récupération de la liste des compétences
//Chemin vers le fichier json
$filePath = ROOT_PATH. '/src/data/competences.json';
//Récupération des données sous la forme d'un tableau
$data = json_decode(file_get_contents($filePath),true);


// Gestion de l'ajout d'une nouvelle compétence
//Récupération des données
$newSkill = filter_input(INPUT_POST,'newSkill', FILTER_SANITIZE_STRING);
$isSubmited = filter_has_var(INPUT_POST,'submit');
//Le formulaire est soumis
if($isSubmited){
    //La compétence n'est pas vide et n'existe pas déjà dans la liste
    //alors il faut l'ajouter
    if(!empty($newSkill) && ! in_array($newSkill, $data["skills"])){
        //Ajout de la compétence au tableau
        $data["skills"][] = $newSkill;
        //Mise à jour de la source de données
        file_put_contents($filePath, json_encode($data));
    }

    //Redirection pour éviter de reposter les données
    header("location:index.php?controller=accueil-admin");
}


 //Gestion de la suppression d'une compétence
$itemIndex = filter_input(INPUT_GET,'itemIndex', FILTER_VALIDATE_INT);

if($itemIndex >0){
    //suppression de la compétence dans le tableau
     array_splice($data["skills"], $itemIndex-1,1);
     //Mise à jour de la source de données
    file_put_contents($filePath, json_encode($data));

    //Redirection pour éviter de reposter les données
    header("location:index.php?controller=accueil-admin");

}

renderView("accueil-admin",
    [
        "pageTitle" => "Administration du site",
        "skills" => $data["skills"]
    ]
);