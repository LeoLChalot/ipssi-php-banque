<?php

class ClientController extends AbstractController
{
    private ClientModel $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }

    public function actionClient()
    {
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $action = $_GET['action'];

            switch ($_GET['action']) {
                case 'inscription':

                    if (isset($_POST['nom']) && empty($_POST['nom'])) {
                        $this->render('inscription', [
                            'erreurs' => ['nom' => 'Veuillez renseigner votre nom']
                        ]);
                    } else if (isset($_POST['prenom']) && empty($_POST['prenom'])) {
                        $this->render('inscription', [
                            'erreurs' => ['prenom' => 'Veuillez renseigner votre prenom']
                        ]);
                    } else if (isset($_POST['telephone']) && empty($_POST['telephone'])) {
                        $this->render('inscription', [
                            'erreurs' => ['telephone' => 'Veuillez renseigner votre telephone']
                        ]);
                    } else if (isset($_POST['email']) && empty($_POST['email'])) {
                        $this->render('inscription', [
                            'erreurs' => ['email' => 'Veuillez renseigner votre email']
                        ]);
                    } else if (isset($_POST['mdp']) && empty($_POST['mdp'])) {
                        $this->render('inscription', [
                            'erreurs' => ['password' => 'Veuillez renseigner votre mot de passe']
                        ]);
                    } else if (isset($_POST['mdp-confirmation']) && empty($_POST['mdp-confirmation'])) {
                        $this->render('inscription', [
                            'erreurs' => ['password' => 'Veuillez confirmer votre mot de passe']
                        ]);
                    } else if (isset($_POST['mdp']) && isset($_POST['mdp-confirmation'])) {
                        if ($_POST['mdp'] != $_POST['mdp-confirmation']) {
                            $this->render('inscription', [
                                'erreurs' => ['password' => 'Veuillez saisir deux mot de passes identiques']
                            ]);
                        }
                    }


                    if (
                        isset($_POST['nom']) && !empty($_POST['nom']) &&
                        isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                        isset($_POST['telephone']) && !empty($_POST['telephone']) &&
                        isset($_POST['email']) && !empty($_POST['email']) &&
                        isset($_POST['mdp']) && !empty($_POST['mdp']) &&
                        isset($_POST['mdp-confirmation']) && !empty($_POST['mdp-confirmation'])
                    ) {
                        $client = new Client($_POST['email'], $_POST['mdp'], $_POST['nom'], $_POST['prenom'], $_POST['telephone']);
                        var_dump($client);

                        $this->model->ajouter($client);
                        // $this->render('connexion');
                    }

                    $this->render('inscription');
                    break;

                case 'connexion':
                    $this->render('connexion');
                    break;

                case 'suppression':
                    break;
            }
        } else {
            $this->render('accueil');
        }
    }
}
