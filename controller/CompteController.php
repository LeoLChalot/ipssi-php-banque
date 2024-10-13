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

            switch ($_GET['action']) {
                case 'mes-comptes':

                    if (isset($_SESSION['client'])) {
                        $client = unserialize($_SESSION['client']);
                        $comptes = $this->model->getByClientID($client->getId());
                        if ($comptes) {
                            if (isset($_POST['idCompte']) && !empty($_POST['idCompte'])) {
                                $compte = $this->model->getById($_POST['idCompte']);
                                return $this->render('compte', ['comptes' => $comptes, 'selectedCompte' => $compte]);
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
                            var_dump($type, $solde, $type->name);
                            $compte = new Compte('', '', $solde, $type, $client->getId());
                            var_dump($compte);
                            $this->model->ajouter($compte);
                            $comptes = $this->model->getByClientID($client->getId());
                            return $this->render('compte', ['comptes' => $comptes]);
                        } else {
                        }
                    }



                    return $this->render('creation-compte');
                    break;
                default:
                    break;
            }
        }
    }
}
