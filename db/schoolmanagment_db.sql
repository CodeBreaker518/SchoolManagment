DROP DATABASE IF EXISTS school_db;
CREATE DATABASE IF NOT EXISTS school_db;

USE school_db;

CREATE TABLE IF NOT EXISTS teachers
(
	teach_id INT NOT NULL AUTO_INCREMENT,
    teach_name VARCHAR(100) NOT NULL, 
    teach_profession VARCHAR(30) NOT NULL,
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
    cour_name VARCHAR(20) NOT NULL,
    cour_description VARCHAR(100) NOT NULL,
    cour_semester ENUM('January-June', 'August-December') NOT NULL,
    cour_days ENUM('Lunes-Jueves','Martes-Viernes','Miercoles','Sabado') NOT NULL,
    cour_hourstart ENUM('08:00 a.m.','10:00 a.m.','12:00 p.m.','02:00 p.m.','04:00 p.m.') NOT NULL,
    cour_teach_id INT,
    
    UNIQUE(cour_name),
    PRIMARY KEY (cour_id),
	CONSTRAINT fk_teacher
		FOREIGN KEY (cour_stu_id) 
        REFERENCES students(stu_id)
        ON UPDATE SET NULL
        ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS records
(
    rec_id INT NOT NULL AUTO_INCREMENT,
    rec_cour_id INT NOT NULL,
    rec_stu_id INT NOT NULL,

    PRIMARY KEY(rec_id),
    CONSTRAINT fk_courses
        FOREIGN KEY(rec_cour_id)
        REFERENCES courses(cour_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_students
        FOREIGN KEY(rec_stu_id)
        REFERENCES students(stu_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);