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
 * File version: 1.5
 * Last update: 10/21/2024
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
 * Color scheme of the login history.
 * @var array|NULL Colors used to display the home menu. The expected array keys
 * are 'filter_bar', 'content', 'btn_action', 'tag' and 'icon'.
 * If NULL, the color CSS classes applied are: 'w3-theme' for 'filter_bar', 
 * 'w3-theme-light' for 'content', 'w3-theme-action' for 'btn_action',
 * 'w3-text-theme' for 'icon' and 'w3-theme' for 'tag'.
 * Example: [
 *   'filter_bar' => 'w3-theme',
 *   'content' => 'w3-theme-light',
 *   'btn_action' => 'w3-theme-action',
 *   'icon' => 'w3-text-theme',
 *   'tag' => 'w3-theme'
 * ] 
 */
define('MOD_Z4M_LOGINHISTORY_COLOR_SCHEME', NULL);

/**
 * Module version number
 * @return string Version
 */
define('MOD_Z4M_LOGINHISTORY_VERSION_NUMBER','1.5');
/**
 * Module version date
 * @return string Date in W3C format
 */
define('MOD_Z4M_LOGINHISTORY_VERSION_DATE','2024-10-21');