# 🎫 Support Ticket Management System

A robust, modern support ticket management system built with **Laravel 13** and **FilamentPHP v3**. The application features dynamic user role management, custom admin/client panel resources, and automated event triggers via **n8n webhooks**.

---

## 🚀 Key Features

* **FilamentPHP Admin Panel:** Sleek, responsive admin interface for managing tickets, users, and ticket statuses.
* **Role & Permission Management:** Custom role-based access control leveraging PHP Enums (`UserRole Enum`) and custom castings.
* **n8n Webhook Integration:** Automated workflows triggering real-time notifications and ticket status updates.
* **Optimized Performance:** Efficient data fetching using Eloquent Eager Loading to minimize database queries ($N+1$ optimization).
* **Ticket Tracking & Statuses:** Filterable data tables, custom action modals, and user activity timelines.

---

## 🛠️ Tech Stack

* **Backend:** PHP 8.x, Laravel 13.x
* **Admin Panel:** FilamentPHP v3
* **Automation:** n8n (Webhooks)
* **Database:** MySQL
* **Frontend:** Tailwind CSS, Livewire, Alpine.js (via Filament ecosystem)

---

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/Ahmadluay/laravel-support-ticket-system.git](https://github.com/Ahmadluay/laravel-support-ticket-system.git)
   cd laravel-support-ticket-system



1- ***Install dependencies:***
```Bash
composer install
npm install && npm run build
```

2- ***Environment setup:***
```Bash
cp .env.example .env
php artisan key:generate
```

3- ***Run migrations:***
```Bash
php artisan migrate
```

4- ***Create Filament Admin User:***
```Bash
php artisan make:filament-user
```

5- ***Serve the application:***
```Bash
php artisan serve
```

