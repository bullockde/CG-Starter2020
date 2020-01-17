CREATE TABLE `tasks` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` text COLLATE utf8_unicode_ci,
 `description` text COLLATE utf8_unicode_ci,
 `hours` text COLLATE utf8_unicode_ci,
 `budget` text COLLATE utf8_unicode_ci,
 `ticket_id` int(11) DEFAULT NULL,
 `start_time` text COLLATE utf8_unicode_ci,
 `end_time` text COLLATE utf8_unicode_ci,
 `start_date` text COLLATE utf8_unicode_ci,
 `target_date` text COLLATE utf8_unicode_ci,
 `due_date` text COLLATE utf8_unicode_ci,
 `end_date` text COLLATE utf8_unicode_ci,
 `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `status` text COLLATE utf8_unicode_ci,
 `notes` text COLLATE utf8_unicode_ci,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci