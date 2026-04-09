<?php require_once __DIR__ . '/../includes/auth.php'; ?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<style>
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}
.admin-wrapper { display: flex; flex-direction: column; gap: 24px; padding: 30px; }
.btn-back { display: inline-block; padding: 10px 20px; background: rgba(224,123,57,0.1); color: #e07b39; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 14px; transition: all 0.3s ease; width: fit-content; animation: slideInUp 0.5s ease-out; }
.btn-back:hover { background: rgba(224,123,57,0.2); transform: translateX(-3px); }
.form-card { background: white; border-radius: 15px; box-shadow: 0 8px 32px rgba(224,123,57,0.15); border: 1px solid rgba(224,123,57,0.12); overflow: hidden; animation: slideInUp 0.6s ease-out 0.1s backwards; }
.form-card-header { padding: 28px 30px 0; }
.form-card-header h2 { font-size: 26px; font-weight: 800; background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin: 0 0 6px; }
.form-card-header p { font-size: 14px; color: #888; margin: 0 0 24px; }
.main-form { padding: 0 30px 30px; display: flex; flex-direction: column; gap: 20px; }
.main-form label { display: block; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; color: #555; margin-bottom: 8px; }
.main-form input[type="text"] { width: 100%; padding: 13px 16px; border: 2px solid rgba(224,123,57,0.2); border-radius: 10px; font-size: 15px; font-family: inherit; color: #333; transition: all 0.3s ease; box-sizing: border-box; }
.main-form input[type="text"]:focus { outline: none; border-color: #e07b39; box-shadow: 0 0 0 3px rgba(224,123,57,0.12); }
.alert-error { padding: 13px 18px; background: #f8d7da; color: #721c24; border-radius: 10px; font-weight: 600; font-size: 14px; border-left: 4px solid #dc3545; }
.form-actions { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }
.btn-submit { padding: 13px 28px; background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: pointer; box-shadow: 0 4px 12px rgba(224,123,57,0.3); transition: all 0.3s ease; }
.btn-submit:hover { transform: translateY(-2px); }
.btn-cancel { padding: 13px 24px; background: transparent; color: #999; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 15px; border: 2px solid #e0e0e0; transition: all 0.3s ease; }
.btn-cancel:hover { border-color: #ccc; color: #666; }
</style>

<div class="admin-wrapper">

    <!-- ✅ Corrigé — pointe vers categories.php racine -->
    <a href="/Marrakech_Food_Lovers/categories.php" class="btn-back">⬅ Retour aux catégories</a>

    <div class="form-card">
        <div class="form-card-header">
            <h2>🗂️ Ajouter une catégorie</h2>
            <p>Créez une thématique pour organiser les recettes (ex: Tajine, Couscous, Pâtisseries).</p>
        </div>

        <!-- ✅ Corrigé — pointe vers add_category.php racine -->
        <form method="POST" action="/Marrakech_Food_Lovers/add_category.php" class="main-form">

            <?php if (isset($error)) : ?>
                <div class="alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div>
                <label for="name">Nom de la catégorie</label>
                <input type="text" id="name" name="name"
                       placeholder="Ex: Plats traditionnels" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Créer la catégorie</button>
                <!-- ✅ Corrigé -->
                <a href="/Marrakech_Food_Lovers/categories.php" class="btn-cancel">Annuler</a>
            </div>

        </form>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>