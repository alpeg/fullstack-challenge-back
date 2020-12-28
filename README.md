

## Full Stack Challenge

This is a back-end part of a fake "Pizza Delivery" application meant to be used for demonstration purposes only.

It is written in laravel with eloquent ORM.

## Features

menu | currency switch | delivery cost | login | registration | order history for logged in users (with pagination) | server-side and client-side form validation

## Installation

This is a laravel project. Please do not attempt to install npm dependencies.

1. Generate a key (and `.env`) with `php artisan key:generate`
2. Configure mysql via `.env` and also check that `APP_URL` is correct and `APP_ENV` and `APP_DEBUG` are set to intended values.
3. Run migrations with `php artisan migrate`
4. Add some mock data by running `php artisan db:seed --class=PizzaProductSeeder` and 
   `php artisan db:seed --class=OrderSeeder`
5. Link  a storage directory with `php artisan storage:link`, otherwise pictures won't be accessible.

# Front-End installation

This is a tricky part.

Ideally this should be done with web server configuration, but this SPA would be using same-origin authentication (recommended by laravel) so it will need additional steps to set up.

1. Obtain a pre-built version of front-end or build it yourself with yarn.
2. Copy `index.html` file to `resources\views\spa.blade.php` and everything else into `public\` directory
3. Everything should work now.



### Cache commands

To clear all caches, run:

```
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan cache:clear
php artisan optimize:clear
```

To warm up caches run:

```
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

This is handy when moving application between computers/servers.




