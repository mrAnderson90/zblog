CREATE TABLE `category` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `category_key` VARCHAR(20) NOT NULL UNIQUE,
    `category_name` VARCHAR(100) NOT NULL
);

CREATE TABLE `article` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `category` INT UNSIGNED,
    `title` VARCHAR(100) NOT NULL,
    `article` TEXT(255) NOT NULL,
    `short_article` TEXT(255),
    `is_public` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    FOREIGN KEY (`category`) REFERENCES `category`(`id`) ON DELETE CASCADE
);

CREATE TABLE `comment` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `article` INT UNSIGNED,
    `user_email` VARCHAR(50),
    `comment` TEXT(255),
    FOREIGN KEY (`article`) REFERENCES `article`(`id`) ON DELETE CASCADE
);

INSERT INTO `category` (`category_key`, `category_name`) VALUES
    ('animals', 'animals'),
    ('weekend', 'Weekend'),
    ('toys', 'Toys')
;
