<?php
include('class/Utilisateur.php');
include('class/Admin.php');
include('class/Client.php');
include('class/Compte.php');
include('model/GenericModel.php');
include('model/CompteModel.php');
include('model/ClientModel.php');
include('controller/AbstractController.php');
include('controller/AdminController.php');
include('controller/ClientController.php');
include('controller/CompteController.php');

session_start();



$clientController = new ClientController();
$adminController = new AdminController();
$compteController = new CompteController();

$clientController->actionClient();
$compteController->actionCompte();


?>