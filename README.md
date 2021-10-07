
## Installation

Clone the repository

```bash
git clone git@github.com:KKawaGS/GSExercise.git
```
Switch to the repo folder

    cd GSExercise

Install all the dependencies using composer and npm

    composer install
    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (Set the database connection in .env before migrating)

    php artisan migrate

Run the database seeder and you're done

    php artisan db:seed

Start the local development server

    php artisan serve

## Screenshot
![Home](../main/screenshot/scs1.png)
