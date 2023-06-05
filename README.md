## Getting Started

1. Clone this repository
2. Install dependencies using `composer install`
3. Run the app
4. Enjoy!

## Some Stuff in this App

1. Migration

-   Create migration: `php artisan make:migration create_users_table`
-   Run migration: `php artisan migrate`
-   Rollback migration: `php artisan migrate:rollback`
-   Refresh migration: `php artisan migrate:refresh`
-   Reset migration: `php artisan migrate:reset`
-   Rollback all migration: `php artisan migrate:reset`

2. Seeder

-   Create seeder: `php artisan make:seeder UsersTableSeeder`
-   Run seeder: `php artisan db:seed`
-   Refresh seeder: `php artisan migrate:refresh --seed`
-   Run specific seeder: `php artisan db:seed --class=UsersTableSeeder`

3. Model

-   Create model: `php artisan make:model User`

4. Controller

-   Create controller: `php artisan make:controller UserController`
-   Create controller with resource: `php artisan make:controller UserController --resource`
-   Create controller with model: `php artisan make:controller UserController --model=User`
-   Create controller with model and resource: `php artisan make:controller UserController --model=User --resource`
-   Create controller with model and resource and api: `php artisan make:controller UserController --model=User --resource --api`

5. Storage

-   Link storage: `php artisan storage:link`

6. Middleware

-   Create middleware: `php artisan make:middleware nameMiddleware`
-   Create middleware with model: `php artisan make:middleware nameMiddleware --model=User`
-   Create middleware with model and resource: `php artisan make:middleware nameMiddleware --model=User --resource`
-   Create middleware with model and resource and api: `php artisan make:middleware nameMiddleware --model=User --resource --api`
