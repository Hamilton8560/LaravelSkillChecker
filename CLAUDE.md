# PowerfulLaravel Project

## Overview
This is a Laravel 12.15.0 project running on PHP 8.4.7 with Livewire components for training management.

## Development Commands

### Running the Application
```bash
php artisan serve
```

### Testing
```bash
php artisan test
```

### Code Quality
```bash
# Run Laravel Pint for code style fixes
./vendor/bin/pint

# Check code style without fixing
./vendor/bin/pint --test

# Run tests
php artisan test
```

## Project Structure

### Key Components
- **Training Management**: Core feature with categories, methods, and training logs
- **Livewire Components**: Used for interactive UI components
- **Database**: SQLite database at `database/database.sqlite`

### Important Paths
- Livewire components: `app/Livewire/`
- Views: `resources/views/livewire/training/`
- Models: `app/Models/`
- Migrations: `database/migrations/`

## Common Issues

### View Not Found Errors
Ensure Livewire components reference the correct view paths:
- Training views are in `resources/views/livewire/training/`
- Use `livewire.training.{view-name}` in render methods

## Dependencies
- Laravel 12.15.0
- PHP 8.4.7
- Livewire
- MaryUI
- TailwindCSS