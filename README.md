# ShopAdminBot (Laravel 12)

Мини-панель администратора для управления пользователями.  
Проект выполнен на **Laravel 12** с использованием **Breeze** и **TailwindCSS**.

---

## Стек технологий

- Laravel 12 (PHP 8+)
- Laravel Breeze (Blade)
- TailwindCSS
- MySQL
- Vite
- Node.js / npm

---

## Возможности (в разработке)

- Регистрация и авторизация пользователей
- Разделение на админов и обычных пользователей
- Защищённые маршруты `/admin`
- Подключение к базе данных через `.env`

---

## Установка

```bash
git clone https://github.com/your-username/shopadminbot.git
cd shopadminbot

composer install
cp .env.example .env
php artisan key:generate

# Настрой .env (DB и т.д.)

npm install
npm run dev

php artisan migrate
