<form action="" method="post">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Nom" required>
        <span class="erreur"><?= isset($erreurs['nom']) ? $erreurs['nom'] : '' ?></span>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
        <span class="erreur"><?= isset($erreurs['prenom']) ? $erreurs['prenom'] : '' ?></span>
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone" placeholder="Téléphone" required>
        <span class="erreur"><?= isset($erreurs['telephone']) ? $erreurs['telephone'] : '' ?></span>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <span class="erreur"><?= isset($erreurs['email']) ? $erreurs['email'] : '' ?></span>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
        <input type="password" name="mdp-confirmation" id="mdp-confirmation" placeholder="Confirmer le mot de passe" required>
        <span class="erreur"><?= isset($erreurs['password']) ? $erreurs['password'] : '' ?></span>
        <small>
            <p>Le mot de passe doit contenir au moins :</p>
            <ul>
                <li>
                    <p id="caracteres"><em>8 caractères</em></p>
                </li>
                <li>
                    <p id="majuscules"><em>une majuscule</em></p>
                </li>
                <li>
                    <p id="minuscules"><em>une minuscule</em></p>
                </li>
                <li>
                    <p id="chiffres"><em>un chiffre</em></p>
                </li>
                <li>
                    <p id="special"><em>un caractère spécial</em></p>
                </li>
            </ul>
        </small>
        <p id="mdp-error"></p>
    </div>
    <div class="form-group">
        <button id="submit" type="submit" value="S'inscrire">S'inscrire</button>
    </div>
</form>