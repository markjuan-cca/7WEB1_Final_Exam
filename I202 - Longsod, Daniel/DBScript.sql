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
