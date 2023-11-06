-- Active: 1699032071892@@127.0.0.1@3306@ostad

-- task 1
SELECT customers.*, COUNT(orders.order_id) as Total_Order_BY_Customer FROM customers
INNER JOIN orders ON customers.id = orders.customer_id
GROUP BY orders.customer_id ORDER BY COUNT(orders.order_id) DESC;

-- task 2
SELECT c.order_id, a.name, b.quantity, c.total
FROM products a
INNER JOIN order_items b ON b.product_id = a.id
INNER JOIN orders c ON c.order_id = b.order_id
ORDER BY c.order_id ASC;

-- task 3
SELECT a.name AS category_name,SUM(c.quantity*c.unit_price) AS revenue
FROM categories a
INNER JOIN products b ON b.category_id = a.id
INNER JOIN order_items c ON c.product_id = b.id
GROUP BY b.category_id ORDER BY revenue DESC;

-- task 4
SELECT a.name AS customers,SUM(b.total) AS purchase_amount
FROM customers a
INNER JOIN orders b ON b.customer_id = a.id
GROUP BY b.customer_id ORDER BY purchase_amount DESC LIMIT 5;