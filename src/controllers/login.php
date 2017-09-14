
<?php
use m2i\web\User;


$errors = [];
// on va recupérer les données postées
 $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		$isSubmitted =filter_has_var(INPUT_POST, 'submit');
//validation des données

	 if ($isSubmitted){

		if(empty($login)){
		$errors[]="vous devez saisir un identifiant";
	}

		if(empty($password)){
			$errors[] ="vous devez saisir un mot de passe";
		}
		//traitement des données
		// s'il n ya pas d'erreurs
		if(count($errors)==0){
		    //connexion à la base de donnée pour vérifier l 'authentification
            $connexion = getPDO();
            $user = new User();


		if($user->loadUser($connexion, $login, $password)){
		    //stokage de l 'utilisateur en session
			$_SESSION["user"]= serialize($user);

			var_dump($user);

			
            $redirections = [
            "ADMIN" =>"accueil-admin",
            "STAGIAIRE" => "accueil-stagiaire",
            "FORMATEUR" => "accueil-formateur",
        ];
            
            $cible = $redirections[$user->getRole()] ?? "accueil";
            
            
            header("location:index.php?controller=$cible");
            exit;

		} else {
			$errors[] = "Vos informations d'identification sont incorrectes";
		}
	}
}	
//affichage du formulaire
renderView('login', 
	[
	'errors' => $errors, 
	'login' => $login, 
	'pageTitle'=> "login administration"
	]
);
