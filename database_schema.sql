-- database schema for php codeigniter 3 crud application with access permission 
-- made by free deepseek ai model and its work on php 8.3
-- Make by Md. Noirul Islam (nobin) https://x.com/livenobin

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `license_number` (`license_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `drivers` (`id`, `name`, `license_number`, `contact_number`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Driver 1',	'Driver 2',	'Driver 2',	'',	'active',	'2025-05-22 15:52:16',	'2025-05-22 15:52:16');

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `permissions` (`id`, `name`, `description`) VALUES
(1,	'view_users',	'View user list'),
(2,	'create_users',	'Create new users'),
(3,	'edit_users',	'Edit existing users'),
(4,	'delete_users',	'Delete users'),
(5,	'view_drivers',	'View driver list'),
(6,	'create_drivers',	'Create new drivers'),
(7,	'edit_drivers',	'Edit existing drivers'),
(8,	'delete_drivers',	'Delete drivers'),
(9,	'view_vehicles',	'View vehicle list'),
(10,	'create_vehicles',	'Create new vehicles'),
(11,	'edit_vehicles',	'Edit existing vehicles'),
(12,	'delete_vehicles',	'Delete vehicles'),
(13,	'view_dashboard',	'View dashboard'),
(14,	'view_roles',	'View role list'),
(15,	'create_roles',	'Create new roles'),
(16,	'edit_roles',	'Edit existing roles'),
(17,	'delete_roles',	'Delete roles'),
(18,	'manage_permissions',	'Manage role permissions');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1,	'admin',	'Administrator with full access'),
(2,	'manager',	'Manager with limited administrative access'),
(3,	'user',	'Regular user with basic access');

DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1,	1),
(1,	2),
(1,	3),
(1,	4),
(1,	5),
(1,	6),
(1,	7),
(1,	8),
(1,	9),
(1,	10),
(1,	11),
(1,	12),
(1,	13),
(1,	14),
(1,	15),
(1,	16),
(1,	17),
(1,	18),
(2,	5),
(2,	6),
(2,	7),
(2,	8),
(2,	9),
(2,	10),
(2,	11),
(2,	12),
(2,	13),
(3,	5),
(3,	9),
(3,	13);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'$2y$10$2e3AlYGglIa.krIkK/nXUuaDLCiPZ/IRFiEzvZWqr7Cjp4WlZh/MC',	'admin@example.com',	1,	'2025-05-22 15:27:35',	'2025-05-22 22:46:37'),
(2,	'nobin',	'$2y$10$O1cxgcR5in82EZ0NiC7njuUqO/xHekv5AcaSqj6UjLWYq9ssqZEFu',	'nobin@cyberbogra.com',	1,	'2025-05-22 15:51:54',	'2025-05-22 15:51:54');

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(20) NOT NULL,
  `model` varchar(50) NOT NULL,
  `make` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `color` varchar(30) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `status` enum('available','in_use','maintenance') NOT NULL DEFAULT 'available',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_number` (`registration_number`),
  KEY `driver_id` (`driver_id`),
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


