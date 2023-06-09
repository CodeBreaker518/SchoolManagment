DROP DATABASE IF EXISTS school_db;
CREATE DATABASE IF NOT EXISTS school_db;

USE school_db;

CREATE TABLE IF NOT EXISTS admins
(
    adm_id INT NOT NULL AUTO_INCREMENT,
    adm_name VARCHAR(100) NOT NULL,
    adm_email VARCHAR(100) NOT NULL,
    adm_password VARCHAR(100) NOT NULL,
    adm_profilepicture BLOB,

    PRIMARY KEY(adm_id)
);

CREATE TABLE IF NOT EXISTS teachers
(
	teach_id INT NOT NULL AUTO_INCREMENT,
    teach_name VARCHAR(100) NOT NULL, 
    teach_profession VARCHAR(30) NOT NULL,
    teach_email VARCHAR(100) NOT NULL,
    teach_password VARCHAR(50) NOT NULL,
    teach_phone VARCHAR(10) NOT NULL,
    teach_profilepicture BLOB,
    
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
    stu_profilepicture BLOB,

    UNIQUE (stu_email),
    UNIQUE (stu_phone),
    PRIMARY KEY (stu_id)
);

CREATE TABLE IF NOT EXISTS courses
(
	cour_id INT NOT NULL AUTO_INCREMENT,
    cour_name VARCHAR(100) NOT NULL,
    cour_description VARCHAR(100) NOT NULL,
    cour_semester ENUM('January-June', 'August-December') NOT NULL,
    cour_days ENUM('Monday-Thursday','Tuesday-Friday','Wednesday','Saturday') NOT NULL,
    cour_hourstart ENUM('08:00 a.m.','10:00 a.m.','12:00 p.m.','02:00 p.m.','04:00 p.m.') NOT NULL,
    cour_teach_id INT,
    
    UNIQUE(cour_name),
    PRIMARY KEY (cour_id),
	CONSTRAINT fk_teacher
		FOREIGN KEY (cour_teach_id) 
        REFERENCES teachers(teach_id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS records
(
    rec_id INT NOT NULL AUTO_INCREMENT,
    rec_cour_id INT NOT NULL,
    rec_stu_id INT NOT NULL,

    UNIQUE(rec_cour_id, rec_stu_id),
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

INSERT INTO admins (adm_name, adm_email, adm_password, adm_profilepicture)
VALUES('ADMIN', 'admin@admin.admin', 'root', CONVERT(FROM_BASE64('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'), BINARY));