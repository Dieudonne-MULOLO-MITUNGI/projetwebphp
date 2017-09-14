<?php
//Requete pour récuperer toutes les lignes de la table matières
$connexion = getpDO(); 
$sql = "SELECT * FROM matieres";
$rs = $connexion->query($sql);
$listeMatieres=$rs->fetchAll(PDO::FETCH_ASSOC);

//Affichage de la vue
renderView('matiere',['listeMatieres'=>$listeMatieres]);









