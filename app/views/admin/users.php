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

/* User name with avatar */
.user-name {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
}

.user-avatar {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 14px;
    flex-shrink: 0;
}

/* Role badges */
.role-badge {
    display: inline-block;
    padding: 5px 13px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.role-badge.admin {
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    color: white;
}

.role-badge.cuisinier {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

/* Buttons */
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

.badge-me {
    display: inline-block;
    padding: 6px 14px;
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    border-radius: 20px;
    font-weight: 600;
    font-size: 12px;
    border: 1px solid rgba(102, 126, 234, 0.3);
}

@media (max-width: 768px) {
    .page-header h1 { font-size: 26px; }
    .table-card th, .table-card td { padding: 12px 10px; font-size: 13px; }
    .user-avatar { width: 30px; height: 30px; font-size: 12px; }
}
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <h1>👥 Gestion des utilisateurs</h1>
        <span class="page-count"><?= count($users) ?> utilisateur<?= count($users) > 1 ? 's' : '' ?></span>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Inscrit le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <div class="user-name">
                            <div class="user-avatar"><?= strtoupper(substr($user['username'], 0, 1)) ?></div>
                            <?= htmlspecialchars($user['username']) ?>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <span class="role-badge <?= $user['role'] ?>">
                            <?= strtoupper($user['role']) ?>
                        </span>
                    </td>
                    <td><?= $user['created_at'] ?></td>
                    <td>
                        <?php if ($user['role'] !== 'admin') : ?>
                            <a href="/Marrakech_Food_Lovers/index.php?action=delete_user&id=<?= $user['id'] ?>"
                               onclick="return confirm('Supprimer cet utilisateur ?')"
                               class="btn-delete">🗑️ Supprimer</a>
                        <?php else : ?>
                            <span class="badge-me">👑 Admin</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>