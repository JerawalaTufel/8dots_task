# 8dots_task

## Description
Overview:

- Make a one Admin panel
- Implement simple authentication using Laravel Passport or Sanctum to protect the API.
- Admin auto seeder run (login handle with middleware).
- Admin can create, edit, and delete their users.
- Users can create, edit, and delete their own posts.
- posts can create, edit, and delete their own comments
- Implement validation and proper error messages to ensure that posts have a title and content before being saved.
- return Responce data to encryption form

## Getting Started
These instructions will help you set up and run the project on your local machine.

### Prerequisites
Ensure you have the following installed on your system:

PHP (>=8.1)

Composer

MySQL

Laravel CLI

### Installing
1. Clone the repository to your local machine:
   ```bash
   git@github.com:JerawalaTufel/8dots_task.git

2. Navigate to the project directory:
    ```bash
    cd your-project

3. Install Dependencies
    ```bash
    composer install

4. Environment Configuration
   ```bash
   cp .env.example .env

Update the .env file with your database and application settings.

5. Environment Configuration
   ```bash
   php artisan key:generate

6. Set Up Database
   ```bash
   php artisan migrate --seed

7. Run the Application
   ```bash
   php artisan serve

Visit http://127.0.0.1:8000 in your browser.

8. Login with below credentials
 ```bash
    Email : admin@admin.com
    password : password
