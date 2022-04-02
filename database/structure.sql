--
-- Create Database rest_school
--

CREATE DATABASE IF NOT EXISTS rest_school;

--
-- Use Database rest_school
--

USE rest_school;

--
-- Create Table schools
--

CREATE TABLE IF NOT EXISTS schools (
    school_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    school_name VARCHAR(125) NOT NULL,
    school_code VARCHAR(12) NULL DEFAULT NULL,
    school_url VARCHAR(255) NULL DEFAULT NULL,
    school_email VARCHAR(255) NULL DEFAULT NULL,
    logoURL VARCHAR(255) NULL DEFAULT NULL,
    school_telephone VARCHAR(15) NULL DEFAULT NULL,
    school_alternate_telephone VARCHAR(15) NULL DEFAULT NULL,
    addressLine1 VARCHAR(52) NULL DEFAULT NULL,
    addressLine2 VARCHAR(52) NULL DEFAULT NULL,
    addressLine3 VARCHAR(52) NULL DEFAULT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    update_log LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL CHECK (json_valid(update_log)),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

--
-- Dump Data Into Table rest_school
--

INSERT INTO schools (school_name, school_code, school_url, school_email, logoURL, school_telephone, school_alternate_telephone, addressLine1, addressLine2, addressLine3, is_active) VALUES
('Space Science Academy', 'SPSA', 'spacescience.academy', 'academics@spacescience.academy', 'https://cdn.logojoy.com/wp-content/uploads/2018/05/30154810/13_big2.png', '+1 (443) 360-0145', null, 'Suite #57 Grand Square Hotel', 'Aberdeen', 'United State', 1),
('Elton College of Fashion', 'ECF', 'eltonfashion.college', 'info@eltonfashion.college', 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/04/mcclean.jpg.jpeg?auto=format&q=60&fit=max&w=930', '+44 7723 12345', null, 'Palto Alto', 'Silicon Valley', 'United State', 1),
('Orlando Crescent Baptist High School', 'OCBH', 'orlandohigh.edu', 'students@orlandohig.edu', 'https://media.istockphoto.com/vectors/education-symbol-design-template-pencil-and-book-icon-stylized-vector-id1171617683?k=20&m=1171617683&s=612x612&w=0&h=E2wEAH0mQ2j-MT_i0sHj_6OUWoJKlD-3Pt7_Y8WhzD0=', '+1 (604) 312-1234', null, 'British Columbia Estate', 'Vancouver', 'Canada', 1),
('Space Science Academy', 'SPSA', 'spacescience.academy', 'academics@spacescience.academy', 'https://dt2sdf0db8zob.cloudfront.net/wp-content/uploads/2020/01/9-Best-School-Logos-and-How-to-Make-Your-Own-for-Free-image1.png', '+1 (443) 360-0145', null, 'Suite #57 Grand Square Hotel', 'Aberdeen', 'United State', 1),
('Sullivan International Academy', 'SIA', 'sullivanacademy.edu.ng', 'academics@spacescience.academy', 'https://penji.co/wp-content/uploads/2019/04/arlington-christian-school.jpg', '+2348123456789', null, 'Sullivan Lodge', 'Abuja', 'Federal Capital Territory Nigeria', 1),('John Steve Institute Of Technology', 'JSIT', 'johnsteve.edu.ng', 'admin@johnsteve.edu.ng', 'https://www.logodesign.net/logo-new/stars-on-private-school-shield-with-book-graduation-cap-quilt-feather-8959ld.png', '+1 (443) 360-0145', null, 'Area 1 Masaka', 'Nasarawa State', 'Nigeria', 1);