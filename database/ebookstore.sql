-- Create Database
CREATE DATABASE IF NOT EXISTS ebookstore;
USE ebookstore;

-- =========================
-- TABLE: ebooks
-- =========================
DROP TABLE IF EXISTS ebooks;

CREATE TABLE ebooks (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  price INT,
  file VARCHAR(255),
  image VARCHAR(255),
  PRIMARY KEY (id)
);

-- Sample Data
INSERT INTO ebooks (id, title, price, file, image) VALUES
(8,'Soch Badlo',99,'1775500869_Soch Badlo Jindgi Badlo.pdf','1775500869_soch_badlo.jpg'),
(9,'Rich Dad Poor Dad',199,'1775586492_rich-dad-poor-dad-hindi-.pdf','1775586492_richdad.jpg'),
(10,'Jiyo To Aise Jiyo',99,'1775586586_Jiyo_To_Aise_Jiyo.pdf','1775586586_jiyo_to_aise.jpg'),
(11,'Safalta Ke Rahasya',89,'1775758122_सफलता_के_रहस्य_रमेश_मात्रे.pdf','1775758122_safalta_ke_rahasya.jpg');

-- =========================
-- TABLE: orders
-- =========================
DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
  id INT NOT NULL AUTO_INCREMENT,
  order_id VARCHAR(100),
  ebook_id INT,
  payment_status VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  download_token VARCHAR(255),
  token_expiry DATETIME,
  PRIMARY KEY (id)
);

-- Sample Data
INSERT INTO orders (id, order_id, ebook_id, payment_status, created_at, download_token, token_expiry) VALUES
(30,'ORD_1774984940266',1,'SUCCESS','2026-03-31 19:22:20',NULL,NULL),
(39,'ORD_1775588308906',9,'SUCCESS','2026-04-07 18:58:28','0e25fe9cdcd8d59483c0be97f52d896c',NULL),
(43,'ORD_1775758499332',9,'SUCCESS','2026-04-09 18:14:59',NULL,NULL);

-- =========================
-- OPTIONAL: RELATION (FOREIGN KEY)
-- =========================
ALTER TABLE orders
ADD CONSTRAINT fk_ebook
FOREIGN KEY (ebook_id) REFERENCES ebooks(id)
ON DELETE SET NULL;
