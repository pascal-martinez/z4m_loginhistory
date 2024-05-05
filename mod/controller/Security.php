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
 * ZnetDK 4 Mobile Login History module Application Controller
 *
 * File version: 1.0
 * Last update: 05/04/2024
 */
namespace z4m_loginhistory\mod\controller;

use \z4m_loginhistory\mod\LoginHistoryManager;

/**
 * Security class including the loginResult() method called by the ZnetDK core
 * controller\Security class
 */
class Security extends \AppController {

    /**
     * Method called by the ZnetDK core controller\Security class each time a
     * user try to log in to the application.
     * @param array $loginInfos Informations about user attempting to log in.
     * The following array keys are set:
     * - 'login_date': date of user log in
     * - 'login_name': name specified as login name,
     * - 'ip_address': IP address of the terminal where user tried to log in
     * - 'status': boolean TRUE if user has logged in successfully, FALSE
     * otherwise
     * - 'message': error message if $loginInfos['status'] === FALSE otherwise
     * an empty string.
     */
    static public function loginResult($loginInfos) {
        try {
            LoginHistoryManager::store($loginInfos);
        } catch (\Exception $ex) {
            \General::writeErrorLog(__METHOD__, $ex->getMessage());
        }
    }
}