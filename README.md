# Simple Laravel E-Commerce

Welcome to Simple Laravel E-Commerce, your starting point for building a Laravel-based e-commerce website. This README will guide you through the setup process and provide essential information about the project.

## Getting Started

To begin, follow these steps:

1. Set up your `.env` file. Navigate to the `backend/` folder and configure your `.env` file there too. Follow the `.env.example` file for sample file contents.

2. In your `.env` file ensure you have outlined your **category plural names** and **category singular names**.

3. You'll need to configure your mailer settings in the `.env` file:

```php
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

3. Ensure you assign a database for your project. If you don't have a similar database you'll need to:

    - Run database migrations: `php artisan migrate`. If you don't have a database, it will prompt if you'd like to create one named in your `.env` file. Type `yes`.
    - Run `php artisan db:seed`

4. In your terminal, go to the project root directory and run:
    ```bash
    npm install && composer install
    ```
5. Next, navigate to the `backend/` folder and run:
    ```bash
    npm install --legacy-peer-deps
    ```
6. Return to the project root directory and execute the following commands in your terminal:
    ```bash
    php artisan serve
    npm run dev
    ```

To access the backend admin, follow these additional steps:

1. From the project root directory, navigate to the `backend/` folder.
2. Run:
    ```bash
    npm run dev
    ```

Please ensure you have PHP, Laravel, NPM, Valet, and MySQL server set up before proceeding.

## Project Goal

The goal of this project is to provide a straightforward method for setting up a Laravel Full-Stack e-commerce website.

## Deployment

...
