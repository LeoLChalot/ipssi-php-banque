<header>
    <nav>
        <a href="./index.php">Accueil</a>
        <?php if (isset($client)): ?>
        <a href="?action=mes-comptes">Mes compte</a>
        <a href="?action=deconnexion">Déconnexion</a>
        <?php else:?>
        <a href="?action=connexion">Se connecter</a>
        <a href="?action=inscription">S'enregistrer</a>
        <?php endif; ?>
        
    </nav>
</header>