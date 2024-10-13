<?php

class CompteModel extends GenericModel
{

    private string $table = 'comptebancaire';

    public function ajouter(Compte $compte): ?bool
    {
        // Vérifie que le compteId n'éxiste pas
        $compteFetch = $this->getByID($compte->getCompteId());
        if ($compteFetch) return false;

        $query =
            "INSERT INTO $this->table 
            (compteId, numeroCompte, solde, typeDeCompte, clientId) 
            VALUES (:compteId, :numeroCompte, :solde, :typeDeCompte, :clientId);";
        $params = [
            'compteId' => $compte->getCompteId(),
            'numeroCompte' => $compte->getNumeroCompte(),
            'solde' => $compte->getSolde(),
            'typeDeCompte' => $compte->getTypeDeCompte(),
            'clientId' => $compte->getClientId(),
        ];
        $res = $this->executeReq($query, $params);
        if ($res) return true;
        return false;
    }

    public function getAll(): ?array
    {
        $query = "SELECT * FROM $this->table;";
        $result = $this->executeReq($query);
        $comptes = $result->fetchAll();

        if (!$comptes) return null;

        foreach ($comptes as $key => $compte) {
            $comptes[$key] = new Compte($compte['compteId'], $compte['numeroCompte'], $compte['solde'], $compte['typeDeCompte'], $compte['clientId']);
        }
        return $comptes;
    }

    public function getByID(string $id): ?Compte
    {
        $query = "SELECT * FROM $this->table WHERE compteId = :id;";
        $params = [
            'id' => $id
        ];
        $result = $this->executeReq($query, $params);
        $compte = $result->fetch();

        if (!$compte) return null;

        $compte = new Compte($compte['compteId'], $compte['numeroCompte'], $compte['solde'], $compte['typeDeCompte'], $compte['clientId']);
        return $compte;
    }

    public function update(Compte $compte): ?bool
    {
        $compteFetch = $this->getByID($compte->getCompteId());
        if (!$compteFetch) return false;

        $query = "UPDATE $this->table SET numeroCompte = :numeroCompte, solde = :solde, typeDeCompte = :typeDeCompte, clientId = :clientId WHERE compteId = :compteId;";
        $params = [
            'compteId' => $compte->getCompteId(),
            'numeroCompte' => $compte->getNumeroCompte(),
            'solde' => $compte->getSolde(),
            'typeDeCompte' => $compte->getTypeDeCompte(),
            'clientId' => $compte->getClientId(),
        ];
        $res = $this->executeReq($query, $params);

        if ($res) return true;
        return false;
    }

    public function delete(Compte $compte): ?bool
    {
        $compteFetch = $this->getByID($compte->getCompteId());

        if (!$compteFetch) return false;

        $query = "DELETE FROM $this->table WHERE compteId = :compteId;";
        $params = [
            'compteId' => $compte->getCompteId(),
        ];
        $res = $this->executeReq($query, $params);

        if ($res) return true;
        return false;
    }

    public function getByClientID(string $id): ?Compte
    {
        $query = "SELECT * FROM $this->table WHERE clientId = :id;";
        $params = [
            'id' => $id
        ];
        $result = $this->executeReq($query, $params);
        $comptes = $result->fetchAll();

        if (!$comptes) return null;

        foreach ($comptes as $key => $compte) {
            $comptes[$key] = new Compte($compte['compteId'], $compte['numeroCompte'], $compte['solde'], $compte['typeDeCompte'], $compte['clientId']);
        }
        return $comptes;
    }
}
