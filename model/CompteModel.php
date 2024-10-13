<?php

class CompteModel extends GenericModel
{
    public function ajouter(Compte $compte)
    {
        $query =
            "INSERT INTO compte 
            (compteId, numeroCompte, solde, typeDeCompte, clientId) 
            VALUES (:compteId, :numeroCompte, :solde, :typeDeCompte, :clientId);";
        $params = [
            'compteId' => $compte->getCompteId(),
            'numeroCompte' => $compte->getNumeroCompte(),
            'solde' => $compte->getSolde(),
            'typeDeCompte' => $compte->getTypeDeCompte(),
            'clientId' => $compte->getClientId(),
        ];
        $this->executeReq($query, $params);
    }
}