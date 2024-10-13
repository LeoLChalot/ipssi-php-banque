<?php

enum TypeDeCompte
{
    case COURANT;
    case EPARGNE;
    case ENTREPRISE;
}

class Compte
{
    public function __construct(
        private string $compteId,
        private string $numeroCompte,
        private float $solde,
        private TypeDeCompte $typeDeCompte,
        private string $clientId
    ){
        $this->compteId = $compteId ?? uniqid();
        $this->numeroCompte = $numeroCompte ?? uniqid();
        $this->solde = $solde ?? 0;
        $this->typeDeCompte = $typeDeCompte ?? TypeDeCompte::COURANT;
        $this->clientId = $clientId;
    }

    /**
     * Renvoie l'identifiant unique du compte
     * 
     * @return string
     */
    public function getCompteId(): string
    {
        return $this->compteId;
    }

    /**
     * Renvoie le num ro de compte
     * 
     * @return string
     */
    public function getNumeroCompte(): string
    {
        return $this->numeroCompte;
    }

    /**
     * Renvoie le solde actuel du compte
     * 
     * @return float
     */
    public function getSolde(): float
    {
        return $this->solde;
    }

    /**
     * Renvoie le type du compte
     * 
     * @return TypeDeCompte
     */
    public function getTypeDeCompte(): TypeDeCompte
    {
        return $this->typeDeCompte;
    }

    /**
     * Renvoie l'identifiant du client li  au compte
     * 
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Modifie le solde du compte
     * 
     * @param float $solde Nouveau solde du compte
     * @return void
     */
    public function setSolde(float $solde): void
    {
        $this->solde = $solde;
    }

    /**
     * Modifie l'identifiant unique du compte
     * 
     * @param string $compteId Nouvel identifiant unique du compte
     * @return void
     */
    public function setCompteId(string $compteId): void
    {
        $this->compteId = $compteId;
    }

    /**
     * Modifie le num ro de compte
     * 
     * @param string $numeroCompte Nouveau num ro de compte
     * @return void
     */
    public function setNumeroCompte(string $numeroCompte): void
    {
        $this->numeroCompte = $numeroCompte;
    }

    /**
     * Modifie le type de compte
     * 
     * @param TypeDeCompte $typeDeCompte Nouveau type de compte
     * @return void
     */
    public function setTypeDeCompte(TypeDeCompte $typeDeCompte): void
    {
        $this->typeDeCompte = $typeDeCompte;
    }

    /**
     * Modifie l'identifiant du client li  au compte
     * 
     * @param string $clientId Nouvel identifiant du client
     * @return void
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * Retourne l'identifiant unique du compte
     * 
     * @return string Identifiant unique du compte
     */
    public function __toString(): string
    {
        return $this->compteId;
    }

    /**
     * Retourne un tableau associatif contenant des informations sur le compte
     * 
     * @return array Tableau associatif contenant les informations sur le compte
     * 
     * @see https://www.php.net/manual/en/language.oop5.magic.php#object.debuginfo
     */
    public function __debugInfo(): array
    {
        return [
            'compteId' => $this->compteId,
            'numeroCompte' => $this->numeroCompte,
            'solde' => $this->solde,
            'typeDeCompte' => $this->typeDeCompte,
            'clientId' => $this->clientId
        ];
    }
}


?>