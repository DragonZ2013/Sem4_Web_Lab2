CREATE TABLE `hotels` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(30) NOT NULL,
 `address` varchar(30) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4


CREATE TABLE `hotel_rooms` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `hotel_id` int(6) unsigned NOT NULL,
 `nightly_cost` decimal(10,2) NOT NULL DEFAULT 200.00,
 `nr_people` int(6) NOT NULL DEFAULT 1,
 `misc` varchar(255) DEFAULT NULL,
 `image` varchar(255) NOT NULL DEFAULT 'default.png',
 PRIMARY KEY (`id`),
 KEY `hotel_id` (`hotel_id`),
 CONSTRAINT `hotel_rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4


CREATE TABLE `reservations` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `id_hotel_room` int(6) unsigned DEFAULT NULL,
 `id_user` int(6) unsigned DEFAULT NULL,
 `date_start` date DEFAULT NULL,
 `date_end` date DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `id_hotel_room` (`id_hotel_room`),
 KEY `id_user` (`id_user`),
 CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_hotel_room`) REFERENCES `hotel_rooms` (`id`),
 CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4


CREATE TABLE `users` (
 `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(255) NOT NULL,
 `password_hash` varchar(255) DEFAULT NULL,
 `admin` tinyint(1) DEFAULT NULL,
 PRIMARY KEY (`ID`),
 UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4