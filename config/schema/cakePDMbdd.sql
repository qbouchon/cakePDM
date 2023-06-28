CREATE TABLE users
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(100),
	lastname VARCHAR(100),
	login VARCHAR(100),
	email VARCHAR(255),
	password VARCHAR(255)
);

CREATE TABLE domains
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	picture VARCHAR(255)
);



CREATE TABLE resources
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	picture VARCHAR(100),
	domain_id INT,
	FOREIGN KEY (domain_id) REFERENCES domains(id)
);

CREATE TABLE reservations 
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	is_back BOOLEAN DEFAULT 0,
	resource_id INT NOT NULL,
	user_id INT NOT NULL,
	FOREIGN KEY (resource_id) REFERENCES resources(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE files 
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	resource_id INT,
	FOREIGN KEY (resource_id) REFERENCES resources(id)
	
);

