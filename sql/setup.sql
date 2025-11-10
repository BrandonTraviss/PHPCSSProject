CREATE TABLE products (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    productTitle VARCHAR(255) NOT NULL,
    productDescription VARCHAR(255),
    productPrice DECIMAL(10, 2) NOT NULL,
    productCondition ENUM('Used', 'New', 'Refurbished') NOT NULL
);