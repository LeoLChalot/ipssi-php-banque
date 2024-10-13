<?php

class Utilisateur
{

    protected string $id;
    protected string $email;
    protected string $mdp;

    public function __construct( 
        string $email,
        string $mdp     
    ) {
        $this->id = $id ?? uniqid();
        $this->email = $email;
        $this->mdp = password_hash($mdp, PASSWORD_BCRYPT);
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setMdp(string $mdp): void
    {
        $this->mdp = password_hash($mdp, PASSWORD_BCRYPT);
    }
}
