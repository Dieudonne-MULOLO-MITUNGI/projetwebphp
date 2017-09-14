<?php
//Récuperation du parametre
$id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
//Execution de la requete

try{

$sql="DELETE FROM matieres WHERE matiere_id=?";
$connexion = getPDO();
$statement = $connexion->prepare($sql);
$statement->execute([$id]);

}Catch(PDOException $e){

$_SESSION["flash"] = "impossible de supprimer cette matière";

}



//redirection vers la page des matières
header("location:index.php?controller=matiere");
