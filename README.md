## Author

- Brandon Traviss  

## Project Overview

This project is a web application built with PHP, HTML/CSS, and SQL, featuring two main sections:

- E-commerce Frontend (Public View): Customers can browse products, view details, and explore brand content.
- Admin Backend (Secured View): Administrators can log in to manage products with full CRUD functionality.
- All styling is custom-built using vanilla CSS.

## Technologies Used

- PHP – Server-side logic and templating
- HTML5 – Semantic structure and metadata
- CSS – Custom styling with multiple fonts
- JavaScript (ES6) – Event handling
- MySQL – Persistent storage for products and admin users

## Features

### Frontend (Public View)
- Responsive homepage, about page, contact page
- Shop page displaying all products from the database
- Single product pages with dynamic content
- Admin registration and login page

### Backend (Secured View)
- Admin login/logout with session-based access control
- Product management dashboard with:
  - Add, edit, delete products
  - Product images and validation
- Redirect to login if unauthorized access is attempted

## Setup Instructions

1. Create MySQL database (e.g., ecommerce_db)
2. Run the included SQL file to create the required tables. (Ensure the database you created is selected)
3. Setup your config.php file with your DB_NAME, DB_USERNAME, DB_PASS, DB_HOST_NAME
4. Use the register page to create Admin account to add data