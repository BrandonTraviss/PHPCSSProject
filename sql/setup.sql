CREATE TABLE products (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    imgLink VARCHAR(255) NOT NULL,
    productTitle VARCHAR(255) NOT NULL,
    productDescription VARCHAR(255),
    productPrice DECIMAL(10, 2) NOT NULL,
    productCondition ENUM('Used', 'New', 'Refurbished') NOT NULL,
    productWidth INT NOT NULL,
    productHeight INT NOT NULL,
    productDepth INT NOT NULL,
    productManufacturer VARCHAR(100) NOT NULL,
    productScreenSize INT NOT NULL,
    productScreenType ENUM('CRT', 'LCD') NOT NULL,
    productWeight INT NOT NULL
);

CREATE table users(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
