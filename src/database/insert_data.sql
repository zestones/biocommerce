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
       (3, 'book_image.jpg', 'Novel', 'Best-selling novel by a renowned author', 29.99, 20, 4, 0);

-- Insert sample data into UserAnnounce table
INSERT INTO UserAnnounce (user_id, announce_id)
VALUES (1, 1),
       (2, 2);

-- Insert sample data into UserSaved table
INSERT INTO UserSaved (user_id, announce_id, quantity_selected, is_in_cart, is_in_favourite)
VALUES (1, 2, 1, 1, 0),
       (2, 1, 2, 0, 1);
