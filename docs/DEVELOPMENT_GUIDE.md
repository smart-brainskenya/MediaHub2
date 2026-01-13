# Smart Brains Media Hub: Development Guide

This document provides a technical overview and practical instructions for developing on the Smart Brains Media Hub platform.

---

## 1. Project Overview

The Smart Brains Media Hub is a public, zero-data-compatible media platform designed to allow students to safely access images and videos for coding projects. It replaces external sources like YouTube and Google Images in environments with restricted internet access. The platform prioritizes offline reliability and pedagogical continuity by hosting all media internally and providing familiar embedding workflows.

**Key Constraints:**
- Laravel monolith architecture.
- Blade templates for rendering.
- Alpine.js for frontend interactivity.
- Tailwind CSS for styling.
- Native HTML `<video>` and `<img>` elements.
- `<iframe>` embeds only for internal embed pages.
- Media served only from Smart Brains domains.
- No React or SPA frameworks.
- No external content embeds.
- No student uploads or authentication.

The authoritative source for all project specifications is `ai-spec/00_CANONICAL_OVERVIEW.md`.

---

## 2. System Requirements

Ensure your local development environment meets the following prerequisites:

-   **PHP:** ^8.2
-   **Composer:** ^2.5
-   **Node.js:** ^16.0 (with npm or yarn)
-   **Database:** SQLite (default for local development, pre-configured)
-   **Web Server:** PHP's built-in server (`php artisan serve`) or Nginx/Apache.

---

## 3. Local Setup Instructions

Follow these steps to set up the project on your local machine:

1.  **Clone the repository:**
    ```bash
    git clone [your-repository-url]
    cd MediaHub
    ```
2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```
3.  **Install Node dependencies & build assets:**
    ```bash
    npm install
    npm run dev
    ```
4.  **Copy environment file:**
    ```bash
    cp .env.example .env
    ```
5.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```
6.  **Set Admin Password:**
    Edit your `.env` file and set the `ADMIN_PASSWORD` variable. This is crucial for creating the default admin account.
    ```dotenv
    ADMIN_PASSWORD=your-secure-password # Choose a strong password
    ```
7.  **Run migrations and seed the database:**
    This will set up your database schema and create the default admin account.
    ```bash
    php artisan migrate --seed
    ```
8.  **Create Storage Symlink:**
    Ensure the public storage link is created to serve media assets.
    ```bash
    php artisan storage:link
    ```
9.  **Start the development server:**
    ```bash
    php artisan serve
    ```
    The application will typically be accessible at `http://127.0.0.1:8000`.

---

## 4. How to Run Migrations & Seeders

-   **Run all pending migrations:**
    ```bash
    php artisan migrate
    ```
-   **Rollback the last migration:**
    ```bash
    php artisan migrate:rollback
    ```
-   **Refresh database (drop all tables, re-run migrations, and re-seed):**
    ```bash
    php artisan migrate:fresh --seed
    ```
    **Note:** This command will delete all data in your database.
-   **Run specific seeders:**
    ```bash
    php artisan db:seed --class=AdminUserSeeder
    ```
-   **Run all seeders (implicitly calls `DatabaseSeeder` which calls `AdminUserSeeder`):**
    ```bash
    php artisan db:seed
    ```

---

## 5. How to Run Tests

The project uses Pest for testing.

-   **Run all tests:**
    ```bash
    php artisan test
    ```
-   **Run tests from a specific file:**
    ```bash
    php artisan test tests/Feature/Feature/ApplicationAccessTest.php
    ```
-   **Run tests for a specific group (if defined):**
    ```bash
    php artisan test --group=authentication
    ```

---

## 6. How to Debug Common Issues

-   **`APP_KEY` not set:** If you see an encryption error, run `php artisan key:generate`.
-   **Frontend assets not loading:** Ensure you've run `npm install` and `npm run dev`. If issues persist, try `npm run build`.
-   **Database errors (e.g., table not found):** Run `php artisan migrate`. If you've modified migrations, you might need `php artisan migrate:fresh --seed` (caution: this clears data).
-   **Admin login issues:** Verify `ADMIN_PASSWORD` is set in `.env` and you've run `php artisan migrate --seed`.
    -   **Default Admin Email:** `graphics@smartbrainskenya.com`
    -   **Default Admin Password:** The value you set for `ADMIN_PASSWORD` in your `.env` file.
-   **Media files not found (404 errors for images/videos):** Ensure `php artisan storage:link` has been run.

---

## 7. How Embed Pages Work (Brief)

For videos, the system generates an `<iframe>` embed code. This iframe's `src` attribute points to an internal application route (`/embed/video/{id}`). This route renders a minimalist Blade view (`videos/embed.blade.php`) that contains only a native HTML `<video>` player, loading the actual video file from internal storage. This approach mimics YouTube embeds without relying on external services, ensuring zero-data compatibility and preserving the student's familiar mental model.

---

## 8. How Admin Access Works (Brief)

Admin access is restricted to authenticated users. All administrative routes (e.g., `/admin/dashboard`, `/admin/videos`, `/admin/images`, `/admin/import`) are protected by Laravel's `auth` middleware. Users attempting to access these routes without being logged in will be redirected to the login page. Admin accounts are provisioned via database seeding, with credentials (especially the password) sourced from environment variables to prevent hard-coding. This ensures a clear separation between public and administrative functionalities.
