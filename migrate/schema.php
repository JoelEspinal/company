<?php
	
	$schema= array(
		"CREATE TABLE people
		(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30) NOT NULL,
			last_name VARCHAR(30) NOT NULL,
			dob DATE NOT NULL,
			gender VARCHAR(1) NOT NULL,
			id_card VARCHAR(14),
			city VARCHAR(50) NOT NULL,
			main_address TEXT,
			phone_number VARCHAR(14)
		);"
		,
		"CREATE TABLE employees
		(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			active TINYINT(1) DEFAULT 1,
			url_img VARCHAR(100),
			code VARCHAR(5),
			title VARCHAR(20),
			salary DECIMAL(9,2),
			afp DECIMAL(2,2),
			sca DECIMAL(2,2),
			isr DECIMAL(2,2),
			person_id INT NOT NULL,
			superior_id INT,
			FOREIGN KEY (person_id) REFERENCES people(id),
			FOREIGN KEY (superior_id) REFERENCES employees(id)
		);"
		,
		"CREATE TABLE users(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			email VARCHAR(100),
			password VARCHAR(100),
			employee_id INT,
			FOREIGN KEY (employee_id) REFERENCES employees(id)
		);"
	);
?>	