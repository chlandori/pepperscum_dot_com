# Pepperscum.com 🎸🕹️

A retro‑inspired band archive and CI/CD playground.  
This project blends modular PHP MVC design with MariaDB, GitHub Actions, and playful retro features like guestbooks and hit counters.

## ⚙️ Setup for Developers

### 1. Prerequisites
- PHP 8.2+
- Composer
- MariaDB 12.1 (installed via MSI for service + root password)
- Git

### 2. Clone & Install
```bash
git clone https://github.com/yourusername/pepperscum_dot_com.git
cd pepperscum.com
composer install
```

### 3. Environment Variables

Copy .env.example -> .env and set your local credentials

Env
DB_HOST=localhost  
DB_USER=pepperscum  
DB_PASS=yourpassword  
DB_NAME=pepperscum_dev  

### 4. Database Setup

``` bash
php scripts/migrate.php
```

This creates:

* guestbook (id, name, message, created_at)
* hit_counter (id, page, hits, last_hit)

### 5. Local Development

Start MariaDB service:

``` powershell
net start MariaDB
```

Run PHP's built-in server:

``` powershell
php -S localhost:8000 -t pepperscum.com
```

Visit: [http://localhost:8000](http://localhost:8000)

# 🚀 CI/CD Workflow
GitHub Actions (ci.yml) spins up MariaDB in a container and runs migrations/tests:
- Services: MariaDB 12.1 container
- Secrets: DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_ROOT_PASSWORD
- Steps:
- Checkout code
- Set up PHP
- Wait for MariaDB health check
- Run scripts/migrate.php
- Run PHPUnit tests

# 🕹️ Retro Features
- Guestbook: Leave messages like it’s 1999.
- Hit Counter: Track page visits with old‑school flair.
- ASCII Branding: Sprinkle nostalgia across views and dashboards.

# 🔒 Security & Onboarding
- Never commit .env — use .env.example for templates.
- Use GitHub Secrets for CI/CD credentials.
- Standardized onboarding: clone → composer install → copy .env.example → run migrations.

# 📜 License
MIT — remix, extend, and enjoy.

---

