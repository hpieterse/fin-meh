# Fin Meh
Fin Meh is a personal budgeting and spend tracking application. Load and categorise your spending and see a summary budget.

## Getting Started

The project is build using [Laravel](https://laravel.com/). The project i configured to run using [Laravel Sail](https://laravel.com/docs/8.x/sail).

### Install dependencies and build
Install composer dependencies
```bash
composer install
```
Install npm dependencies
```bash
npm install
```
Build the web resources
```bash
npm run dev
```

### Setup the env fil
Copy `.env.example` and rename it to `.env`
```bash
cp .env.example .env
```
Generate a new app key
```bash
artisan key:generate
```

### Run the project
Rnu the project using Laravel Sail
```
./vendor/bin/sail up
```

## Road Map

The technical debt has to be paid
1. Add unit and functional testing
2. Add release automation
3. Refactor UI to be more DRY

The the following feature will be added
1. Adding ability to set budget for a category
2. Importing spend items with a CSV import
3. Changing category ordering
