# Calendar App

This repository contains a simple Laravel + Vue application for creating events and tracking RSVPs. Events can also be exported as standard `.ics` files for use in calendar clients.

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

## Quick Setup

Run the included `setup.sh` script from the repository root to install Composer
and NPM dependencies and prepare the application:

```bash
./setup.sh
```

After it completes you can start the server:

```bash
cd calendar-app
php artisan serve
```

### ICS Export

Events can be downloaded as `.ics` files via the API:

```bash
curl http://localhost:8000/api/events/{id}/ics -o event.ics
```

### Event Filtering

The events endpoint accepts optional query parameters to filter results:

```bash
curl "http://localhost:8000/api/events?title=Meeting&start=2024-01-01&end=2024-01-31"
```

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
