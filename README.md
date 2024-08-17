<p align="center"><a href="https://lumagraph.ie" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/8/84/Light_bulb_icon_red.svg" width="400" alt="Lumagraph Logo placeholder"></a></p>


## About Lumagraph

Laravel is a tech consultancy company based in Dublin, Ireland. This repo describes the web app for the company 

### 1. Prerequisites

Ensure you have the following installed on your machine:

- **PHP 8.0 or higher**
- **Composer** (Dependency Manager for PHP)
- **Git** (Version Control)
- **Node.js & NPM** (Optional: for managing frontend assets if applicable)
- **Database Server** (e.g., MySQL, PostgreSQL, SQLite)
Laravel is accessible, powerful, and provides tools required for large, robust applications.

### 2. Install Dependencies

- Clone the repo and navigate to the directory.
- Run "composer install" in terminal
- Duplicate the .env.example file and rename the copy to .env. This will have to be edited with relevant local machine details
- Generate Application Key using "php artisan key:generate" in terminal
- "php artisan migrate" in terminal
- Install Node Dependencies "npm install" and Compile Assets "npm run dev"

### 3. Run Application

- "php artisan serve" in terminal
- navigate to http://localhost:8000 in browser


## Contributing

Thank you for considering contributing to the Laravel framework!


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Duncan Wallace via [duncan@lumagraph.ie](mailto:duncan@lumagraph.ie). All security vulnerabilities will be promptly addressed.

