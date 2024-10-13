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
                            return $this->render('mes-comptes', ['comptes' => $comptes]);
                        }
                    }

                    return $this->render('compte');
                    break;

                case 'creation-compte':

                    return $this->render('creation-compte');
                    break;
                default:
                    break;
            }
        }
    }
}
