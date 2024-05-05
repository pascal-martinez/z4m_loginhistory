/**
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://mobile.znetdk.fr
 * Copyright (C) 2024 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL https://www.gnu.org/licenses/gpl-3.0.html GNU GPL
 * --------------------------------------------------------------------
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * ZnetDK 4 Mobile Login History module SQL script
 *
 * File version: 1.0
 * Last update: 05/04/2024
 */

CREATE TABLE IF NOT EXISTS `zdk_user_login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Internal identifier',
  `login_date` datetime NOT NULL COMMENT 'Login date and time',
  `login_name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Login name',
  `ip_address` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IP address',
  `user_agent` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User agent',
  `status` tinyint(4) NOT NULL COMMENT 'Login status',
  `message` TEXT COLLATE utf8_unicode_ci NOT NULL COMMENT 'Error message when login failed',
  PRIMARY KEY (`id`),
  KEY `login_date` (`login_date`),
  KEY `ip_address` (`ip_address`),
  KEY `status` (`status`),
  KEY `login_name` (`login_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
