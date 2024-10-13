<?php

class Client extends Utilisateur
{
    /**
     * Constructeur de la classe Client
     *
     * @param string $id Identifiant unique du client
     * @param string $email Adresse email du client
     * @param string $mdp Mot de passe du client
     * @param string $nom Nom du client
     * @param string $prenom Pr nom du client
     * @param string $telephone Num ro de t l phone du client
     */
    public function __construct(
        protected string $id,
        protected string $email,
        protected string $mdp,
        private string $nom,
        private string $prenom,
        private string $telephone,

    ) {

        $id = $id == '' ? uniqid() : $id;
        parent::__construct($id, $email, $mdp);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
    }

    /**
     * Renvoie le nom du client
     * 
     * @return string Le nom du client
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Renvoie le prénom du client
     * 
     * @return string Le prénom du client
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Renvoie le numéro de téléphone du client
     * 
     * @return string Le numéro de téléphone du client
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * Modifie le nom du client
     * 
     * @param string $nom Nouveau nom du client
     * @return void
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Modifie le pr nom du client
     * 
     * @param string $prenom Nouveau pr nom du client
     * @return void
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * Modifie le numéro de téléphone du client
     * 
     * @param string $telephone Nouveau numéro de téléphone du client
     * @return void
     */
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }
}
