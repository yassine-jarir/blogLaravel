# Blog Laravel  

Un blog développé avec Laravel permettant la gestion des utilisateurs, catégories et articles, avec authentification et AJAX.  

## 🚀 Fonctionnalités  
- CRUD des articles 📝  
- Gestion des utilisateurs et catégories 👥  
- Authentification avec Laravel Breeze 🔐  
- Changement du statut d’un article via AJAX ⚡  
- Intégration de Bootstrap via NPM 🎨  
- Autorisation via Middleware 🛡️  

## 🛠️ Technologies  
- Laravel 10+  
- MySQL / SQLite  
- Bootstrap (via NPM)  
- AJAX (Fetch API / jQuery)  
- Laravel Breeze  
- JIRA (Planification)  
- UML (Modélisation)  

## 📌 Installation  
```bash
git clone https://github.com/ton-repo/blog-laravel.git  
cd blog-laravel  
composer install  
cp .env.example .env  
php artisan key:generate  
php artisan migrate --seed  
npm install && npm run dev  
php artisan serve  
