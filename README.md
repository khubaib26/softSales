
## How to run the code
- git clone https://github.com/khubaib26/vv-bark.git
- cd vv-bark
- cp .env.example `.env`
- open .env and update DB_DATABASE (database details)
- run : `composer install`
- run : `php artisan key:generate`
- run : `php artisan migrate:fresh --seed`
- run : `php artisan serve`

- Best of luck 


## Credentials
- #### Admin
- email: admin@admin.com
- password : password
- #### Writer
- email: writer@writer.com
- password: password