Customer Orders — MySQL conversion
===================================

Target: MySQL 8.0.16 or later (recommended: current MySQL 8.0/8.4).

Files:
  01_schema.sql              Creates database and tables, indexes and constraints.
  02_views.sql               Creates MySQL-compatible views.
  customers_data.sql         Customer sample data.
  products_data.sql          Core product data; no JSON column retained.
  product_details_data.sql  Product attributes, sizes and reviews in relational tables.
  stores_data.sql            Store data.
  orders_data.sql            Order data.
  shipments_data.sql         Shipment data.
  order_items_data.sql       Order line data.
  inventory_data.sql         Inventory data.
  install_mysql.sql          Master script listing the execution order.

Recommended execution order:
  1. 01_schema.sql
  2. customers_data.sql
  3. products_data.sql
  4. product_details_data.sql
  5. stores_data.sql
  6. orders_data.sql
  7. shipments_data.sql
  8. order_items_data.sql
  9. inventory_data.sql
  10. 02_views.sql

Conversions and limitations:
- Oracle VARCHAR2 -> MySQL VARCHAR.
- Oracle NUMBER(10,2) -> DECIMAL(10,2); unconstrained NUMBER for latitude/longitude
  -> DECIMAL(10,7).
- Oracle identity columns -> AUTO_INCREMENT.
- Oracle BLOB -> LONGBLOB.
- Oracle PRODUCT_DETAILS JSON stored in a BLOB was normalized into product_details,
  product_sizes and product_reviews relational tables; no JSON column is retained.
- Oracle TO_TIMESTAMP values were converted to DATETIME(6) literals. Fractional
  seconds are truncated to six digits because MySQL DATETIME(6) supports microseconds.
- EMPTY_BLOB() values are represented as NULL; empty binary objects in this sample
  are not preserved as distinct zero-length blobs.
- Oracle LISTAGG was converted to GROUP_CONCAT.
- Oracle GROUPING SETS was rewritten as UNION ALL queries.
- Oracle SQL*Plus commands and PL/SQL block wrappers were removed from data scripts.
- Oracle-specific spatial objects, packages, triggers, stored procedures, and other
  non-portable functionality are not migrated unless explicitly represented above.

Run each file in the order above using MySQL Workbench or the mysql client.
Foreign-key constraints mean the data files must be run in the listed order.
If rerunning the installation, drop the customer_orders database first or clear
the tables in dependency order.


PRODUCT_DETAILS NORMALIZATION
------------------------------
The Oracle PRODUCT_DETAILS BLOB (JSON document) has been decomposed into:
  product_details: colour, gender, brand and description (one row per product).
  product_sizes: ordered sizes, preserving whether each original size was text or numeric.
  product_reviews: ordered reviews, rating and review text (including ratings with no review text).
No JSON column is used for these product attributes. Execute product_details_data.sql after products_data.sql.
