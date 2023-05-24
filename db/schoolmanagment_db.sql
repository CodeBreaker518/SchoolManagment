DROP DATABASE IF EXISTS school_db;
CREATE DATABASE IF NOT EXISTS school_db;

USE school_db;

CREATE TABLE IF NOT EXISTS teachers
(
	teach_id INT NOT NULL AUTO_INCREMENT,
    teach_name VARCHAR(100),
    teach_profession VARCHAR(30),
    teach_email VARCHAR(100) NOT NULL,
    teach_password VARCHAR(50) NOT NULL,
    teach_phone VARCHAR(10) NOT NULL,
    
    UNIQUE (teach_email),
    UNIQUE (teach_phone),
    PRIMARY KEY (teach_id)
);

CREATE TABLE IF NOT EXISTS students
(
	stu_id INT NOT NULL AUTO_INCREMENT,
    stu_name VARCHAR(100) NOT NULL,
    stu_email VARCHAR(100) NOT NULL,
    stu_password VARCHAR(50) NOT NULL,
	stu_phone VARCHAR(10) NOT NULL,
    
    UNIQUE (stu_email),
    UNIQUE (stu_phone),
    PRIMARY KEY (stu_id)
);

CREATE TABLE IF NOT EXISTS courses
(
	cour_id INT NOT NULL AUTO_INCREMENT,
    cour_name VARCHAR(20),
    cour_date DATE NOT NULL, # Formato: YYYY-MM-DD
    cour_hour TIME NOT NULL, # Formato: 09:30:45
    cour_teach_id INT,
    cour_stu_id INT,
    
    PRIMARY KEY (cour_id),
    CONSTRAINT fk_student
		FOREIGN KEY (cour_teach_id) 
        REFERENCES teachers(teach_id)
        ON UPDATE SET NULL
        ON DELETE SET NULL,
	CONSTRAINT fk_teacher
		FOREIGN KEY (cour_stu_id) 
        REFERENCES students(stu_id)
        ON UPDATE SET NULL
        ON DELETE SET NULL
);

