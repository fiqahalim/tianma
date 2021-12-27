<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## System Requirements
- PHP version ^7.3 | >= 8.0

## Installation Instrustion
### Deployment
1. Clone this project to your folder you want

2. Run `cp .env.example .env` file to copy example file to `.env`

     Then edit your .env file with DB credentials and other settings.
     
3. Run `composer install` command, after that run `npm install` and `npm run dev`.

4. Run `php artisan migrate --seed` command.

    Notice: seed is important, because it will create the first admin user for you.
    
5. Run `php artisan key:generate` command.

6. If you have file/photo fields, run `php artisan storage:link` command.

And that's it, go to your domain and login:

### Default credentials
Username: `admin@admin.com`

Password: `password`
