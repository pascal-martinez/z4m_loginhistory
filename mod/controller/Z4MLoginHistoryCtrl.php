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
 * File version: 1.1
 * Last update: 05/23/2024
 */

namespace z4m_loginhistory\mod\controller;

use \z4m_loginhistory\mod\LoginHistoryManager;
/**
 * Z4MLoginHistoryCtrl Application Controller class called get user login
 * history rows.
 */
class Z4MLoginHistoryCtrl extends \AppController {
    
    /**
     * Evaluates whether action is allowed or not.
     * When authentication is required, action is allowed if connected user has
     * full menu access or if has a profile allowing access to the  
     * 'z4m_loginhistory' view.
     * If no authentication is required, action is allowed if the expected view
     * menu item is declared in the 'menu.php' script of the application.
     * @param string $action Action name
     * @return Boolean TRUE if action is allowed, FALSE otherwise
     */
    static public function isActionAllowed($action) {
        $status = parent::isActionAllowed($action);
        if ($status === FALSE) {
            return FALSE;
        }
        $actionView = [
            'all' => 'z4m_loginhistory',
            'purge' => 'z4m_loginhistory'
        ];
        $menuItem = key_exists($action, $actionView) ? $actionView[$action] : NULL;
        return CFG_AUTHENT_REQUIRED === TRUE
            ? \controller\Users::hasMenuItem($menuItem) // User has right on menu item
            : \MenuManager::getMenuItem($menuItem) !== NULL; // Menu item declared in 'menu.php'
    }
    
    // Controller's actions

    /**
     * Returns the user login history. Expected POST parameters are:
     * - first: the first row number to return (for pagination purpose)
     * - rows: the number of rows to return (for pagination purpose)
     * - search_criteria: criteria to apply in JSON format. Expected properties
     * are 'status' ('0' or '1'), 'start' (W3C start date) and 'end' (W3C end
     * date).
     * @return \Response The user login history rows in JSON format.
     * The returned properties are:
     * - total: The total number of existing rows matching the search criteria
     * if specified. This number is generally greater than the number of rows
     * returned.
     * - rows: an array of objects containing history infos.
     * - success: value true on success, false in case of error.
     */
    static protected function action_all() {
        $request = new \Request();
        $first = $request->first; $count = $request->count;
        $searchCriteria = is_string($request->search_criteria) ? json_decode($request->search_criteria, TRUE) : NULL;
        $response = new \Response();
        $rowsFound = array();
        try {
            $response->total = LoginHistoryManager::getAll($first, $count, $searchCriteria, 'id DESC', $rowsFound);
            $response->rows = $rowsFound;
            $response->success = TRUE;
        } catch (\Exception $ex) {
            \General::writeErrorLog(__METHOD__, $ex->getMessage());
            $response->setFailedMessage(LC_MSG_CRI_ERR_SUMMARY, LC_MSG_CRI_ERR_GENERIC);
        }
        return $response;
    }
    
    /**
     * Purges all history or only rows matching the specified filter criteria.
     * Expected POST parameter is:
     * - search_criteria: optional criteria to apply in JSON format. Expected
     * properties are 'status' ('0' or '1'), 'start' (W3C start date) and
     * 'end' (W3C end date).
     * @return \Response Success or failed message in JSON format
     */
    static protected function action_purge() {
        $request = new \Request();
        $searchCriteria = is_string($request->search_criteria) ? json_decode($request->search_criteria, TRUE) : NULL;
        $response = new \Response();
        try {
            LoginHistoryManager::purge($searchCriteria);
            $response->setSuccessMessage(NULL, MOD_Z4M_LOGINHISTORY_PURGE_SUCCESS);
        } catch (Exception $ex) {
            \General::writeErrorLog(__METHOD__, $ex->getMessage());
            $response->setFailedMessage(LC_MSG_CRI_ERR_SUMMARY, LC_MSG_CRI_ERR_GENERIC);
        }
        return $response;
    }
}
