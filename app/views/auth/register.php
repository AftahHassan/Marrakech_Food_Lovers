<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">

        <h2>📝 Créer un compte</h2>

        <?php if (isset($error)) : ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="/Marrakech_Food_Lovers/register.php">

            <div class="form-group">
                <input
                    type="text"
                    name="username"
                    placeholder="Nom d'utilisateur"
                    required
                >
            </div>

            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                >
            </div>

            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    required
                >
            </div>

            <button type="submit">S'inscrire</button>

        </form>

        <p class="auth-link">
            Déjà un compte ?
            <a href="/Marrakech_Food_Lovers/login.php">Se connecter</a>
        </p>

    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>