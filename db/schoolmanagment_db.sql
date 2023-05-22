DROP DATABASE IF EXISTS school_db;
CREATE DATABASE IF NOT EXISTS school_db;

USE school_db;

CREATE TABLE IF NOT EXISTS teachers
(
	teach_id INT NOT NULL AUTO_INCREMENT,
    teach_name VARCHAR(100),
    teach_profession VARCHAR(30),
    teach_email VARCHAR(100) NOT NULL,
    teach_phone VARCHAR(10) NOT NULL,
    
    PRIMARY KEY (teach_id)
);

CREATE TABLE IF NOT EXISTS courses
(
	cour_id INT NOT NULL AUTO_INCREMENT,
    cour_name VARCHAR(20),
    cour_date DATE NOT NULL, # Formato: YYYY-MM-DD
    cour_hour TIME NOT NULL, # Formato: 09:30:45
    teacher_id INT,    
	
    PRIMARY KEY (cour_id),
	FOREIGN KEY (teacher_id) REFERENCES teachers(teach_id) 
);