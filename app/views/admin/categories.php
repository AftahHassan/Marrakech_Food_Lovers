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
    gap: 14px;
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

.btn-add {
    display: inline-block;
    padding: 12px 24px;
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 15px;
    box-shadow: 0 4px 12px rgba(224, 123, 57, 0.3);
    transition: all 0.3s ease;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(224, 123, 57, 0.4);
}

/* Messages flash */
.alert-success, .alert-error {
    padding: 14px 20px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    animation: slideInUp 0.5s ease-out;
}
.alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
.alert-error   { background: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }

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
    background: rgba(224, 123, 57, 0.05);
}

.table-card tbody tr:last-child td {
    border-bottom: none;
}

.btn-edit, .btn-delete {
    display: inline-block;
    padding: 7px 15px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-right: 6px;
    border: none;
    cursor: pointer;
}

.btn-edit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(102, 126, 234, 0.25);
}

.btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 14px rgba(102, 126, 234, 0.35);
}

.btn-delete {
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(224, 123, 57, 0.25);
}

.btn-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 14px rgba(224, 123, 57, 0.35);
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
    .btn-edit, .btn-delete { padding: 6px 11px; font-size: 12px; margin-bottom: 4px; }
}
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <h1>🗂️ Gestion des catégories</h1>
        <a href="/Marrakech_Food_Lovers/add_category.php" class="btn-add">➕ Ajouter une catégorie</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') : ?>
        <div class="alert-success">✅ Catégorie supprimée avec succès.</div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'is_linked') : ?>
        <div class="alert-error">⚠️ Impossible de supprimer : cette catégorie contient des recettes.</div>
    <?php endif; ?>

    <div class="table-card">
        <?php if (count($categories) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><strong><?= htmlspecialchars($category['name']) ?></strong></td>
                    <td>
                        <a href="/Marrakech_Food_Lovers/edit_category.php?id=<?= $category['id'] ?>"
                           class="btn-edit">✏️ Modifier</a>

                        <a href="/Marrakech_Food_Lovers/delete_category.php?id=<?= $category['id'] ?>"
                           onclick="return confirm('Supprimer cette catégorie ?')"
                           class="btn-delete">🗑️ Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
            <div class="empty-state">Aucune catégorie trouvée. Commencez par en créer une !</div>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>