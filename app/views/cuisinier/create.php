<?php require_once __DIR__ . '/../includes/auth.php'; ?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>


<style>
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}
main { animation: slideInUp 0.6s ease-out; }
.form-container {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 8px 32px rgba(255, 107, 157, 0.1);
    border: 1px solid rgba(255, 107, 157, 0.2);
    max-width: 600px;
    margin: 0 auto;
}
.form-title {
    font-size: 32px;
    font-weight: 800;
    background: linear-gradient(135deg, #ff6b9d 0%, #c34a7b 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 30px;
    text-align: center;
}
.main-form { display: flex; flex-direction: column; gap: 20px; }
.form-group { display: flex; flex-direction: column; gap: 8px; }
label { font-size: 14px; font-weight: 700; color: #1a1a1a; text-transform: uppercase; letter-spacing: 0.5px; }
input[type="text"], textarea, select {
    padding: 15px;
    border: 2px solid rgba(255, 107, 157, 0.2);
    border-radius: 10px;
    font-size: 15px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: #f8f9fa;
    color: #1a1a1a;
}
input[type="text"]:focus, textarea:focus, select:focus {
    outline: none;
    border-color: #ff6b9d;
    background: white;
    box-shadow: 0 0 0 4px rgba(255, 107, 157, 0.1);
}
textarea { resize: vertical; min-height: 150px; line-height: 1.6; }
button[type="submit"] {
    padding: 16px 32px;
    background: linear-gradient(135deg, #ff6b9d 0%, #c34a7b 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
    margin-top: 10px;
}
button[type="submit"]:hover { transform: translateY(-3px); }
.btn-back {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background: rgba(255,107,157,0.1);
    color: #c34a7b;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
}
.alert-error {
    padding: 12px 16px;
    background: rgba(255,107,157,0.1);
    border: 1px solid rgba(255,107,157,0.3);
    border-radius: 10px;
    color: #c34a7b;
    font-weight: 600;
}
</style>


<main>
    <a href="/Marrakech_Food_Lovers/admin_recipes.php" class="btn-back">← Retour au Dashboard</a>


    <div class="form-container">
        <h1 class="form-title">➕ Nouvelle Recette</h1>


        <?php if (isset($error)) : ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>


        <form action="/Marrakech_Food_Lovers/create_recipe.php" method="POST" class="main-form">


            <div class="form-group">
                <label for="title">Titre de la recette</label>
                <input type="text" id="title" name="title"
                       placeholder="Ex: Tajine de poulet aux olives" required>
            </div>


            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Choisir une catégorie --</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="ingredients">Ingrédients</label>
                <textarea id="ingredients" name="ingredients"
                          placeholder="Listez les ingrédients nécessaires..." required></textarea>
            </div>


            <div class="form-group">
                <label for="description">Description / Préparation</label>
                <textarea id="description" name="description"
                          placeholder="Décrivez les étapes de préparation..." required></textarea>
            </div>


            <button type="submit">✨ Créer la recette</button>


        </form>
    </div>
</main>


<?php require_once __DIR__ . '/../includes/footer.php'; ?>
