<?php

class ClientModel extends GenericModel
{

    public function ajouter(Client $client)
    {
        // Vérifier que l'email n'existe pas
        $fetchedClient = $this->getByEmail($client->getEmail());

        if ($fetchedClient) {
            return null;
        }

        $query = "INSERT INTO client (clientId, nom, prenom, telephone, email, mdp) VALUES (:clientId, :nom, :prenom, :telephone, :email, :mdp)";
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

    public function connecter(string $email, string $mdp): ?Client
    {

        echo "<script>alert('".$email. " " . $mdp."');</script>";
        // Vérifier que l'email existe
        $client = $this->getByEmail($email);
        // Vérifier le contenu de $client
        if (!$client) return null;

        // Vérifier que le mot de passe est correct
        if($client->verifierMotDePasse($mdp)) {
            return $client;
        }
        return null;
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

    public function getByEmail(string $email): ?Client
    {
        $query = "SELECT * FROM client WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $result = $this->executeReq($query, $params);
        $client = $result->fetch();

        if (!$client) return null;

        $client = new Client($client['clientId'], $client['email'], $client['mdp'], $client['nom'], $client['prenom'], $client['telephone']);
        echo "<script>alert('".$client->getMdp()."');</script>";
        return $client;
    }

    public function getByID(string $id): ?Client
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
