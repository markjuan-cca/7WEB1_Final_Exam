# PHP CRUD Operations App

This is a simple PHP CRUD application that allows you to perform **Create**, **Read**, **Update**, and **Delete** operations on a MySQL database. The app manages user records with fields such as First Name, Last Name, Email, Gender, Year, and Section.

---

## Prerequisites

Before running the application, ensure you have the following installed:

1. **Web Server**: Apache (XAMPP, WAMP, or any LAMP stack)
2. **PHP**: Version 7.4 or higher
3. **MySQL**: Database server
4. **Browser**: Any modern browser to test the app

---

## Setup Instructions

### 1. Download and Extract the Application

1. Download the ZIP file: [1202-DanielLongsod.zip](#)
2. Extract the ZIP file into your web server's root directory:
   - For XAMPP: Place the files in the `htdocs` folder (e.g., `C:/xampp/htdocs/1202-DanielLongsod`)
   - For WAMP: Place the files in the `www` folder
   - For LAMP: Place the files in `/var/www/html/`

### 2. Set Up the MySQL Database

1. Open your MySQL database tool (phpMyAdmin, MySQL CLI, etc.).
2. Run the following SQL script to create the database and `users` table:

```sql
-- Create the database
CREATE DATABASE IF NOT EXISTS testDB;

-- Use the newly created database
USE testDB;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    gender VARCHAR(20) NOT NULL,
    year INT NOT NULL,
    section VARCHAR(10) NOT NULL
);
```

3. Make sure the MySQL server is running.

---

### 3. Configure the Database Connection

1. Open the `config.php` file located in the app directory.
2. Update the database connection details if necessary:

```php
<?php
$host = "localhost";       // Change this if your database is hosted elsewhere
$username = "root";        // Default MySQL username for XAMPP/WAMP
$password = "";            // Default password is blank in XAMPP/WAMP
$dbname = "testDB";     // Database name created in step 2
?>
```

3. Save the changes.

---

### 4. Start the Application

1. Start your web server (e.g., start Apache and MySQL from XAMPP/WAMP control panel).
2. Open your browser and navigate to the following URL:

```
http://localhost/1202-DanielLongsod/index.php
```

Replace `1202-DanielLongsod` with the folder name where you extracted the files.

---

## Usage

1. **Add a New User**:

   - Click on the **"Add New User"** button.
   - Fill in the required fields and submit.

2. **View User Records**:

   - The homepage displays all user records in a table.

3. **Edit a User**:

   - Click on the **"Edit"** link next to a user record.
   - Update the fields and save.

4. **Delete a User**:
   - Click on the **"Delete"** link next to a user record.
   - Confirm the deletion.

---

## Troubleshooting

1. **Database Connection Issues**:

   - Verify that your MySQL server is running.
   - Ensure the `config.php` file has the correct database credentials.

2. **"Access Denied" or "Permission Denied" Errors**:

   - Ensure your database user has the necessary permissions.

3. **404 Not Found**:
   - Check the folder path in your browser.
   - Verify that the files are in the correct directory of your web server.

---
