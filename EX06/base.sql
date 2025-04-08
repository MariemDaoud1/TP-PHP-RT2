CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(50) NOT NULL,
    description TEXT
);

INSERT INTO users (username, email, role, password) VALUES
('admin1', 'admin1@example.com', 'admin', 'admin123'),
('user1', 'user1@example.com', 'user', 'user123');

INSERT INTO sections (designation, description) VALUES
('Section A', 'Première année informatique'),
('Section B', 'Deuxième année sciences');