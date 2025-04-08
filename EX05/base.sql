-- Table users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    password VARCHAR(255) NOT NULL -- Ajouté pour l'authentification
);

-- Table sections
CREATE TABLE sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(50) NOT NULL,
    description TEXT
);

-- Table students
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birthday DATE,
    image VARCHAR(255),
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE SET NULL
);

-- Données de test
INSERT INTO users (username, email, role, password) VALUES
('Aymen', 'Aymen@example.com', 'admin', 'admin123'),
('Skander', 'Skander@example.com', 'user', 'user123');

INSERT INTO sections (designation, description) VALUES
('Section A', 'RT2'),
('Section B', 'GL2');

INSERT INTO students (name, birthday, image, section_id) VALUES
('Jean Dupont', '2000-05-15', 'images/jean.jpg', 1),
('Marie Curie', '1999-11-20', 'images/marie.jpg', 1),
('Paul Martin', '2001-03-10', 'images/paul.jpg', 2);