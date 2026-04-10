Voici **un seul fichier README.md complet**, propre et prêt à copier-coller dans ton projet 👇

---

````markdown
# 🍽️ Marrakech Food Lovers

## 📌 Description

**Marrakech Food Lovers** est une application web développée en **PHP / MySQL** basée sur une architecture **MVC**.

Elle permet aux utilisateurs de partager et gérer des recettes marocaines organisées par catégories, avec un système d’authentification sécurisé et gestion des rôles :

* 👨‍🍳 **Cuisinier** : peut créer, modifier et supprimer ses propres recettes
* 👑 **Admin** : peut gérer les utilisateurs, les catégories et toutes les recettes

---

## 🎯 Objectifs

* Gérer des recettes de manière structurée  
* Implémenter une authentification sécurisée  
* Séparer les rôles (admin / cuisinier)  
* Appliquer une architecture MVC claire  

---

## 🔐 Comptes de test

```plaintext
Admin :
Email : admin@foodlovers.com
Mot de passe : admin123

Cuisinier :
Email : fatima@foodlovers.com
Mot de passe : admin123

Cuisinier :
Email : youssef@foodlovers.com
Mot de passe : admin123
````

⚠️ **Important** : changer les mots de passe après connexion.

---

## 🔁 Fonctionnement global

1. Accès à l’application (`index.php`)
2. Redirection vers splash → login
3. Authentification via `AuthController`
4. Création de session
5. Redirection selon le rôle :

   * Admin → dashboard admin
   * Cuisinier → dashboard cuisinier
6. Actions CRUD
7. Déconnexion

---

## 🧠 Architecture du projet

```
/marrakech-food-lovers
│
├── /app
│   ├── /models
│   │   ├── Database.php
│   │   ├── User.php
│   │   ├── Recipe.php
│   │   └── Category.php
│   │
│   ├── /controllers
│   │   ├── AuthController.php
│   │   ├── RecipeController.php
│   │   ├── CategoryController.php
│   │   └── UserController.php
│   │
│   └── /views
│       ├── /includes
│       │   ├── header.php
│       │   ├── footer.php
│       │   └── auth.php
│       │
│       ├── /auth
│       │   ├── login.php
│       │   ├── register.php
│       │   └── splash.php
│       │
│       ├── /cuisinier
│       │   ├── dashboard.php
│       │   ├── create.php
│       │   ├── edit.php
│       │   └── delete_recipe.php
│       │
│       └── /admin
│           ├── dashboard.php
│           ├── users.php
│           ├── recipes.php
│           ├── categories.php
│           ├── add_category.php
│           ├── edit_category.php
│           └── delete_category.php
│
├── /config
│   └── database.php
│
├── /public
│   └── /css
│       └── style.css
│
├── /database
│   └── food_lovers.sql
│
├── index.php
├── login.php
├── register.php
├── logout.php
├── dashboard.php
├── create_admin.php
│
├── categories.php
├── add_category.php
├── create_recipe.php
├── delete_category.php
├── delete_recipe.php
├── edit_category.php
├── edit_recipe.php
├── recipe.php
├── splash.php
├── admin_recipes.php
│
└── README.md
```

---

## 🗄️ Base de données

Le fichier `database/food_lovers.sql` contient :

* **users** → utilisateurs + rôles
* **categories** → catégories
* **recipes** → recettes

---

## ⚙️ Installation

### 1️⃣ Cloner le projet

```bash
git clone https://github.com/username/marrakech-food-lovers.git
```

---

### 2️⃣ Importer la base de données

* Ouvrir **phpMyAdmin**
* Créer une base : `marrakech_food_lovers`
* Importer :

```
database/food_lovers.sql
```

---

### 3️⃣ Configurer la connexion

📄 `config/database.php`

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'marrakech_food_lovers');
define('DB_USER', 'root');
define('DB_PASS', '');
```

---

### 4️⃣ Lancer le projet

```
http://localhost/marrakech-food-lovers/
```

---

## 🔐 Sécurité

* Sessions PHP (`$_SESSION`)
* Protection des pages (`auth.php`)
* Vérification des rôles
* Hachage des mots de passe
* Requêtes sécurisées avec PDO

---

## 🎨 Design

* Interface moderne
* Responsive
* Animations CSS
* Google Fonts (Outfit)

---

## 🚀 Améliorations possibles

* 🔔 Notifications
* 🌙 Mode sombre
* 📊 Statistiques
* ❤️ Recettes favorites
* 🔍 Recherche
* 📸 Upload d’images

---

## 👨‍💻 Auteur

Projet réalisé par **Hassan**.

---

## 🏆 Conclusion

✔️ Authentification sécurisée
✔️ Gestion des rôles
✔️ Architecture MVC
✔️ CRUD complet
✔️ Bonne organisation du code

```

---

Si tu veux, je peux maintenant :
- ajouter **badges GitHub (PHP, MySQL, MVC)**  
- ou transformer ça en **README premium pour portfolio 🔥**
```
