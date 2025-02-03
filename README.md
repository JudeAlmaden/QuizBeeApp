// Run php artisan serve to open server
php artisan serve --port=8080 

//This project was made for our annual SBAT day celebration at school St.Anne College Lucena, Made and developed by Justien Jude D. Almaden

When cloning the repository
1. Create a Database locally
2. Rename .env.example file to .env inside your project root and fill the database information. (windows won't let you do it, so you have to open your console cd your project root directory and run mv .env.example .env )
3. Open the console and cd your project root directory
4. Run composer install
5. Run php artisan key:generate
6. Run php artisan migrate
7. Run php artisan db:seed to run seeders, if any.
8. Run php artisan serve
