<?php
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
 * Parameters of the ZnetDK 4 Mobile Login History module
 *
 * File version: 1.6
 * Last update: 10/22/2024
 */

/**
 * Path of the SQL script to update the database schema
 * @string Path of the SQL script
 */
define('MOD_Z4M_LOGINHISTORY_SQL_SCRIPT_PATH', ZNETDK_MOD_ROOT
        . DIRECTORY_SEPARATOR . 'z4m_loginhistory' . DIRECTORY_SEPARATOR
        . 'mod' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR
        . 'z4m_loginhistory.sql');

/**
 * Color scheme applied to the login history.
 * @var array|NULL Colors used to display the home menu. The expected array keys
 * are 'filter_bar', 'list_border_bottom', 'content', 'btn_action', 'tag',
 * 'icon' and 'msg_error'.
 * If NULL, default color CSS classes are applied.
 */
define('MOD_Z4M_LOGINHISTORY_COLOR_SCHEME', NULL);

/**
 * Module version number
 * @return string Version
 */
define('MOD_Z4M_LOGINHISTORY_VERSION_NUMBER','1.6');
/**
 * Module version date
 * @return string Date in W3C format
 */
define('MOD_Z4M_LOGINHISTORY_VERSION_DATE','2024-10-22');