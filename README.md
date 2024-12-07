# Clinica Amateus

**Clinica Amateus** is an online medical appointment booking system that allows patients to book, view, and manage their medical appointments with doctors. The platform allows users to check available doctors, available time slots, and schedule appointments accordingly.

## Features

- **Patient login**: Secure login system for patients.
- **Doctor availability**: Check available doctors and their available time slots.
- **Create appointments**: Patients can book appointments with doctors based on availability.
- **Appointment management**: View and manage upcoming and past appointments.
- **Role-based access**: Only patients can book appointments, while doctors can view their scheduled appointments.

## Prerequisites

Before running the project, make sure you have the following installed:

- **PHP 8.1 or higher**: The backend of the application is built using PHP with the Laravel framework.
- **Composer**: Dependency management for PHP.
- **MySQL or SQLite**: Database for storing user and appointment data.
- **Node.js**: Required for managing front-end assets (optional if you use Laravel Mix for frontend tasks).

## Getting Started

Follow these steps to set up and run the project on your local machine.

### 1. Clone the Repository

First, clone the repository to your local machine:
cd clinica-amateus
### 2. Install Dependencies
Run the following command to install the PHP dependencies using Composer:
composer install
npm install

### 3. Set Up the Environment
Copy the .env.example file to create your own .env file. This file contains the environment variables needed to run the application.
cp .env.example .env

Then, generate the Laravel application key:

php artisan key:generate

### 4. Configure the Database
Make sure to configure your database settings in the .env file. Set your DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD accordingly.

For example, if you're using MySQL, your .env file should look like this:
DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=3306
DB_DATABASE=name_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

### 5. Migrate the Database

Run the following Artisan command to migrate the database and create the necessary tables:
php artisan migrate

### Run the Application
php artisan serve

