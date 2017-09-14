<?php
//récuperation d'une connexion à la base de données

$connexion = getPDO();

$sql = "SELECT * FROM personnes";
$resultat = $connexion->query($sql);
var_dump($resultat);

var_dump($resultat->fetch(PDO::FETCH_ASSOC));
var_dump($resultat->fetch(PDO::FETCH_ASSOC));

while(($ligne = $resultat->fetch(PDO::FETCH_ASSOC))!== false){
	//var_dump($ligne);
echo $ligne["prenom"]. " ". $ligne["nom"]. "<br>";
}//fin du parcours de la requête


// récuperation globale
$resultat = $connexion->query($sql);
$donnees=$resultat->fetchAll(PDO::FETCH_ASSOC);
$nbPersonnes = count($donnees);
var_dump($donnees);




//supprimer les inscriptions de la personne dont l id est 1
$sql = "DELETE FROM inscription_formation WHERE personne_id=1";
$nbSupprime = $connexion ->exec($sql);
echo "<p>$nbSupprime inscriptions supprimées supprimées</p>";

//supprimer les notes de la personne dont l id est est 1

$sql = "DELETE FROM notes WHERE personne_id=1";
$nbSupprime = $connexion ->exec($sql);
echo "<p>$nbSupprime notes supprimées</p>";

//supprimer les inscription dont l'id est 1
$sql = "DELETE FROM ventes WHERE vendeur_id=1";
$nbSupprime = $connexion ->exec($sql);
echo "<p>$nbSupprime ventes supprimées</p>";
//procedure de suppression de la personne

$sql ="DELETE FROM personnes WHERE personne_id =1";
// execution de la requête

$nbSupprime = $connexion-> exec($sql);
echo "<p>$nbSupprime lignes supprimées</p>";

//EXECUTION D'UNE PROCEDURE STOCKEE
$sql="CALL proc_insert_personne_pdo('Tesla','Nikola','1623-12-01',)";
$connexion->exec($sql);

$id=$connexion->lastInsertId();

//Requete pour vérifier l 'insertion des données'
$sql = "SELECT * FROM personnes WHERE personne_id=@id";
$resultat = $connexion->query($sql);
var_dump($resultat->fetch(PDO:: FETCH_ASSOC));