<?php

class ClientModel extends GenericModel
{

    public function ajouter(Client $client)
    {

        $query =
            "INSERT INTO client 
        (clientId, nom, prenom, telephone, email, mdp) 
        VALUES (:clientId, :nom, :prenom, :telephone, :email, :mdp)";
        $params = [
            'clientId' => $client->getId(),
            'nom' => $client->getNom(),
            'prenom' => $client->getPrenom(),
            'telephone' => $client->getTelephone(),
            'email' => $client->getEmail(),
            'mdp' => $client->getMdp()
        ];

        $this->executeReq($query, $params);
    }

    public function connecter(string $email, string $mdp): Client
    {
        $query = "SELECT * FROM client WHERE email = :email AND mdp = :mdp";
        $params = [
            'email' => $email,
            'mdp' => $mdp
        ];
        $result = $this->executeReq($query, $params);
        $client = $result->fetch();
        return $client;
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM client";
        $result = $this->executeReq($query);
        $clients = $result->fetchAll();
        foreach ($clients as $key => $client) {
            $clients[$key] = new Client($client['clientId'], $client['nom'], $client['prenom'], $client['telephone'], $client['email'], $client['mdp']);
        }
        return $clients;
    }

    public function getByEmail(string $email): Client
    {
        $query = "SELECT * FROM client WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $result = $this->executeReq($query, $params);
        $client = $result->fetch();
        $client = new Client($client['clientId'], $client['nom'], $client['prenom'], $client['telephone'], $client['email'], $client['mdp']);
        return $client;
    }

    public function getByID(string $id): Client
    {
        $query = "SELECT * FROM client WHERE clientId = :id";
        $params = [
            'id' => $id
        ];
        $result = $this->executeReq($query, $params);
        $client = $result->fetch();
        $client = new Client($client['clientId'], $client['nom'], $client['prenom'], $client['telephone'], $client['email'], $client['mdp']);
        return $client;
    }

    public function update(Client $client): void
    {
        $query = "UPDATE client SET nom = :nom, prenom = :prenom, telephone = :telephone, email = :email, mdp = :mdp WHERE clientId = :clientId";
        $params = [
            'clientId' => $client->getId(),
            'nom' => $client->getNom(),
            'prenom' => $client->getPrenom(),
            'telephone' => $client->getTelephone(),
            'email' => $client->getEmail(),
            'mdp' => $client->getMdp()
        ];
        $this->executeReq($query, $params);
    }

    public function delete(Client $client): void
    {
        $query = "DELETE FROM client WHERE clientId = :clientId";
        $params = [
            'clientId' => $client->getId()
        ];
        $this->executeReq($query, $params);
    }
}
