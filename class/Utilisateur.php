<?php

class Utilisateur
{

    protected string $id;
    protected string $email;
    protected string $mdp;

    /**
     * Constructeur de la classe Utilisateur
     * 
     * @param string $id Identifiant unique de l'utilisateur (facultatif, généré automatiquement si vide)
     * @param string $email Adresse électronique de l'utilisateur
     * @param string $mdp Mot de passe de l'utilisateur
     */
    public function __construct(
        string $id,
        string $email,
        string $mdp
    ) {
        $this->id = $id ?? uniqid();
        $this->email = $email;
        $this->mdp = $mdp;
    }

    /**
     * Vérifie si le mot de passe fourni correspond à celui enregistré
     * 
     * @param string $mdp Mot de passe à vérifier
     * @return bool Le mot de passe est-il correct ?
     */
    public function verifierMotDePasse(string $mdp): bool
    {
        return password_verify($mdp, $this->mdp);
    }

    /**
     * Renvoie l'identifiant unique de l'utilisateur
     * 
     * @return string Identifiant unique de l'utilisateur
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * Renvoie l'adresse électronique de l'utilisateur
     * 
     * @return string Adresse électronique de l'utilisateur
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Renvoie le mot de passe de l'utilisateur
     * 
     * @return string Mot de passe de l'utilisateur
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * Modifie l'adresse électronique de l'utilisateur
     * 
     * @param string $email Nouvelle adresse électronique de l'utilisateur
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Modifie le mot de passe de l'utilisateur
     * 
     * @param string $mdp Nouveau mot de passe de l'utilisateur
     * @return void
     */
    public function setMdp(string $mdp): void
    {
        $this->mdp = password_hash($mdp, PASSWORD_BCRYPT);
    }
}
