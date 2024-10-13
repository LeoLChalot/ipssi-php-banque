<?php

class CompteController extends AbstractController
{

    private CompteModel $model;

    public function __construct()
    {
        $this->model = new CompteModel();
    }

    public function actionCompte()
    {
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $action = $_GET['action'];

            switch ($action) {
                case 'mes-comptes':

                    if (isset($_SESSION['client'])) {

                        // Récupération des informations de SESSION de l'utilisateur
                        $client = unserialize($_SESSION['client']);

                        // Récupération des comptes du client
                        $comptes = $this->model->getByClientID($client->getId());

                        // Récupération du compte selectionné
                        if (isset($_SESSION['compte'])) $compte = unserialize($_SESSION['compte']);

                        if ($comptes) {

                            // DEPOT
                            if (isset($_POST['depot']) && !empty($_POST['depot'])) {
                                $depot = $_POST['depot'];
                                if ($compte->setSolde($depot)) {
                                    $this->model->update($compte);
                                    $comptes = $this->model->getByClientID($client->getId());
                                    return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compte]);
                                } else {
                                    $error = 'Le solde ne permet pas de deposer ce montant';
                                    return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compte, 'errorDepot' => $error]);
                                }

                            // RETRAIT
                            } else if (isset($_POST['retrait']) && !empty($_POST['retrait'])) {
                                $montantRetrait = -1 * $_POST['retrait'];
                                $retrait = $compte->setSolde($montantRetrait);
                                if ($retrait) {
                                    $this->model->update($compte);
                                    $comptes = $this->model->getByClientID($client->getId());
                                    return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compte]);
                                } else {
                                    $error = 'Le solde ne permet pas de retirer ce montant';
                                    return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compte, 'errorRetrait' => $error]);
                                }

                            // VIREMENT
                            } else if (isset($_POST['virement']) && !empty($_POST['virement']) && isset($_POST['idCompteVirement']) && !empty($_POST['idCompteVirement'])) {

                                $compteEmetteur = $compte;
                                $compteRecepteur = $this->model->getById($_POST['idCompteVirement']);

                                //  On vérifie que la somme est disponible sur le compte émetteur
                                $montantVirementEmetteur = -1 * $_POST['virement'];

                                //  On retire le montant du compte émetteur
                                $retraitCompteEmetteur = $compteEmetteur->setSolde($montantVirementEmetteur);
                                
                                if ($retraitCompteEmetteur) {
                                    $this->model->update($compteEmetteur);

                                    $montantVirementRecepteur = $_POST['virement'];

                                    //  On ajoute le montant au compte recepteur
                                    $depotCompteRecepteur = $compteRecepteur->setSolde($montantVirementRecepteur);

                                    //  On ajoute le montant au compte récepteur
                                    if ($depotCompteRecepteur) {
                                        $this->model->update($compteRecepteur);
                                        $comptes = $this->model->getByClientID($client->getId());
                                        return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compteEmetteur]);
                                    } else {
                                        $error = 'Le solde ne permet pas de virer ce montant';
                                        return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compte, 'errorVirement' => $error]);
                                    }
                                } else {
                                    $error = 'Le solde ne permet pas de retirer ce montant';
                                    return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compte, 'errorRetrait' => $error]);
                                }

                            // CONSULTATION
                            } else if (isset($_POST['idCompte']) && !empty($_POST['idCompte'])) {
                                $fetchedCompte = $this->model->getById($_POST['idCompte']);
                                $_SESSION['compte'] = serialize($fetchedCompte);
                                return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $fetchedCompte]);

                            // DEFAULT
                            } else {
                                return $this->render('compte', ['comptes' => $comptes]);
                            }
                        }
                    }
                    return $this->render('compte');
                    break;

                case 'creation-compte':

                    if (isset($_SESSION['client'])) {
                        $client = unserialize($_SESSION['client']);
                        if ($_GET['idClient'] !== $client->getId()) return;

                        if (isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['solde']) && !empty($_POST['solde'])) {
                            $type = $_POST['type'];
                            $solde = $_POST['solde'];
                            switch ($type) {
                                case 'EPARGNE':
                                    $type = TypeDeCompte::EPARGNE;
                                    break;
                                case 'COURANT':
                                    $type = TypeDeCompte::COURANT;
                                    break;
                                case 'ENTREPRISE':
                                    $type = TypeDeCompte::ENTREPRISE;
                                    break;
                                default:
                                    break;
                            }
                            $compte = new Compte('', '', $solde, $type, $client->getId());
                            $this->model->ajouter($compte);
                            $comptes = $this->model->getByClientID($client->getId());
                            return $this->render('compte', ['comptes' => $comptes]);
                        } else {
                        }
                    }



                    return $this->render('creation-compte');
                    break;

                case 'supprimer-compte':
                    if (isset($_SESSION['client'])) {
                        $client = unserialize($_SESSION['client']);
                        if ($_GET['idClient'] !== $client->getId()) return;
                        if (isset($_GET['idCompte']) && !empty($_GET['idCompte']) && isset($_GET['idClient']) && !empty($_GET['idClient'])) {
                            $this->model->delete($_GET['idCompte']);

                            $comptes = $this->model->getByClientID($client->getId());
                            return $this->render('compte', ['comptes' => $comptes]);
                        }
                    }
                    return $this->render('supprimer-compte');
                    break;

                
                
                default:
                    break;
            }
        }
    }
}
