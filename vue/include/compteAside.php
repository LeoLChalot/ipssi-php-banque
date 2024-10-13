<?php if (isset($compte)): ?>
    <aside>
        <div id="infos-compte-container">
            <h2>Compte</h2>
            <form action="" method="post">
                <div class="form-group">
                    <select name="idCompte" id="">
                        <option value="">--- Choisissez un compte ---</option>
                        <?php foreach ($comptes as $compte): ?>
                            <option value=<?= $compte['idCompte'] ?>><?= $compte['idCompte'] ?> - <?= $compte['typeDeCompte'] ?> - <?= $compte['solde'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Selectionner">
                </div>
            </form>
            <!-- <p><b>Solde :</b> <?= $compte->getSolde() ?></p>
            <p><b>Type de compte :</b> <?= $compte->getType() ?></p>
            <p><b>Client :</b> <?= $compte->getClient() ?></p>
            <p><b>Identifiant :</b> <?= $compte->getId() ?></p> -->
        </div>
        <!-- <div id="link-container">
        <a href="?action=depot">Dépôt</a>
        <a href="?action=retrait">Retrait</a>
        <a href="?action=virement">Virement</a>
        <a href="?action=supprimerCompte">Supprimer le compte</a>
    </div> -->
    </aside>
<?php endif; ?>