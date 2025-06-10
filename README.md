# Calendar App

This repository contains a simple Laravel + Vue application for creating events and tracking RSVPs.

## Requirements

- PHP **8.2** or newer
- Node.js **18+** (see `.nvmrc` for the exact version)

## Setup

```bash
# Enter the Laravel application directory
cd calendar-app

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

All Laravel commands should be executed from inside the `calendar-app` directory.

The application uses SQLite by default and stores the database at `calendar-app/database/database.sqlite`.
