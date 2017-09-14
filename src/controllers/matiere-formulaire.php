<?php
$connexion = getPDO();
//récuperation du paramètre id
$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
// si id n'est pas null alors requete pour recuperer le libéllé de la matière
$matiere="";
$pageTitle = "Nouvelle matiere";
if($id != null){

	$sql= "SELECT matiere FROM matieres WHERE matiere_id=?";
	$stm= $connexion->prepare($sql);
	$stm->execute([$id]);
	$rs= $stm->fetch(PDO::FETCH_ASSOC);
	$matiere=$rs["matiere"];
	$pageTitle = "modification d'une matiere";
}
// traiment du formulaire



$isSubmitted = filter_has_var(INPUT_POST, 'submit');
if($isSubmitted){
	$matiere=filter_input(INPUT_POST,'matiere',FILTER_SANITIZE_STRING);
	$id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);


	//validation des données saisies
	$valid =  !(empty($matiere));

	// validation que l 'insertion dou la mise à jour ne genere pas se doublon
	$sql = "SELECT matiere FROM matieres WHERE matiere=:matiere";
	$stm= $connexion -> prepare($sql);
	$stm -> execute(["matiere" =>$matiere]);
	$nbmatieres = count($stm->fetchAll(PDO::FETCH_ASSOC));
	$valid = $valid & $nbmatieres==0;


	//test de la validité du token
	$token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);
	$valid = $valid & ($token == $_SESSION["token"]);


// en fonction de la valeur de $id on va faire un insert ou un update
		
   try{

	   	if($valid){
			$params["matiere"]=$matiere;

			//définition de la requete à executer et ajout du parametre id
				//dans le cas d'une mise à jour
			if($id == null){
				$sql = "INSERT INTO matieres (matiere) VALUES (:matiere)";
				
				$_SESSION["flash"] = "votre nouvelle matiere est en eregistrée dans la base";

			    }else{
			    	$sql = "UPDATE matieres SET matiere=:matiere WHERE matiere_id=:id";
			    	$params["id"]=$id;
			    	$_SESSION["flash"]= "votre modofication est enregistrée dans la base";

			    }
		 //préparation et exécutiion de la requete
		    $stm = $connexion->prepare($sql);
		    $stm->execute ($params);

	// redirection vers la liste des matieres
	        header("location: index.php? controller=matiere");
	   	} else {
	   		$_SESSION["flash"] = "votre saisie est incorect";
	   	
		}

	} catch(PDOException $e){
			$_SESSION["flash"]= "Impossible d'executer la requete";
	}

}


//génération d'un token de protection contre les attaques CSEF(cross site request Forgery)
	
  $token = uniqid();
  $_SESSION["token"] = $token;
  
renderView("matiere-formulaire",[
	"pageTitle"=> $pageTitle,
	"matiere" =>$matiere,
	"id" => $id,
	"token" => $token
	]);
	