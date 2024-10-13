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

                    // Gestion des erreurs
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
                            return $this->render('inscription', [
                                'erreurs' => ['password' => 'Veuillez saisir deux mot de passes identiques']
                            ]);
                            exit;
                        }
                    }

                    // Ajout du compte client
                    if (
                        isset($_POST['nom']) && !empty($_POST['nom']) &&
                        isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                        isset($_POST['telephone']) && !empty($_POST['telephone']) &&
                        isset($_POST['email']) && !empty($_POST['email']) &&
                        isset($_POST['mdp']) && !empty($_POST['mdp']) &&
                        isset($_POST['mdp-confirmation']) && !empty($_POST['mdp-confirmation'])
                    ) {
                        $client = new Client(
                            '',
                            $_POST['email'],
                            password_hash($_POST['mdp'], PASSWORD_DEFAULT),
                            $_POST['nom'],
                            $_POST['prenom'],
                            $_POST['telephone']
                        );
                        var_dump($client);

                        // Vérification de l'existence de l'email et ajout d'un nouveau client
                        if ($this->model->getByEmail($_POST['email'])) {
                            return $this->render('inscription', [
                                'erreurs' => ['email' => 'Cet email est déjà enregistré']
                            ]);
                            exit;
                        }

                        $this->model->ajouter($client);


                        header('Location: index.php?action=connexion');
                        exit;
                    }

                    return $this->render('inscription');
                    break;

                case 'connexion':
                    if (isset($_POST['email']) && isset($_POST['mdp'])) {
                        $client = $this->model->connecter($_POST['email'], $_POST['mdp']);

                        if ($client == null) {
                            $this->render('connexion', [
                                'erreurs' => ['password' => 'Email ou mot de passe incorrect']
                            ]);
                            exit;
                        }
                        
                        $_SESSION['client'] = serialize($client);
                        header('Location: index.php');
                    }
                    $this->render('connexion');
                    break;

                case 'suppression':
                    break;
                case 'deconnexion':
                    session_destroy();
                    header('Location: index.php');
                    break;
                default:
                    break;
            }
        } else {
            $this->render('accueil');
        }
    }
}
