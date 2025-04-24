USE injection_sql_basic;
CREATE TABLE Users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL
);
INSERT INTO Users (user, password) VALUES ('admin', '3NS:aw0JU%h7U~k');
