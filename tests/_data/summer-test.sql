DROP TABLE IF EXISTS users;
CREATE TABLE users(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE KEY,
    first_name VARCHAR(70),
    last_name VARCHAR(70),
    gender enum('male', 'female') DEFAULT NULL,
#     birth_date DATE,
    password_hash TINYTEXT NOT NULL
#     secret_string TINYTEXT NOT NULL,
#     settings JSON DEFAULT NULL
);