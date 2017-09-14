<?php
namespace m2i\web;

/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 26/06/2017
 * Time: 09:49
 */
class inscription
{
    /**
     * les données de l 'inscription
     * @var array
     */
    private $data = [];

    private $errors = [];
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Tableau des erreurs de la validation des données et des règles métier
     * @var array
     */

    /**
     * inscription constructor.
     * @param array $data
     */
    public function __construct(array $data, PDO $pdo)
    {
        $this->data = $data = $this->SanitizeData($data);
        $this->pdo = $pdo;
    }

    /**
     * @param array $data
     * @return  array
     */
    private function SanitizeData($data)
    {
        //Régles de netoyyages des données
        $rules = [
            "nom" => FILTER_SANITIZE_STRING,
            "prenom" => FILTER_SANITIZE_STRING,
            "mdp" => FILTER_SANITIZE_STRING,
            "confirmation-mdp" => FILTER_SANITIZE_STRING,
            "email" => FILTER_VALIDATE_EMAIL,
            "submit" => FILTER_DEFAULT,
        ];

        //Nettoyage de données
        $data = filter_var_array($data, $rules);

        //retourne le tableau nettoyé
        return $data;
    }

    /**
     * validtation de la saisie du formulaire
     */
    private function validateInput()
    {

        if (empty($this->data["nom"])) {
            $this->errors[] = "Vous devez saisir un nom";
        }
        if (empty($this->data["email"])) {
            $errors[] = "Vous devez saisir un email";
        }

        if (empty($this->data["mdp"])) {
            $errors[] = "Vous devez saisir un mot de passe";
        }
        if ($this->data["mdp"] != $this->data["confirmation-mdp"]) {
            $errors[] = "Le mot de passe et sa confirmation doivent être identiques";
        }
        return !$this->hasErrors();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    private function emailAlreadyExist()
    {
        $sql = "SELECT email FROM utilisateurs WHERE email=?";
        $stm = $this->PDO->prepare($sql);
        $stm->execute([$this->data["email"]]);
        return count($stm->fetchAll(PDO::FETCH_ASSOC)) > 0;


    }

    private function personAlreadyRegistered()
    {
        $sql = "SELECT p.personne_id FROM personnes as p INNER JOIN utilisateurs as u
                ON p.personne_id=u.personne_id
                WHERE p.nom=? and p.prenom =?";
        $stm = $this->PDO->prepare($sql);
        $stm->execute([$this->data["nom"], $this->data["prenom"]]);
        return count($stm->fetchAll(PDO::FETCH_ASSOC)) > 0;

    }

    /**
     * validation des règles des métiers
     */
    private function validateBusinessRules()
    {
        //validation des règles métier uniquement si la saisie est valide
        if ($this->validateInput()) {
            if ($this->emailAlreadyExists()) {
                $this->errors[] = "Cette adresse email est déjà utilisée";
            }
            if ($this->personAlreadyRegistered()) {
                $this->errors[] = "Vous vous êtes déjà inscrit en tant qu'utilisateur";
            }
        }
        return !$this->hasErrors();
    }


    private function persist()
    {
        $this->pdo->beginTransaction();

        $sql = "CALL proc_insert_personne_pdo(?,?,NULL)";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$this->data["nom"], $this->data["prenom"]]);

        //Insertion de l'utilisateur
        $sql = "INSERT INTO utilisateurs (email, mot_de_passe, personne_id)
                VALUES (?,?,@id)";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$this->data["nom"], sha1($this->data["prenom"])]);
        $this->pdo->commit();
    }


    public function handleRequest()
    {
        $this->persist();
    }

    public function isFormSubmitted()
    {
        return isset($this->data["submit"]);
    }
}