CREATE TABLE IF NOT EXISTS User (
  id INTEGER PRIMARY KEY,
  firstname VARCHAR,
  lastname VARCHAR,
  email VARCHAR,
  phone_number VARCHAR,
  password VARCHAR,
  is_admin INTEGER
);

CREATE TABLE IF NOT EXISTS Category (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

CREATE TABLE IF NOT EXISTS Announce (
  id INTEGER PRIMARY KEY,
  id_category INTEGER,
  image VARCHAR,
  title VARCHAR,
  description VARCHAR,
  price FLOAT,
  quantity INTEGER,
  rating INTEGER,
  out_of_stock BOOLEAN,
  FOREIGN KEY (id_category) REFERENCES Category(id)
);

CREATE TABLE IF NOT EXISTS UserAnnounce (
  id INTEGER PRIMARY KEY,
  user_id INTEGER,
  announce_id INTEGER,
  FOREIGN KEY (user_id) REFERENCES User(id),
  FOREIGN KEY (announce_id) REFERENCES Announce(id)
);

CREATE TABLE IF NOT EXISTS UserSaved (
  id INTEGER PRIMARY KEY,
  user_id INTEGER,
  announce_id INTEGER,
  quantity_selected INTEGER,
  is_in_cart BOOLEAN,
  is_in_favourite BOOLEAN,
  FOREIGN KEY (user_id) REFERENCES User(id),
  FOREIGN KEY (announce_id) REFERENCES Announce(id)
);
