CREATE TABLE IF NOT EXISTS User (
  id INTEGER PRIMARY KEY,
  firstname TEXT,
  lastname TEXT,
  email TEXT,
  username TEXT,
  icon TEXT,
  phone_number TEXT,
  password TEXT,
  is_admin INTEGER
);

CREATE TABLE IF NOT EXISTS Category (
  id INTEGER PRIMARY KEY,
  name TEXT
);

CREATE TABLE IF NOT EXISTS Announce (
  id INTEGER PRIMARY KEY,
  id_category INTEGER,
  image TEXT,
  title TEXT,
  description TEXT,
  price FLOAT,
  quantity INTEGER,
  rating INTEGER,
  out_of_stock BOOLEAN,
  FOREIGN KEY (id_category) REFERENCES Category(id)
);

CREATE TABLE IF NOT EXISTS AnnounceComment (
  id INTEGER PRIMARY KEY,
  announce_id INTEGER,
  user_id INTEGER,
  comment TEXT,
  rating INTEGER,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (announce_id) REFERENCES Announce(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES User(id)
);

CREATE TABLE IF NOT EXISTS AnnounceImage (
  id INTEGER PRIMARY KEY,
  announce_id INTEGER,
  image TEXT,
  FOREIGN KEY (announce_id) REFERENCES Announce(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS UserAnnounce (
  id INTEGER PRIMARY KEY,
  user_id INTEGER,
  announce_id INTEGER,
  FOREIGN KEY (user_id) REFERENCES User(id),
  FOREIGN KEY (announce_id) REFERENCES Announce(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS UserSaved (
  id INTEGER PRIMARY KEY,
  user_id INTEGER,
  announce_id INTEGER,
  quantity_selected INTEGER,
  is_in_cart BOOLEAN,
  is_in_favourite BOOLEAN,
  FOREIGN KEY (user_id) REFERENCES User(id),
  FOREIGN KEY (announce_id) REFERENCES Announce(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS UserTransaction (
  id INTEGER PRIMARY KEY,
  user_id INTEGER,
  product_name TEXT,
  quantity INTEGER,
  price FLOAT,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES User(id)
);