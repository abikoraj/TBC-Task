# Laravel Project

This is a Laravel project that includes user authentication, CRUD operations, and other functionalities.

## Requirements

- PHP >= 8.0.2
- Composer
- Node.js and npm
- MySQL (or another database supported by Laravel)

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/abikoraj/TBC-Task.git
    cd your-project
    ```

2. **Install PHP dependencies:**

    ```sh
    composer install
    ```

3. **Install Node.js dependencies:**

    ```sh
    npm install
    ```

4. **Copy the `.env.example` file to `.env`:**

    ```sh
    cp .env.example .env
    ```

5. **Generate an application key:**

    ```sh
    php artisan key:generate
    ```

6. **Configure the `.env` file:**

    Update the `.env` file with your database and other configurations. For example, if you are using SQLite, you can set the `DB_CONNECTION` to `sqlite` and specify the database path.

    ```env
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:...
    APP_DEBUG=true
    APP_URL=http://localhost

    DB_CONNECTION=sqlite
    DB_DATABASE=/path/to/database.sqlite

    # Other configurations...
    ```

7. **Run database migrations:**

    ```sh
    php artisan migrate
    ```

8. **Link the storage:**

    ```sh
    php artisan storage:link
    ```


## Running the Project

1. **Start the development server:**

    ```sh
    php artisan serve
    ```

    The application will be available at [`http://localhost:8000`].

2. **Compile assets:**

    For development:

    ```sh
    npm run dev
    ```

    For production:

    ```sh
    npm run build
    ```

## Running Tests

To run the tests, use the following command:

```sh
php artisan test