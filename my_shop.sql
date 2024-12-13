-- Active: 1729843604294@@localhost@8889@web
USE my_shop;
show tables;
DESCRIBE categories;
DESCRIBE products;
INSERT INTO products (name, price, category_id) VALUES
("Coombes", 2600, 1),
("Keeves Set", 590, 2),
("Nillè", 950, 3),
("Blanko", 90, 4),
("Momo", 890, 5),
("Penmillè", 120, 6),
("Kappu", 420, 5);

ALTER TABLE products
ADD color VARCHAR(255);

UPDATE products SET color = 'grey' WHERE id = 1;
UPDATE products SET color = 'white' WHERE id = 2;
UPDATE products SET color = 'brown' WHERE id = 3;
UPDATE products SET color = 'white' WHERE id = 4;
UPDATE products SET color = 'brown' WHERE id = 5;
UPDATE products SET color = 'white' WHERE id = 6;
UPDATE products SET color = 'brown' WHERE id = 7;


ALTER TABLE products
ADD collection VARCHAR(255);

UPDATE products SET collection = 'philippe stark' WHERE id = 1;
UPDATE products SET collection = 'lilly reich' WHERE id = 2;
UPDATE products SET collection = 'willy guhl' WHERE id = 3;
UPDATE products SET collection = 'charlotte perriand' WHERE id = 4;
UPDATE products SET collection = 'børge Morgensen' WHERE id = 5;
UPDATE products SET collection = 'philippe stark' WHERE id = 6;
UPDATE products SET collection = 'lilly reich' WHERE id = 7;

SELECT * FROM products;


DESCRIBE categories;

INSERT INTO categories (name) VALUES
("lounge"),
("table & chairs"),
("armchair"),
("side table"),
("shelves"),
("chair");

SELECT * FROM categories;
SELECT * FROM products;
SELECT * FROM users;


SELECT count(id) FROM users;

DESCRIBE products;

ALTER TABLE products
ADD image VARCHAR(255);

UPDATE products SET image = '/img/img1.png' WHERE id = 1;
UPDATE products SET image = '/img/img2.png' WHERE id = 2;
UPDATE products SET image = '/img/img3.png' WHERE id = 3;
UPDATE products SET image = '/img/img4.png' WHERE id = 4;
UPDATE products SET image = '/img/img5.png' WHERE id = 5;
UPDATE products SET image = '/img/img6.png' WHERE id = 6;
UPDATE products SET image = '/img/img7.png' WHERE id = 7;


ALTER TABLE users
ADD token VARCHAR(255);

DESCRIBE users;

