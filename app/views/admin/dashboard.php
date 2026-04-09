<?php require_once __DIR__ . '/../includes/auth.php'; ?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<style>
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

.dashboard-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 30px;
}

.dashboard-header {
    animation: slideInUp 0.6s ease-out;
}

.dashboard-header h1 {
    font-size: 42px;
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
    letter-spacing: -1px;
    margin: 0 0 6px;
}

.dashboard-header p {
    font-size: 16px;
    color: #888;
    font-weight: 500;
    margin: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    animation: slideInUp 0.7s ease-out 0.1s backwards;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 28px 24px;
    box-shadow: 0 8px 32px rgba(224, 123, 57, 0.15);
    border: 1px solid rgba(224, 123, 57, 0.12);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(224, 123, 57, 0.25);
}

.stat-card .stat-title {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #999;
    font-weight: 700;
    margin-bottom: 10px;
}

.stat-card .stat-value {
    font-size: 40px;
    font-weight: 800;
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 6px;
}

.stat-card small {
    font-size: 13px;
    color: #aaa;
    display: block;
}

.stat-card .progress-bar {
    margin-top: 14px;
    height: 4px;
    background: rgba(224, 123, 57, 0.15);
    border-radius: 99px;
    overflow: hidden;
}

.stat-card .progress-fill {
    height: 100%;
    width: 65%;
    background: linear-gradient(90deg, #e07b39, #c0501a);
    border-radius: 99px;
}

.admin-section {
    background: white;
    border-radius: 15px;
    padding: 28px;
    box-shadow: 0 8px 32px rgba(224, 123, 57, 0.12);
    border: 1px solid rgba(224, 123, 57, 0.1);
    animation: slideInUp 0.7s ease-out 0.2s backwards;
}

.admin-section h3 {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin: 0 0 18px;
}

.admin-links {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-users {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.25);
}

.btn-users:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.35);
}

.btn-category {
    background: linear-gradient(135deg, #e07b39 0%, #c0501a 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(224, 123, 57, 0.25);
}

.btn-category:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(224, 123, 57, 0.35);
}

.btn-recipes {
    background: linear-gradient(135deg, #43b89c 0%, #2d8a72 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(67, 184, 156, 0.25);
}

.btn-recipes:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(67, 184, 156, 0.35);
}

@media (max-width: 768px) {
    .dashboard-header h1 { font-size: 30px; }
    .stat-card .stat-value { font-size: 30px; }
}
</style>

<div class="dashboard-container">

    <div class="dashboard-header">
        <h1>📊 Tableau de Bord Admin</h1>
        <p>Bonjour, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> 👑</p>
    </div>

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-title">Cuisiniers</div>
            <div class="stat-value"><?= $totalUsers -1 ?></div>
            <small>utilisateurs inscrits</small>
            <div class="progress-bar"><div class="progress-fill"></div></div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Recettes</div>
            <div class="stat-value"><?= $totalRecipes ?></div>
            <small>recettes publiées</small>
            <div class="progress-bar"><div class="progress-fill"></div></div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Catégories</div>
            <div class="stat-value"><?= $totalCategories  ?></div>
            <small>thématiques actives</small>
            <div class="progress-bar"><div class="progress-fill"></div></div>
        </div>

    </div>

    <div class="admin-section">
        <h3>🛠️ Gestion</h3>
        <div class="admin-links">
            <a href="/Marrakech_Food_Lovers/index.php?action=users"      class="btn btn-users">👥 Utilisateurs</a>
            <a href="/Marrakech_Food_Lovers/admin_recipes.php"    class="btn btn-recipes">🍽️ Recettes</a>
            <a href="/Marrakech_Food_Lovers/index.php?action=categories" class="btn btn-category">🗂️ Catégories</a>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>