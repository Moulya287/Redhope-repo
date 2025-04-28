CREATE DATABASE IF NOT EXISTS red_hope_blood_bank;
USE red_hope_blood_bank;


CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    UNIQUE (username)
);

CREATE TABLE USER_DONATIONS (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    age INT NOT NULL CHECK (age >= 18 AND age <= 65),
    gender ENUM('Male', 'Female', 'Others') NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    preferred_date DATE NOT NULL,
    message TEXT,
    action ENUM('Approve', 'Delete') DEFAULT NULL
);
CREATE TABLE USER_REQUESTS (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    delivery_location TEXT NOT NULL,
    quantity INT NOT NULL,
    date_needed DATE NOT NULL,
    additional_info TEXT,
    action ENUM('Approve', 'Delete') DEFAULT NULL
);

CREATE TABLE APPROVED_DONATIONS (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    age INT NOT NULL CHECK (age >= 18 AND age <= 65),
    gender ENUM('Male', 'Female', 'Others') NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    blood_donated DATE NOT NULL
);
CREATE TABLE APPROVED_REQUESTS (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    delivery_location TEXT NOT NULL,
    quantity INT NOT NULL,
    delivered_date DATE NOT NULL
);

