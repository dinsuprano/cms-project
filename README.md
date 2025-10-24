# Jobes (Laravel)

Jobes is a modern job listing platform built with Laravel 12, featuring a comprehensive set of tools for job seekers and employers.

## Features

-   Complete Job Listing Management (Create, Read, Update, Delete)
-   User Authentication & Role-Based Authorization
-   Custom Profile with Avatar Uploads
-   Reusable Blade Components
-   Vite Build Tool & TailwindCSS v4 Integration
-   Save Jobs with Bookmarking System
-   Job Applications with Resume Upload
-   Personalized User Dashboard
-   Interactive UI with Alpine.js
-   Pre-configured Database Seeders
-   Advanced Job Search Functionality
-   Interactive Maps powered by Mapbox
-   Email Notifications via Mailtrap
-   Paginated Job Listings
-   Two user (Job Seeker and Employee)

## Usage

#### Install composer dependencies

```
composer install
```

#### Install NPM dependencies and build assets

```
npm install
npm run build
```

#### Add .env Variables

Rename the `.env.example` file to `.env` and add your database values. Change driver and port as needed.

```
DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Add your mabox API key:

```
MAPBOX_API_KEY=
```

#### Run Migrations

```
php artisan migrate
```

#### Seed Database (Optional)

You can seed the database with users, jobs and bookmarks

```
php artisan db:seed
```

You will have a test user available with the following credentials:

-   Email: test@test.com
-   Password: 12345678

#### Run Server

If you are using artisan to serve, run the following:

```
composer run dev
```

Open http://localhost:8000

## License

Jobes has an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).