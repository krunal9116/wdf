CREATE DATABASE food_portal;
USE food_portal;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE menu_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  price DECIMAL(8,2) NOT NULL,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  items TEXT NOT NULL, 
  total DECIMAL(10,2) NOT NULL,
  status ENUM('pending','accepted','delivered','cancelled') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


-- INSERT INTO users (name, email, password, role)
-- VALUES ('Admin User', 'admin@foodhub.test', '" . sha1('change') . "', 'admin');
INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@foodhub.test', SHA1('change'), 'admin');




INSERT INTO menu_items (title, description, price)
VALUES
('Margherita Pizza','Classic cheese & tomato',399.00),
('Veggie Burger','Grilled veg patty with lettuce & tomato',249.00);
