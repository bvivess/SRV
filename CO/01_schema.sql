-- Customer Orders schema converted from Oracle to MySQL 8.0+
CREATE DATABASE IF NOT EXISTS co
  CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE co;

CREATE TABLE customers (
  customer_id INT NOT NULL AUTO_INCREMENT,
  email_address VARCHAR(255) NOT NULL,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  phone_number VARCHAR(25) NULL,
  address_line1 VARCHAR(255) NULL,
  city VARCHAR(100) NULL,
  state_province VARCHAR(100) NULL,
  postal_code VARCHAR(20) NULL,
  country VARCHAR(100) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (customer_id),
  UNIQUE KEY customers_email_u (email_address),
  KEY customers_name_i (last_name, first_name)
) ENGINE=InnoDB;

CREATE TABLE stores (
  store_id INT NOT NULL AUTO_INCREMENT,
  store_name VARCHAR(255) NOT NULL,
  web_address VARCHAR(100),
  physical_address VARCHAR(512),
  latitude DECIMAL(10,7),
  longitude DECIMAL(10,7),
  logo LONGBLOB,
  logo_mime_type VARCHAR(512),
  logo_filename VARCHAR(512),
  logo_charset VARCHAR(512),
  logo_last_updated DATE,
  PRIMARY KEY (store_id),
  UNIQUE KEY store_name_u (store_name),
  CONSTRAINT store_at_least_one_address_c CHECK (web_address IS NOT NULL OR physical_address IS NOT NULL)
) ENGINE=InnoDB;

CREATE TABLE products (
  product_id INT NOT NULL AUTO_INCREMENT,
  product_name VARCHAR(255) NOT NULL,
  unit_price DECIMAL(10,2),
  product_image LONGBLOB,
  image_mime_type VARCHAR(512),
  image_filename VARCHAR(512),
  image_charset VARCHAR(512),
  image_last_updated DATE,
  PRIMARY KEY (product_id)
) ENGINE=InnoDB;

-- Product attributes normalized from Oracle PRODUCT_DETAILS JSON/BLOB
CREATE TABLE product_details (
  product_id INT NOT NULL,
  colour VARCHAR(100),
  gender VARCHAR(100),
  brand VARCHAR(100),
  description TEXT,
  PRIMARY KEY (product_id),
  CONSTRAINT product_details_product_fk FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE product_sizes (
  product_id INT NOT NULL,
  size_order INT NOT NULL,
  size_value VARCHAR(50) NOT NULL,
  size_type ENUM('STRING','NUMBER') NOT NULL,
  PRIMARY KEY (product_id, size_order),
  CONSTRAINT product_sizes_product_fk FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE product_reviews (
  product_id INT NOT NULL,
  review_id INT NOT NULL,
  rating TINYINT,
  review TEXT,
  PRIMARY KEY (product_id, review_id),
  CONSTRAINT product_reviews_product_fk FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
  CONSTRAINT product_reviews_rating_ck CHECK (rating IS NULL OR rating BETWEEN 1 AND 10)
) ENGINE=InnoDB;

CREATE TABLE orders (
  order_id INT NOT NULL AUTO_INCREMENT,
  order_datetime DATETIME(6) NOT NULL,
  customer_id INT NOT NULL,
  order_status VARCHAR(10) NOT NULL,
  store_id INT NOT NULL,
  PRIMARY KEY (order_id),
  KEY orders_customer_id_i (customer_id),
  KEY orders_store_id_i (store_id),
  CONSTRAINT orders_customer_id_fk FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
  CONSTRAINT orders_store_id_fk FOREIGN KEY (store_id) REFERENCES stores(store_id),
  CONSTRAINT orders_status_c CHECK (order_status IN ('CANCELLED','COMPLETE','OPEN','PAID','REFUNDED','SHIPPED'))
) ENGINE=InnoDB;

CREATE TABLE shipments (
  shipment_id INT NOT NULL AUTO_INCREMENT,
  store_id INT NOT NULL,
  customer_id INT NOT NULL,
  delivery_address VARCHAR(512) NOT NULL,
  shipment_status VARCHAR(100) NOT NULL,
  PRIMARY KEY (shipment_id),
  KEY shipments_store_id_i (store_id),
  KEY shipments_customer_id_i (customer_id),
  CONSTRAINT shipments_store_id_fk FOREIGN KEY (store_id) REFERENCES stores(store_id),
  CONSTRAINT shipments_customer_id_fk FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
  CONSTRAINT shipment_status_c CHECK (shipment_status IN ('CREATED','SHIPPED','IN-TRANSIT','DELIVERED'))
) ENGINE=InnoDB;

CREATE TABLE order_items (
  order_id INT NOT NULL,
  line_item_id INT NOT NULL,
  product_id INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  quantity INT NOT NULL,
  shipment_id INT,
  PRIMARY KEY (order_id, line_item_id),
  UNIQUE KEY order_items_product_u (product_id, order_id),
  KEY order_items_shipment_id_i (shipment_id),
  CONSTRAINT order_items_order_id_fk FOREIGN KEY (order_id) REFERENCES orders(order_id),
  CONSTRAINT order_items_shipment_id_fk FOREIGN KEY (shipment_id) REFERENCES shipments(shipment_id),
  CONSTRAINT order_items_product_id_fk FOREIGN KEY (product_id) REFERENCES products(product_id)
) ENGINE=InnoDB;

CREATE TABLE inventory (
  inventory_id INT NOT NULL AUTO_INCREMENT,
  store_id INT NOT NULL,
  product_id INT NOT NULL,
  product_inventory INT NOT NULL,
  PRIMARY KEY (inventory_id),
  UNIQUE KEY inventory_store_product_u (store_id, product_id),
  KEY inventory_product_id_i (product_id),
  CONSTRAINT inventory_store_id_fk FOREIGN KEY (store_id) REFERENCES stores(store_id),
  CONSTRAINT inventory_product_id_fk FOREIGN KEY (product_id) REFERENCES products(product_id)
) ENGINE=InnoDB;
