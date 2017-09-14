<?php

$errors = [];
// on va recupérer les données postées
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$isSubmitted = filter_has_var(INPUT_POST, 'submit');
//validation des données

if ($isSubmitted) {

    if (empty($login)) {
        $errors[] = "vous devez saisir un identifiant";
    }

    if (empty($password)) {
        $errors[] = "vous devez saisir un mot de passe";
    }
    //traitement des données
    // s'il n ya pas d'erreurs
    if (count($errors) == 0) {

        $user = new User;


        if ($user->loadUser(getPDO(), $login, $password)) {
            $_SESSION["user"] = serialize($user);

            //redirection
            header("location:index.php?controller=accueil-admin");
            exit;

        } else {
            $errors[] = "Vos informations d'identification sont incorrectes";
        }
    }
}
//affichage du formulaire
renderView('login-admin',
    [
        'errors' => $errors,
        'login' => $login,
        'pageTitle' => "login administration"
    ]
);
