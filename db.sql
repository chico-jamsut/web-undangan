-- TABEL UNTUK ADMIN LOGIN
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert admin default (username: admin, password: 123456)
INSERT INTO admin_users (username, password)
VALUES ('admin', SHA2('123456', 256));

-- TABEL UNTUK ARTIKEL
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    image VARCHAR(255),
    content TEXT,
    list TEXT,
    quote TEXT
);
