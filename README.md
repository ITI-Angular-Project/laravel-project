# Hireon – Job Listing Management Platform

Hireon is a Laravel 12 + Tailwind + Vite application that connects candidates, employers, and admins through a role-aware job marketplace. Public visitors can explore curated jobs, candidates can apply with guided profile completion, and employers/admins run analytics-rich dashboards to manage postings, applicants, companies, and notifications.

## Project Links
- Agile board (Jira): https://ahmedalla56756.atlassian.net/jira/software/projects/HIR/boards/100
- Database ERD: https://dbdiagram.io/d/Job-Listing-Management-66785b045a764b3c7231a5a0
- Live demo: _to be added soon_

## Tech Stack
- PHP 8.2, Laravel 12, Laravel Breeze auth scaffolding
- MySQL (default), SQLite support for local prototyping
- Queue + notification channels backed by the database driver
- Tailwind CSS 3, Alpine.js stores (dark mode, UI state), Vite 7
- PHPUnit / Pest for automated tests, Laravel Pint for linting

## Feature Highlights
- **Marketing site**: Hero slider, featured/latest jobs, category stats, and company/candidate metrics powered by `HomeController`.
- **Job marketplace**: Advanced filtering (category, keyword, location, work type, salary buckets, date posted) with job detail pages that track authenticated candidate views.
- **Candidate applications**: Guided profile completion (phone, resume upload), duplicate application prevention, and seamless submission.
- **Employer/Admin dashboard**: Role-scoped analytics, CRUD flows for jobs/companies, applicant pipelines, job approval/rejection, and toast-driven feedback.
- **Notifications**: Queued mail + database notifications for employers (job approvals) and candidates (application decisions), plus in-app notification center with mark-as-read endpoints.
- **Contact & theme**: SMTP-backed contact form and Alpine-powered dark/light theme toggle stored per user.

## Project Structure
```text
project-root/
├── app/
│   ├── Http/Controllers       # Public, dashboard, auth, notification, contact flows
│   ├── Http/Middleware        # RoleMiddleware + auth gates
│   ├── Models                 # Job, Company, Application, JobView, etc.
│   ├── Notifications          # Queue-aware notification classes
│   ├── Policies               # JobPolicy rules for employers/demo accounts
│   └── Providers              # AppServiceProvider registering gates + view composers
├── config/                    # queue.php defaults to the database driver
├── database/
│   ├── factories/             # Rich model factories for seeding
│   ├── migrations/            # Jobs, apps, comments, queue tables, etc.
│   └── seeders/               # DatabaseSeeder creates full demo data
├── public/                    # Entry point + built assets
├── resources/
│   ├── css/                   # Tailwind + animation utilities
│   ├── js/                    # Alpine store & bootstrap.js
│   └── views/                 # Layouts, components, dashboard & landing pages
├── routes/                    # web.php + auth.php (Breeze)
├── storage/                   # Public disk for resumes/logos (symlinked)
├── tests/                     # Feature + unit tests (Pest/PHPUnit)
├── composer.json              # PHP deps + helper Composer scripts
└── package.json               # Vite/Tailwind/Alpine configuration
```

## Getting Started

### 1. Prerequisites
- PHP 8.2+, Composer 2.6+
- Node 18+/20+ with npm
- MySQL 8 (or MariaDB/SQLite for local dev)
- Optional Redis; queues default to MySQL tables
- Mail credentials for SMTP notifications

### 2. Installation
1. Clone the repository and `cd` into it.
2. Copy env file: `cp .env.example .env`.
3. Install backend deps: `composer install`.
4. Install frontend tooling: `npm install`.
5. Generate the key: `php artisan key:generate`.
6. Update `.env` with database, queue, cache/session, and mail credentials. Set `QUEUE_CONNECTION=database` (default) and, if needed, `DB_QUEUE_CONNECTION=mysql`.
7. Link storage for public assets: `php artisan storage:link`.
8. Run migrations + seeders:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
   For a clean slate use `php artisan migrate:fresh --seed`.

### 3. Running the App
- Serve API + frontend separately:
  ```bash
  php artisan serve
  npm run dev
  ```
- Or use the Composer helper that also spawns the queue worker:
  ```bash
  composer run dev
  ```

### 4. Background Jobs & Notifications
Notifications implement `ShouldQueue`, so keep a worker online:
```bash
php artisan queue:work database --queue=default --tries=3 --timeout=90
```
For local debugging you can run `php artisan queue:listen --tries=1`.

### 5. Assets
- Dev build: `npm run dev`
- Production build: `npm run build`
- Preview production bundle locally: `npm run preview`

### 6. Seeded Accounts & Demo Data
`database/seeders/DatabaseSeeder.php` provisions hundreds of users/jobs plus a verified admin you can use right away:

| Role  | Email                       | Password  |
|-------|-----------------------------|-----------|
| Admin | ahmed.alla56756@gmail.com   | password  |

Factories also generate companies, technologies, comments, saved jobs, applications, and job views so every dashboard widget has meaningful analytics immediately.

### 7. Testing & QA
- Run backend tests: `php artisan test` (or `composer test`)
- Static analysis / formatting: `./vendor/bin/pint`
- Add UI/feature tests as you extend flows (Pest scaffolding included).

### 8. Deployment Checklist
- Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` to your domain.
- Cache config/routes: `php artisan config:cache && php artisan route:cache`.
- Build assets: `npm run build` (commit or deploy artifact).
- Run migrations with `php artisan migrate --force`.
- Start queue workers under Supervisor/systemd using `php artisan queue:work database --queue=default --tries=3 --timeout=90`.
- Schedule tasks if needed via `php artisan schedule:work` or a cron entry.
- Ensure `php artisan storage:link` ran on the server and `public/` is the web root.
- Update the README “Live demo” link once the production URL is ready.

---

Need help extending the platform (e.g., multi-tenant companies, interview pipeline, analytics exports)? Open an issue or reach out via the Agile board link above.
