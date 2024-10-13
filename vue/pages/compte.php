<?php
if (isset($_SESSION['client'])) {
    $client = unserialize($_SESSION['client']);
} else {
    $client = null;
    header('Location: ./index.php');
}
if (isset($selectedCompte)) {
    if ($selectedCompte->getClientId() !== $client->getId()) {
        $client = null;
        header('Location: ./index.php');
    }
}

?>
<div id="container-compte">
    <?php if (isset($comptes)): ?>
        <aside>
            <div id="infos-compte-container">
                <h2>Compte(s)</h2>
                <form action="" method="post" id="comptes-selection">
                    <div class="form-group">
                        <select name="idCompte" id="">
                            <option value="">--- Choisissez un compte ---</option>
                            <?php foreach ($comptes as $compte): ?>
                                <option value=<?= $compte['compteId'] ?>><?= $compte['compteId'] ?> - <?= $compte['typeDeCompte'] ?> - <?= $compte['solde'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Selectionner">
                    </div>
                </form>
                <?php if (isset($selectedCompte)): ?>
                    <div id="info-compte">
                        <h3>Compte selectionné</h3>
                        <p><b>Identifiant du compte :</b> <?= $selectedCompte->getCompteId() ?></p>
                        <p><b>Identifiant client :</b> <?= $client->getId() ?></p>
                        <p><b>Titulaire :</b> <?= $client->getNom() ?></p>
                        <p><b>Type de compte :</b> <?= $selectedCompte->getTypeDeCompte() ?></p>
                        <p><b>Solde :</b> <?= $selectedCompte->getSolde() ?> €</p>
                    </div>
                <?php else: ?>
                    <div id="info-compte">
                        <h3>Compte selectionné</h3>
                        <p><b>Identifiant du compte :</b></p>
                        <p><b>Solde :</b> -- €</p>
                        <p><b>Type de compte :</b></p>
                        <p><b>Client :</b> <?= $client->getNom() ?></p>
                        <p><b>Identifiant client :</b> <?= $client->getId() ?></p>
                    </div>
                <?php endif; ?>

                <div id="link-container">
                    <a class="btn add" href="?action=creation-compte&idClient=<?= $client->getId() ?>">Créer un compte</a>
                    <?php if (isset($selectedCompte)): ?>
                        <a class="btn delete" href="?action=supprimer-compte&idCompte=<?= $selectedCompte->getCompteId() ?>&idClient=<?= $client->getId() ?>">Supprimer le compte</a>
                    <?php endif ?>
                </div>

            </div>
        </aside>

        <section>
            <form id="form-depot" action="" method="post">
                <div class="form-group">
                    <label for="depot">
                        <h3>Dépôt</h3>
                    </label>
                    <input type="number" name="depot" id="depot" min="0" step="0.01" placeholder="Montant" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Déposer">
                    <?php if (isset($errorDepot)) echo $errorDepot; ?>
                </div>
            </form>
            <form id="form-retrait" action="" method="post">
                <div class="form-group">
                    <label for="retrait">
                        <h3>Retrait</h3>
                    </label>
                    <input type="number" name="retrait" id="retrait" min="0" step="0.01" placeholder="Montant" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Retirer">
                    <?php if (isset($errorRetrait)) echo $errorRetrait; ?>
                </div>
            </form>
            <form id="form-virement" action="" method="post">
                <div class="form-group">
                    <label for="virement">
                        <h3>Virement</h3>
                    </label>
                    <select name="idCompteVirement" id="">
                        <option value="">--- Choisissez un compte ---</option>
                        <?php foreach ($comptes as $compte): ?>
                            <option value=<?= $compte['compteId'] ?>><?= $compte['compteId'] ?> - <?= $compte['typeDeCompte'] ?> - <?= $compte['solde'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" name="virement" id="virement" min="0" step="0.01" placeholder="Montant" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="Virement">
                    <?php if (isset($errorVirement)) echo $errorVirement; ?>
                </div>
            </form>

        </section>
    <?php else: ?>
        <p>Vous n'avez pas encore de compte.</p>
        <a href="?action=creation-compte&idClient=<?= $client->getId() ?>">Créer un compte</a>
    <?php endif; ?>
</div>