CREATE TABLE countries(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
)

CREATE TABLE provinces(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country_id INT NOT NULL,
    FOREIGN KEY (country_id) REFERENCES countries(id)
)

CREATE TABLE locations(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    province_id INT NOT NULL,
    FOREIGN KEY (province_id) REFERENCES provinces(id)
)

CREATE TABLE stadiums(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    location_id INT NOT NULL,
    FOREIGN KEY (location_id) REFERENCES locations(id)
)