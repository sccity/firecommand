# SantaClaraHub

A Laravel-based web application for Santa Clara City employees, providing centralized access to various department tools and features.

## Features

- User Authentication with Laravel Breeze
- Role-based Access Control using Spatie Permissions
- Fire Department Command Center
  - Real-time Active Fire Incidents
  - Unit Status Tracking
  - Unit Location Updates
- Administrative Tools
  - Finance Management
  - User Management

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- SQLite or MySQL

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/SantaClaraHub.git
cd SantaClaraHub
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install and compile frontend dependencies:
```bash
npm install
npm run dev
```

4. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env`:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

6. Run migrations:
```bash
php artisan migrate
```

7. Seed the database (optional):
```bash
php artisan db:seed
```

## API Configuration

The application uses the Spillman API for fire incident data. Configure your API token in `.env`:

```
SPILLMAN_API_TOKEN=your_token_here
```

## Development

To start the development server:

```bash
php artisan serve
```

For hot-reloading of assets:

```bash
npm run dev
```

## Testing

Run the test suite:

```bash
php artisan test
```

## License

This project is proprietary software for Santa Clara City.

## Security

If you discover any security-related issues, please email security@santaclarautah.gov instead of using the issue tracker.
