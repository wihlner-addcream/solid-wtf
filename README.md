# Calendar App

This repository contains a simple Laravel + Vue application for creating events and tracking RSVPs.

## Setup

```bash
# Install PHP dependencies
composer install

# Install node dependencies
npm install

# Build frontend assets
npm run build

# Run database migrations
php artisan migrate

# Start the local server
php artisan serve
```

The application uses SQLite by default and stores the database at `database/database.sqlite`.
