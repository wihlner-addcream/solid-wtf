# Calendar App

This repository contains a simple Laravel + Vue application for creating events and tracking RSVPs.

## Cloning the repository

Before running any Git commands, clone the project and ensure the remote is set. This avoids errors such as `fatal: not a git repository`.

```bash
# Clone from GitHub
git clone https://github.com/<your-username>/solid-wtf.git
cd solid-wtf

# If the remote is missing, add it
git remote add origin https://github.com/<your-username>/solid-wtf.git

# Pull the latest changes
git pull origin main
```

## Requirements

 - PHP **8.2** or newer
 - [Composer](https://getcomposer.org/)
 - Node.js **18+** (see `.nvmrc` for the exact version)
 - npm

## Setup

```bash
# Enter the Laravel application directory
cd calendar-app

# Copy the example environment file and generate an application key
cp .env.example .env
php artisan key:generate

# Install PHP dependencies
composer install

# Install node dependencies
npm install

# Build frontend assets (or use "npm run dev" for development)
npm run build

# Run database migrations
php artisan migrate

# Start the local server
php artisan serve
```

To run the test suite:

```bash
php artisan test
```

All Laravel commands should be executed from inside the `calendar-app` directory.

The application uses SQLite by default and stores the database at `calendar-app/database/database.sqlite`, which will be created automatically during setup.
