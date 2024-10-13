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
                case 'compte':
                    $this->render('compte');
                    break;
                default:
                    break;
            }
        }
    }
}
