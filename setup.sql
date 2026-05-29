-- Run this SQL in MySQL to set up the database

CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender VARCHAR(10),
    standard VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    age INT NOT NULL,
    email VARCHAR(150) NOT NULL,
    father_name VARCHAR(100),
    father_mobile CHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);