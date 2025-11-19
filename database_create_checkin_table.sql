-- Script SQL para criar a tabela checkin
-- Execute este script no seu banco de dados MySQL

CREATE TABLE IF NOT EXISTS `checkin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_exercise` int(11) NOT NULL,
  `categoria` varchar(120) DEFAULT NULL,
  `data_checkin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user` (`id_user`),
  KEY `idx_exercise` (`id_exercise`),
  KEY `idx_data` (`data_checkin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



