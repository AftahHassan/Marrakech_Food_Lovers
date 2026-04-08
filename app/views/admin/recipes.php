<?php require_once __DIR__ . '/../includes/auth.php'; ?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<style>
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

.admin-wrapper {
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 30px;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    animation: slideInUp 0.6s ease-out;
}

.page-header h1 {
    font-size: 38px;
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
    letter-spacing: -1px;
    margin: 0;
}

.page-count {
    display: inline-block;
    padding: 7px 16px;
    background: rgba(224, 123, 57, 0.1);
    color: #e07b39;
    border-radius: 20px;
    font-weight: 700;
    font-size: 13px;
}

.table-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(224, 123, 57, 0.12);
    border: 1px solid rgba(224, 123, 57, 0.1);
    overflow: hidden;
    animation: slideInUp 0.7s ease-out 0.1s backwards;
}

.table-card table {
    width: 100%;
    border-collapse: collapse;
}

.table-card thead {
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    color: white;
}

.table-card th {
    padding: 18px 20px;
    text-align: left;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-card td {
    padding: 16px 20px;
    border-bottom: 1px solid rgba(224, 123, 57, 0.08);
    color: #333;
    font-size: 15px;
}

.table-card tbody tr {
    transition: background 0.2s ease;
}

.table-card tbody tr:hover {
    background: rgba(224, 123, 57, 0.04);
}

.table-card tbody tr:last-child td {
    border-bottom: none;
}

.recipe-title {
    font-weight: 600;
    color: #222;
}

.category-badge {
    display: inline-block;
    padding: 5px 12px;
    background: rgba(224, 123, 57, 0.1);
    color: #c0501a;
    border-radius: 20px;
    font-weight: 600;
    font-size: 12px;
}

.btn-delete {
    display: inline-block;
    padding: 7px 15px;
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    box-shadow: 0 3px 10px rgba(224, 123, 57, 0.25);
    transition: all 0.3s ease;
}

.btn-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 14px rgba(224, 123, 57, 0.4);
}

.empty-state {
    padding: 60px 30px;
    text-align: center;
    color: #aaa;
    font-size: 16px;
    font-weight: 500;
}

@media (max-width: 768px) {
    .page-header h1 { font-size: 26px; }
    .table-card th, .table-card td { padding: 12px 10px; font-size: 13px; }
}
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <h1>🍽️ Toutes les recettes</h1>
        <span class="page-count"><?= count($recipes) ?> recette<?= count($recipes) > 1 ? 's' : '' ?></span>
    </div>

    <div class="table-card">
        <?php if (count($recipes) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Cuisinier</th>
                    <th>Catégorie</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recipes as $recipe) : ?>
                <tr>
                    <td><?= $recipe['id'] ?></td>
                    <td class="recipe-title"><?= htmlspecialchars($recipe['title']) ?></td>
                    <td><?= htmlspecialchars($recipe['username']) ?></td>
                    <td><span class="category-badge"><?= htmlspecialchars($recipe['category_name']) ?></span></td>
                    <td><?= htmlspecialchars($recipe['description']) ?></td>
                    <td><?= $recipe['created_at'] ?></td>
                    <td>
                        <a href="/Marrakech_Food_Lovers/admin/delete_recipe.php?id=<?= $recipe['id'] ?>"
                           onclick="return confirm('Supprimer cette recette ?')"
                           class="btn-delete">🗑️ Supprimer</a>
                           <a href="/Marrakech_Food_Lovers/cuisinier/edit.php.php?id=<?= $recipe['id'] ?>"
                           
                           class="btn-delete">Modifier</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
            <div class="empty-state">Aucune recette trouvée pour le moment.</div>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>