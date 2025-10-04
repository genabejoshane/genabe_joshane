-- user.sql
-- MySQL/MariaDB schema for authentication users
-- Import this file into your database, then configure DB connection in `app/config/database.php`

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(64) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','user') NOT NULL DEFAULT 'user',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: Seed an admin user (replace :BCRYPT_HASH with a bcrypt of 'admin123')
-- INSERT INTO `user` (`username`, `password_hash`, `role`) VALUES ('admin', ':BCRYPT_HASH', 'admin');
