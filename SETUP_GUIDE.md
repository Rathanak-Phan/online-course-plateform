# 🎓 Online Course Platform - Laravel Setup Guide

Welcome to your new Laravel project! This guide will walk you through the essential steps to get your online course platform up and running from scratch.

---

## 🚀 Quick Start Checklist

1. [x] Laravel Installation
2. [x] Environment Configuration (`.env`)
3. [x] MySQL Database Connection
4. [x] Authentication (Laravel Breeze)
5. [x] Frontend Styling (TailwindCSS)

---

## 🛠 Step-by-Step Instructions

### 1. Project Initialization
We started by creating a fresh Laravel skeleton:
```bash
composer create-project laravel/laravel .
```

### 2. Environment Setup
Your `.env` file has been configured to connect to MySQL. 

> [!IMPORTANT]
> Ensure your MySQL server is running. If you need to update your password, look for the `DB_PASSWORD` line in your `.env` file.

**Current Database Config:**
- **Connection:** `mysql`
- **Host:** `127.0.0.1`
- **Port:** `3306`
- **Database:** `online_course_db` (Recommended)

### 3. Authentication with Laravel Breeze
We've installed **Laravel Breeze**, which provides a robust starting point for user authentication (Login, Registration, Password Reset).

**Commands run:**
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade --dark
```
*Note: We chose the **Blade** stack with **Dark Mode** support for a premium feel.*

### 4. Database Migrations
To create the necessary tables (users, password_resets, etc.), run:
```bash
php artisan migrate
```

### 5. Frontend Assets (TailwindCSS)
TailwindCSS is integrated via Vite. To compile your assets and see changes in real-time:

**Install dependencies:**
```bash
npm install
```

**Run the development server:**
```bash
npm run dev
```

---

## 🎨 Design Philosophy
For an **Online Course Platform**, we recommend:
- **Clean Typography:** Use fonts like *Inter* or *Outfit* for readability.
- **Vibrant Accents:** Use primary colors like `indigo-600` or `violet-600` for call-to-actions.
- **Card-Based Layouts:** Great for displaying course listings and modules.

---

## 📚 Useful Artisan Commands

| Command | Purpose |
| :--- | :--- |
| `php artisan serve` | Start the PHP development server |
| `php artisan make:model Course -m` | Create a Course model and migration |
| `php artisan route:list` | View all registered routes |
| `php artisan db:seed` | Populate your database with test data |

---

> [!TIP]
> **Next Steps:** Start by creating your `Course` and `Lesson` models to define the core of your platform!
