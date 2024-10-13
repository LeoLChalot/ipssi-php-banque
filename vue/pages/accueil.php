<?php
if (isset($_SESSION['client'])) {
    $client = unserialize($_SESSION['client']);
} else {
    $client = null;
}
?>
<div id="container-accueil">
    <h1>
        <?php if (isset($client)): ?>
            Bonjour, Mr <?= $client->getNom() ?> !
        <?php else: ?>
            Bienvenue sur la page d'accueil
        <?php endif ?>
    </h1>

    <?php if (isset($client)): ?>
        <div id="actions-compte">
            <h2>Que voulez-vous faire ?</h2>
            <div id="buttons-group">
                <a href="?action=mes-comptes">Consulter mes comptes</a>
                <a href="?action=depot">Effectuer un dépôt</a>
                <a href="?action=retrait">Effectuer un retrait</a>
                <a href="?action=virement">Effectuer un virement</a>
            </div>
        </div>

    <?php endif ?>

</div>