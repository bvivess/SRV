-- MySQL-compatible views (MySQL 8.0+)
USE co;

CREATE OR REPLACE VIEW customer_order_products AS
SELECT o.order_id, o.order_datetime, o.order_status,
       c.customer_id, c.email_address, c.last_name, c.first_name,
       SUM(oi.quantity * oi.unit_price) AS order_total,
       GROUP_CONCAT(p.product_name ORDER BY oi.line_item_id SEPARATOR ', ') AS items
FROM orders o
JOIN order_items oi ON o.order_id = oi.order_id
JOIN customers c ON o.customer_id = c.customer_id
JOIN products p ON oi.product_id = p.product_id
GROUP BY o.order_id, o.order_datetime, o.order_status,
         c.customer_id, c.email_address, c.last_name, c.first_name;

CREATE OR REPLACE VIEW store_orders AS
SELECT 'STORE TOTAL' AS total, s.store_name,
       COALESCE(s.web_address, s.physical_address) AS address,
       s.latitude, s.longitude, NULL AS order_status,
       COUNT(DISTINCT o.order_id) AS order_count,
       SUM(oi.quantity * oi.unit_price) AS total_sales
FROM stores s JOIN orders o ON s.store_id=o.store_id
JOIN order_items oi ON o.order_id=oi.order_id
GROUP BY s.store_name, COALESCE(s.web_address, s.physical_address), s.latitude, s.longitude
UNION ALL
SELECT 'STATUS TOTAL', s.store_name,
       COALESCE(s.web_address, s.physical_address), s.latitude, s.longitude,
       o.order_status, COUNT(DISTINCT o.order_id),
       SUM(oi.quantity * oi.unit_price)
FROM stores s JOIN orders o ON s.store_id=o.store_id
JOIN order_items oi ON o.order_id=oi.order_id
GROUP BY s.store_name, COALESCE(s.web_address, s.physical_address),
         s.latitude, s.longitude, o.order_status
UNION ALL
SELECT 'ORDER STATUS TOTAL', NULL, NULL, NULL, NULL,
       o.order_status, COUNT(DISTINCT o.order_id),
       SUM(oi.quantity * oi.unit_price)
FROM orders o JOIN order_items oi ON o.order_id=oi.order_id
GROUP BY o.order_status
UNION ALL
SELECT 'GRAND TOTAL', NULL, NULL, NULL, NULL, NULL,
       COUNT(DISTINCT o.order_id), SUM(oi.quantity * oi.unit_price)
FROM orders o JOIN order_items oi ON o.order_id=oi.order_id;

CREATE OR REPLACE VIEW product_reviews_summary AS
SELECT p.product_name, r.rating,
       ROUND(AVG(r.rating) OVER (PARTITION BY p.product_name), 2) AS avg_rating,
       r.review
FROM products p
JOIN product_reviews r ON r.product_id = p.product_id;

CREATE OR REPLACE VIEW product_orders AS
SELECT p.product_name, o.order_status,
       SUM(oi.quantity * oi.unit_price) AS total_sales,
       COUNT(*) AS order_count
FROM orders o
JOIN order_items oi ON o.order_id=oi.order_id
JOIN customers c ON o.customer_id=c.customer_id
JOIN products p ON oi.product_id=p.product_id
GROUP BY p.product_name, o.order_status;
