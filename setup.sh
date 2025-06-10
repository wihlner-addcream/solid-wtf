#!/bin/bash
set -e

# Change to the Laravel application directory
cd "$(dirname "$0")/calendar-app"

# Copy environment file if it doesn't exist
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Ensure SQLite database file exists
if [ ! -f database/database.sqlite ]; then
  mkdir -p database
  touch database/database.sqlite
fi

# Install PHP dependencies
composer install

# Install node dependencies
npm install

# Build frontend assets
npm run build

# Generate application key
php artisan key:generate --ansi

# Run database migrations
php artisan migrate --force --ansi

echo "Setup complete. You can now run 'php artisan serve' inside calendar-app.'"
