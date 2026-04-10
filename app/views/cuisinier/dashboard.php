<?php
if ($_SESSION['role'] !== 'cuisinier' && $_SESSION['role'] !== 'admin') {
    header('Location: /Marrakech_Food_Lovers/login.php');
    exit();
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>


<style>
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    animation: slideInUp 0.6s ease-out;
}
.dashboard-header h2 {
    font-size: 42px;
    font-weight: 800;
    background: linear-gradient(135deg, #ff6b9d 0%, #c34a7b 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.btn-new-prompt {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #ff6b9d 0%, #c34a7b 100%);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
}
.btn-new-prompt:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 107, 157, 0.4);
}
.btn-new-prompt-icon { font-size: 20px; font-weight: 400; }
.filter-box {
    background: white;
    border-radius: 12px;
    padding: 20px 25px;
    margin-bottom: 30px;
    box-shadow: 0 4px 16px rgba(255, 107, 157, 0.1);
    border: 1px solid rgba(255, 107, 157, 0.15);
    display: flex;
    align-items: center;
    gap: 15px;
    animation: slideInUp 0.6s ease-out 0.1s backwards;
}
.filter-box form { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
.filter-box label { font-weight: 700; color: #333; font-size: 14px; }
.filter-box select {
    padding: 10px 16px;
    border: 2px solid rgba(255, 107, 157, 0.2);
    border-radius: 10px;
    font-size: 14px;
    font-family: inherit;
    color: #333;
    background: #f8f9fa;
    cursor: pointer;
    transition: all 0.3s ease;
}
.filter-box select:focus {
    outline: none;
    border-color: #ff6b9d;
    box-shadow: 0 0 0 3px rgba(255, 107, 157, 0.1);
}
.filter-box a {
    padding: 8px 16px;
    background: rgba(255, 107, 157, 0.1);
    color: #c34a7b;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
}
.filter-box a:hover { background: rgba(255, 107, 157, 0.2); }
.prompt-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    animation: slideInUp 0.6s ease-out 0.2s backwards;
}
.prompt-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 8px 32px rgba(255, 107, 157, 0.1);
    border: 1px solid rgba(255, 107, 157, 0.15);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.prompt-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(255, 107, 157, 0.2);
}
.badge {
    display: inline-block;
    padding: 5px 14px;
    background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
    color: white;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
    width: fit-content;
}
.prompt-card h3 { font-size: 18px; font-weight: 700; color: #1a1a1a; line-height: 1.4; }
.content-box {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
    border: 1px solid rgba(255, 107, 157, 0.1);
}
.content-box code {
    font-family: inherit;
    font-size: 13px;
    color: #555;
    line-height: 1.7;
    white-space: pre-wrap;
}
.prompt-card p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.actions {
    display: flex;
    gap: 8px;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid rgba(255, 107, 157, 0.1);
    flex-wrap: wrap;
}
.actions a {
    padding: 8px 14px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-edit {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}
.btn-delete {
    background: rgba(255, 59, 48, 0.1);
    color: #ff3b30;
}
.btn-edit:hover, .btn-delete:hover { transform: translateY(-2px); filter: brightness(1.1); }
.badge-readonly {
    display: inline-block;
    padding: 8px 14px;
    background: rgba(153, 153, 153, 0.1);
    color: #999;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
}
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 30px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(255, 107, 157, 0.1);
    border: 2px dashed rgba(255, 107, 157, 0.3);
}
.empty-state p { font-size: 18px; color: #999; font-weight: 500; }
@media (max-width: 768px) {
    .dashboard-header { flex-direction: column; gap: 15px; align-items: flex-start; }
    .dashboard-header h2 { font-size: 32px; }
    .prompt-grid { grid-template-columns: 1fr; }
    .filter-box form { flex-direction: column; align-items: flex-start; }
}
</style>


<div class="dashboard-header">
    <h2>🍽️ Mes Recettes</h2>
    <a href="/Marrakech_Food_Lovers/create_recipe.php" class="btn-new-prompt">
        <span class="btn-new-prompt-icon">＋</span>
        Nouvelle Recette
    </a>
</div>


<!-- FILTRE PAR CATEGORIE -->
<div class="filter-box">
    <form action="/Marrakech_Food_Lovers/dashboard.php" method="GET">
        <label for="category_id">Filtrer par catégorie :</label>
<select name="category_id" id="category_id" onchange="filterCategory(this.value)">
            <option value="0">Toutes les catégories</option>
            <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat['id'] ?>"
                    <?= ($category_filter == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if ($category_filter > 0) : ?>
            <a href="/Marrakech_Food_Lovers/dashboard.php">🔄 Réinitialiser</a>
        <?php endif; ?>
    </form>
    <script>
function filterCategory(categoryId) {
    window.location.hash = 'category=' + categoryId;
    // Simple reload with hash - stays "same page" feel, no full refresh effect
    window.location.search = '?category_id=' + categoryId;
}
    </script>
</div>


<!-- GRILLE RECETTES -->
<div class="prompt-grid">
    <?php if (count($recipes) > 0) : ?>
        <?php foreach ($recipes as $r) : ?>
            <div class="prompt-card">
                <span class="badge"><?= htmlspecialchars($r['category_name']) ?></span>
                <h3><?= htmlspecialchars($r['title']) ?></h3>
                <div class="content-box">
                    <code><?= nl2br(htmlspecialchars($r['ingredients'])) ?></code>
                </div>
                <p><?= nl2br(htmlspecialchars($r['description'])) ?></p>


                <div class="actions">
                    <?php if ($r['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] === 'admin') : ?>
                        <!-- ✅ Propriétaire OU Admin -->
                        <a href="/Marrakech_Food_Lovers/edit_recipe.php?id=<?= $r['id'] ?>">✏️ Modifier</a>
                        <a href="/Marrakech_Food_Lovers/delete_recipe.php?id=<?= $r['id'] ?>"
                           onclick="return confirm('Supprimer cette recette ?')"
                           class="btn-delete">🗑️ Supprimer</a>
                    <?php else : ?>
                        <!-- 👁️ Cuisinier B — lecture seule -->
                        <span class="badge-readonly">👁️ Lecture seule</span>
                    <?php endif; ?>
                </div>


            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="empty-state">
            <p>🍽️ Aucune recette trouvée. Créez votre première recette !</p>
        </div>
    <?php endif; ?>
</div>


<?php require_once __DIR__ . '/../includes/footer.php'; ?>