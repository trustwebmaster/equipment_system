# Equipment Management System

Welcome to the Equipment Management System! This project is a full-stack application built with Laravel (backend) and  (frontend). Follow the instructions below to set up and run the project on your local machine.

## Requirements
Ensure you have the following prerequisites installed on your machine:
- PHP version **8.1** or above

## Installation

### System 

1. **Clone the Project:**
   ```bash
   git clone https://github.com/trustwebmaster/equipment_system.git
   ```

2. **Navigate to Project Directory:**
   ```bash
   cd equipment_system
   ```

3. **Install Laravel Dependencies:**
   ```bash
   composer install
   ```

4. **Create Database:**
   Create a new database for your project.

5. **Configure Environment:**
   Duplicate the .env.example file to create a new .env file.
   Open .env and set up your database connection and other configuration parameters.
   ```bash
   DB_CONNECTION=sqlite
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   ```

6. **Run  Migrations and Seed:**
   ```bash
   php artisan migrate --seed


7. **Run Laravel Project:**
   ```bash
   php artisan serve 
   
8. **User Sample Log In Details :*

## Super Admin
   ```bash
   email : superadmin@example.com
   pass : 12345678 
   ```
   
## Company  Admin
   ```bash
   email : admin@example.com
   pass : 12345678
   ```

## Regular User
   ```bash
   email : user@example.com
   pass : 12345678
```

The  Project will be accessible at http://localhost:8000.


