CREATE TABLE users
(
	id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(100),
	lastname VARCHAR(100),
	username VARCHAR(50),
	email VARCHAR(255),
	password VARCHAR(255),
	admin BOOLEAN DEFAULT 0,
	active BOOLEAN DEFAULT 1 
);

CREATE TABLE domains
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	picture VARCHAR(255),
	picture_path VARCHAR(255),
	description TEXT
);



CREATE TABLE resources
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	picture VARCHAR(255),
	picture_path VARCHAR(255),
	description TEXT,
	domain_id INT,
	max_duration INT unsigned DEFAULT 0,
	archive BOOLEAN DEFAULT 0,
	color VARCHAR(7),
	FOREIGN KEY (domain_id) REFERENCES domains(id) 
);

CREATE TABLE reservations 
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	is_back BOOLEAN DEFAULT 0,
	back_date DATE,
	last_mail_date DATE,
	resource_id INT NOT NULL,
	user_id INT NOT NULL,
	FOREIGN KEY (resource_id) REFERENCES resources(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE files 
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	file_path VARCHAR(255),
	resource_id INT,
	FOREIGN KEY (resource_id) REFERENCES resources(id)
	
);

CREATE TABLE configuration 
(
	name VARCHAR(255) PRIMARY KEY NOT NULL,
	home_text LONGTEXT,
	home_picture VARCHAR(255),
	home_picture_path VARCHAR(255),
	reminder_mail_object VARCHAR(255),
	reminder_mail_text LONGTEXT,
	send_mail_resa_admin BOOLEAN DEFAULT 0,
	send_mail_resa_admin_object VARCHAR(255),
	send_mail_resa_admin_text LONGTEXT DEFAULT 0,
	send_mail_edit_resa_admin BOOLEAN DEFAULT 0,
	send_mail_edit_resa_admin_object VARCHAR(255),
	send_mail_edit_resa_admin_text LONGTEXT DEFAULT 0,
	send_mail_delete_resa_admin BOOLEAN DEFAULT 0,
	send_mail_delete_resa_admin_object VARCHAR(255),
	send_mail_delete_resa_admin_text LONGTEXT DEFAULT 0,
	send_mail_resa_user BOOLEAN DEFAULT 0,
	send_mail_resa_user_object VARCHAR(255),
	send_mail_resa_user_text LONGTEXT DEFAULT 0,
	send_mail_edit_resa_user BOOLEAN DEFAULT 0,
	send_mail_edit_resa_user_object VARCHAR(255),
	send_mail_edit_resa_user_text LONGTEXT DEFAULT 0,
	send_mail_delete_resa_user BOOLEAN DEFAULT 0,
	send_mail_delete_resa_user_object VARCHAR(255),
	send_mail_delete_resa_user_text LONGTEXT DEFAULT 0,
	send_mail_back_resa_user BOOLEAN DEFAULT 0,
	send_mail_back_resa_user_object VARCHAR(255),
	send_mail_back_resa_user_text LONGTEXT DEFAULT 0,
	mail_protocol VARCHAR(255),
	mail_host VARCHAR(255),
	mail_port VARCHAR(255),
	mail_username VARCHAR(255),
	mail_password VARCHAR(255),
    open_monday BOOLEAN DEFAULT 1,
    open_tuesday BOOLEAN DEFAULT 1,
    open_wednesday BOOLEAN DEFAULT 1,
    open_thursday BOOLEAN DEFAULT 1,
    open_friday BOOLEAN DEFAULT 1,
    start_hour_monday VARCHAR(255),
	end_hour_monday VARCHAR(255),
  	start_hour_tuesday VARCHAR(255),
  	end_hour_tuesday VARCHAR(255),
  	start_hour_wednesday VARCHAR(255),
 	end_hour_wednesday VARCHAR(255),
  	start_hour_thursday VARCHAR(255),
  	end_hour_thursday VARCHAR(255),
  	start_hour_friday VARCHAR(255),
  	end_hour_friday VARCHAR(255),


);

CREATE TABLE closing_dates 
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(255), 
	start_date DATE NOT NULL,
	end_date DATE NOT NULL

);

INSERT INTO configuration (name) VALUES ('crest_default_config');