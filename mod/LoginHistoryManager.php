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
 * ZnetDK 4 Mobile Login History module Manager class
 *
 * File version: 1.2
 * Last update: 08/05/2024
 */

namespace z4m_loginhistory\mod;

/**
 * ZnetDK 4 Mobile Login history managing class
 */
class LoginHistoryManager {

    /**
     * Returns user login history rows
     * @param int $first The first row number to return
     * @param int $count The number of rows to return
     * @param array $searchCriteria Filter criteria. Expected keys are 'status',
     * 'start_date' and 'end_date'.
     * @param string $sortCriteria Sort criteria
     * @param array $rowsFound
     * @return int Total number of history rows in database
     * @throws \Exception When query failed
     */
    static public function getAll($first, $count, $searchCriteria, $sortCriteria, &$rowsFound) {
        $dao = new model\LoginHistoryDAO();
        self::createModuleSqlTable($dao);
        $dao->setSortCriteria($sortCriteria);
        if (is_array($searchCriteria)) {
            $dao->applySearchCriteria($searchCriteria);
        }
        $total = $dao->getCount();
        if (!is_null($first) && !is_null($count)) {
            $dao->setLimit($first, $count);
        }
        while($row = $dao->getResult()) {
            $rowsFound[] = $row;
        }
        return $total;
    }

    /**
     * Inserts in database a new row for login history
     * @param array $loginInfos User login informations
     * @return int Internal database identifier of the added table row.
     * @throws \Exception When row insert failed
     */
    static public function store($loginInfos) {
        $dao = new model\LoginHistoryDAO();
        self::createModuleSqlTable($dao);
        $loginInfos['user_agent'] = key_exists('HTTP_USER_AGENT', $_SERVER) 
                ? \General::sanitize($_SERVER['HTTP_USER_AGENT']) : '????';
        return $dao->store($loginInfos);
    }
    
    /**
     * Purge history rows. If search criteria are set, only the matching rows
     * are removed
     * @param array $searchCriteria Filter criteria. Expected keys are 'status',
     * 'start_date' and 'end_date'.
     * @return int The number of rows removed
     */
    static public function purge($searchCriteria) {
        $dao = new model\LoginHistoryDAO();
        if (is_array($searchCriteria)) {
            $dao->applySearchCriteria($searchCriteria);
        }
        return $dao->remove(NULL);
    }

    /**
     * Create the SQL table required for the module.
     * The table is created from the SQL script defined via the
     * MOD_Z4M_LOGINHISTORY_SQL_SCRIPT_PATH constant.
     * @param DAO $dao DAO for which existence is checked
     * @throws \Exception SQL script is missing and SQL table creation failed.
     */
    static private function createModuleSqlTable($dao) {
        if ($dao->doesTableExist()) {
            return;
        }
        if (!file_exists(MOD_Z4M_LOGINHISTORY_SQL_SCRIPT_PATH)) {
            $error = "SQL script '" . MOD_Z4M_LOGINHISTORY_SQL_SCRIPT_PATH . "' is missing.";
            throw new \Exception($error);
        }
        $sqlScript = file_get_contents(MOD_Z4M_LOGINHISTORY_SQL_SCRIPT_PATH);
        $db = \Database::getApplDbConnection();
        $db->exec($sqlScript);
    }

}