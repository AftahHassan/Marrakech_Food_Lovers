<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">

        <h2>🔐 Connexion</h2>

        <div class="log-form">
            <?php if (isset($error)) : ?>
                <div class="alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="/Marrakech_Food_Lovers/login.php">

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

                <button type="submit">Se connecter</button>

            </form>

            <p class="auth-link">
                Pas encore de compte ?
                <a href="/Marrakech_Food_Lovers/register.php">S'inscrire</a>
            </p>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>