<form action="" method="post">
    <h1>Créer un compte</h1>
    <div class="form-group">
        <select name="type" id="type">
            <option value="">--- Choisissez un type de compte ---</option>
            <option value="Epargne">Epargne</option>
            <option value="Courant">Courant</option>
            <option value="Entreprise">Entreprise</option>
        </select>
    </div>
    <div class="form-group">
        <label for="solde">Un premier apport est nécessaire pour la création du compte</label>
        <input type="number" name="solde" id="solde" min="0" step="0.01" placeholder="Solde" required>
        <small>Le dépôt initial doit être compris entre 10 et 2000 €</small>
    </div>
    <div class="form-group">
        <input type="submit" value="Valider">
    </div>

</form>