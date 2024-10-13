<div id="container-compte">
    <?php
    include('./vue/include/compteAside.php');
    ?>

    <section>
        <form id="form-depot" action="" method="post">
            <div class="form-group">
                <label for="depot"><h3>Dépôt</h3></label>
                <input type="number" name="depot" id="depot" min="0" step="0.01" placeholder="Montant" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Déposer">
            </div>
        </form>
        <form id="form-retrait" action="" method="post">
            <div class="form-group">
                <label for="retrait"><h3>Retrait</h3></label>
                <input type="number" name="retrait" id="retrait" min="0" step="0.01" placeholder="Montant" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Retirer">
            </div>
        </form>
        <form id="form-virement" action="" method="post">
            <div class="form-group">
                <label for="virement"><h3>Virement</h3></label>
                <input type="number" name="virement" id="virement" min="0" step="0.01" placeholder="Montant" required>
            </div>
            <div class="form-group">
                <select name="idCompte" id="idCompte">
                    <option value="">--- Choisissez un compte ---</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Virement">
            </div>
        </form>
</div>