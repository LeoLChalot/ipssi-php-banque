<form action="" method="post">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Nom" required>
        <span><?= isset($erreurs['nom']) ? $erreurs['nom'] : '' ?></span>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
        <span><?= isset($erreurs['prenom']) ? $erreurs['prenom'] : '' ?></span>
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone" placeholder="Téléphone" required>
        <span><?= isset($erreurs['telephone']) ? $erreurs['telephone'] : '' ?></span>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <span><?= isset($erreurs['email']) ? $erreurs['email'] : '' ?></span>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
        <input type="password" name="mdp-confirmation" id="mdp-confirmation" placeholder="Confirmer le mot de passe" required>
        <span><?= isset($erreurs['password']) ? $erreurs['password'] : '' ?></span>
        <small>
            <p>Le mot de passe doit contenir au moins :</p>
            <ul>
                <li>
                    <p><em>8 caractères</em></p>
                </li>
                <li>
                    <p><em>une majuscule</em></p>
                </li>
                <li>
                    <p><em>une minuscule</em></p>
                </li>
                <li>
                    <p><em>un chiffre</em></p>
                </li>
                <li>
                    <p><em>un caractère spécial</em></p>
                </li>
            </ul>
        </small>
        <p id="mdp-error"></p>
    </div>
    <div class="form-group">
        <input type="submit" value="S'inscrire">
    </div>
</form>