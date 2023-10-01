create database if not exists ShareThoughts;
use ShareThoughts;
create table if not exists Quote(
    sno int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title varchar(255)  not null,
    description text(65530)  not null,
    tstamp DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);