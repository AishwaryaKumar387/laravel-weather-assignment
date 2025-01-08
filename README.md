
# Weather Application: Laravel Assignment

Laravel-based application designed to fetch, store, and display temperature data for cities. It includes database management, API integration with the Open-Meteo API, scheduled tasks, and a graph-based visualization of city temperature data using Chart.js.

# Features
- ### City Model & City Seeder: 
Stores city names, states, countries, and temperature data.
- ### Temperature Fetching Command: 
Fetches temperature data for Mohali from the Open-Meteo API.
- ### Task Scheduling: 
Automatically fetches updated temperature data of Mohali every hour using Laravel's scheduler.
- ### Line Chart Visualization: 
Displays temperature data in a responsive line chart using Chart.js.

# Installation Guide
- PHP 8.2
- Laravel 11
- MySQL

### Steps to Install
- git clone <repository-url>
- composer install
- Copy the .env.example file to .env
- Update the .env file with your database credentials:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database_name
        DB_USERNAME=your_username
        DB_PASSWORD=your_password

-  Generate Application Key

       php artisan key:generate

- Run Migrations and Seed Data
    - Create the database structure and seed initial data:

            php artisan migrate
            php artisan db:seed --class=CitySeeder

- Test the Fetch Command
    - Run the custom command to fetch the temperature for Mohali:

            php artisan fetch:temperature-mohali

![test command on local](https://i.ibb.co/YdrQYMj/Screenshot-10.png)

- Set Up Task Scheduling
    - To enable automatic hourly fetching of temperature data, the following schedule is called in routes/console.php (previously before 11th version this was use to add in app/Console/Kernel.php):

            use Illuminate\Support\Facades\Schedule;

            Schedule::command('fetch:temperature-mohali')->hourly();

For Frequency Options (like hourly or others): we can check on https://laravel.com/docs/11.x/scheduling#schedule-frequency-options

#### Note: To run this laravel scheduler: 
##### we need to open the crontab file and then need to add (for hourly):

        0 * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

#### To check it manual and to run it:
###### we can see the schedule time and run like this:
       /** This will indicate Next due time **/
       php artisan schedule:list

       /** This will run the schedular
       php artisan schedule:list

![scheduler on local](https://i.ibb.co/LDK4hF4/Screenshot-9.png)

- Serve the Application
         
        php artisan serve

![After serving on local](https://i.ibb.co/GCSWHbJ/Screenshot-11.png)
