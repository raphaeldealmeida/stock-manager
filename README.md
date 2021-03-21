# Stock Manager System
A simple system built with Laravel + Vue.JS

##Install
The project is split in backend and frontend

###Install backend
The backend is a laravel API without HTML return.
Start on backend folder.
Copy `.env.example` to `.env`,  fill database credentials and create it

`composer install`

`php artisan key:generate`

`php artisan migrate --seed`

`php artisan serve`

Whether this works, http://localhost:8000 will say hello

###Install frontend
Start on frontend folder

`npm install`

`npm run serve`

For run the tests e2e you need `php artisan serve` before. Each execution the database will be refreshed

`cypress:chrome`

Whether this works, http://localhost:8080 will show up.