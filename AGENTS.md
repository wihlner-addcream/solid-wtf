# AGENTS

This repository contains a Laravel + Vue calendar application.

## Setup

Run `./setup.sh` from the repository root to install Composer and npm
packages, generate the `.env` file and run migrations. All development
commands (`composer`, `php artisan`, `npm`) must be executed inside the
`calendar-app` directory.

## Testing

Run `composer test` in `calendar-app/` after making changes. The command
runs the Laravel test suite. If tests fail due to missing dependencies,
execute the setup script first.

## Coding Style

- Follow PSR-12 for PHP.
- Indent with 4 spaces and use LF line endings.
- Ensure files end with a newline.
- Keep lines under 100 characters when possible.

## Commit Messages

- Use short imperative summaries under 72 characters
  (e.g., "Add ICS download route").
- Body text is optional and should wrap at 72 characters.

## PR Messages

PRs should include a **Summary** of the changes and a **Testing** section
noting the results of `composer test`.
