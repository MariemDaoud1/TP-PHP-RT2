CREATE DATABASE students;
USE students;

CREATE TABLE students(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    date_de_naissance DATE NOT NULL,
);

INSERT INTO students (name, date_de_naissance) VALUES
('Aymen', '1982-02-07'),
('Skander', '2018-07-11');