-- Insert sample data into User table
INSERT INTO User (firstname, lastname, email, username, icon, phone_number, password, is_admin)
VALUES ('admin', 'admin', 'admin@gmail.com', 'zestones', '../public/default-user-icon.png', '123456789', 'admin', 1),
       ('John', 'Doe', 'jane@example.com', 'zigmondy', '../public/default-user-icon.png', '987654321', 'qwerty123', 0);

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


-- Insert sample data into AnnounceComment table
INSERT INTO AnnounceComment (announce_id, user_id, comment, rating) 
VALUES (2, 1, "The smartphone is amazing! It has a stunning display, powerful performance, and a great camera. I highly recommend it to anyone looking for a top-notch device.", 5),
       (2, 2, "The t-shirt is super comfortable and the quality is excellent. It's my new favorite shirt!", 4),
       (2, 1, "The novel is a captivating read. The story is well-written and keeps you hooked until the very end. I couldn't put it down!", 4),
       (2, 2, "The laptop is incredibly fast and reliable. It handles multitasking with ease and the graphics are impressive.", 5),
       (2, 1, "The jeans are stylish and fit perfectly. The color is exactly as shown in the picture. I'm very happy with my purchase.", 4),
       (2, 2, "The biography is truly inspiring. It provides valuable insights into the life of a remarkable individual. Highly recommended!", 5),
       (2, 1, "The tablet is sleek and lightweight, making it perfect for on-the-go use. The screen is sharp and the battery life is impressive.", 4),
       (2, 2, "The dress is elegant and beautifully designed. It's perfect for special occasions and I received many compliments when I wore it.", 5),
       (2, 1, "The self-help book is a practical guide to personal development. It offers valuable advice and strategies for achieving personal growth.", 4),
       (2, 2, "The headphones have excellent sound quality and the wireless feature is convenient. They are comfortable to wear for extended periods of time.", 5),
       (2, 1, "The sweater is warm and cozy, perfect for cold weather. The material is soft and the fit is great. I love wearing it!", 4),
       (2, 2, "The mystery novel is a thrilling read. It kept me guessing until the very end. I highly recommend it to fans of the genre.", 5),
       (2, 1, "The smartwatch is packed with useful features. It tracks my fitness activities and keeps me connected with notifications. I'm very satisfied with it.", 4),
       (2, 2, "The jacket is stylish and versatile. It's a great addition to my wardrobe and I receive compliments whenever I wear it.", 5),
       (2, 1, "The science fiction novel is imaginative and thought-provoking. The world-building is impressive and the story is engaging from start to finish.", 4);

    -- Insert sample data into AnnounceImage table
    INSERT INTO AnnounceImage (announce_id, image)
    VALUES (1, '../public/1/announce/salade.png'),
           (1, '../public/1/announce/pomme.png'),
           (1, '../public/1/announce/choux-fleur.png'),
           (2, '../public/1/announce/salade.png'),
           (2, '../public/1/announce/pomme.png'),
           (2, '../public/1/announce/choux-fleur.png');
           