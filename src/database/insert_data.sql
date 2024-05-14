-- Insert sample data into User table
INSERT INTO User (firstname, lastname, email, username, icon, phone_number, password, is_admin)
VALUES ('Mohamed', 'Benguezzou', 'admin@gmail.com', 'admin', '../assets/insert-data/avatar/avatar-4.jpg', '123456789', 'admin', 1),
       ('John', 'Doe', 'john@example.com', 'zigmondy', '../assets/insert-data/avatar/avatar-3.webp', '987654321', 'password', 0),
       ('Alice', 'Smith', 'alice.smith@example.com', 'alice', '../assets/insert-data/avatar/avatar-1.png', '123456789', 'password', 0),
       ('Bob', 'Johnson', 'bob.johnson@example.com', 'bob', '../assets/insert-data/avatar/avatar-2.webp', '987654321', 'password', 0),
       ('Charlie', 'Brown', 'charlie.brown@example.com', 'charlie', '../assets/insert-data/avatar/avatar-5.png', '555666777', 'password', 0),
       ('David', 'Lee', 'david.lee@example.com', 'david', '../assets/insert-data/avatar/avatar-4.jpg', '333222111', 'password', 0),
       ('Emma', 'Garcia', 'emma.garcia@example.com', 'emma', '../assets/insert-data/avatar/avatar-1.png', '999888777', 'password', 0),
       ('Frank', 'Martinez', 'frank.martinez@example.com', 'frank', '../assets/insert-data/avatar/avatar-3.webp', '444555666', 'password', 0),
       ('Grace', 'Lopez', 'grace.lopez@example.com', 'grace', '../assets/insert-data/avatar/avatar-1.png', '777888999', 'password', 0),
       ('Henry', 'Perez', 'henry.perez@example.com', 'henry', '../assets/insert-data/avatar/avatar-3.webp', '111222333', 'password', 0),
       ('Isabella', 'Hernandez', 'isabella.hernandez@example.com', 'isabella', '../public/default-user-icon.png', '666555444', 'password', 0),
       ('Jack', 'Taylor', 'jack.taylor@example.com', 'jack', '../public/default-user-icon.png', '222333444', 'password', 0);

       

-- Insert sample data into Category table
INSERT INTO Category (name)
VALUES ('Fruits'),
       ('Légumes'),
       ('Céréales'),
       ('Produits laitiers'),
       ('Viandes'),
       ('Épices'),
       ('Boissons');

-- Insert sample data into Announce table
INSERT INTO Announce (id_category, image, title, description, price, quantity, rating, out_of_stock)
VALUES (7, '../assets/insert-data/announce/boisson/cafe.png', "Café Arabica", "Café Arabica de première qualité, torréfié avec soin pour une saveur riche et intense.", 5.99, 100, 3, 0),
       (7, '../assets/insert-data/announce/boisson/jus-orange.png', "Jus d'orange frais", "Jus d'orange frais pressé, riche en vitamines et en saveur. Idéal pour commencer la journée.", 2.49, 40, 4, 0),
       (6, '../assets/insert-data/announce/epices/romarin.png', 'Romarin séché', "Romarin séché bio, idéal pour aromatiser vos plats et donner une touche méditerranéenne à vos recettes.", 1.29, 75, 5, 0),
       (6, '../assets/insert-data/announce/epices/cannel.png', 'Cannelle en poudre', 'Cannelle en poudre bio, idéale pour parfumer vos pâtisseries, boissons chaudes et plats sucrés.', 1.19, 60, 2, 0),
       (6, '../assets/insert-data/announce/epices/curcuma.png', 'Curcuma moulu', 'Curcuma moulu bio, connu pour ses propriétés anti-inflammatoires et ses bienfaits pour la santé.', 1.29, 70, 3, 0),
       (6, '../assets/insert-data/announce/epices/paprika.png', 'Paprika doux', 'Paprika doux bio, idéal pour donner de la couleur et de la saveur à vos plats. Parfait pour les marinades et les grillades.', 1.09, 80, 4, 0),
       (6, '../assets/insert-data/announce/epices/poivre-noir.png', 'Poivre noir moulu', "Poivre noir moulu bio, idéal pour assaisonner vos plats et apporter une touche d'épices à vos recettes.", 1.09, 85, 4, 0),
       (5, '../assets/insert-data/announce/viandes/boeuf.png', 'Filet de boeuf bio', 'Filet de boeuf bio tendre et savoureux. Idéal pour une cuisson à la poêle, au grill ou au four.', 8.99, 20, 2, 0),
       (5, '../assets/insert-data/announce/viandes/poulet.png', 'Filet de poulet bio', 'Filet de poulet bio tendre et juteux. Parfait pour une cuisson au four, à la poêle ou au barbecue.', 6.99, 30, 3, 0),
       (4, '../assets/insert-data/announce/produits-laitier/brie.png', 'Brie français', 'Brie français crémeux et délicat. Parfait pour accompagner une planche de fromages ou pour cuisiner.', 3.99, 25, 5, 0),
       (4, '../assets/insert-data/announce/produits-laitier/roquefort.png', 'Roquefort AOP', 'Roquefort AOP français, fromage bleu au goût intense et à la texture fondante. Idéal pour les amateurs de fromages forts.', 4.49, 20, 4, 0),
       (3, '../assets/insert-data/announce/cereales/riz.png', 'Riz Basmati', 'Riz Basmati authentique, parfumé et léger. Parfait pour accompagner vos plats préférés.', 3.49, 50, 4, 0),
       (3, '../assets/insert-data/announce/cereales/avoine.png', "Flocons d'avoine", "Flocons d'avoine bio riches en fibres, idéaux pour un petit-déjeuner nutritif et énergétique.", 2.49, 40, 5, 0),
       (3, '../assets/insert-data/announce/cereales/ble.png', 'Blé complet', 'Blé complet bio, riche en nutriments et en fibres. Idéal pour accompagner vos plats et vos salades.', 1.99, 60, 2, 0),
       (3, '../assets/insert-data/announce/cereales/mais.png', 'Maïs', 'Maïs bio, idéal pour agrémenter vos salades, vos plats mexicains et vos recettes exotiques.', 1.29, 70, 1, 0),
       (2, '../assets/insert-data/announce/legumes/patate.png', 'Patate bio', 'Patate bio fraîche et polyvalente. Parfaite pour les frites, la purée ou les plats au four.', 1.19, 60, 4, 0),
       (2, '../assets/insert-data/announce/legumes/aubergine.png', 'Aubergine bio', 'Aubergine bio fraîche et savoureuse. Idéale pour préparer des plats végétariens et gourmands.', 1.79, 45, 2, 0),
       (2, '../assets/insert-data/announce/legumes/piment-rouge.png', 'Piment rouge fort', 'Piment rouge bio fort et épicé. Ajoutez du piquant à vos plats pour une explosion de saveurs.', 0.99, 55, 4, 0),
       (2, '../assets/insert-data/announce/legumes/tomate.png', 'Tomate cerise', 'Tomate cerise bio juteuse et sucrée. Parfaite pour les salades et les apéritifs.', 1.09, 70, 3, 0),
       (2, '../assets/insert-data/announce/legumes/piment-vert.png', 'Piment vert doux', 'Piment vert bio doux et aromatique. Ajoutez une touche de fraîcheur à vos plats avec ce piment.', 0.89, 65, 3, 0),
       (2, '../assets/insert-data/announce/legumes/choux-fleur.png', 'Chou-fleur bio', 'Chou-fleur bio frais et croquant. Parfait pour les gratins, les soupes et les plats au four.', 1.59, 55, 4, 0),
       (2, '../assets/insert-data/announce/legumes/concombre.png', 'Concombre bio', 'Concombre bio frais et désaltérant. Idéal pour les salades, les smoothies et les plats estivaux.', 0.99, 75, 5, 0),
       (2, '../assets/insert-data/announce/legumes/laitue-verte.png', 'Laitue verte', 'Laitue verte bio croquante et rafraîchissante. Parfaite pour les salades et les sandwichs.', 1.09, 70, 4, 0),
       (2, '../assets/insert-data/announce/legumes/poivron-vert.png', 'Poivron vert', 'Poivron vert bio croquant et sucré. Idéal pour les salades, les grillades et les plats exotiques.', 1.29, 65, 4, 0),
       (2, '../assets/insert-data/announce/legumes/salade.png', 'Salade mixte', 'Salade mixte bio fraîche et colorée. Idéale pour les salades composées et les plats équilibrés.', 1.19, 75, 3, 0),
       (1, '../assets/insert-data/announce/fruits/annanas.png', 'Ananas frais', 'Ananas frais et juteux, plein de saveur et de vitamines. Parfait pour les smoothies et les desserts.', 2.99, 30, 1, 0),
       (1, '../assets/insert-data/announce/fruits/pomme.png', 'Pomme Granny Smith', 'Pomme Granny Smith croquante et rafraîchissante, idéale pour une collation saine et délicieuse.', 0.89, 80, 0, 0),
       (1, '../assets/insert-data/announce/fruits/fraise.png', 'Fraises fraîches', 'Fraises fraîches et sucrées, pleines de saveur et de vitamines. Idéales pour les desserts et les en-cas.', 3.49, 35, 2, 0),
       (1, '../assets/insert-data/announce/fruits/poire.png', 'Poires bio', 'Poires bio juteuses et sucrées, idéales pour les desserts et les compotes. Un fruit de saison à déguster.', 1.29, 70, 0, 0),
       (1, '../assets/insert-data/announce/fruits/orange.png', 'Oranges bio', 'Oranges bio juteuses et sucrées, idéales pour les jus, les salades et les desserts. Un fruit vitaminé et rafraîchissant.', 1.09, 80, 1, 0);


-- Comments for the first announcement
INSERT INTO AnnounceComment (announce_id, user_id, comment, rating) 
VALUES (1, 1, 'Great coffee, I love it!', 5),
       (1, 3, 'Good quality coffee beans, highly recommended.', 4),
       (1, 4, 'Smooth and rich flavor, perfect for my mornings.', 5),
       (1, 5, 'Average coffee, nothing special.', 3),
       (1, 6, 'Disappointing, expected better quality.', 2),
       (1, 7, 'Great coffee, I love it!', 5),
       (1, 8, 'The best coffee I have ever tasted!', 5),
       (1, 9, 'Good quality coffee beans, highly recommended.', 4),
       (1, 10, 'Smooth and rich flavor, perfect for my mornings.', 5),
       (1, 11, 'Average coffee, nothing special.', 3),
       (1, 12, 'Disappointing, expected better quality.', 2),
       (1, 1, 'Great coffee, I love it!', 5),
       (1, 2, 'The best coffee I have ever tasted!', 5),
       (2, 1, 'Fresh and delicious orange juice!', 5),
       (2, 2, 'Perfect for breakfast, highly recommend.', 5),
       (2, 3, 'Decent taste, but a bit too expensive.', 4),
       (2, 4, 'Great taste, I buy it regularly.', 5),
       (2, 5, 'Not as fresh as expected, disappointed.', 3),
       (2, 6, 'Average taste, not worth the price.', 3),
       (3, 1, 'Love the aroma of rosemary, perfect for cooking!', 5),
       (3, 2, 'Great quality rosemary, highly recommend.', 5),
       (3, 3, 'Fresh and aromatic, enhances the flavor of dishes.', 4),
       (3, 4, 'Good product, but a bit pricey.', 4),
       (3, 5, 'Not as fresh as expected, disappointed.', 3),
       (3, 6, 'Average quality, expected better.', 3),
       (4, 1, 'Love the aroma of cinnamon, perfect for baking!', 5),
       (4, 2, 'Great quality cinnamon, highly recommend.', 5),
       (4, 3, 'Fresh and aromatic, enhances the flavor of desserts.', 4),
       (4, 4, 'Good product, but a bit pricey.', 4),
       (4, 5, 'Not as fresh as expected, disappointed.', 3),
       (4, 6, 'Average quality, expected better.', 3),
       (5, 1, 'Love the aroma of turmeric, perfect for cooking!', 5),
       (5, 2, 'Great quality turmeric, highly recommend.', 5),
       (5, 3, 'Fresh and aromatic, enhances the flavor of dishes.', 4),
       (5, 4, 'Good product, but a bit pricey.', 4),
       (5, 5, 'Not as fresh as expected, disappointed.', 3),
       (5, 6, 'Average quality, expected better.', 3),
       (6, 1, 'Love the aroma of paprika, perfect for cooking!', 5),
       (6, 2, 'Great quality paprika, highly recommend.', 5),
       (6, 3, 'Fresh and aromatic, enhances the flavor of dishes.', 4),
       (6, 4, 'Good product, but a bit pricey.', 4),
       (6, 5, 'Not as fresh as expected, disappointed.', 3),
       (6, 6, 'Average quality, expected better.', 3),
       (7, 1, 'Love the aroma of black pepper, perfect for cooking!', 5),
       (7, 2, 'Great quality black pepper, highly recommend.', 5),
       (7, 3, 'Fresh and aromatic, enhances the flavor of dishes.', 4),
       (7, 4, 'Good product, but a bit pricey.', 4),
       (7, 5, 'Not as fresh as expected, disappointed.', 3),
       (7, 6, 'Average quality, expected better.', 3),
       (8, 1, 'Tender and juicy beef, perfect for grilling!', 5),
       (8, 2, 'Great quality beef, highly recommend.', 5),
       (8, 3, 'Tender and flavorful, perfect for steaks.', 4),
       (8, 4, 'Good product, but a bit pricey.', 4),
       (8, 5, 'Not as fresh as expected, disappointed.', 3),
       (8, 6, 'Average quality, expected better.', 3),
       (9, 1, 'Tender and juicy chicken, perfect for roasting!', 5),
       (9, 2, 'Great quality chicken, highly recommend.', 5),
       (9, 3, 'Tender and flavorful, perfect for grilling.', 4),
       (9, 4, 'Good product, but a bit pricey.', 4),
       (9, 5, 'Not as fresh as expected, disappointed.', 3),
       (9, 6, 'Average quality, expected better.', 3),
       (10, 1, 'Creamy and delicate brie, perfect for cheese platters!', 5),
       (10, 2, 'Great quality brie, highly recommend.', 5),
       (10, 3, 'Creamy and flavorful, perfect for sandwiches.', 4),
       (10, 4, 'Good product, but a bit pricey.', 4),
       (10, 5, 'Not as fresh as expected, disappointed.', 3),
       (10, 6, 'Average quality, expected better.', 3),
       (11, 1, 'Intense and flavorful Roquefort, perfect for cheese lovers!', 5),
       (11, 2, 'Great quality Roquefort, highly recommend.', 5),
       (11, 3, 'Intense and creamy, perfect for salads.', 4),
       (11, 4, 'Good product, but a bit pricey.', 4),
       (11, 5, 'Not as fresh as expected, disappointed.', 3),
       (11, 6, 'Average quality, expected better.', 3),
       (12, 1, 'Fragrant and light Basmati rice, perfect for curries!', 5),
       (12, 2, 'Great quality Basmati rice, highly recommend.', 5);


-- Insert sample data into AnnounceImage table
INSERT INTO AnnounceImage (announce_id, image)
VALUES (1, '../assets/insert-data/announce/boisson/cafe.png'),
       (1, '../assets/insert-data/announce/boisson/cafe-2.jpg'),
       (1, '../assets/insert-data/announce/boisson/cafe-3.jpg'),
       (1, '../assets/insert-data/announce/boisson/cafe-4.jpg'), 
       (2, '../assets/insert-data/announce/boisson/jus-orange.png'),
       (2, '../assets/insert-data/announce/boisson/jus-orange-2.avif'),
       (2, '../assets/insert-data/announce/boisson/jus-orange-3.jpeg'),
       (2, '../assets/insert-data/announce/boisson/jus-orange-4.jpg'),
       (3, '../assets/insert-data/announce/epices/romarin.png'),
       (3, '../assets/insert-data/announce/epices/romarin-2.jpg'),
       (4, '../assets/insert-data/announce/epices/cannel.png'),
       (5, '../assets/insert-data/announce/epices/curcuma.png'),
       (6, '../assets/insert-data/announce/epices/paprika.png'),
       (7, '../assets/insert-data/announce/epices/poivre-noir.png'),
       (8, '../assets/insert-data/announce/viandes/boeuf.png'),
       (9, '../assets/insert-data/announce/viandes/poulet.png'),
       (10, '../assets/insert-data/announce/produits-laitier/brie.png'),
       (11, '../assets/insert-data/announce/produits-laitier/roquefort.png'),
       (12, '../assets/insert-data/announce/cereales/riz.png'),
       (13, '../assets/insert-data/announce/cereales/avoine.png'),
       (14, '../assets/insert-data/announce/cereales/ble.png'),
       (15, '../assets/insert-data/announce/cereales/mais.png'),
       (16, '../assets/insert-data/announce/legumes/patate.png'),
       (17, '../assets/insert-data/announce/legumes/aubergine.png'),
       (18, '../assets/insert-data/announce/legumes/piment-rouge.png'),
       (19, '../assets/insert-data/announce/legumes/tomate.png'),
       (20, '../assets/insert-data/announce/legumes/piment-vert.png'),
       (21, '../assets/insert-data/announce/legumes/choux-fleur.png'),
       (22, '../assets/insert-data/announce/legumes/concombre.png'),
       (23, '../assets/insert-data/announce/legumes/laitue-verte.png'),
       (24, '../assets/insert-data/announce/legumes/poivron-vert.png'),
       (25, '../assets/insert-data/announce/legumes/salade.png'),
       (26, '../assets/insert-data/announce/fruits/annanas.png'),
       (27, '../assets/insert-data/announce/fruits/pomme.png'),
       (28, '../assets/insert-data/announce/fruits/fraise.png'),
       (29, '../assets/insert-data/announce/fruits/poire.png'),
       (30, '../assets/insert-data/announce/fruits/orange.png');

-- Insert sample data into UserAnnounce table
INSERT INTO UserAnnounce (user_id, announce_id)
VALUES (1, 1),
       (2, 2),
       (1, 3),
       (2, 4);

-- Insert sample data into UserSaved table
INSERT INTO UserSaved (user_id, announce_id, quantity_selected, is_in_cart, is_in_favourite)
VALUES (1, 2, 3, 1, 0),
       (1, 2, 1, 0, 1),
       (1, 3, 1, 1, 1),
       (1, 4, 1, 0, 1),
       (2, 1, 2, 0, 1);


-- Insert sample data into UserTransaction table
INSERT INTO UserTransaction (user_id, product_name, quantity, price, date)
VALUES (1, 'Café Arabica', 2, 11.98, '2024-01-15 10:30:00'),
       (1, 'Jus d''orange frais', 12, 2.49, '2024-01-15 11:45:00'),
       (2, 'Romarin séché', 4, 1.29, '2024-01-16 09:30:00'),
       (2, 'Cannelle en poudre', 1, 1.19, '2024-01-16 10:15:00'),
       (1, 'Curcuma moulu', 6, 1.29, '2024-01-17 12:00:00'),
       (1, 'Paprika doux', 1, 1.09, '2024-01-17 13:30:00'),
       (2, 'Poivre noir moulu', 1, 1.09, '2024-01-18 14:45:00'),
       (2, 'Filet de boeuf bio', 1, 8.99, '2024-01-18 15:30:00'),
       (1, 'Filet de poulet bio', 1, 6.99, '2024-01-19 16:00:00'),
       (1, 'Brie français', 7, 3.99, '2024-01-19 17:30:00'),
       (1, 'Roquefort AOP', 1, 4.49, '2024-01-20 18:45:00'),
       (1, 'Riz Basmati', 8, 3.49, '2024-01-20 19:30:00'),
       (1, 'Flocons d''avoine', 1, 2.49, '2024-01-21 20:00:00'),
       (1, 'Blé complet', 6, 1.99, '2024-01-21 21:30:00'),
       (2, 'Maïs', 9, 1.29, '2024-01-22 22:45:00'),
       (2, 'Patate bio', 1, 1.19, '2024-01-22 23:30:00'),
       (1, 'Aubergine bio', 2, 1.79, '2024-01-23 00:00:00'),
       (1, 'Piment rouge fort', 1, 0.99, '2024-01-23 01:30:00'),
       (2, 'Tomate cerise', 3, 1.09, '2024-01-24 02:45:00'),
       (2, 'Piment vert doux', 1, 0.89, '2024-01-24 03:30:00'),
       (1, 'Chou-fleur bio', 4, 1.59, '2024-01-25 04:00:00'),
       (1, 'Concombre bio', 1, 0.99, '2024-01-25 05:30:00'),
       (2, 'Laitue verte', 2, 1.09, '2024-01-26 06:45:00'),
       (2, 'Poivron vert', 1, 1.29, '2024-01-26 07:30:00'),
       (1, 'Salade mixte', 3, 1.19, '2024-01-27 08:00:00'),
       (1, 'Ananas frais', 1, 2.99, '2024-01-27 09:30:00'),
       (2, 'Pomme Granny Smith', 4, 0.89, '2024-01-28 10:45:00'),
       (2, 'Fraises fraîches', 1, 3.49, '2024-01-28 11:30:00'),
       (1, 'Poires bio', 2, 1.29, '2024-01-29 12:00:00'),
       (1, 'Oranges bio', 3, 1.09, '2024-01-29 13:30:00');