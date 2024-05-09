-- Insert sample data into User table
INSERT INTO User (firstname, lastname, email, phone_number, password, is_admin)
VALUES ('admin', 'admin', 'admin@gmail.com', '123456789', 'admin', 1),
       ('John', 'Doe', 'jane@example.com', '987654321', 'qwerty123', 0);

-- Insert sample data into Category table
INSERT INTO Category (name)
VALUES ('Electronics'),
       ('Clothing'),
       ('Books');

-- Insert sample data into Announce table
INSERT INTO Announce (id_category, image, title, description, price, quantity, rating, out_of_stock)
VALUES (1, 'electronics_image.jpg', 'Smartphone', 'Brand new smartphone with the latest features', 499.99, 10, 4, 0),
       (2, 'clothing_image.jpg', 'T-shirt', 'Casual cotton t-shirt available in multiple colors', 19.99, 50, 5, 0),
       (3, 'book_image.jpg', 'Novel', 'Best-selling novel by a renowned author', 29.99, 20, 4, 0),
       (1, 'electronics_image.jpg', 'Laptop', 'High-performance laptop for work and entertainment', 899.99, 5, 5, 1),
       (2, 'clothing_image.jpg', 'Jeans', 'Classic denim jeans for everyday wear', 39.99, 30, 4, 0),
       (3, 'book_image.jpg', 'Biography', 'Inspirational biography of a famous personality', 24.99, 15, 3, 0),
       (1, 'electronics_image.jpg', 'Tablet', 'Sleek and lightweight tablet for on-the-go use', 299.99, 8, 4, 0),
       (2, 'clothing_image.jpg', 'Dress', 'Elegant dress for special occasions', 49.99, 25, 5, 0),
       (3, 'book_image.jpg', 'Self-Help', 'Practical guide to personal development and growth', 19.99, 10, 4, 0),
       (1, 'electronics_image.jpg', 'Headphones', 'Wireless headphones with noise-cancelling technology', 99.99, 15, 4, 0),
       (2, 'clothing_image.jpg', 'Sweater', 'Warm and cozy sweater for cold weather', 29.99, 35, 5, 0),
       (3, 'book_image.jpg', 'Mystery', 'Thrilling mystery novel with unexpected twists', 14.99, 12, 4, 0),
       (1, 'electronics_image.jpg', 'Smartwatch', 'Smartwatch with fitness tracking and notifications', 149.99, 20, 4, 0),
       (2, 'clothing_image.jpg', 'Jacket', 'Stylish jacket for a fashionable look', 59.99, 40, 5, 0),
       (3, 'book_image.jpg', 'Science Fiction', 'Imaginative science fiction novel set in a futuristic world', 17.99, 8, 4, 0);

-- Insert sample data into UserAnnounce table
INSERT INTO UserAnnounce (user_id, announce_id)
VALUES (1, 1),
       (2, 2),
       (1, 3),
       (2, 4);

-- Insert sample data into UserSaved table
INSERT INTO UserSaved (user_id, announce_id, quantity_selected, is_in_cart, is_in_favourite)
VALUES (1, 2, 1, 1, 0),
       (2, 1, 2, 0, 1);
