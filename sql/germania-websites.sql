
CREATE TABLE `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `content_file` varchar(255) DEFAULT '',
  `template` varchar(255) DEFAULT NULL,
  `dom_id` varchar(255) DEFAULT NULL,
  `is_active` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_route` (`route`),
  KEY `index_route` (`route`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
