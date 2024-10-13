<?php

class Client extends Utilisateur
{
    public function __construct(
        protected string $email,
        protected string $mdp,
        private string $nom,
        private string $prenom,
        private string $telephone,

    ) {

        parent::__construct($email, $mdp);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }
}
